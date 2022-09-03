<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;

class Type extends Model
{
    protected $table = 'types';

    protected $fillable = [
        'name', 'order', 'public'
    ];
}
