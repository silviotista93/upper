<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Car
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Car newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Car newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Car query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $board
 * @property string $picture
 * @property int $card_type_id
 * @property int $cilindraje_id
 * @property int $brand_id
 * @property int $color_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Car whereBoard($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Car whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Car whereCardTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Car whereCilindrajeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Car whereColorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Car whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Car whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Car wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Car whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Car whereUserId($value)
 * @property int $car_type_id
 * @property-read \App\Brand $brand
 * @property-read \App\CarType $car_type
 * @property-read \App\Cilindraje $cilindrajes
 * @property-read \App\User $clients
 * @property-read \App\Color $color
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Subscription[] $subscription
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Car whereCarTypeId($value)
 */
class Car extends Model
{
    protected $fillable = [
        'board', 'picture', 'car_type_id' ,
        'cilindraje_id', 'brand_id', 'color_id', 'user_id'
    ];

    public function clients(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function subscription(){
        return $this->belongsToMany(Subscription::class,'car_subscriptions','cars_id','subscription_id');
    }

    public function cilindrajes(){
        return $this->belongsTo(Cilindraje::class, 'cilindraje_id');
    }

    public function color(){
        return $this->belongsTo(Color::class, 'color_id');
    }

    public function car_type(){
        return $this->belongsTo(CarType::class, 'car_type_id');
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }
}
