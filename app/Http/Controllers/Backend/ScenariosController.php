<?php

namespace App\Http\Controllers\Backend;

use App\ConstApp;
use App\Helpers\Helper;
use App\Models\Agent;
use App\Models\Audio;
use App\Models\Country;
use App\Models\Port;
use App\Models\ProductCategory;
use App\Models\Scenario;
use App\Models\Ship;
use App\Models\Step;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Auth;
use Hash;
use App\User;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cookie;
use App\Exports\ScenarioExport;
use Illuminate\Support\Facades\DB;
//use mysql_xdevapi\Session;
use Symfony\Component\Console\Input\Input;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

//use MaatwebsiteExcelFacadesExcel;

class ScenariosController extends Controller
{
    var $limit = 10;

    public function __construct()
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login');
        }
    }

    public function index(Request $request)
    {
        $submit_data = $request->all();
        $data['limit'] = ConstApp::NUMBER_PER_PAGE;
        $query = Scenario::where('id','>', 0);
        if (isset($submit_data['start']) && $submit_data['start']) {
            $submit_data['start'] = \DateTime::createFromFormat("d/m/Y", $submit_data['start'])->format('Y-m-d');
            $query->where('departure_day','=', date("Y-m-d", strtotime($submit_data['start'])));
        }
        if (isset($submit_data['end']) && $submit_data['end']) {
            $submit_data['end'] = \DateTime::createFromFormat("d/m/Y", $submit_data['end'])->format('Y-m-d');
            $query->where('arrival_date','<=', date("Y-m-d",strtotime($submit_data['end'])));
        }

        $id = isset($_GET['id'])?$_GET['id']:0;
        $data['scenario'] = Scenario::where('id', $id)->first();
        if($id == 0){
            if(isset($submit_data['is_inbound']) && $submit_data['is_inbound'] == 1){
                $query->where('scenarios.country_id',1);
            } else {
                $query->where('scenarios.country_id','<>',1);
            }
        }else{
            $query->where('scenarios.country_id',$data['scenario']->country_id);
        }
        $data['categories'] = $query->orderBy('id', 'DESC')->paginate(ConstApp::NUMBER_PER_PAGE);

        $data['ports'] = Port::get();
        $data['ships'] = Ship::get();
        $data['agents'] = Agent::get();
        $data['download_link'] = route('export').'?';
        foreach ($submit_data as $k => $v){
            $data['download_link'] .= $k.'='.$v.'&';
        }
        return view('backend.scenarios.index', $data);
    }

    public function add(Request $request, $category_id = 0)
    {
        $data = [];
        $category = Scenario::where('id', $category_id)->first();
        $data['category'] = $category;
        return view('backend.scenarios.edit', $data);
    }

    public function process(Request $request, $category_id = 0)
    {
        $data = $request->all();
        /*$msg = $request->validate([
            'boss_port_id' => 'required|numeric|min:0|not_in:0',
            'unloading_port_id' => 'required|numeric|min:0|not_in:0',
            'transit_port_id' => 'required|numeric|min:0|not_in:0',
            'ship_id' => 'required|numeric|min:0|not_in:0',
            'agent_id' => 'required|numeric|min:0|not_in:0',
            'departure_day' => ['required'],
            'arrival_date' => ['required'],
        ]);*/
        $port = Port::where('id', $data['boss_port_id'])->first();
        $data['country_id'] = isset($port->country_id)?$port->country_id:0;
        if($data['departure_day'] && $data['arrival_date']){
            $data['departure_day'] = \DateTime::createFromFormat("d/m/Y", $data['departure_day'])->format('Y-m-d');
            $data['arrival_date'] = \DateTime::createFromFormat("d/m/Y", $data['arrival_date'])->format('Y-m-d');
            $errorMsg = "";
            if($data['departure_day'] > $data['arrival_date']) {
                \Session::flash('errorMsg', "Ngày đến không được bé hơn ngày đi");
            }
            $departure_day = Carbon::parse($data['departure_day']);
            $arrival_date = Carbon::parse($data['arrival_date']);
            $data['total_date'] = $departure_day->diffInDays($arrival_date);
        }


        $validate = Validator::make($data, [
            'boss_port_id' => 'required|numeric|min:0|not_in:0',
            'unloading_port_id' => 'required|numeric|min:0|not_in:0',
            'transit_port_id' => 'required|numeric|min:0|not_in:0',
            'ship_id' => 'required|numeric|min:0|not_in:0',
            'agent_id' => 'required|numeric|min:0|not_in:0',
            'departure_day' => ['required'],
            'arrival_date' => ['required'],
        ]);
        if ($validate->fails()) {
            \Session::flash('errorMsg', "Dữ liệu nhập vào không hợp lệ");
            \Session::flash('alert-class', 'alert-danger');
        }elseif ($data['departure_day'] > $data['arrival_date']) {
            \Session::flash('errorMsg', "Ngày đến không được bé hơn ngày đi");
        }else{
            if (isset($data['id']) && $data['id']) {
                $update = [
                    'boss_port_id' => $data['boss_port_id'],
                    'unloading_port_id' => $data['unloading_port_id'],
                    'transit_port_id' => $data['transit_port_id'],
                    'ship_id' => $data['ship_id'],
                    'agent_id' => $data['agent_id'],
                    'departure_day' => $data['departure_day'],
                    'arrival_date' => $data['arrival_date'],
                    'country_id' => $data['country_id'],
                    'total_date' => $data['total_date'],
                ];
                if($errorMsg == "") {
                    Scenario::where('id', $data['id'])->update($update);
                }
            }else{
                $update = [
                    'boss_port_id' => $data['boss_port_id'],
                    'unloading_port_id' => $data['unloading_port_id'],
                    'transit_port_id' => $data['transit_port_id'],
                    'ship_id' => $data['ship_id'],
                    'agent_id' => $data['agent_id'],
                    'departure_day' => $data['departure_day'],
                    'arrival_date' => $data['arrival_date'],
                    'country_id' => $data['country_id'],
                    'total_date' => $data['total_date'],
                ];
                if($errorMsg == "") {
                    Scenario::create($update);
                }
            }
            \Session::flash('successMsg', "Lưu thông tin thành công!");
        }

        $data['limit'] = $this->limit;
        $category = Scenario::where('id','>', 0);
        if(isset($data['country_id']) && $data['country_id'] == 1){
            $category->where('scenarios.country_id',1);
        } else {
            $category->where('scenarios.country_id','<>',1);
        }/*

        if (isset($_GET['start']) && $_GET['start']) {
            $category->where('departure_day','>=', date("Y-m-d", strtotime($_GET['start'])));
        }
        if (isset($_GET['end']) && $_GET['end']) {
            $category->where('arrival_date','<=', date("Y-m-d",strtotime($_GET['end'])));
        }
        if(isset($_GET['id']) && $_GET['id'] != "") {
            $data['scenario'] = Scenario::where('id', $_GET['id'])->first();
        }*/

        $data['categories'] = $category->orderBy('updated_at', 'DESC')->paginate(ConstApp::NUMBER_PER_PAGE);

        $data['download_link'] = route('export').'?';

        return view('backend.scenarios.ajax', $data);
    }

    public function export(Request $request)
    {

        if(isset($_GET['is_inbound']) && $_GET['is_inbound'] == 1) {
            $file_name = 'OutBound_'.date("YmdHis").'.xlsx';
        } else {
            $file_name = 'InBound_'.date("YmdHis").'.xlsx';
        }

        $conditions = $request->all();
        return \Excel::download(new ScenarioExport($conditions), $file_name);
    }

    public function delete($category_id){
        Scenario::where('id', $category_id)->delete();
        return redirect()->route('admin.scenarios')->with('status', 'Xóa thông tin thành công');
    }

    public function deleteMultiple(Request $request){
        $scenarial_ids = $request->all();
        $scenarial_ids = explode(',',$scenarial_ids['list_scenarios_id']);
        Scenario::whereIn('id', $scenarial_ids)->delete();
        return redirect()->back()->with('status', 'Xóa thông tin thành công');
    }

}
