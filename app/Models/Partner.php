<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;

class Partner extends Model
{
    protected $table = 'partners';

    protected $fillable = [
        'title_vn','title_en','content_vn','content_en','img','link','is_show','type'
    ];
}
