<?php

namespace App\Http\Controllers\Movil;

use App\Car;
use App\CarSubscription;
use App\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = Plan::with('wash_type')->get();
        return response()->json(['plans' => $plans]);
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
        $plan = Plan::where('id', $id)->with('wash_type')->first();
        return response()->json(['plan' => $plan]);
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

    public function getCarSuscription ($id){
        $car = Car::where('id', $id)->with('brand')->first();
        return response()->json(['car' => $car]);
    }
    public function getPlanSuscription ($id){
        $plan = Plan::where('id', $id)->with('wash_type')->first();
        return response()->json(['plan' => $plan]);
    }
    public function getCarsPlans(Request $request) {
        $cars = Car::where('user_id', $request->user()->id)->with('color','cilindrajes','car_type','brand')->whereDoesntHave('subscription')->get();
        return response()->json(['cars' => $cars]);
    }
}
