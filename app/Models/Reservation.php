<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'table_id',
        'reservation_date',
        'start_time',
        'end_time',
        'guest_count',
        'status',
        'payment_status',
        'special_note',
        'checked_in_at'
    ];


    protected $casts = [
        'reservation_date' => 'date',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
