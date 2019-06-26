<?php

use Illuminate\Database\Seeder;
use \App\Color;

class ColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Color::truncate();

        $color = new Color;
        $color->name = "Amarillo";
        $color->picture = "/movil/img/colores/amarillo.png";
        $color->save();

        $color = new Color;
        $color->name = "Azul Bandera";
        $color->picture = "/movil/img/colores/azul_bandera.png";
        $color->save();

        $color = new Color;
        $color->name = "Azul";
        $color->picture = "/movil/img/colores/azul.png";
        $color->save();

        $color = new Color;
        $color->name = "Blanco";
        $color->picture = "/movil/img/colores/blanco.png";
        $color->save();

        $color = new Color;
        $color->name = "Morado";
        $color->picture = "/movil/img/colores/morado.png";
        $color->save();


        $color = new Color;
        $color->name = "Naranja";
        $color->picture = "/movil/img/colores/naranja.png";
        $color->save();

        $color = new Color;
        $color->name = "Negro";
        $color->picture = "/movil/img/colores/negro.png";
        $color->save();

        $color = new Color;
        $color->name = "Gris";
        $color->picture = "/movil/img/colores/gris.png";
        $color->save();

        $color = new Color;
        $color->name = "Rojo";
        $color->picture = "/movil/img/colores/rojo.png";
        $color->save();

        $color = new Color;
        $color->name = "Verde";
        $color->picture = "/movil/img/colores/verde.png";
        $color->save();
    }
}
