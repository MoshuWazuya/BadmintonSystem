<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';
    protected $primaryKey = 'booking_id';
    public $incrementing = true;

    protected $fillable = [
        'user_id',
        'court_id',
        'booking_date',
        'start_time',
        'end_time',
        'status',
        'qr_code',
        'checked_in',
    ];

    protected static function booted()
    {
        static::creating(function ($booking) {
            if (!$booking->qr_code) {
                $booking->qr_code = (string) Str::uuid();
            }
        });
    }

    public function court()
    {
        return $this->belongsTo(Court::class, 'court_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

