<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Court extends Model
{
    use HasFactory;

    protected $primaryKey = 'court_id';
    protected $fillable = ['court_name', 'court_type', 'location', 'status'];

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'court_id');
    }
}

