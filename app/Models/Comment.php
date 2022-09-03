<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    protected $table = 'comments';

    protected $fillable = [
        'name', 'public','type','material','process','finish_date','factory','quantity','do_date','certificate','exp_date'
    ];

    /*public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function chapter()
    {
        return $this->belongsTo('App\Models\Chapter');
    }
    public static function saveData($data){
        $comment = Comment::where('chapter_id', $data['chapter_id'])->where('user_id', $data['user_id'])->where('public',1)->first();
        if(! $comment){
            $comment = new Comment();
        }
        $comment->comment = isset($data['comment'])?$data['comment']:'';
        $comment->user_id = isset($data['user_id'])?$data['user_id']:0;
        $comment->chapter_id = isset($data['chapter_id'])?$data['chapter_id']:0;
        $comment->public = isset($data['public'])?$data['public']:1;
        $comment->save();
        return $comment;
    }*/
}
