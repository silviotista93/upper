<?php

use Illuminate\Database\Seeder;
use  \App\Wash_type;

class WashTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Wash_type::truncate();

        $wach_type = new Wash_type;
        $wach_type->type = "Lavado Basico";
        $wach_type->price = 12000;
        $wach_type->description = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took";
        $wach_type->save();

        $wach_type = new Wash_type;
        $wach_type->type = "Lavado Exterior";
        $wach_type->price = 14000;
        $wach_type->description = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took";
        $wach_type->save();

        $wach_type = new Wash_type;
        $wach_type->type = "Lavado Motor";
        $wach_type->price = 15000;
        $wach_type->description = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took";
        $wach_type->save();

        $wach_type = new Wash_type;
        $wach_type->type = "Lavado Interior";
        $wach_type->price = 10000;
        $wach_type->description = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took";
        $wach_type->save();

        $wach_type = new Wash_type;
        $wach_type->type = "Polishada";
        $wach_type->price = 9000;
        $wach_type->description = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took";
        $wach_type->save();
    }
}
