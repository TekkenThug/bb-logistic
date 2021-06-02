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
     * Display a listing of the resource.
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $courier = User::find($id)->roles->name === 'courier' ? User::find($id) : null;

        if (!$courier) {
            return response([
                'status' => 'fail'
            ], 404);
        }

        $courierOrders = Order::where('courier_id', $id)->get();

        return response([
            'status' => 'success',
            'courier' => $courier,
            'courierOrders' => OrderController::getFullData($courierOrders)
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
        $courier = User::find($id);

        if ($courier->roles->name !== 'courier') {
            return response([
                'status' => 'fail',
                'data' => 'Courier not found'
            ]);
        }

        if ($request->input('comment')) {
            $courier->update(['courier_comment' => $request['comment']]);
            return response([
                'status' => 'success'
            ]);
        }

        if ($request['password']) {
            $upd = $courier->update([
                'name' => $request['name'],
                'email' => $request['email'],
                'phone_number' => $request['phone'],
                'password' => bcrypt($request['password'])
            ]);
        } else {
            $upd = $courier->update([
                'name' => $request['name'],
                'email' => $request['email'],
                'phone_number' => $request['phone'],
            ]);
        }

        if ($upd) {
            return response([
                'status' => 'success'
            ]);
        } else {
            return response([
                'status' => 'fail'
            ]);
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
        //
    }
}
