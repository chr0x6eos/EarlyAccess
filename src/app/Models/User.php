<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
     * @param string $role // User-role (admin|user)
     * @return bool
     */
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    /**
     * Returns True, if user is admin
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->hasRole("admin");
    }

    /**
     * Returns all send messages
     *
     * @return HasMany
     */
    public function sent(): HasMany
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    /**
     * Returns all received messages
     *
     * @return HasMany
     */
    public function received(): HasMany
    {
        return $this->hasMany(Message::class, 'recipient_id');
    }

    /**
     * Sends message to $recipient with $message
     *
     * @param $recipient //ID of user to send to
     * @param string $message //Message body
     * @param string $subject //Message subject
     * @return Model
     */
    public function sendMessage($recipient, string $message, string $subject): Model
    {
        return $this->sent()->create([
            'subject' => $subject,
            'body' => $message,
            'sender_id' => $this->id,
            'recipient_id' => $recipient
        ]);
    }

    public function download()
    {
        if ($this->isAdmin())
        {
            if(Storage::disk('local')->exists('backup.zip'))
                return Storage::download('backup.zip');
            else
                return redirect()->route('admin.index')->withErrors('Critical ERROR: Backup file not found!');
        }
        else
            return redirect()->route('dashboard')->withErrors('You are not authorized to access this resource!');
    }

    public function verify_key($key): bool
    {
        //TODO: Implement verification algorithm
        if($key == "TEST-GAME-KEY")
            return true;

        return false;
    }

    public function isSender($id) : bool
    {
        $message = Message::findOrFail($id);
        return $this->id === $message->sender->id;
    }

    public function isRecipient($id) : bool
    {
        $message = Message::findOrFail($id);
        return $this->id === $message->recipient->id;
    }
}
