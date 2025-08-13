<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriVideo extends Model
{
    use HasFactory;

    protected $table = 'materi_video';

    protected $fillable = [
        'materi_id',
        'judul',
        'deskripsi',
        'youtube_url',
        'youtube_id',
        'urutan',
        'status'
    ];

    protected $casts = [
        'urutan' => 'integer',
    ];

    /**
     * Relasi ke Materi
     */
    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }

    /**
     * Get YouTube Video ID dari URL
     */
    public function getYoutubeIdAttribute($value)
    {
        if ($value) {
            return $value;
        }

        // Parse YouTube URL untuk mendapatkan video ID
        $url = $this->youtube_url;
        if (preg_match('/youtube\.com\/watch\?v=([^&]+)/', $url, $matches)) {
            return $matches[1];
        } elseif (preg_match('/youtu\.be\/([^?]+)/', $url, $matches)) {
            return $matches[1];
        }

        return null;
    }

    /**
     * Get YouTube Embed URL
     */
    public function getEmbedUrlAttribute()
    {
        $videoId = $this->youtube_id;
        if ($videoId) {
            return "https://www.youtube.com/embed/{$videoId}";
        }
        return null;
    }

    /**
     * Get YouTube Thumbnail URL
     */
    public function getThumbnailUrlAttribute()
    {
        $videoId = $this->youtube_id;
        if ($videoId) {
            return "https://img.youtube.com/vi/{$videoId}/maxresdefault.jpg";
        }
        return null;
    }

    /**
     * Scope untuk video yang aktif
     */
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    /**
     * Scope untuk urutan video
     */
    public function scopeUrutan($query)
    {
        return $query->orderBy('urutan', 'asc');
    }
}
