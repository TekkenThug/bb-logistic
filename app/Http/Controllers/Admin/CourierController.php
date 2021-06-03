<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class CourierController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Отобразить всех курьеров
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->input('name')) {
            return response([
                'couriers' => $this->user
                    ->searchByName($request->input('name'), 'courier')
            ]);
        }

        return response([
            'couriers' => $this->user->couriers(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Отобразить одного курьера
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Получение курьера
        $courier = $this->user->find($id);

        // Действительно ли это курьер
        if (!($courier->hasRole() === 'courier')) {
            return response([
                'status' => 'fail'
            ], 404);
        }

        // Получаем заказы, в которых он указан исполнителем
        $courierOrders = $courier->ordersWhereParts('courier');

        // Возврат курьера и связанных с ним заявок
        return response([
            'status' => 'success',
            'courier' => $courier,
            'courierOrders' => OrderController::getFullData($courierOrders)
        ], 200);
    }

    /**
     * Обновить данные курьера
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Получение курьера
        $courier = $this->user->find($id);

        // Действительно ли курьер
        if (!($courier->hasRole() === 'courier')) {
            return response([
                'status' => 'fail',
            ], 500);
        }

        // Добавляем комментарий, если он есть
        if ($request->input('comment')) {
            $courier->update(['courier_comment' => $request['comment']]);
            return response([
                'status' => 'success'
            ]);
        }

        // Проверяем, есть ли обновление поля пароля и обновляем
        if ($request['password']) {
            $upd = $courier->updateUser($request, 'courier', true);
        } else {
            $upd = $courier->updateUser($request, 'courier', false);
        }

        // Ответ
        if ($upd) return response(['status' => 'success']);
        return response(['status' => 'fail'], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
