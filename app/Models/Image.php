<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    // Definisikan field yang boleh diisi
    protected $fillable = [
        'gallery_id',
        'file',
        'title',
    ];

    // Relasi ke Gallery
    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }
}
