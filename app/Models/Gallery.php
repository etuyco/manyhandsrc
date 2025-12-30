<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'description', 
        'type', 
        'url', 
        'file_path', 
        'thumbnail',
        'event_id',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function getYoutubeThumbnailAttribute()
    {
        if ($this->type === 'video' && $this->url) {
            // Extract YouTube video ID from URL
            preg_match("/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^\"&?\/\s]{11})/", $this->url, $matches);
            if (isset($matches[1])) {
                return "https://img.youtube.com/vi/{$matches[1]}/maxresdefault.jpg";
            }
        }
        return $this->thumbnail;
    }
}
