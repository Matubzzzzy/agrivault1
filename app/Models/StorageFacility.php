<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StorageFacility extends Model
{
    use HasFactory;

    protected $table = 'storage_facilities';

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

    public function reviews()
    {
        return $this->hasMany(Review::class, 'facility_id');
    }
}
