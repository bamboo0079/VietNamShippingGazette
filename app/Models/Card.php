<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $table = 'cards';

    protected $fillable = [
        'full_name',
        'company',
        'invoice_export',
        'tax_no',
        'invoice_address',
        'product_address',
        'tel',
        'mobile',
        'email',
        'card_info',
        'car_date',
        'member_id',
        'note',
        'status',
        'del_flg',
    ];
}