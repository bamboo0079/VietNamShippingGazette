<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;

class Support extends Model
{
    protected $table = 'supports';

    protected $fillable = [
        'name','zalo','skype','phone','sex'
    ];
}
