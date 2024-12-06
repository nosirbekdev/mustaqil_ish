<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    // To'ldirilishi mumkin bo'lgan ustunlar
    protected $fillable = [
        'name',
        'email',
        'message',
    ];
}

