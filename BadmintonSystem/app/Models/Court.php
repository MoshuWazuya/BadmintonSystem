<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Court extends Model
{
    use HasFactory;

    // specific primary key as per your ERD
    protected $primaryKey = 'court_id'; 
    
    protected $fillable = [
        'court_name',
        'court_type',
        'location',
        'status', // e.g., 'active', 'maintenance'
    ];

    // Relationship: A court has many bookings
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'court_id', 'court_id');
    }
}