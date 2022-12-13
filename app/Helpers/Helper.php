<?php

namespace App\Helpers;

use App\ConstApp;
use App\Models\Chapter;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Card;
use App\Models\Contact;
use App\Models\Member;
use App\Models\News;
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

    public static function substractTwoDate($date_1, $date_2) {
        $datetime1 = strtotime($date_1);
        $datetime2 = strtotime($date_2);

        $secs = $datetime2 - $datetime1;// == <seconds between the two times>
        $days = $secs / 86400;
        return $days;
    }

    public static function limitCharacters($str,$number) {
        if(strlen($str) <= $number) {
            return $str;
        }
        $str = strip_tags($str);
        $str = wordwrap($str, $number);
        $str = explode("\n", $str);
        return $str[0] . '...';

    }

    public static function getCountCard() {
        $data = Card::where('status','=','0')->get();
        return count($data);
    }

    public static function getCountContact() {
        $data = Contact::where('is_read','=','0')->get();
        return count($data);
    }

    public static function getCountMember() {
        $data = Member::where('active','=','0')->get();
        return count($data);
    }

    public static function getGiaoThuong() {

        $data = News::whereIn('category_id',['3','4','5'])->get();
        return count($data);
    }

    public static function getBaoGia() {

        $data = News::whereIn('category_id',['3'])->get();
        return count($data);
    }

    public static function getBaoGiaCount() {

        $data = News::whereIn('category_id',['3'])->get();
        return count($data);
    }

    public static function getChaoMuaCount() {

        $data = News::whereIn('category_id',['4'])->get();
        return count($data);
    }

    public static function getChaoBanCount() {

        $data = News::whereIn('category_id',['5'])->get();
        return count($data);
    }
}