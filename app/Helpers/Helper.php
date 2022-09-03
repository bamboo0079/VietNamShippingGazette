<?php

namespace App\Helpers;

use App\Models\Chapter;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Helper
{
    public static function updateDayList()
    {
        $chapters = Chapter::where('public', 1)
            ->whereHas('book', function ($q) {
                $q->where('public', 1);
            })
            ->orderBy('book_id', 'ASC')
            ->orderBy('order', 'ASC')
            ->orderBy('id', 'ASC')
            ->get();
        if (count($chapters)) {
            foreach ($chapters as $k => $chapter_row) {
                $chapter_row->day = $k + 1;
                $chapter_row->save();
            }
        }
    }

    public static function getNextChapter($current_day)
    {
        $current_chapter = Chapter::where('day', $current_day)->where('public', 1)->first();
        $current_day++;
        $next_chapter = Chapter::where('day', $current_day)/*->where('book_id',$current_chapter->book_id)*/
        ->where('public', 1)->first();
        if ($next_chapter) {
            return $next_chapter->book->name . ' - ' . $next_chapter->name;
        } else {
            return $current_chapter->book->name . ' - ' . '終了';
        }
    }

    public static function getCurrentUserDay($register_date = '')
    {
        if ($register_date == '') {
            $register_date = Auth::user()->register_date;
        }
        $current_day = Carbon::createFromFormat("Y-m-d", $register_date)->diffInDays(Carbon::now()) + 1;
        return $current_day;
    }

    public static function showAudioName($string = '')
    {
        if (strpos($string, '{') !== false && strpos($string, '}') !== false && strpos($string, '|') !== false) {
            $tmp = explode('}', $string);
            $string = '';
            foreach ($tmp as $key => $value) {
                if ($value && strpos($value, '|') !== false) {
                    $value = str_replace('{', '<ruby>', $value);
                    $value = str_replace('|', '<rt>', $value);
                    $string .= $value . '</rt></ruby>';
                } else {
                    $string .= $value;
                }
            }
        }
        return $string;
    }

    public static function pushNotify($data)
    {
        
    }
}