<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Helper;
use App\Models\Category;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Auth;
use Hash;
use App\User;
use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cookie;
class UploadsController extends Controller
{
    var $limit = 10;

    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $submit_data = $request->all();
        if($request->has('img')){
            $submit_data['img'] = '/'.request()->file('img')->store('certificates','public');
        }else{
            $submit_data['img'] = '';
        }
        return $submit_data['img'];
    }


}
