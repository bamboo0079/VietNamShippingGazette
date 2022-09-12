<?php

namespace App\Http\Controllers\Frontend;

//use App\Helpers\Helper;
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
        foreach ($categories_new_id as $id){
            $data['other'][$id] = News::where('category_id', $id)->where('approved', 1)->orderBy('id','DESC')->limit(4)->get();
        }
        return view('templates.homePage', $data);
    }

    public function newsDetail(Request $request, $id = 0)
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
            $data['hot_news'] = News::where('approved', 1)->where('id','<>', $id)->where('category_id', $news->category_id)->where('product_category_id', $news->product_category_id)->orderBy('id','DESC')->limit(6)->get();
            return view('frontend.product', $data);
        }
        return view('templates.newsDetail', $data);
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
        // truy van lay du lieu cu the
        return view('templates.category', $data);
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
                $list_scenarios = $list_scenarios->where('departure_day', '>=',$departure_day);
            }
            if(isset($_GET['arrival_date']) && $_GET['arrival_date']){
                $arrival_date = \DateTime::createFromFormat("d/m/Y", $_GET['arrival_date'])->format('Y-m-d');
                $list_scenarios = $list_scenarios->where('departure_day', '<=',$arrival_date);
            }
            $list_scenarios = $list_scenarios->orderBy('departure_day', 'ASC')->get();
            $data['list_scenarios'] = $list_scenarios;
        }

        // truy van lay du lieu cu the
        return view('frontend.schedule', $data);
    }

    public function productCategory(Request $request, $id = 0)
    {
        $data = [];
        $category = ProductCategory::where('id', $id)->first();
        $news = News::where('product_category_id', $id)->where('approved', 1)->orderBy('id', 'DESC')->paginate(12);
        $data['category'] = $category;
        $data['news'] = $news;
        $data['categories'] = Category::get();
        $data['categories_menu'] = Category::where('show_menu', 1)->where('type', 1)->orderBy('order','ASC')->get();
        $data['trades_menu'] = Category::where('show_menu', 1)->where('type', 2)->orderBy('order','ASC')->get();
        $data['product_categories_menu'] = ProductCategory::where('show_menu', 1)->orderBy('order','ASC')->get();
        $data['hot_news'] = News::where('product_category_id', $id)->orderBy('id','DESC')->limit(6)->get();
        $data['paid_news'] = News::where('is_paid', 1)->orderBy('id','DESC')->limit(3)->get();
        // truy van lay du lieu cu the
        return view('frontend.subcategory', $data);
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
            $data['hot_news'] = News::where('approved', 1)->where('id','<>', $id)->where('category_id', $news->category_id)->where('product_category_id', $news->product_category_id)->orderBy('id','DESC')->limit(6)->get();
            return view('frontend.product', $data);
        }
        return view('frontend.detail', $data);
    }

    public function contact(Request $request)
    {
        $data = [];
        $msg = '';
        $category = Category::where('id', '>', 0)->first();
        $id = $category->id;
        $news = News::where('category_id', $id)->where('approved', 1)->orderBy('id', 'DESC')->paginate(10);
        $data['category'] = $category;
        $data['news'] = $news;
        $data['categories'] = Category::get();
        $data['categories_menu'] = Category::where('show_menu', 1)->where('type', 1)->orderBy('order','ASC')->get();
        $data['trades_menu'] = Category::where('show_menu', 1)->where('type', 2)->orderBy('order','ASC')->get();
        $data['product_categories_menu'] = ProductCategory::where('show_menu', 1)->orderBy('order','ASC')->get();
        $data['hot_news'] = News::where('is_hot', 1)->orderBy('id','DESC')->limit(3)->get();
        $data['paid_news'] = News::where('is_paid', 1)->orderBy('id','DESC')->limit(3)->get();
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $submit_data = $request->all();
            $contact = new Contact();
            $contact->name = $submit_data['name'];
            $contact->email = $submit_data['email'];
            $contact->phone = $submit_data['phone'];
            $contact->title = $submit_data['title'];
            $contact->content = $submit_data['content'];
            $contact->save();
            $msg = 'Gửi thông tin thành công!';
        }
        $data['msg'] = $msg;
        return view('frontend.contact', $data);
    }

    public function chaomua(Request $request)
    {
        if(!Session::has('member')){
            return redirect('/login');
        }
        $member = Session::get('member');

        $data = [];
        $msg = '';
        $category = Category::where('id', '>', 0)->first();
        $data['category'] = $category;
        $data['categories'] = Category::get();
        $data['categories_menu'] = Category::where('show_menu', 1)->where('type', 1)->orderBy('order','ASC')->get();
        $data['trades_menu'] = Category::where('show_menu', 1)->where('type', 2)->orderBy('order','ASC')->get();
        $data['product_categories_menu'] = ProductCategory::where('show_menu', 1)->orderBy('order','ASC')->get();
        $data['hot_news'] = News::where('is_hot', 1)->orderBy('id','DESC')->limit(3)->get();
        $data['paid_news'] = News::where('is_paid', 1)->orderBy('id','DESC')->limit(3)->get();
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $submit_data = $request->all();
            $new = new News();
            $new->category_id = $submit_data['category_id'];
            $new->title_vn = $submit_data['title_vn'];
            $new->title_en = $submit_data['title_vn'];
            $new->content_vn = $submit_data['content_vn'];
            $new->content_en = $submit_data['content_vn'];
            $new->content_en = $submit_data['content_vn'];
            $new->approved = 0;
            $new->member_id = $member->id;
            if($request->has('img')){
                $new->img = '/'.request()->file('img')->store('certificates','public');
            }
            $new->save();
            $msg = 'Gửi thông tin thành công. Xin cảm ơn!';
        }
        $data['msg'] = $msg;
        $news = News::where('member_id', $member->id)->orderBy('id', 'DESC')->paginate(10);
        $data['news'] = $news;
        return view('frontend.mypage', $data);
    }

    public function register(Request $request)
    {
        $data = [];
        $category = Category::where('id', '>', 0)->first();
        $id = $category->id;
        $news = News::where('category_id', $id)->where('approved', 1)->orderBy('id', 'DESC')->paginate(10);
        $data['category'] = $category;
        $data['categories'] = Category::get();
        $data['categories_menu'] = Category::where('show_menu', 1)->where('type', 1)->orderBy('order','ASC')->get();
        $data['trades_menu'] = Category::where('show_menu', 1)->where('type', 2)->orderBy('order','ASC')->get();
        $data['product_categories_menu'] = ProductCategory::where('show_menu', 1)->orderBy('order','ASC')->get();

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
                        $member->password = md5($submit_data['password']);
                        $member->save();
                        Session::flash('successMsg', __("messages.SUCCESS_REGISTER_ACCOUNT"));
                    } catch (\Exception $exception) {
                        Session::flash('errMsg', __("messages.EXCEPTION_REGISTER_ERROR_MSG"));
                    }
                }
            }
        }
        return view('templates.register',$data);
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

        if(!preg_match("/^0(1\d{9}|9\d{8})$/", $submit_data['phone'])) {
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
        $data = [];
        $category = Category::where('id', '>', 0)->first();
        $id = $category->id;
        $news = News::where('category_id', $id)->where('approved', 1)->orderBy('id', 'DESC')->paginate(10);
        $data['category'] = $category;
        $data['news'] = $news;
        $data['categories'] = Category::get();
        $data['categories_menu'] = Category::where('show_menu', 1)->where('type', 1)->orderBy('order','ASC')->get();
        $data['trades_menu'] = Category::where('show_menu', 1)->where('type', 2)->orderBy('order','ASC')->get();
        $data['product_categories_menu'] = ProductCategory::where('show_menu', 1)->orderBy('order','ASC')->get();

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){

            $submit_data = $request->all();
            if(strlen($submit_data['email']) == 0 || strlen($submit_data['password']) == 0) {
                Session::flash('errLoginMsg', __("messages.EMPTY_DATA_LOGIN"));
            } else {
                $member = Member::where('email', $submit_data['email'])->where('password', md5($submit_data['password']))->first();
                if(!isset($member->id)){
                    Session::flash('errLoginMsg', __("messages.ERROR_LOGIN_MSG"));
                } else {
                    Session::flash('successLoginMsg', __("messages.SUCCESS_LOGIN_MSG"));
                    Session::put('member', $member);
                }
            }
        }
        return view('templates.login', $data);
    }

    public function resetPassword(Request $request)
    {
        $data = [];
        $msg = '';
        $category = Category::where('id', '>', 0)->first();
        $id = $category->id;
        $news = News::where('category_id', $id)->where('approved', 1)->orderBy('id', 'DESC')->paginate(10);
        $data['category'] = $category;
        $data['news'] = $news;
        $data['categories'] = Category::get();
        $data['categories_menu'] = Category::where('show_menu', 1)->where('type', 1)->orderBy('order','ASC')->get();
        $data['trades_menu'] = Category::where('show_menu', 1)->where('type', 2)->orderBy('order','ASC')->get();
        $data['product_categories_menu'] = ProductCategory::where('show_menu', 1)->orderBy('order','ASC')->get();
        $data['hot_news'] = News::where('is_hot', 1)->orderBy('id','DESC')->limit(3)->get();
        $data['paid_news'] = News::where('is_paid', 1)->orderBy('id','DESC')->limit(3)->get();
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $submit_data = $request->all();
            if(strlen($submit_data['password']) < 6){
                $msg = 'Mật khẩu tối thiểu 6 ký tự!';
            }elseif($submit_data['password'] != $submit_data['confirm_password']){
                $msg = 'Mật khẩu không trùng khớp!';
            }else{
                $member = Session::get('member');
                Member::where('id', $member->id)->update(['password' => md5($submit_data['password'])]);
                $msg = 'Đổi mật khẩu thành công!';
            }
        }
        $data['msg'] = $msg;
        return view('frontend.reset', $data);
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
}
