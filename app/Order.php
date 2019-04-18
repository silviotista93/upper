<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Order
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order query()
 * @mixin \Eloquent
 * @property int $id
 * @property float $latitude
 * @property float $longitude
 * @property string $status
 * @property string|null $sign
 * @property string|null $description
 * @property int $subscription_cars_id
 * @property int $plan_type_washes_id
 * @property int $washer_id
 * @property string $address
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order wherePlanTypeWashesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereSign($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereSubscriptionCarsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereWasherId($value)
 */
class Order extends Model
{
    const PEDIDO = 1;
    const REALIZADO = 2;
    const CANCELADO = 3;
}
