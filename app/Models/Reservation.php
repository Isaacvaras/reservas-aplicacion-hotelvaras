<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    protected $fillable = [
        'guest_name',
        'room_id',
        'check_in',
        'check_out',
        'nights',
        'total_amount',
    ];
    protected $casts = [
        'check_in' => 'datetime',
        'check_out' => 'datetime',
    ];


    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }
}
