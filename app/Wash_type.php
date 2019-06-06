<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\wash_type
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wash_type newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wash_type newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wash_type query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $type
 * @property string $price
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wash_type whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wash_type whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wash_type whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wash_type wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wash_type whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Wash_type whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Plan[] $plan
 */
class Wash_type extends Model
{
    public function plan(){
        return $this->belongsToMany(Plan::class,'plan_type_washes','type_wash_id','plan_id');
    }

    public function order(){
        return $this->belongsToMany(order::class);
    }
}
