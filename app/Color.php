<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\color
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Color newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Color newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Color query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $picture
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Color whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Color whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Color whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Color wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Color whereUpdatedAt($value)
 * @property-read \App\Car $car
 */
class Color extends Model
{
    public function car(){
        return $this->hasOne(Car::class);
    }
}
