<?php

namespace App\Models;

use App\Models\Album;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;
    public function album()
    {
        return $this->belongsTo(Album::class);
    }
}
