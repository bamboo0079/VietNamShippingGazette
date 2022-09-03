<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model
{
    use SoftDeletes;// add soft delete
    protected $table = 'products_categories';

    protected $fillable = [
        'name_vn', 'name_en','show_menu','order'
    ];
}
