<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\CarType
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarType query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $picture
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarType wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarType whereUpdatedAt($value)
 * @property-read \App\Car $car
 */
class CarType extends Model
{
    public function car(){
        return $this->hasOne(Car::class);
    }
}
