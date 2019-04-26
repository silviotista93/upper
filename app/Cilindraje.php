<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\cilindraje
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Cilindraje newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\cilindraje newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\cilindraje query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $picture
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Cilindraje whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Cilindraje whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Cilindraje whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Cilindraje wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Cilindraje whereUpdatedAt($value)
 * @property-read \App\Car $car
 */
class Cilindraje extends Model
{
    public function car(){
        return $this->hasOne(Car::class);
    }
}
