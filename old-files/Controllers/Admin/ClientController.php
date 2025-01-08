<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Role;
use App\Models\User;
use App\Services\PaymentService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    protected $user;
    protected $paymentService;

    public function __construct(User $user, PaymentService $paymentService)
    {
        $this->user = $user;
        $this->paymentService = $paymentService;
    }

    /**
     * Отобразить всех клиентов.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->input('name')) {
            return response([
                'clients' => $this->user
                    ->searchByName($request->input('name'), 'client')
            ]);
        }

        return response([
            'clients' => $this->user->clients(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Отобразить одного клиента
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        // Получение клиента
        $client = $this->user->find($id);

        // Действительно ли клиент
        if (!($client->hasRole() === 'client')) {
            return response([
                'status' => 'fail'
            ], 404);
        }

        // Получаем заказы, в которых он указан заказчиком
        if ($filter = $request->input('filter')) {
            $clientOrders = $client->ordersWhereParts('client', ['delivery_type' => $filter]);
        } else $clientOrders = $client->ordersWhereParts('client');

        $payments = $this->paymentService->getPayments($client->ordersWhereParts('client'), 'client');

        // Ответ
        return response([
            'status' => 'success',
            'client' => $client,
            'money' => $payments,
            'couriers' => $this->user->couriers(),
            'clientOrders' => OrderController::getFullData($clientOrders)
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Получение клиента
        $client = $this->user->find($id);

        // Действительно ли клиент
        if (!($client->hasRole() === 'client')) {
            return response([
                'status' => 'fail'
            ], 404);
        }

        // Отдача денег курьеру
        if ($request->input('payment')) {
            $orders = $client->ordersWhereParts('client');
            $this->paymentService->updatePaymentsStatus($orders, "finish");

            return response([
                'status' => 'success'
            ]);
        }

        // Проверяем, есть ли обновление поля пароля и обновляем
        if ($request['password']) {
            $upd = $client->updateUser($request, 'client', true);
        } else {
            $upd = $client->updateUser($request, 'client', false);
        }

        // Ответ
        if ($upd) return response(['status' => 'success'], 200);
        return response(['status' => 'fail'], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
