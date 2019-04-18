<?php

use Illuminate\Database\Seeder;
use App\CarType;

class CarTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CarType::truncate();

        $car_type = new CarType;
        $car_type->name = "Campero";
        $car_type->picture = "/movil/img/tipo_vehiculo/campero.png";
        $car_type->save();

        $car_type = new CarType;
        $car_type->name = "Camioneta";
        $car_type->picture = "/movil/img/tipo_vehiculo/camioneta.png";
        $car_type->save();

        $car_type = new CarType;
        $car_type->name = "Moto Carro";
        $car_type->picture = "/movil/img/tipo_vehiculo/motocarro.png";
        $car_type->save();

        $car_type = new CarType;
        $car_type->name = "Cuatrimoto";
        $car_type->picture = "/movil/img/tipo_vehiculo/cuatrimoto.png";
        $car_type->save();

        $car_type = new CarType;
        $car_type->name = "Microbus";
        $car_type->picture = "/movil/img/tipo_vehiculo/microbus.png";
        $car_type->save();
    }
}
