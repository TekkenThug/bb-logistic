<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Good;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->input('id') && $request->input('role') === 'client') {
            $orders = Order::where(['client_id' => auth()->id()])
                ->where('id', 'LIKE', "%{$request->input('id')}%")
                ->get();
        } else if ($request->input('role') === 'client') {
            $orders = Order::where(['client_id' => auth()->id()])->get();

            foreach ($orders as $order) {
                $order['goods'] = $order->goods;
            }

            return response(['orders' => $orders], 200);
        }

        else
            $orders = Order::all();

        return response(['orders' => $orders], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cost = 0;
        foreach ($request['products'] as $price) {
            $cost += $price['cost'] * $price['count'];
        }

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

        if ($order) {
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


        return response([], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        if ($request->input('role') == 'client') {
            $order = Order::where(['id' => $id, 'client_id' => auth()->id()])->first();

            if (!$order) {
                return response([
                    'status' => 'fail'
                ], 501);
            }

            $order['goods'] = $order->goods;
            return response([
                'status' => 'success',
                'order' => $order
            ]);
        }
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
        if ($request->input('role') === 'client') {

            $cost = 0;
            foreach ($request['products'] as $price) {
                $cost += $price['cost'] * $price['count'];
            }

            $order = Order::where(['id' => $id,'client_id' => auth()->id()])
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
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);

        if ($order->delete()) {
            return response([
                'status' => 'success'
            ]);
        } else {
            return response([
                'status' => 'fail'
            ]);
        }
    }


}
