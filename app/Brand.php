<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\brand
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Brand newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Brand newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Brand query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $picture
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Brand whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Brand whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Brand whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Brand wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Brand whereUpdatedAt($value)
 * @property-read \App\Car $car
 */
class Brand extends Model
{
    public function car(){
        return $this->hasOne(Car::class);
    }
}
