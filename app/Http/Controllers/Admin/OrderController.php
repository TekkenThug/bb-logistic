<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
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
        if ($request->input('role') === 'client')
            $orders = Order::where(['client_id' => auth()->id()])->get();
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

        if ($order)
            return response(['status' => 'success'], 200);

        return response([], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
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
