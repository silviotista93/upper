<?php

namespace App\Http\Controllers\Movil;

use App\Car;
use App\CarSubscription;
use App\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $suscripciones = CarSubscription::with('car', 'suscriptions.plans')->whereHas('car.clients', function ($query) use ($request){
            $query->where('id', '=',  $request->user()->id);
        })->orderby('updated_at','ASC')->get();
        /*=============================================
        Solicitud solamente suscripciones activas
        =============================================*/
        /*$suscripciones = CarSubscription::with('car','suscriptions.plans')
            ->whereHas('suscriptions', function ($query){
                $query->where('state', '=', 1);
            })
            ->whereHas('car.clients', function ($query) use ($request){
                $query->where('id', '=',  $request->user()->id);
            })->get();*/
        return response()->json(['suscripciones' => $suscripciones]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){

        $suscription = new Subscription([
            'plan_id'   => $request->plan_id,
            'date_start' => Carbon::now(),
            'date_end' => Carbon::now()->addMonths(2),
        ]);
        $suscription->save();
        $car_suscription = new CarSubscription([
            'subscription_id'   => $suscription->id,
            'cars_id' => $request->car_id,
        ]);
        $car_suscription->save();
        return response()->json([
            'message' => 'Creado exitosamente!'], 201);
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
        //
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
