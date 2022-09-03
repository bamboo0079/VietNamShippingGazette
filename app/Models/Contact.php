<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;

class Contact extends Model
{
    protected $table = 'contacts';

    protected $fillable = [
        'email', 'name','phone','title','content','is_read'
    ];
}
