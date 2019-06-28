<?php

namespace App;

use App\Notifications\ResetPasswordNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

/**
 * App\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $names
 * @property string|null $last_name
 * @property string|null $picture
 * @property string|null $phone_1
 * @property string|null $phone_2
 * @property string $state
 * @property string|null $slug
 * @property string|null $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePhone1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePhone2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @property string|null $avatar
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Car[] $car
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read \App\Enterprise $enterprise
 * @property-read \App\help $help
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Role[] $roles
 * @property-read \App\UserSocialAccount $socialAcounts
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @property-read \App\Washer $washer
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereAvatar($value)
 */
class User extends Authenticatable
{
    const ACTIVE = 1;
    const INACTIVE = 2;
    use Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'names' ,'last_name', 'email', 'password','slug','avatar','phone_1','phone_2'
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getRouteKeyName(){
        return 'slug';
    }

    public function setNamesAttribute($valor){
        $this->attributes['names'] = strtolower($valor);
    }

    public function getNamesAttribute($valor){
        return ucwords($valor);
    }

    public function setLast_NameAttribute($valor){
        $this->attributes['last_name'] = strtolower($valor);
    }

    public function getLast_NameAttribute($valor){
        return ucwords($valor);
    }


    public function roles(){
        return $this->belongsToMany(Role::class,'roles_users','users_id','roles_id');
    }

    public function socialAcounts(){
        return $this->hasOne(UserSocialAccount::class);
    }

    public function car(){
        return $this->hasMany(Car::class);
    }
    public function enterprise(){
        return $this->hasOne(Enterprise::class);
    }

    public function help(){
        return $this->hasOne(help::class);
    }

    public function washer(){
        return $this->hasOne(Washer::class);
    }
}
