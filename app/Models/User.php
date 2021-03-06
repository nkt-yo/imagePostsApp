<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Http\Request;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

        
    protected $table = 'users';
    protected $primaryKey = 'email';

    public static function findAllUserName()
    {
        $userNames = User::select('name', 'id')
                        ->orderBy('id')
                        ->paginate(15, ["*"], 'userpage')
                        ->appends(["contentpage" => \Request::get('contentpage')]);
        return $userNames;
    }

    public static function findOneUsername($userId)
    {
        $userName = User::select('name')
                        ->where('users.id', $userId)
                        ->first();
        return $userName;
    }

    public static function findRandomOneUserId()
    {
        $userId = User::inRandomOrder()
                        ->select('id')
                        ->first();

        return $userId;
    }

}
