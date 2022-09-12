<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;

class News extends Model
{
    protected $table = 'news';

    protected $fillable = [
        'category_id','member_id','price','product_category_id','youtube_url', 'img', 'title_vn', 'title_en','content_vn','content_en','approved','reject_reason','is_new','is_hot','is_paid'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
    public function productcategory()
    {
        return $this->belongsTo('App\Models\ProductCategory', 'product_category_id');
    }
}
