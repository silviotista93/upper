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
use Illuminate\Support\Facades\File;


class CarController extends Controller
{
   
    #region obtener todos los carros
    public function index(Request $request)
    {
        $cars = Car::where('user_id', $request->user()->id)->with('color','cilindrajes','car_type','brand')->get();
        return response()->json(['cars' => $cars]);
    }
    #endregion

    #region Creacion de los autos
    public function createCar(Request $request)
    {
        $request->validate([
            'board'         => 'required|string|min:6|max:6|regex:/^[ A-Za-z0-9]+$/',
            'car_type_id'   => 'required',
            // 'picture'       => 'required',
            'cilindraje_id' => 'required',
            'color_id'      => 'required',
            'brand_id'      => 'required',
            'user_id'       => 'required'
        ]);
        $user = User::where('id',$request->user()->id)->first();
        // $path = $request->file('picture')->store('cars/'.$user->id);  

        $car = new Car([
            'board'         => strtoupper($request->board),
            // 'picture'       => '/storage/'. $path,
            'picture'       => '/storage/'. $request->picture,
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
        $cars = Car::where('user_id', $request->user()->id)->with('color','cilindrajes','car_type','brand','subscription.plans.wash_type')->whereHas('subscription', function ($query){
            $query->where('state', '=', 1);
        })->get();
        return response()->json(['cars' => $cars]);
    }

    public function getPlanTypeWashes(Request $request){
        $get = PlanTypeWash::where('plan_id', $request->id )->get();
        return response()->json(['plan-type-washes' => $get]);
    }
     #endregion
    
    #region Borrar Auto
    public function deleteCar(Request $request){
        // $car = Car::findOrFail($request->id);   
        // $car->delete();
        Car::destroy($request->id);
        
        $cars = Car::where('user_id', $request->user()->id)->get();
        return response()->json([
            "cars"       => $cars,
            "message"   => 'Se eliminó correctamente'
        ], 201);
    }
    #endregion

    #region Actualizar foto
    public function updatePicture(Request $request , Car $car){
        $request->validate([
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $user = User::where('id',$request->user()->id)->first();
        $car = Car::where('id',$request->id)->first();
        $image = $car->picture;

        if(\File::exists(public_path($image))){

            \File::delete(public_path($image));
            $path = $request->file('picture')->store('cars/'.$user->id.'/'.$car->id);  
            $car->picture = '/storage/'.$path;
            $car->save();
        }  else{
            $path = $request->file('picture')->store('cars/'.$user->id.'/'.$car->id);  
            $car->picture = '/storage/'.$path;
            $car->save();
        }
        return $car->picture;
    }
    #endregion

    
    public function getCar($id){
        $Car = Car::where('id', $id )->first();
        return response()->json(['car' => $Car]);
    }

    // ESAT FUNCION SE PUEDE BORRAR, SOLO ERA PRUEBA
    public function deleteImage(Request $request, Car $car){
        $user = User::where('id',$request->user()->id)->first();
        $car = Car::where('id',$request->id)->first();
        
        $image = $car->picture;
        // $name = explode("/", $image);
        // $lastElement = last($name);
       
        if(\File::exists(public_path($image))){

            \File::delete(public_path($image));
            $path = $request->file('picture')->store('cars/'.$user->id.'/'.$car->id);  
            $car->picture = '/storage/'.$path;
            $car->save();
          }
    
        else{
            dd('File does not exists.'); 
        }

        return response()->json(['image' => $car]); 
    }

    #region Actualizar auto
    public function updateCar(Request $request)
    {
        $request->validate([
            'board'         => 'required|string|min:6|max:6|regex:/^[ A-Za-z0-9]+$/',
            'car_type_id'   => 'required',
            // 'picture'       => 'required',
            'cilindraje_id' => 'required',
            'color_id'      => 'required',
            'brand_id'      => 'required',
        ]);

        $carUpdate = Car::where('id',$request->id)->update([
            'board'         => strtoupper($request->board),
            'picture'       => $request->picture,
            'car_type_id'   => $request->car_type_id,
            'cilindraje_id' => $request->cilindraje_id,
            'color_id'      => $request->color_id,
            'brand_id'      => $request->brand_id,
        ]);

        return response()->json([
            'newCar' => $carUpdate,
            'message' => 'Auto actualizado'], 201);
    }
    #endregion

    #region MAS METODOS
   
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        
    }


    public function edit($id)
    {
        //
    }

   
    public function destroy($id)
    {
        // 
    }
    #endregion
}
