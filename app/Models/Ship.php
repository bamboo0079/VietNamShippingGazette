<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;

class Ship extends Model
{
    protected $table = 'ships';

    protected $fillable = [
        'ship_nm_vn', 'ship_nm_en','status'
    ];
}
