<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentPage extends Model
{
    protected $fillable = [
        'title',
        'content',
        'email',
        'email_label',
        'address',
        'phone',
    ];
}
