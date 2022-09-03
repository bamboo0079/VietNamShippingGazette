<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;

class Port extends Model
{
    protected $table = 'ports';

    protected $fillable = [
        'port_nm_vn', 'port_nm_en','status', 'country_id'
    ];



    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_id');
    }
}
