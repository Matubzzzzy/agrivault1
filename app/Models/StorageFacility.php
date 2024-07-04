<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StorageFacility extends Model
{
    use HasFactory;

    // Add the fillable property to allow mass assignment on these fields
    protected $fillable = [
        'name',
        'location',
        'description',
        'contacts',
        'county', 
        'slots_available', 
        'image'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'facility_id');
    }
}
