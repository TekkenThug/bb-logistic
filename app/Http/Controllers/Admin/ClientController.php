<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->input('name')) {
            $parametr = $request->input('name');
            $clients = Role::where('name', 'client')
                ->first()
                ->users()
                ->where('name', 'LIKE', "%{$parametr}%")
                ->get();
        } else
            $clients = Role::where('name', 'client')->first()->users;

        return response([
            'clients' => $clients,
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
    public function show($id, Request $request)
    {
        $client = User::find($id)->roles->name === 'client' ? User::find($id) : null;

        if (!$client) {
            return response([
                'status' => 'fail'
            ], 404);
        }

        if ($filter = $request->input('filter')) {
            $clientOrders = Order::where(['client_id' => $id, 'delivery_type' => $filter])->get();
        } else $clientOrders = Order::where('client_id', $id)->get();


        return response([
            'status' => 'success',
            'client' => $client,
            'couriers' => User::where('role_id', 3)->get(),
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
        $client = User::find($id);

        if ($client->roles->name !== 'client') {
            return response([
                'status' => 'fail',
                'data' => 'Client not found'
            ]);
        }

        if ($request['password']) {
            $upd = $client->update([
                'name' => $request['name'],
                'email' => $request['email'],
                'delivery_address' => $request['address'],
                'password' => bcrypt($request['password'])
            ]);
        } else {
            $upd = $client->update([
                'name' => $request['name'],
                'email' => $request['email'],
                'delivery_address' => $request['address'],
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
