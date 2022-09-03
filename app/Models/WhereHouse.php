<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;

class WhereHouse extends Model
{
    protected $table = 'warehouses';

    protected $fillable = [
        'name', 'qty', 'unit'
    ];
}
