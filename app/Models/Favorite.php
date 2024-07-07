<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'facility_id'];

    public function facility()
    {
        return $this->belongsTo(StorageFacility::class, 'facility_id');
    }
}
