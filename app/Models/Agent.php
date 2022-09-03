<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;

class Agent extends Model
{
    protected $table = 'agents';

    protected $fillable = [
        'agent_nm_vn', 'agent_nm_en','status'
    ];
}
