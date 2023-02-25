<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';

    protected $guarded = ['id'];


    protected function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    protected function group() : BelongsTo
    {
        return $this->belongsTo(GroupChat::class, 'id_group');
    }

}
