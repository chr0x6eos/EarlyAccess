<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['body', 'recipient_id', 'sender_id'];

    // Return sender of message
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    // Return recipient of message
    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }
}
