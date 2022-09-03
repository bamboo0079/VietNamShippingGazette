<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;

class Scenario extends Model
{
    protected $table = 'scenarios';

    protected $fillable = [
        'country_id', 'boss_port_id','unloading_port_id','transit_port_id','ship_id','agent_id','departure_day','arrival_date','total_date','status'
    ];

    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_id');
    }

    public function boss()
    {
        return $this->belongsTo('App\Models\Port', 'boss_port_id');
    }

    public function unloading()
    {
        return $this->belongsTo('App\Models\Port', 'unloading_port_id');
    }

    public function transit()
    {
        return $this->belongsTo('App\Models\Port', 'transit_port_id');
    }

    public function ship()
    {
        return $this->belongsTo('App\Models\Ship', 'ship_id');
    }

    public function agent()
    {
        return $this->belongsTo('App\Models\Agent', 'agent_id');
    }
}
