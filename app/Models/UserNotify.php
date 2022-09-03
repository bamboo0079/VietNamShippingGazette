<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserNotify extends Model
{
    protected $table = 'user_notifies';

    protected $fillable = [
        'user_id',
        'token',
        'platforms'
    ];

    public static function saveData($data){
        $notify = UserNotify::where('user_id', $data['user_id'])->where('token', $data['token'])->first();
        if(! $notify){
            $notify = new UserNotify();
            $notify->user_id = $data['user_id'];
            $notify->token = $data['token'];
            $notify->platforms = $data['platforms'];
            $notify->save();
        }
        return $notify;
    }
}
