<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\plan
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plan query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $picture
 * @property string $time
 * @property float $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plan whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plan whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plan wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plan wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plan whereTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Plan whereUpdatedAt($value)
 * @property-read \App\Subscription $subscription
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Wash_type[] $wash_type
 */
class Plan extends Model
{
    public function wash_type(){
        return $this->belongsToMany(Wash_type::class, 'plan_type_washes','plan_id','type_wash_id')->withPivot('quantity');
    }

    public function subscription(){
        return $this->hasOne(Subscription::class);
    }
}
