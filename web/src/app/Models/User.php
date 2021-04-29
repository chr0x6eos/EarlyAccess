<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

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
     * Marks relation with scoreboard
     *
     * @return HasMany
     */
    public function score(): HasMany
    {
        return $this->hasMany(Scoreboard::class, 'user_id');
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

    /**
     * Verifies, if $role is valid
     *
     * @param $role
     * @return bool
     */
    public function validRole($role) : bool
    {
        return $role === "admin" || $role === "user";
    }


    /**
     * Returns true, if $this (user) is sender of Message ($id)
     *
     * @param $id // ID of message
     * @return bool
     */
    public function isSender($id) : bool
    {
        $message = Message::findOrFail($id);
        return $this->id === $message->sender->id;
    }

    /**
     * Returns true, if $this (user) is recipient of Message ($id)
     *
     * @param $id // ID of message
     * @return bool
     */
    public function isRecipient($id) : bool
    {
        $message = Message::findOrFail($id);
        return $this->id === $message->recipient->id;
    }
}
