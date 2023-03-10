<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reimburse extends Model
{
    use HasFactory;

    protected $fillable = [
        'approval_rate',
        'transfer_destination',
        'transfer_amount',
        'description',
        'approval_due_date',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'transfer_destination', 'id');
    }

}
