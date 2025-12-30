<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_id',
        'nominal_deposit',
        'payment_method',
        'status_payment',
        'payment_date',
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
