<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'facility_id',
        'user_id',
        'username',
        'email',
        'phone',
        'slots',
        'info',
        'review_rating',
        'review_text',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function facility()
    {
        return $this->belongsTo(StorageFacility::class);
    }
}
