<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;

class WhereHouseHistory extends Model
{
    protected $table = 'warehouses_history';

    protected $fillable = [
        'pic', 'qty', 'note', 'unit', 'do_date', 'is_input', 'product_id'
    ];
}
