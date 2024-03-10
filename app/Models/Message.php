<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

   // In app/Models/Message.php or your relevant directory
protected $fillable = ['sender_id', 'receiver_id', 'content', 'read_at'];

}
