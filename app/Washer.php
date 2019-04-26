<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\washer
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Washer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Washer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Washer query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $user_id
 * @property int $enterprise_id
 * @property string|null $state
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Washer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Washer whereEnterpriseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Washer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Washer whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Washer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Washer whereUserId($value)
 * @property-read \App\User $user
 */
class Washer extends Model
{
    const OCUPADO = 1;
    const LIBRE = 2;

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
