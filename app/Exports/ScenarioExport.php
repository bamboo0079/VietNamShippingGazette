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
        $this->data = $query->orderBy('id','DESC')->get();
    }

    public function collection()
    {

        $data = [];
        $count = 0;
        $header = [];
        $locate = [];
        $detail = [];
        $last_name = '';
        $last_name2 = '';
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
            }
            $last_name2 = $current_name2;

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
//        print_r($header);
//        print_r($locate);
//        print_r($data);die;
        return collect($data);
    }

    public function registerEvents(): array
    {
        $count = 0;
        $header = [];
        $locate = [];
        $detail = [];
        $last_name = '';
        $last_name2 = '';
        foreach ($this->data as $key => $item){
            $current_name = $item->boss->port_nm_vn.','.$item->country->country_nm_vn;
            if($current_name != $last_name){
                $count++;
                $header[] = $count;
            }
            $last_name = $current_name;

            $current_name2 = $item->unloading->port_nm_vn;
            if($current_name2 != $last_name2){
                $count++;
                $locate[] = $count;
            }
            $last_name2 = $current_name2;

            $count++;
            $detail[] = $count;
        }
        $data = [
            'header' => $header,
            'locate' => $locate,
            'detail' => $detail,
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
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setName('Arial Narrow')->getColor()->setARGB('FF0000');
                foreach ($data['header'] as $item){
                    $cellRange = 'A'.$item.':F'.$item;
                    $cellRange2 = 'A'.$item.':C'.$item;
                    $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(10);
                    $event->sheet->getStyle($cellRange)->ApplyFromArray($styleBold);
                    $event->sheet->mergeCells($cellRange);
                }
                foreach ($data['locate'] as $item){
                    $cellRange = 'A'.$item.':F'.$item;
                    $cellRange2 = 'A'.$item.':C'.$item;
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
