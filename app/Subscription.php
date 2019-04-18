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
 */
class Subscription extends Model
{
    public function car(){
        return $this->belongsToMany(Car::class,'car_subscriptions','subscription_id','cars_id');
    }

    public function plans(){
        return $this->belongsTo(Plan::class);
    }
}
