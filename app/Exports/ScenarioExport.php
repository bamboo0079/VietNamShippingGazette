<?php

namespace App\Exports;

use App\Models\Scenario;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use RegistersEventListeners;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ScenarioExport implements FromCollection, /*WithHeadings,*/ ShouldAutoSize, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $conditions;
    protected $data;
    protected $header;
    protected $locate;
    protected $transit;
    protected $detail;

    public function __construct($conditions)
    {
        $this->conditions = $conditions;
        $submit_data = $this->conditions;
        $query = Scenario::query();
        if (isset($submit_data['is_inbound']) && $submit_data['is_inbound'] == 1) {
            $query->where('country_id', 1);
        } else {
            $query->where('country_id', '<>', 1);
        }
        if (isset($submit_data['start']) && $submit_data['start']) {
            $query->where('arrival_date', '>=', $submit_data['start']);
        }
        if (isset($submit_data['end']) && $submit_data['end']) {
            $query->where('departure_day', '<=', $submit_data['end']);
        }
        $this->data = $query->orderBy('boss_port_id','ASC')->orderBy('country_id','ASC')->orderBy('unloading_port_id','ASC')->get();
    }

    public function collection()
    {
        $cond = $this->conditions;
        $data = [];
        $count = 0;
        $header = [];
        $locate = [];
        $transit = [];
        $detail = [];
        $last_name = '';
        $last_name2 = '';
        $last_name3 = '';
        foreach ($this->data as $key => $item){
            $current_name = $item->boss->port_nm_vn.','.$item->country->country_nm_vn;
            if($current_name != $last_name){
                $count++;
                $header[] = $count;
                $data[] =  [
                    'title1' => ''.$item->boss->port_nm_vn.','.$item->country->country_nm_vn,
                    'title2' =>'',
                    'title3' =>'',
                    'title4' =>'',
                    'title5' =>'',
                    'title6' =>'',
                ];
                $last_name2 = '';
                $last_name3 = '';
            }
            $last_name = $current_name;

            $current_name2 = $item->unloading->port_nm_vn;
            if($current_name2 != $last_name2){
                $count++;
                $locate[] = $count;
                $data[] =  [
                    'title1' => ''.$item->unloading->port_nm_vn,
                    'title2' =>'',
                    'title3' =>'',
                    'title4' =>'',
                    'title5' =>'',
                    'title6' =>'',
                ];
                $last_name3 = '';
            }
            $last_name2 = $current_name2;

            $current_name3 = (isset($cond['country']) && $cond['country'] == 1 && isset($item->transit->port_nm_vn))?$item->transit->port_nm_vn:'';
            if($current_name3 != $last_name3){
                $count++;
                $transit[] = $count;
                $data[] =  [
                    'title1' => '',
                    'title2' =>''.$item->transit->port_nm_vn,
                    'title3' =>'',
                    'title4' =>'',
                    'title5' =>'',
                    'title6' =>'',
                ];
            }
            $last_name3 = $current_name3;

            $count++;
            $detail[] = $count;
            $data[] =  [
                'title1' => ''.date("d-m", strtotime($item->departure_day)),
                'title2' =>'('.substr(date("D", strtotime($item->departure_day)), 0, 2).')',
                'title3' =>''.$item->ship->ship_nm_vn.'('.$item->agent->agent_nm_vn.')',
                'title4' =>''.date("d-m", strtotime($item->arrival_date)),
                'title5' =>'('.substr(date("D", strtotime($item->arrival_date)), 0, 2).')',
                'title6' =>'('.$item->total_date.' days)',
            ];
        }
        return collect($data);
    }

    public function registerEvents(): array
    {
        $cond = $this->conditions;
        $count = 0;
        $header = [];
        $locate = [];
        $detail = [];
        $transit = [];
        $last_name = '';
        $last_name2 = '';
        $last_name3 = '';
        foreach ($this->data as $key => $item){
            $current_name = $item->boss->port_nm_vn.','.$item->country->country_nm_vn;
            if($current_name != $last_name){
                $count++;
                $header[] = $count;
                $last_name2 = '';
                $last_name3 = '';
            }
            $last_name = $current_name;

            $current_name2 = $item->unloading->port_nm_vn;
            if($current_name2 != $last_name2){
                $count++;
                $locate[] = $count;
                $last_name3 = '';
            }
            $last_name2 = $current_name2;

            $current_name3 = (isset($cond['country']) && $cond['country'] == 1 && isset($item->transit->port_nm_vn))?$item->transit->port_nm_vn:'';
            if($current_name3 != $last_name3){
                $count++;
                $transit[] = $count;
            }
            $last_name3 = $current_name3;

            $count++;
            $detail[] = $count;
        }

        $color = 'FF0000';
        if(isset($cond['country']) && $cond['country'] == 1){
            $color = '000000';
        }
        $data = [
            'header' => $header,
            'locate' => $locate,
            'transit' => $transit,
            'detail' => $detail,
            'color' => $color,
        ];
        return [
            AfterSheet::class => function (AfterSheet $event) use ($data) {
                $styleBold = [
                    'font' => [
                        'bold' => true,
                    ]
                ];
                $cellRange = 'A1:F100'; // All headers
                $event->sheet->getSheetView()->setZoomScale(175);
                $event->sheet->getColumnDimension('A')->setAutoSize(false)->setWidth(3);
                $event->sheet->getColumnDimension('B')->setAutoSize(false)->setWidth(2);
                $event->sheet->getColumnDimension('C')->setAutoSize(false)->setWidth(20);
                $event->sheet->getColumnDimension('D')->setAutoSize(false)->setWidth(3);
                $event->sheet->getColumnDimension('E')->setAutoSize(false)->setWidth(2);
                $event->sheet->getColumnDimension('F')->setAutoSize(false)->setWidth(5);
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setName('Arial Narrow')->getColor()->setARGB($data['color']);
                foreach ($data['header'] as $item){
                    $cellRange = 'A'.$item.':F'.$item;
                    $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(10);
                    $event->sheet->getStyle($cellRange)->ApplyFromArray($styleBold);
                    $event->sheet->mergeCells($cellRange);
                }
                foreach ($data['locate'] as $item){
                    $cellRange = 'A'.$item.':F'.$item;
                    $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(7);
                    $event->sheet->getStyle($cellRange)->ApplyFromArray($styleBold);
                    $event->sheet->mergeCells($cellRange);
                }
                foreach ($data['transit'] as $item){
                    $cellRange = 'B'.$item.':F'.$item;
                    $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(7);
                    $event->sheet->getStyle($cellRange)->ApplyFromArray($styleBold);
                    $event->sheet->mergeCells($cellRange);
                }
                foreach ($data['detail'] as $item){
                    $cellRange = 'A'.$item.':F'.$item;
                    $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(6);
                }
            },
        ];
    }
}
