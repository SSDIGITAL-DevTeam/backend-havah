<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GroupChat extends Model
{
    use HasFactory;

    protected $table = "group_chats";
    protected $guarded = ['id'];

    public function members() : HasMany
    {
        return $this->hasMany(Member::class, 'id_group');
    }

    public function chats() : HasMany
    {
        return $this->hasMany(Chat::class, 'id_group');
    }

}
