<?php

namespace App\Models;

use App\Models\StorageFacility;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'user_id', 
        'facility_id', 
        'rating', 
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
