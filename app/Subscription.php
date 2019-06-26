<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Subscription
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $plan_id
 * @property string|null $date_start
 * @property string|null $date_end
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription whereDateEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription whereDateStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription wherePlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Subscription whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Car[] $car
 * @property-read \App\Plan $plans
 */
class Subscription extends Model
{
    const ACTIVE = 1;
    const INACTIVE = 2;

    protected $fillable = [ 'plan_id', 'date_start', 'date_end'];

    public function car(){
        return $this->belongsToMany(Car::class,'car_subscriptions','subscription_id','cars_id');
    }

    public function plans(){
        return $this->belongsTo(Plan::class,'plan_id');
    }

    public function order(){
        return $this->hasOne(Order::class);
    }
}
