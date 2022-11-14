<?php

namespace App\Http\Controllers\Backend;

use App\ConstApp;
use App\Models\Agent;
use App\Models\Country;
use App\Models\Port;
use App\Models\Scenario;
use App\Models\Ship;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Auth;
use Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cookie;
use App\Exports\ScenarioExport;

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
//        print_r($submit_data);die;
        $data['limit'] = ConstApp::NUMBER_PER_PAGE;
        $query = Scenario::where('id','>', 0);
        if (isset($submit_data['start']) && $submit_data['start']) {
            $submit_data['start'] = \DateTime::createFromFormat("d/m/Y", $submit_data['start'])->format('Y-m-d');
            $query->where('departure_day','>=', date("Y-m-d", strtotime($submit_data['start'])));
        }
        if (isset($submit_data['end']) && $submit_data['end']) {
            $submit_data['end'] = \DateTime::createFromFormat("d/m/Y", $submit_data['end'])->format('Y-m-d');
            $query->where('arrival_date','<=', date("Y-m-d",strtotime($submit_data['end'])));
        }
        if (isset($submit_data['country_id']) && $submit_data['country_id'] != 0) {
            $query->where('country_id','=', $submit_data['country_id']);
        }
        if (isset($submit_data['boss_port_id']) && $submit_data['boss_port_id'] != 0) {
            $query->where('boss_port_id','=', $submit_data['boss_port_id']);
        }
        if (isset($submit_data['unloading_port_id']) && $submit_data['unloading_port_id'] != 0) {
            $query->where('unloading_port_id','=', $submit_data['unloading_port_id']);
        }
        if (isset($submit_data['transit_port_id']) && $submit_data['transit_port_id'] != 0) {
            $query->where('transit_port_id','=', $submit_data['transit_port_id']);
        }
        if (isset($submit_data['ship_id']) && $submit_data['ship_id'] != 0) {
            $query->where('ship_id','=', $submit_data['ship_id']);
        }
        if (isset($submit_data['agent_id']) && $submit_data['agent_id'] != 0) {
            $query->where('agent_id','=', $submit_data['ship_id']);
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

        $data['countries'] = Country::orderBy('country_nm_vn', 'ASC')->get();
        $data['ports'] = Port::orderBy('port_nm_vn', 'ASC')->get();
        $data['ships'] = Ship::orderBy('ship_nm_vn', 'ASC')->get();
        $data['agents'] = Agent::orderBy('agent_nm_vn', 'ASC')->get();
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

        $port = Port::where('id', $data['boss_port_id'])->first();

        $data['country_id'] = $port->country_id;
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
//            'transit_port_id' => 'required|numeric|min:0|not_in:0',
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
        }

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
