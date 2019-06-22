<?php

namespace App\Http\Controllers\Movil;

use App\Car;
use App\Brand;
use App\Color;
use App\CarType;
use App\Cilindraje;
use App\PlanTypeWash;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;


class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cars = Car::where('user_id', $request->user()->id)->with('color','cilindrajes','car_type','brand')->get();
        return response()->json(['cars' => $cars]);
    }

    #region Creacion de los autos
    public function createCar(Request $request)
    {
        $request->validate([
            'board'         => 'required|string|min:6|max:6|regex:/^[ A-Za-z0-9]+$/',
            'car_type_id'   => 'required',
            // 'picture'       => 'required|mimes:jpeg,png,jpg,gif,svg',
            'cilindraje_id' => 'required',
            'color_id'      => 'required',
            'brand_id'      => 'required',
            'user_id'       => 'required'
        ]);
        $user = User::where('id',$request->user()->id)->first();
        $path = $request->file('picture')->store('cars/'.$user->id);  

        $car = new Car([
            'board'         => strtoupper($request->board),
            'picture'       => '/storage/'. $path,
            'car_type_id'   => $request->car_type_id,
            'cilindraje_id' => $request->cilindraje_id,
            'color_id'      => $request->color_id,
            'brand_id'      => $request->brand_id,
            'user_id'       => $request->user_id,
        ]);
        $car->save();

        return response()->json([
            'car'     => $car,
            'message' => 'Creado exitosamente!'], 201);
    }
    #endregion

    #region SUBIR FOTO CARRO
    public function uploadPicture(Request $request){
       
        $request->validate([
            'picture'    => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ]);

        $user = User::where('id',$request->user()->id)->first();

        // $file = new Filesystem;
        // $file->cleanDirectory('storage/cars/'.$user->id);

        $path = $request->file('picture')->store('cars/'.$user->id);  
        $path = str_replace("/","\\",$path);

        return $path;
    }
    #endregion
    
    #region Marcas, colores, cilindajes...
    public function getBrands(Request $request){
        $brands = Brand::all();
        return response()->json(['brands' => $brands]);
    }

    public function getColors(Request $request){
        $colors = Color::all();
        return response()->json(['colors' => $colors]);
    }
    public function getTypeCar(Request $request){
        $carType = CarType::all();
        return response()->json(['carTypes' => $carType]);
    }

    public function getCilindraje(Request $request){
        $cilindraje = Cilindraje::all();
        return response()->json(['cilindrajes' => $cilindraje]);
    }

    public function getCarPlans(Request $request){
        $cars = Car::where('user_id', $request->user()->id)->with('color','cilindrajes','car_type','brand','subscription.plans.wash_type')->get();
        return response()->json(['cars' => $cars]);
    }

    public function getPlanTypeWashes(Request $request){
        $get = PlanTypeWash::where('plan_id', $request->id )->get();
        return response()->json(['plan-type-washes' => $get]);
    }
     #endregion
    
    #region Borrar Auto
    public function deleteCar(Request $request){
        $car = Car::findOrFail($request->id);   
        $car->delete();
        
        $cars = Car::where('user_id', $request->user()->id)->get();
        return response()->json([
            "cars"       => $cars,
            "message"   => 'Se eliminó correctamente'
        ], 201);
    }
    #endregion

    public function getCar($id){
        $Car = Car::where('id', $id )->first();
        return response()->json(['car' => $Car]);
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

    }
}
