<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Photo extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function album_id() {
        return $this->belongsTo(Album::class, 'album_id', 'id');
    }

    public function getImageAttribute($value){
        return Storage::url($value);
    }
}
