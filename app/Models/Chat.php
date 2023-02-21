<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chat extends Model
{
    use HasFactory;
    protected $table = "chats";
    protected $guarded = ['id'];

    public function user() : BelongsTo 
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function group_chats() : BelongsTo
    {
        return $this->belongsTo(GroupChat::class, 'id_group');
    }

}
