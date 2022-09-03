<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;

class Book extends Model
{
    protected $table = 'books';

    protected $fillable = [
        'name', 'order', 'pic', 'tel', 'public', 'addr', 'content', 'area', 'image1', 'image2', 'image3', 'image4', 'image5', 'image6', 'image7', 'image8', 'image9', 'image10',
    ];

    public function chapters()
    {
        return $this->hasMany('App\Models\Chapter')->where('public','=', 1)->orderBy('order', 'ASC');
    }
}
