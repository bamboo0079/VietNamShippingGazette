<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Helper;
use App\Models\UserNotify;
use Illuminate\Support\Facades\Auth;
use Hash;
use App\User;
use App\Models\Card;
use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cookie;

class CardsController extends Controller
{

    public function listCard() {
        $data['products'] = News::where('approved','=','1')->get();
        $data['cards'] = Card::where('cards.del_flg', '=', 0)->leftJoin('members', 'cards.member_id', '=', 'members.id')->orderBy('cards.created_at', 'DESC')->paginate(100);
        return view('backend.cards.listCards', $data);
    }

    public function processCard(Request $request) {

        $update = [
            'status' => 1,
            'card_update_date' => now()
        ];

        Card::where('card_id', $_POST['id'])->update($update);

        return date('d/m/Y H:i');
    }
}
