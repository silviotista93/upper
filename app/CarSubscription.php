<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\CarSubscription
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarSubscription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarSubscription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarSubscription query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $subscription_id
 * @property int $cars_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarSubscription whereCarsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarSubscription whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarSubscription whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarSubscription whereSubscriptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CarSubscription whereUpdatedAt($value)
 */
class CarSubscription extends Model
{
    //
}
