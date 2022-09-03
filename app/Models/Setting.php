<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';

    protected $fillable = [
        'content',
    ];

    public static function saveData($data){
        $setting = Setting::where('id','>', 0)->first();
        if(! $setting){
            $setting = new Setting();
        }
        $setting->content = $data['content'];
        $setting->save();
        return $setting;
    }
}
