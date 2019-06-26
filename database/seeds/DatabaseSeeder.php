<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Storage::deleteDirectory('cars');
        Storage::deleteDirectory('plans');
        Storage::deleteDirectory('users');


        Storage::makeDirectory('cars');
        Storage::makeDirectory('plans');
        Storage::makeDirectory('users');

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $this->call(BrandTableSeeder::class);
        $this->call(CilindrajesTableSeeder::class);
        $this->call(ColorsTableSeeder::class);
        $this->call(CarTypeTableSeeder::class);
        $this->call(WashTypeTableSeeder::class);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        /*=============================================
        CREANDO LOS ROLES PARA LOS USUARIOS
        =============================================*/

        factory(\App\Role::class, 1)->create(['rol' => 'Admin']);
        factory(\App\Role::class, 1)->create(['rol' => 'Lavador']);
        factory(\App\Role::class, 1)->create(['rol' => 'Cliente']);
        factory(\App\Role::class, 1)->create(['rol' => 'Empresa']);

        /*=============================================
             CREANDO UN USUARIO ADMINISTRADOR DEL SISTEMA
        =============================================*/

        factory(\App\User::class, 1)->create([
            'names' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('secret'),
            'slug' => Str::slug('admin' . mt_rand(1, 10000), '-')
        ])->each(function (\App\User $u) {
            $u->roles()->attach(['1']);
        });

        /*=============================================
          CREANDO 50 CLIENTES EN LA BASE DE DATOS
         =============================================*/

        factory(\App\User::class, 70)->create([
        ])->each(function (\App\User $u) {
            $u->roles()->attach(['3']);
        });

        /*=============================================
        CREANDO 5 EMPRESARIOS POR DEFECTO Y LE ESTAMOS ASIGNANDO UNA UNA EMPRESA
        =============================================*/

        factory(\App\User::class, 5)->create()
            ->each(function (\App\User $u) {
                factory(\App\Enterprise::class, 1)->create(['user_id' => $u->id])->each(function (\App\Enterprise $e) {
                    factory(\App\User::class, 2)->create()->each(function (\App\User $l) use ($e) {
                        factory(\App\Washer::class, 1)->create(['user_id' => $l->id, 'enterprise_id' => $e->id]);
                        $l->roles()->attach(['2']);
                    });
                });
                $u->roles()->attach(['4']);
            });

        /*=============================================
        CREANDO 50 CARROS ASIGNADOS A UN CLIENTE
        =============================================*/
        factory(\App\Plan::class, 4)->create()
        ->each(function (\App\Plan $p){
            factory(\App\PlanTypeWash::class, rand(1, 2))->create(['plan_id' => $p->id]);
        });

        /*=============================================
        CREANDO 50 CARROS ASIGNADOS A UN CLIENTE
        =============================================*/
        factory(\App\Car::class, 50)->create()
        ->each(function (\App\Car $car){
            factory(\App\Subscription::class, 1)->create()->each(function (\App\Subscription $s) use ($car){
                $s->car()->attach($car->id);
            });
        });
        factory(\App\Car::class, 20)->create();
    }
}



