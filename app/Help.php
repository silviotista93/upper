<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\help
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\help newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\help newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\help query()
 * @mixin \Eloquent
 * @property int $id
 * @property string|null $message
 * @property int $user_id
 * @property string|null $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\help whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\help whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\help whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\help whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\help whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\help whereUserId($value)
 * @property-read \App\User $user
 */
class help extends Model
{
    const ERROR = 1;
    const PREGUNTA = 2;
    const SEGERENCIAS = 3;
    const RECLAMOS = 4;

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
