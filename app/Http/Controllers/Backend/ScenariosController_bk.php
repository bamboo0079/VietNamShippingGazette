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
        $date_from = "";
        $date_to = "";

//        $data['limit'] = $this->limit;
//        $category = Scenario::where('id','>', 0);
//        print_r($submit_data);die;
        $sub_query = "SELECT * from `scenarios` ";
        if (isset($submit_data['start']) || isset($submit_data['end'])) {
            $sub_query .= " WHERE ";
        }
        if (isset($submit_data['start']) && $submit_data['start']) {
            $date_from = urlencode($submit_data['start']);
            $sub_query .= " DATE(departure_day) >= '".date("Y-m-d",strtotime($submit_data['start']))."'";
        }
        if (isset($submit_data['end']) && $submit_data['end']) {
            $date_to = urlencode($submit_data['end']);
            if (isset($submit_data['end']) && $submit_data['end']) {
                $sub_query .= " AND ";
            }
            $sub_query .= " DATE(arrival_date) <= '".date("Y-m-d",strtotime($submit_data['end']))."'";
        }

        if(isset($submit_data['is_inbound']) && $submit_data['is_inbound'] == 1) {
            $sql_add = " WHERE dt.country_id = 1 ";
        } else {
            $sql_add = " WHERE dt.country_id <> 1";
        }

        $current_page = "";
        if(isset($_GET['page'])) {
            $current_page = $_GET['page'];
        }
        $limit = ConstApp::NUMBER_PER_PAGE;
        $offset = $current_page * $limit;

        $total_number = "SELECT hd.*, ports.port_nm_vn as transit_port, ships.ship_nm_vn as ship_nm, agents.agent_nm_vn as agent_nm FROM 
                SELECT ps.*,ports.port_nm_vn as unloading_port  FROM (
                    SELECT dt.*, ports.port_nm_vn as port_nm FROM(
                        $sub_query
                    )as dt 
                    LEFT JOIN ports ON dt.boss_port_id = ports.id
                    $sql_add
                    AND dt.status = 0 ORDER BY id DESC
                ) as ps
                LEFT JOIN ports ON ps.unloading_port_id = ports.id
            ) hd
            WHERE hd.status = 0";
        $number_obj = DB::select(DB::raw($total_number));
        $total = $number_obj[0]->number;

        $sql = "SELECT hd.*, ports.port_nm_vn as transit_port, ships.ship_nm_vn as ship_nm, agents.agent_nm_vn as agent_nm FROM (
                SELECT ps.*,ports.port_nm_vn as unloading_port  FROM (
                    SELECT dt.*, ports.port_nm_vn as port_nm FROM(
                        $sub_query
                    )as dt 
                    LEFT JOIN ports ON dt.boss_port_id = ports.id
                    $sql_add
                    AND dt.status = 0 ORDER BY id DESC
                ) as ps
                LEFT JOIN ports ON ps.unloading_port_id = ports.id
            ) hd
            LEFT JOIN ports ON hd.transit_port_id = ports.id
            LEFT JOIN ships ON hd.ship_id = ships.id
            LEFT JOIN agents ON hd.agent_id = agents.id
            AND hd.status = 0  LIMIT $limit offset $offset";
//        echo $sql;die;
        $result = DB::select(DB::raw($sql));

        $result_data = new Paginator($result, ConstApp::NUMBER_PER_PAGE, $current_page);
        if(isset($submit_data['start']) && isset($submit_data['end'])) {
            $result_data->withPath('?start='.$date_from.'&end='.$date_to.'&is_inbound='.$_GET['is_inbound']);
        } else {
            $result_data->withPath("");
        }
        $data['categories'] = $result_data;
//        print_r($data);die;

//        dd($page1);
//        print_r($page1);die;
//        $limit = 2;
//        $page = 1;
//        $myPaginator = new LengthAwarePaginator($result, count($result), $limit, $page, ['path' => action('scenarios')]);
//        print_r($myPaginator);die;
//        $data['result'] = $myPaginator;
//        $data_query = new Paginator($query, 1);
//        print_r($data_query);die;
//        dd($page1);
//        $data['categories'] = $data_query;
//        print_r($data_query);die;
//        if(isset($submit_data['is_inbound']) && $submit_data['is_inbound'] == 1) {
//            $category->where('country_id','=',1);
//        } else {
//            $category->where('country_id','<>', 1);
//        }
//        if (isset($submit_data['start']) && $submit_data['start']) {
//            $submit_data['start'] = \DateTime::createFromFormat("d/m/Y", $submit_data['start'])->format('Y-m-d');
//            $category->where('departure_day','>=', $submit_data['start']);
//        }
//
//        if (isset($submit_data['end']) && $submit_data['end']) {
//            $submit_data['end'] = \DateTime::createFromFormat("d/m/Y", $submit_data['end'])->format('Y-m-d');
//            $category->orWhere('arrival_date','<=', $submit_data['end']);
//        }
//        dd($category->toSql());die;
//        $data['categories'] = $category->orderBy('id', 'DESC')->paginate($this->limit);
        $id = isset($_GET['id'])?$_GET['id']:0;
        $data['scenario'] = Scenario::where('id', $id)->first();
        $data['ports'] = Port::get();
        $data['ships'] = Ship::get();
        $data['agents'] = Agent::get();
        $data['download_link'] = route('export').'?';
        foreach ($submit_data as $k => $v){
            $data['download_link'] .= $k.'='.$v.'&';
        }
        return view('backend.scenarios.index', $data);
    }

    public function paginates($items, $total , $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items,  $total, $perPage, $page, $options);
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
            $request->validate([
                'boss_port_id' => 'required|numeric|min:0|not_in:0',
                'unloading_port_id' => 'required|numeric|min:0|not_in:0',
                'transit_port_id' => 'required|numeric|min:0|not_in:0',
                'ship_id' => 'required|numeric|min:0|not_in:0',
                'agent_id' => 'required|numeric|min:0|not_in:0',
                'departure_day' => ['required'],
                'arrival_date' => ['required'],
            ]);
        $port = Port::where('id', $data['boss_port_id'])->first();
        $data['country_id'] = isset($port->country_id)?$port->country_id:0;
        $data['departure_day'] = \DateTime::createFromFormat("d/m/Y", $data['departure_day'])->format('Y-m-d');
        $data['arrival_date'] = \DateTime::createFromFormat("d/m/Y", $data['arrival_date'])->format('Y-m-d');
        $departure_day = Carbon::parse($data['departure_day']);
        $arrival_date = Carbon::parse($data['arrival_date']);
        $data['total_date'] = $departure_day->diffInDays($arrival_date);
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
            Scenario::where('id', $data['id'])->update($update);
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

            Scenario::create($update);
        }
        $data['limit'] = $this->limit;
        $category = Scenario::where('id','>', 0);
        $data['categories'] = $category->orderBy('id', 'DESC')->paginate($this->limit);
        $data['download_link'] = route('export').'?';
        return view('backend.scenarios.ajax', $data);
//        return redirect()->route('admin.scenarios')->with('status', 'Lưu thông tin thành công');
    }

    public function export(Request $request)
    {
        print_r($request);die;
        $conditions = $request->all();
        return \Excel::download(new ScenarioExport($conditions), 'download_'.date("YmdHis").'.xlsx');
    }

    public function delete($category_id){
        Scenario::where('id', $category_id)->delete();
        return redirect()->route('admin.scenarios')->with('status', 'Xóa thông tin thành công');
    }

}
