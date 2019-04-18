<?php

use Illuminate\Database\Seeder;
use  \App\cilindraje;

class CilindrajesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cilindraje::truncate();

        $cilindraje = new Cilindraje;
        $cilindraje->name = "< 1500 CC";
        $cilindraje->picture = "/movil/img/cilindrajes/<_1500_CC.png";
        $cilindraje->save();

        $cilindraje = new Cilindraje;
        $cilindraje->name = ">= 1500 CC";
        $cilindraje->picture = "/movil/img/cilindrajes/>=_1500_CC.png";
        $cilindraje->save();

        $cilindraje = new Cilindraje;
        $cilindraje->name = "> 2500 CC";
        $cilindraje->picture = "/movil/img/cilindrajes/>_2500_CC.png";
        $cilindraje->save();

        $cilindraje = new Cilindraje;
        $cilindraje->name = "3000 CC";
        $cilindraje->picture = "/movil/img/cilindrajes/3000_CC.png";
        $cilindraje->save();

        $cilindraje = new Cilindraje;
        $cilindraje->name = "3500 CC";
        $cilindraje->picture = "/movil/img/cilindrajes/3500_CC.png";
        $cilindraje->save();
    }
}
