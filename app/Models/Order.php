<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'email', 'name','phone','product_id','company','company_tax','company_tax_address','address','export_order'
    ];
}
