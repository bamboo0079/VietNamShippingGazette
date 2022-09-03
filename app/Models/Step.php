<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;

class Step extends Model
{
    protected $table = 'steps';

    protected $fillable = [
        'content', 'quantity', 'quantity_number', 'area', 'audio_id','type_id','public','do_date','status','summary','result'
    ];

    public function type()
    {
        return $this->belongsTo('App\Models\Type');
    }

    public function audio()
    {
        return $this->belongsTo('App\Models\Audio');
    }
}
