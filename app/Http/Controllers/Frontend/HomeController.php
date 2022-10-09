<?php

namespace App\Http\Controllers\Frontend;

//use App\Helpers\Helper;
use App\ConstApp;
use App\Models\Audio;
use App\Models\Book;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Member;
use App\Models\News;
use App\Models\Notify;
use App\Models\Partner;
use App\Models\Port;
use App\Models\ProductCategory;
use App\Models\Scenario;
use App\Models\Setting;
use App\Models\Ship;
use App\Models\Step;
use App\Models\Support;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Reader\Xls\MD5;
use Session;
use Cookie;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    public $books;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, $id = 0)
    {
        if(! Session::get('locale')){
            App::setLocale('vi');
            Session::put('locale', 'vi');
        }
        $data = [];
        $data['categories'] = Category::get();
        $data['categories_menu'] = Category::where('show_menu', 1)->where('type', 1)->orderBy('order','ASC')->get();
        $categories_new_id = Category::where('show_menu', 1)->where('type', 1)->pluck('id')->toArray();
        $data['trades_menu'] = Category::where('show_menu', 1)->where('type', 2)->orderBy('order','ASC')->get();
        $data['product_categories_menu'] = ProductCategory::where('show_menu', 1)->orderBy('order','ASC')->get();
        $data['news'] = News::where('approved', 1)->whereIn('category_id', $categories_new_id)->orderBy('id','DESC')->get();
        $data['event_news'] = News::where('category_id', 1)->where('approved', 1)->orderBy('id','DESC')->limit(3)->get();
        $data['vsg_news'] = News::where('category_id', 2)->where('approved', 1)->orderBy('id','DESC')->limit(3)->get();
        $data['req_news'] = News::where('category_id', 3)->where('approved', 1)->orderBy('id','DESC')->limit(3)->get();
        $data['forbuy_news'] = News::where('category_id', 4)->where('approved', 1)->orderBy('id','DESC')->limit(3)->get();
        $data['forsell_news'] = News::where('category_id', 5)->where('approved', 1)->orderBy('id','DESC')->limit(3)->get();
        $data['road_news'] = News::where('category_id', 6)->where('approved', 1)->orderBy('id','DESC')->limit(4)->get();
        $data['import_news'] = News::where('category_id', 7)->where('approved', 1)->orderBy('id','DESC')->limit(4)->get();
        $data['station_news'] = News::where('category_id', 8)->where('approved', 1)->orderBy('id','DESC')->limit(4)->get();
        $data['invest_news'] = News::where('category_id', 9)->where('approved', 1)->orderBy('id','DESC')->limit(4)->get();
        $data['other_news'] = News::where('category_id', 10)->where('approved', 1)->orderBy('id','DESC')->limit(4)->get();
        $data['hot_news'] = News::where('is_hot', 1)->orderBy('id','DESC')->limit(3)->get();
        $data['paid_news'] = News::where('is_paid', 1)->orderBy('id','DESC')->limit(3)->get();
        $data['partners'] = Partner::where('type', 1)->orderBy('id','DESC')->limit(3)->get();
        $data['anpham'] = Partner::where('type', 2)->where('is_show', 1)->orderBy('id','DESC')->limit(3)->get();
        $data['supports'] = Support::where('is_show',1)->get();
        $data['other'] = [];
        $data['menu_active'] = 'index';
        foreach ($categories_new_id as $id){
            $data['other'][$id] = News::where('category_id', $id)->where('approved', 1)->orderBy('id','DESC')->limit(4)->get();
        }
        return view('templates.news.homePage', $data);
    }

    public function newsDetail(Request $request, $id = 0)
    {
        $data = $this->commonMenuData();
        $category = ProductCategory::where('id', $id)->first();
        $news = News::where('id', $id)->where('approved', 1)->orderBy('id', 'DESC')->first();
        $data['hot_news'] = News::where('is_hot', 1)->orderBy('id','DESC')->limit(3)->get();
        $data['paid_news'] = News::where('is_paid', 1)->orderBy('id','DESC')->limit(3)->get();
        $data['news'] = $news;

        $data['relate_news'] = News::where('approved', 1)->where('id','<>', $id)->where('category_id', $news->category_id)->where('product_category_id', $news->product_category_id)->inRandomOrder()->limit(6)->get();
        return view('templates.news.newsDetail', $data);
    }

    public function category(Request $request, $id = 0)
    {
        $data = [];
        $category = Category::where('id', $id)->first();
        $news = News::where('category_id', $id)->where('approved', 1)->orderBy('id', 'DESC')->paginate(10);
        if(isset($_GET['s']) && $_GET['s']){
            $category = Category::where('id','>', 0)->first();
            $news = News::where('title_vn', 'like', '%'.$_GET['s'].'%')->where('approved', 1)->orderBy('id', 'DESC')->paginate(10);
        }
        $data['category'] = $category;
        $data['news'] = $news;
        $data['categories'] = Category::get();
        $data['categories_menu'] = Category::where('show_menu', 1)->where('type', 1)->orderBy('order','ASC')->get();
        $data['trades_menu'] = Category::where('show_menu', 1)->where('type', 2)->orderBy('order','ASC')->get();
        $data['product_categories_menu'] = ProductCategory::where('show_menu', 1)->orderBy('order','ASC')->get();
        $data['hot_news'] = News::where('is_hot', 1)->orderBy('id','DESC')->limit(3)->get();
        $data['paid_news'] = News::where('is_paid', 1)->orderBy('id','DESC')->limit(3)->get();
        $data['anpham'] = Partner::where('type', 2)->where('is_show', 1)->orderBy('id','DESC')->limit(3)->get();
        $data['partners'] = Partner::where('type', 1)->orderBy('id','DESC')->limit(3)->get();
        if($id == 3 || $id == 4 || $id == 5) {
            $data['menu_active'] = 'gt';
        }elseif($id == 1) {
            $data['menu_active'] = 'event';
        } elseif($id == 17) {
            $data['menu_active'] = 'rec';
        }
        else{
            $data['menu_active'] = 'news';
        }
        return view('templates.news.category', $data);
    }

    public function schedule(Request $request, $id = 0)
    {
        $data = [];
        $data['list_scenarios']=[];
        $category = Category::where('id', '>', 0)->first();
        $id = $category->id;
        $news = News::where('category_id', $id)->where('approved', 1)->orderBy('id', 'DESC')->paginate(10);
        if(isset($_GET['s']) && $_GET['s']){
            $category = Category::where('id','>', 0)->first();
            $news = News::where('title_vn', 'like', '%'.$_GET['s'].'%')->where('approved', 1)->orderBy('id', 'DESC')->paginate(10);
        }
        $data['category'] = $category;
        $data['news'] = $news;
        $data['categories'] = Category::get();
        $data['categories_menu'] = Category::where('show_menu', 1)->where('type', 1)->orderBy('order','ASC')->get();
        $data['trades_menu'] = Category::where('show_menu', 1)->where('type', 2)->orderBy('order','ASC')->get();
        $data['product_categories_menu'] = ProductCategory::where('show_menu', 1)->orderBy('order','ASC')->get();
        $data['hot_news'] = News::where('is_hot', 1)->orderBy('id','DESC')->limit(3)->get();
        $data['paid_news'] = News::where('is_paid', 1)->orderBy('id','DESC')->limit(3)->get();
        $data['list_ship'] = Ship::where('id','>', 0)->orderBy('id','ASC')->get();
        $data['list_port'] = Port::where('id','>', 0)->orderBy('id','ASC')->get();
        $data['menu_active'] = 'schedule';
        if(isset($_GET['ship_id']) || isset($_GET['boss_port_id']) || isset($_GET['unloading_port_id']) || isset($_GET['departure_day']) || isset($_GET['arrival_date'])) {
            $list_scenarios = Scenario::query();
            if(isset($_GET['ship_id']) && $_GET['ship_id']){
                $list_scenarios = $list_scenarios->where('ship_id', $_GET['ship_id']);
            }
            if(isset($_GET['boss_port_id']) && $_GET['boss_port_id']){
                $list_scenarios = $list_scenarios->where('boss_port_id', $_GET['boss_port_id']);
            }
            if(isset($_GET['unloading_port_id']) && $_GET['unloading_port_id']){
                $list_scenarios = $list_scenarios->where('unloading_port_id', $_GET['unloading_port_id']);
            }
            if(isset($_GET['departure_day']) && $_GET['departure_day']){
                $departure_day = \DateTime::createFromFormat("d/m/Y", $_GET['departure_day'])->format('Y-m-d');
                $list_scenarios = $list_scenarios->where('departure_day', '=',$departure_day);
            }
            if(isset($_GET['arrival_date']) && $_GET['arrival_date']){
                $arrival_date = \DateTime::createFromFormat("d/m/Y", $_GET['arrival_date'])->format('Y-m-d');
                $list_scenarios = $list_scenarios->where('arrival_date', '<=',$arrival_date);
            }
            $list_scenarios = $list_scenarios->orderBy('departure_day', 'ASC')->get();
            $data['list_scenarios'] = $list_scenarios;
        }

        return view('templates.schedules.schedule', $data);
    }

    public function productCategory(Request $request, $id = 0)
    {
        $data = $this->commonMenuData();
        $data['news'] = News::where('product_category_id', $id)->where('approved', 1)->orderBy('id', 'DESC')->paginate(ConstApp::NUMBER_PER_PAGE);
        $data['hot_news'] = News::where('product_category_id', $id)->where('approved', 1)->orderBy('id','DESC')->limit(6)->get();
        $data['paid_news'] = News::where('is_paid', 1)->orderBy('id','DESC')->limit(3)->get();
        $data['menu_active'] = 'product';
        return view('templates.products.productList', $data);
    }

    public function productDetail(Request $request, $id = 0) {

        $data = [];
        $category = ProductCategory::where('id', $id)->first();
        $news = News::where('id', $id)->where('approved', 1)->orderBy('id', 'DESC')->first();
        $data['category'] = $category;
        $data['news'] = $news;
        $data['categories'] = Category::get();
        $data['categories_menu'] = Category::where('show_menu', 1)->where('type', 1)->orderBy('order','ASC')->get();
        $data['trades_menu'] = Category::where('show_menu', 1)->where('type', 2)->orderBy('order','ASC')->get();
        $data['product_categories_menu'] = ProductCategory::where('show_menu', 1)->orderBy('order','ASC')->get();
        $data['hot_news'] = News::where('is_hot', 1)->orderBy('id','DESC')->limit(3)->get();
        $data['paid_news'] = News::where('is_paid', 1)->orderBy('id','DESC')->limit(3)->get();
        $data['relate_news'] = News::where('approved', 1)->where('id','<>', $id)->where('category_id', $news->category_id)->where('product_category_id', $news->product_category_id)->inRandomOrder()->limit(6)->get();

        return view('templates.products.productDetail', $data);
    }

    public function detail(Request $request, $id = 0)
    {
        $data = [];
        $category = ProductCategory::where('id', $id)->first();
        $news = News::where('id', $id)->where('approved', 1)->orderBy('id', 'DESC')->first();
        $data['category'] = $category;
        $data['news'] = $news;
        $data['categories'] = Category::get();
        $data['categories_menu'] = Category::where('show_menu', 1)->where('type', 1)->orderBy('order','ASC')->get();
        $data['trades_menu'] = Category::where('show_menu', 1)->where('type', 2)->orderBy('order','ASC')->get();
        $data['product_categories_menu'] = ProductCategory::where('show_menu', 1)->orderBy('order','ASC')->get();
        $data['hot_news'] = News::where('is_hot', 1)->orderBy('id','DESC')->limit(3)->get();
        $data['paid_news'] = News::where('is_paid', 1)->orderBy('id','DESC')->limit(3)->get();
        $data['relate_news'] = News::where('approved', 1)->where('id','<>', $id)->where('category_id', $news->category_id)->where('product_category_id', $news->product_category_id)->inRandomOrder()->limit(6)->get();
        // truy van lay du lieu cu the
        if($news->product_category_id){
            $data['hot_news'] = News::where('approved', 1)/*->where('id','<>', $id)*/->where('category_id', $news->category_id)->where('product_category_id', $news->product_category_id)->orderBy('id','DESC')->limit(6)->get();
            return view('frontend.product', $data);
        }
        return view('frontend.detail', $data);
    }

    public function contact(Request $request)
    {
       $data = $this->commonMenuData();
        $data['menu_active'] = 'contact';
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $submit_data = $request->all();
            $validate = $this->validateContactData($submit_data);
            Session::flash('name',$submit_data['name']);
            Session::flash('email',$submit_data['email']);
            Session::flash('phone',$submit_data['phone']);
            Session::flash('title',$submit_data['title']);
            Session::flash('content',trim($submit_data['content']));
            if($validate == true) {
                $contact = new Contact();
                $contact->name = $submit_data['name'];
                $contact->email = $submit_data['email'];
                $contact->phone = $submit_data['phone'];
                $contact->title = $submit_data['title'];
                $contact->content = trim($submit_data['content']);
                $contact->save();
                Session::flash('successMsg',  __("messages.SUCCESS_CONTACT"));
                Session::forget('name');
                Session::forget('email');
                Session::forget('phone');
                Session::forget('title');
                Session::forget('content');
            }
        }

        return view('templates.members.contact', $data);
    }

    public function validateContactData($submit_data) {
        if(strlen($submit_data['name']) == 0) {
            Session::flash('errMsg', __("messages.FULL_NAME"));
            return false;
        }

        if(strlen($submit_data['email']) == 0) {
            Session::flash('errMsg', __("messages.EMPTY_EMAIL_ERROR_MSG"));
            return false;
        }

        if (!filter_var($submit_data['email'], FILTER_VALIDATE_EMAIL)) {
            Session::flash('errMsg', __("messages.FORMAT_EMAIL_ERROR_MSG"));
            return false;
        }

        if (strlen($submit_data['phone']) == 0) {
            Session::flash('errMsg', __("messages.EMPTY_PHONE_ERROR_MSG"));
            return false;
        }

        if(strlen($submit_data['phone']) < 8) {
            Session::flash('errMsg', __("messages.FORMAT_PHONE_ERROR_MSG"));
            return false;
        }

        if (strlen($submit_data['content']) == 0) {
            Session::flash('errMsg', __("messages.ERROR_EMPTY_CONTENT"));
            return false;
        }

        return true;
    }

    public function memberInfo(Request $request)
    {
        if(!Session::has('member')){
            return redirect('/login');
        }

        $data = $this->commonMenuData();

        $member = Session::get('member');
        $data['name'] = $member->name;
        $data['email'] = $member->email;
        $data['phone'] = $member->phone;
        $data['router_active'] = 'my_account';
        return view('templates.members.accountInfo', $data);
    }

    public function updateAccount(Request $request) {

        if(!Session::has('member')) {
            return redirect('/');
        }
        $data = $this->commonMenuData();

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){

            $submit_data = $request->all();
            $validate = $this->validateUpdateAccount($submit_data);

            if($validate == true) {
                try{
                    Session::get('member')->name = $submit_data['name'];
                    Session::get('member')->phone = $submit_data['phone'];

                    Member::where('id', Session::get('member')->id)->update([
                        'name' => $submit_data['name'],
                        'phone' => $submit_data['phone'],
                    ]);
                    Session::flash('successMsg', __("messages.SUCCESS_UPDATE_ACCOUNT"));
                } catch (\Exception $exception) {
                    Session::flash('errMsg', __("messages.EXCEPTION_UPDATE_ERROR_MSG"));
                }
            }
        }

        $member = Session::get('member');
        $data['name'] = $member->name;
        $data['email'] = $member->email;
        $data['phone'] = $member->phone;
        $data['router_active'] = 'my_account';

        return view('templates.members.editMemberInfo', $data);
    }

    public function validateUpdateAccount($submit_data) {

        if(strlen($submit_data['name']) == 0) {
            Session::flash('errMsg', __("messages.FULL_NAME"));
            return false;
        }

        if (strlen($submit_data['phone']) == 0) {
            Session::flash('errMsg', __("messages.EMPTY_PHONE_ERROR_MSG"));
            return false;
        }

        if(strlen($submit_data['phone']) < 8) {
            Session::flash('errMsg', __("messages.FORMAT_PHONE_ERROR_MSG"));
            return false;
        }

        return true;
    }

    public function register(Request $request)
    {

        $data = $this->commonMenuData();

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){

            $submit_data = $request->all();
            $validate = $this->validateDataRegister($submit_data);
            Session::flash('name', $submit_data['name']);
            Session::flash('email', $submit_data['email']);
            Session::flash('phone', $submit_data['phone']);

            if($validate == true) {
                $mem = Member::where('email', $submit_data['email'])->count();
                if($mem > 0) {
                    Session::flash('errMsg', __("messages.ACCOUNT_EXISTS_ERROR_MSG"));
                } else {
                    try{
                        $member = new Member();
                        $member->name = $submit_data['name'];
                        $member->email = $submit_data['email'];
                        $member->phone = $submit_data['phone'];
                        $member->company = $submit_data['company'];
                        $member->password = md5($submit_data['password']);
                        $member->save();
                        Session::flash('successMsg', __("messages.SUCCESS_REGISTER_ACCOUNT"));
                    } catch (\Exception $exception) {
                        Session::flash('errMsg', __("messages.EXCEPTION_REGISTER_ERROR_MSG"));
                    }
                }
            }
        }
        return view('templates.members.register',$data);
    }

    public function validateDataRegister($submit_data) {

        if(strlen($submit_data['name']) == 0) {
            Session::flash('errMsg', __("messages.FULL_NAME"));
            return false;
        }

        if(strlen($submit_data['email']) == 0) {
            Session::flash('errMsg', __("messages.EMPTY_EMAIL_ERROR_MSG"));
            return false;
        }

        if (!filter_var($submit_data['email'], FILTER_VALIDATE_EMAIL)) {
            Session::flash('errMsg', __("messages.FORMAT_EMAIL_ERROR_MSG"));
            return false;
        }

        if (strlen($submit_data['phone']) == 0) {
            Session::flash('errMsg', __("messages.EMPTY_PHONE_ERROR_MSG"));
            return false;
        }

        if(strlen($submit_data['phone']) < 8) {
            Session::flash('errMsg', __("messages.FORMAT_PHONE_ERROR_MSG"));
            return false;
        }

        if (strlen($submit_data['password']) == 0) {
            Session::flash('errMsg', __("messages.EMPTY_PASSWORD_ERROR_MSG"));
            return false;
        }

        if (strlen($submit_data['password']) < 6) {
            Session::flash('errMsg', __("messages.PASSWORD_MORE_SIX_CHARACTERS_ERROR_MSG"));
            return false;
        }

        if ($submit_data['password'] != $submit_data['confirm_password']) {
            Session::flash('errMsg', __("messages.PASSWORD_AND_REPASSWORD_NOT_MATCH_ERROR_MSG"));
            return false;
        }

        return true;
    }

    public function login(Request $request)
    {
        $data = $this->commonMenuData();

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){

            $submit_data = $request->all();

            if(strlen($submit_data['email']) == 0 || strlen($submit_data['password']) == 0) {
                Session::flash('errLoginMsg', __("messages.EMPTY_DATA_LOGIN"));
            } else {
                $member = Member::where('email', $submit_data['email'])->where('password', md5($submit_data['password']))->first();
                if(!isset($member->id) || $member->active == 0){
                    Session::flash('errLoginMsg', __("messages.ERROR_LOGIN_MSG"));
                } else {
                    Session::flash('successLoginMsg', __("messages.SUCCESS_LOGIN_MSG"));
                    Session::put('member', $member);
                }
            }
        }
        return view('templates.members.login', $data);
    }

    public function resetPassword(Request $request)
    {
        if(!Session::has('member')) {
            return redirect('/');
        }

        $data = $this->commonMenuData();

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){

            $submit_data = $request->all();
            $validate = $this->validateDataResetPassword($submit_data);
            if($validate == true) {
                $member = Session::get('member');
                Member::where('id', $member->id)->update(['password' => md5($submit_data['password'])]);
                Session::flash('successResetMsg', __("messages.RESET_PASS_SUCCESS"));
                Session::get('member')->password = md5($submit_data['password']);
            }
        }
        $data['router_active'] = 'reset_pass';
        return view('templates.members.resetPassword', $data);
    }

    public function validateDataResetPassword($submit_data) {

        if(strlen($submit_data['old_password']) == 0) {
            Session::flash('errResetMsg', __("messages.EMPTY_OLD_PASS_ERROR"));
            return false;
        }

        if(strlen($submit_data['password']) == 0) {
            Session::flash('errResetMsg', __("messages.EMPTY_NEW_PASS_ERROR"));
            return false;
        }

        if(strlen($submit_data['password']) < 6) {
            Session::flash('errResetMsg', __("messages.PASSWORD_MORE_SIX_CHARACTERS_ERROR_MSG"));
            return false;
        }

        if($submit_data['password'] != $submit_data['confirm_password']) {
            Session::flash('errResetMsg', __("messages.NOT_MATCH_PASS_ERROR"));
            return false;
        }

        $meber_data = Session::get("member");
        if($meber_data->password != md5($submit_data['old_password'])) {
            Session::flash('errResetMsg', __("messages.OLD_PASS_INVALID_ERROR"));
            return false;
        }

        return true;
    }

    public function logout(Request $request){
        Session::flush();
        return redirect('/');
    }

    public function language(Request $request, $lang = 'vi'){
        if($lang == 'en'){
            App::setLocale('en');
            Session::put('locale', 'en');
        }else{
            App::setLocale('vi');
            Session::put('locale', 'vi');
        }
        return redirect()->back();
    }

    public function commonMenuData() {

        $data = array();
        $data['category'] = Category::where('id', '>', 0)->first();
        $data['categories'] = Category::get();
        $data['categories_menu'] = Category::where('show_menu', 1)->where('type', 1)->orderBy('order','ASC')->get();
        $data['trades_menu'] = Category::where('show_menu', 1)->where('type', 2)->orderBy('order','ASC')->get();
        $data['product_categories_menu'] = ProductCategory::where('show_menu', 1)->orderBy('order','ASC')->get();
        return $data;
    }

    public function addNews( Request $request) {

        if(!Session::has('member')) {
            return redirect('/');
        }
        $data = $this->commonMenuData();

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){

            $submit_data = $request->all();
            $validate = $this->validateNews($submit_data, $request);

            if($validate == true) {
                try{
                    $new = new News();
                    $new->category_id = $submit_data['category_id'];
                    $new->title_vn = $submit_data['title_vn'];
                    $new->title_en = $submit_data['title_vn'];
                    $new->content_vn = $submit_data['content_vn'];
                    $new->content_en = $submit_data['content_vn'];
                    $new->content_en = $submit_data['content_vn'];
                    $new->approved = 0;
                    $new->member_id = Session::get('member')->id;
                    if($request->has('img')){
                        $new->img = '/'.request()->file('img')->store('certificates','public');
                    }
                    $new->save();
                    Session::flash('successMsg', __("messages.SUCCESS_ADD_NEWS"));
                } catch (\Exception $exception) {
                    Session::flash('errMsg', __("messages.EXCEPTION_ERROR_ADD_NEWS"));
                }
                Session::forget('category_id');
                Session::forget('title_vn');
                Session::forget('content_vn');
            } else {
                Session::flash('category_id',$submit_data['category_id']);
                Session::flash('title_vn',$submit_data['title_vn']);
                Session::flash('content_vn',$submit_data['content_vn']);
            }
        }
        $data['router_active'] = 'news_add';
        return view('templates.news.addNews', $data);
    }

    public function validateNews($submit_data, $request) {

        if (strlen($submit_data['category_id']) == 0) {
            Session::flash('errMsg', __("messages.PASSWORD_AND_REPASSWORD_NOT_MATCH_ERROR_MSG"));
            return false;
        }

        if (strlen($submit_data['title_vn']) == 0) {
            Session::flash('errMsg', __("messages.ERROR_NEWS_TITLE"));
            return false;
        }

        if (strlen($submit_data['title_vn']) > ConstApp::NUMBER_CHARACTERS_LIMIT_TITLE) {
            $msg =  __("messages.ERROR_NEWS_TITLE_LIMIT");
            $msg = str_replace('%s',ConstApp::NUMBER_CHARACTERS_LIMIT_TITLE, $msg);
            Session::flash('errMsg', $msg);
            return false;
        }

        if (strlen($submit_data['title_vn']) < ConstApp::NUMBER_CHARACTERS_TITLE_LET_THAN) {
            $msg =  __("messages.ERROR_NEWS_TITLE_LESS_THAN");
            $msg = str_replace('%s',ConstApp::NUMBER_CHARACTERS_TITLE_LET_THAN, $msg);
            Session::flash('errMsg', $msg);
            return false;
        }

        if (strlen($submit_data['content_vn']) == 0) {
            Session::flash('errMsg', __("messages.content_vn"));
            return false;
        }

        if (strlen($submit_data['content_vn']) == 0) {
            Session::flash('errMsg', __("messages.ERROR_NEWS_CONTENT"));
            return false;
        }

        if (strlen($submit_data['content_vn']) < ConstApp::NUMBER_CHARACTERS_TITLE_LET_THAN) {
            $msg =  __("messages.ERROR_NEWS_CONTENT_LESS_THAN");
            $msg = str_replace('%s',ConstApp::NUMBER_CHARACTERS_TITLE_LET_THAN, $msg);
            Session::flash('errMsg', $msg);
            return false;
        }

        if(!$request->has('img')){
            Session::flash('errMsg', __("messages.ERROR_NEWS_IMAGE"));
            return false;
        }

        return true;
    }

    public function newsManagent(Request $request) {
        $data = $this->commonMenuData();
        $data['posted'] = News::where('member_id', Session::get('member')->id)->orderBy('id', 'DESC')->paginate(10);
        $data['router_active'] = 'news_manager';
        return view('templates.news.newsManagent', $data);
    }

    public function svgNews(Request $request) {
        $data = $this->commonMenuData();
        $data['news'] = News::where('category_id', 2)->where('approved', 1)->orderBy('id', 'DESC')->paginate(ConstApp::NUMBER_PER_PAGE);
        $data['hot_news'] = News::where('product_category_id', 0)->where('approved', 1)->orderBy('id','DESC')->limit(6)->get();
        $data['paid_news'] = News::where('is_paid', 1)->orderBy('id','DESC')->limit(3)->get();
        $data['menu_active'] = 'svg';
        return view('templates.news.svgNews', $data);
    }

    public function partner(Request $request) {
        $data = $this->commonMenuData();
        $data['partners'] = Partner::where('type', 1)->orderBy('id','DESC')->get();
        $data['menu_active'] = 'doi_tac';
        return view('templates.partners.partnerList', $data);
    }

    public function partnerDetail(Request $request, $id = 0) {
        $data = $this->commonMenuData();
        $data['partners'] = Partner::where('id', $id)->get();
        $data['partnersRelationship'] = Partner::where('type', 1)->where('id','<>', $id)->where('is_show','=', 1)->get();

        $data['menu_active'] = 'doi_tac';
        return view('templates.partners.partnerDetail', $data);
    }
}
