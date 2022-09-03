<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;

class Partner extends Model
{
    protected $table = 'partners';

    protected $fillable = [
        'img','link','name','is_show','type'
    ];
}
