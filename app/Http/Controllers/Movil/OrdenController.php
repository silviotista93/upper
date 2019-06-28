<?php

namespace App\Http\Controllers\Movil;

use App\CarSubscription;
use App\Order;
use App\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrdenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orden = Order::where('user_id', $request->user()->id)->with('suscription.car.brand', 'suscription.plans.wash_type','planTypeWash')->get();
        return response()->json(['orders' => $orden]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->typesWash);
        $order = new Order([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'subscription_cars_id' => $request->subscription,
            'address' => $request->address,
            'user_id' => $request->user_id,
            'description' => $request->description  

        ]);
        $order->save();
        $order->planTypeWash()->attach($request->typesWash);
        return response()->json([
            'order'     => $order,
            'message' => 'Orden creada exitosamente!'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orden = Order::where('id', $id )->with('suscription.car', 'suscription.plans', 'planTypeWash')->first();
        return response()->json(['detail-order' => $orden]);
    }

    public function  car_suscription($id)
    {
        $car_suscription = CarSubscription::where('id', $id )->with('car')->first();
        return response()->json(['car_suscription' => $car_suscription]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
