<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    // Allow mass-assignment for 'youtube_link' and 'title'
    protected $fillable = ['title', 'youtube_link'];
}
