<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
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
     * @param string $role User-role (admin|user)
     * @return bool
     */
    public function hasRole($role)
    {
        return $this->role === $role;
    }

    /**
     * Returns True, if user is admin
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->hasRole("admin");
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

    // Send message to $recipient with $message
    public function sendMessage($recipient, $message, $subject)
    {
        try
        {
            return $this->sent()->create([
                'subject' => $subject,
                'body' => $message,
                'sender_id' => $this->id,
                'recipient_id' => $recipient
            ]);
        }
        catch(\Exception $ex)
        {
            throw $ex;
        }
    }

    public function download()
    {
        if ($this->isAdmin())
        {
            if(Storage::disk('local')->exists('backup.zip'))
                return Storage::download('backup.zip');
        }
        return redirect()->route()->withErrors('You are not authorized to access this resource!');
    }
}
