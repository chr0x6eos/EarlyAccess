<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

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
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
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
     * The attributes that should be cast to native types.
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

    /**
     * Returns True, if user is part of $role
     *
     * @param string $role User-role (admin|user|api)
     * @return bool
     */
    public function hasRole($role)
    {
        return $this->role === $role;
    }

     // All send messages
     public function sent()
     {
         return $this->hasMany(Message::class, 'sender_id');
     }

     // All received messages
     public function received()
     {
         return $this->hasMany(Message::class, 'recipient_id');
     }


    public function sendMessage($recipient, $message)
    {
        return $this->sent()->create([
            'body'       => $message,
            'sender_id' => $this->id,
            'recipient_id' => $recipient,
        ]);
    }
}
