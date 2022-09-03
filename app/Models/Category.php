<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;// add soft delete

    protected $table = 'categories';

    protected $fillable = [
        'name_vn', 'name_en','show_menu','order'
    ];
}
