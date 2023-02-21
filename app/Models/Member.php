<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Member extends Model
{
    use HasFactory;

    protected $table = "members";
    protected $guarded = ['id'];

    public function group_chats() : BelongsTo
    {
        return $this->belongsTo(GroupChat::class, 'id_group');
    }

    public function users() : BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

}
