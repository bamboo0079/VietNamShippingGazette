<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;

class Audio extends Model
{
    protected $table = 'audios';
    protected $fillable = [
        'name', 'category_id', 'audio1', 'audio2', 'book_id', 'chapter_id', 'order', 'public', 'image1', 'image2', 'image3', 'image4', 'image5', 'image6', 'image7', 'image8', 'image9', 'image10','expected_quantity', 'harvest_date',
    ];

    public function book()
    {
        return $this->belongsTo('App\Models\Book');
    }

    public function chapter()
    {
        return $this->belongsTo('App\Models\Chapter');
    }

    public function steps()
    {
        return $this->hasMany('App\Models\Step')->where('public','=', 1)->orderBy('id','DESC');
    }

    public function quantity()
    {
        return $this->hasMany('App\Models\Step')->where('public','=', 1)->where('type_id','=', 6);
    }
}
