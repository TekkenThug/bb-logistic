<?php

namespace App\Http\Controllers\Admin;

use App\Events\ImportantOrderCreated;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Good;
use App\Models\Payment;
use App\Models\Role;
use App\Models\User;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class OrderController extends Controller
{
    protected $order;
    protected $paymentService;

    public function __construct(Order $order, PaymentService $paymentService)
    {
        $this->order = $order;
        $this->paymentService = $paymentService;
    }

    public static function getFullData($orders)
    {
        foreach ($orders as $order) {
            $order['goods'] = $order->goods;
            $order['client_name'] = $order->client->name;
            $order['courier_name'] = $order->courier ? $order->courier->name : "";
            $order['courier_phone'] = $order->courier ? $order->courier->phone_number : "";
        }

        return $orders;
    }

    /**
     * Отображение заказов.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Получение заказов
        $orders = $this->getFullData($this->order->getOrders($request->input('filter'), $request->input('id')));
        $payments = $this->paymentService->getPayments($orders);

        // Ответ
        return response([
            'status' => 'success',
            'orders' => $orders,
            'payments' => $payments
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $cost = 0;
        foreach ($request['products'] as $price) {
            $cost += $price['cost'] * $price['count'];
        }

        if (User::find(auth()->id())->roles->name === 'admin') {
            $order = Order::create([
                'client_id' => $request['user'],
                'courier_id' => $request['courier'],
                'status' => $request['deliveryStatus'],
                'delivery_type' => $request['deliveryType'],
                'delivery_date' => $request['date'],
                'delivery_time' => $request['time'],
                'delivery_address' => $request['address'],
                'delivery_fio' => $request['fullname'],
                'delivery_phones' => implode("\n", $request['phones']),
                'delivery_comment' => $request['comment'],
                'delivery_cost' => $cost,
                'delivery_pay' => $request['clientPay'],
            ]);
        } else {
            $order = Order::create([
                'client_id' => auth()->id(),
                'delivery_type' => $request['deliveryType'],
                'delivery_date' => $request['date'],
                'delivery_time' => $request['time'],
                'delivery_address' => $request['address'],
                'delivery_fio' => $request['fullname'],
                'delivery_phones' => implode("\n", $request['phones']),
                'delivery_comment' => $request['comment'],
                'delivery_cost' => $cost,
                'delivery_pay' => $request['clientPay'],
            ]);
        }


        if ($order) {
            $payment = new Payment;
            $order->payment()->save($payment);

            foreach ($request['products'] as $product) {
                Good::create([
                    'order_id' => $order->id,
                    'name' => $product['name'],
                    'count' => $product['count'],
                    'cost' => $product['cost']
                ]);
            }
            event(new ImportantOrderCreated($order->id));
            return response(['status' => 'success'], 200);
        }


        return response([], 500);
    }

    /**
     * Отображение одного заказа
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Получение заказа
        $order = $this->order->getOrder($id);

        // Ошибка если нет товара
        if (!$order) return response(['status' => 'fail'], 500);

        // Получение сопутствующих товаров
        $order['goods'] = $order->goods;

        // Ответ
        return response([
            'status' => 'success',
            'order' => $order
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->input('role') === 'client') {

            $cost = 0;
            foreach ($request['products'] as $price) {
                $cost += $price['cost'] * $price['count'];
            }

            $order = Order::where(['id' => $id, 'client_id' => auth()->id()])
                ->update([
                    'delivery_type' => $request['deliveryType'],
                    'delivery_date' => $request['date'],
                    'delivery_time' => $request['time'],
                    'delivery_address' => $request['address'],
                    'delivery_fio' => $request['fullname'],
                    'delivery_phones' => implode("\n", $request['phones']),
                    'delivery_comment' => $request['comment'],
                    'delivery_cost' => $cost,
                    'delivery_pay' => $request['clientPay'],
                ]);

            if ($order) {
                $order = Order::find($id);
                $order->goods()->delete();

                foreach ($request['products'] as $product) {
                    Good::create([
                        'order_id' => $order->id,
                        'name' => $product['name'],
                        'count' => $product['count'],
                        'cost' => $product['cost']
                    ]);
                }

                return response(['status' => 'success'], 200);
            }
        } else if ($request->input('role') === 'courier') {
            $order = Order::where(['id' => $id, 'courier_id' => auth()->id()])->first();

            if ($order->update(['status' => $request->input('status')])) {
                if ($request->input('status') === 'finished') {
                    $payMethod = $request->input('pay-method');
                    $order->payment()->update([
                        'paymentPos' => 'courier',
                        'isCredit' => $payMethod === 'card'
                    ]);
                }


                return response([
                    'status' => 'success'
                ], 200);
            }
        } else if ($request->input('role') === 'admin' && $request->input('fast') === 'true') {
            $order = Order::where('id', $id)
                ->update([
                    'courier_id' => $request['courier_id'],
                    'status' => 'pending'
                ]);

            if ($order) return response(['status' => 'success'], 200);
            else return response(['status' => 'fail'], 500);
        } else if ($request->input('role') === 'admin') {
            $cost = 0;
            foreach ($request['products'] as $price) {
                $cost += $price['cost'] * $price['count'];
            }

            $order = Order::where('id', $id)
                ->update([
                    'status' => $request['deliveryStatus'],
                    'client_id' => $request['user'],
                    'courier_id' => $request['courier'],
                    'delivery_type' => $request['deliveryType'],
                    'delivery_date' => $request['date'],
                    'delivery_time' => $request['time'],
                    'delivery_address' => $request['address'],
                    'delivery_fio' => $request['fullname'],
                    'delivery_phones' => implode("\n", $request['phones']),
                    'delivery_comment' => $request['comment'],
                    'delivery_cost' => $cost,
                    'delivery_pay' => $request['clientPay'],
                ]);

            if ($order) {
                $order = Order::find($id);
                $order->goods()->delete();

                if ($order->status === 'pending' || $order->status === 'not-allocated') {
                    $order->payment->update(['paymentPos' => 'start']);
                }

                foreach ($request['products'] as $product) {
                    Good::create([
                        'order_id' => $order->id,
                        'name' => $product['name'],
                        'count' => $product['count'],
                        'cost' => $product['cost']
                    ]);
                }

                return response(['status' => 'success'], 200);
            }
        }
    }

    /**
     * Удаление заказа
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->order->find($id)->delete())
            return response(['status' => 'success'], 200);

        return response(['status' => 'fail'], 500);
    }
}
