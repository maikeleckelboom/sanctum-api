<?php

namespace App\Models;

use App\Notifications\VerificationNoticeNotification;
use App\Notifications\VerificationSuccessNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @method static where(string $string, mixed $email)
 * @method static create(array $array)
 * @method static findOrFail(int|string|null $id)
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $with = [
        'address',
    ];


    /**
     * Get the address for the user.
     **/
    public function address(): MorphOne
    {
        return $this->morphOne(Address::class, 'addressable');
    }


    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerificationNoticeNotification());
    }

    public function sendEmailVerifiedNotification()
    {
        $this->notify(new VerificationSuccessNotification());
    }

}
