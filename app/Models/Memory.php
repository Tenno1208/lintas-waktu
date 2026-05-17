<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Memory extends Model
{
    protected $fillable = [
    'title', 'category', 'event_date', 'story', 'location', 'photos', 'height_mdpl', 'gpx_track'
    ];

    protected $casts = [
        'photos' => 'array',
        'event_date' => 'date'
    ];
}