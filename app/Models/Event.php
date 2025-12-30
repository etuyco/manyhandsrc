<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'description', 'content', 'event_date', 'start_time', 
        'end_time', 'location', 'recurrence', 'is_active', 'is_featured', 'image'
    ];

    public function galleries()
    {
        return $this->hasMany(Gallery::class)->orderBy('sort_order');
    }
}
