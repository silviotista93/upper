<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Enterprise
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Enterprise newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Enterprise newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Enterprise query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $nit
 * @property string $phone
 * @property string $address
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Enterprise whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Enterprise whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Enterprise whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Enterprise whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Enterprise whereNit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Enterprise wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Enterprise whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Enterprise whereUserId($value)
 * @property-read \App\User $user
 */
class Enterprise extends Model
{
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
