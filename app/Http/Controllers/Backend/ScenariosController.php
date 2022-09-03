<?php

namespace App\Http\Controllers\Backend;

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
        $data['limit'] = $this->limit;
        $category = Scenario::where('id','>', 0);
        if (isset($submit_data['country']) && $submit_data['country'] != -1) {
            if($submit_data['country'] == 1){
                $category->where('country_id',1);
            }else{
                $category->where('country_id','>',1);
            }
        }
        if (isset($submit_data['start']) && $submit_data['start']) {
            $submit_data['start'] = \DateTime::createFromFormat("d/m/Y", $submit_data['start'])->format('Y-m-d');
            $category->where('arrival_date','>=', $submit_data['start']);
        }
        if (isset($submit_data['end']) && $submit_data['end']) {
            $submit_data['end'] = \DateTime::createFromFormat("d/m/Y", $submit_data['end'])->format('Y-m-d');
            $category->where('departure_day','<=', $submit_data['end']);
        }

        $data['categories'] = $category->orderBy('id', 'DESC')->paginate($this->limit);
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
        $conditions = $request->all();
        return \Excel::download(new ScenarioExport($conditions), 'download_'.date("YmdHis").'.xlsx');
    }

    public function delete($category_id){
        Scenario::where('id', $category_id)->delete();
        return redirect()->route('admin.scenarios')->with('status', 'Xóa thông tin thành công');
    }

}
