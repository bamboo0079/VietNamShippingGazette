<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notify extends Model
{
    protected $table = 'notifies';

    protected $fillable = [
        'name', 'public','type','material','process','finish_date','factory','quantity','do_date','certificate','exp_date'
    ];

    public static function saveData($data){
        if(! isset($data['id'])){
            $notify = new Notify();
        }else{
            $notify = Notify::where('id', $data['id'])->first();
        }
        $notify->content = $data['content'];
        $notify->title = $data['title'];
        $notify->save();
        return $notify;
    }
}
