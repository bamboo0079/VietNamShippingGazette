<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;

class Country extends Model
{
    protected $table = 'countries';

    protected $fillable = [
        'country_nm_vn', 'country_nm_en','status'
    ];
}
