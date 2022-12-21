<?php

namespace App\Exports;

use App\Models\Scenario;
use Maatwebsite\Excel\Concerns\FromCollection;
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
    protected $export_cound;
    protected $data_out_bound;
    protected $data_in_bound;

    public function __construct($conditions)
    {
       $this->data_out_bound = [];
       $this->data_in_bound = [];
        $this->conditions = $conditions;
        $submit_data = $this->conditions;
        $this->export_cound = 0;
        $query = Scenario::query();
        if (isset($submit_data['is_inbound']) && $submit_data['is_inbound'] == 1) {
            $query->where('scenarios.country_id', 1);
        } else {
            $query->where('scenarios.country_id', '<>', 1);
        }

        if (isset($submit_data['start']) && $submit_data['start']) {
            $submit_data['start'] = $this->formatDate($submit_data['start']);
            $query->where('scenarios.departure_day','>=', $submit_data['start']);
        }
        if (isset($submit_data['end']) && $submit_data['end']) {
            $submit_data['end'] = $this->formatDate($submit_data['end']);
            $query->where('scenarios.arrival_date','<=', $submit_data['end']);
        }

        if (isset($submit_data['country_id']) && $submit_data['country_id'] != 0) {
            $query->where('scenarios.country_id','=', $submit_data['country_id']);
        }
        if (isset($submit_data['boss_port_id']) && $submit_data['boss_port_id'] != 0) {
            $query->where('scenarios.boss_port_id','=', $submit_data['boss_port_id']);
        }
        if (isset($submit_data['unloading_port_id']) && $submit_data['unloading_port_id'] != 0) {
            $query->where('scenarios.unloading_port_id','=', $submit_data['unloading_port_id']);
        }
        if (isset($submit_data['transit_port_id']) && $submit_data['transit_port_id'] != 0) {
            $query->where('scenarios.transit_port_id','=', $submit_data['transit_port_id']);
        }
        if (isset($submit_data['ship_id']) && $submit_data['ship_id'] != 0) {
            $query->where('scenarios.ship_id','=', $submit_data['ship_id']);
        }
        if (isset($submit_data['agent_id']) && $submit_data['agent_id'] != 0) {
            $query->where('scenarios.agent_id','=', $submit_data['agent_id']);
        }
        $this->data = $query->get();
    }

    public function formatDate($date) {
        $expl = explode('/',$date);
        $date_str = $expl[2].'-'.$expl[1].'-'.$expl[0];
        return $date_str;
    }

    public function collection()
    {
        $cond = $this->conditions;
        if(isset($cond['is_inbound']) && $cond['is_inbound'] == 1) { // converse data for outbound
            $data = $this->makeDataOutbound();
        } else { // converse data for inbound

            $data = $this->makeDataExportInBound();
        }

        return collect($data);
    }

    public function makeDataExportoutBound($goup) {

        $data_out_bound = [];
        $i = 0;

        foreach ($goup as $key => $_group) {
            // Data cang nuoc ngoai
            $data_out_bound[$i] = [
                'cang_do' => '' . $key,
                'title2' => '',
                'title3' => '',
                'title4' => '',
                'title5' => '',
                'title6' => ''
            ];
            $i += 1;
            //Data cang trong nuoc
            foreach ($_group as $_key => $item) {
                $data_out_bound[$i] = [
                    'cang_xep' => '' . $_key,
                    'title2' => '',
                    'title3' => '',
                    'title4' => '',
                    'title5' => '',
                    'title6' => ''
                ];

                $i+=1;

                //Data thong tin tau va ngay
                foreach ($item as $_item_key => $child) {
                    if($_item_key == 'None') { // truong hop khong co cang transis
                        foreach ($child as $_child_key => $_child) {
                            $data_out_bound[$i] = $_child;
                            $i+=1;
                        }
                    } else {
                        $data_out_bound[$i] = [
                            'title1' => '',
                            'cang_trantsis' => '' . $_item_key,
                            'title3' => '',
                            'title4' => '',
                            'title5' => '',
                            'title6' => '',
                        ];
                        foreach ($child as $_child_key => $_child) {
                            $i+=1;
                            $data_out_bound[$i] = $_child;
                        }
                        $i+=1;
                    }
                }

            }

        }
        $this->export_cound = $i;
        return $this->data_out_bound = $data_out_bound;
    }

    public function sortDataArray($data) {
        $result_data = [];
        $tmp_arr = [];
        foreach ($data as $key => $value) {
            $first_char = substr($key, 0, 8);
            $tmp_arr[$first_char] = $key;
        }
        ksort($tmp_arr);
        foreach ($tmp_arr as $_item) {
            $result_data[$_item] = [];
        }
        return $result_data;
    }

    public function makeDataOutbound() {

        //Sap xep aphabet theo ky tu dau
        $data_sort = [];
        foreach ($this->data as $key => $item) {
            if(isset($item->unloading->port_nm_vn) && $item->unloading->port_nm_vn != "" && isset($item->unloading->country->country_nm_vn) && $item->unloading->country->country_nm_vn != "") {
                $cang_xep = mb_strtoupper($item->unloading->port_nm_vn) . ',' . mb_strtoupper($item->unloading->country->country_nm_vn);
                if(!isset($data_sort[$cang_xep])) {
                    $data_sort[$cang_xep] = array();
                }
            }
        }

        $data = $this->sortDataArray($data_sort);

        foreach ($this->data as $key => $item) {
            if(isset($item->unloading->port_nm_vn) && $item->unloading->port_nm_vn != "" && isset($item->unloading->country->country_nm_vn) && $item->unloading->country->country_nm_vn != "") {
                $cang_xep =  mb_strtoupper($item->unloading->port_nm_vn) . ',' . mb_strtoupper($item->unloading->country->country_nm_vn);

                if(isset($item->boss->port_nm_vn) && $item->boss->port_nm_vn != "") {
                    $cang_do = $item->boss->port_nm_vn;
                    $cang_transit = isset($item->transit->port_nm_vn) ? $item->transit->port_nm_vn : "None";
                    $tau_info = [
                        'title1' => '' . date("d-m", strtotime($item->departure_day)),
                        'title2' => '(' . substr(date("D", strtotime($item->departure_day)), 0, 2) . ')',
                        'title3' => '' . isset($item->ship->ship_nm_vn) ? $item->ship->ship_nm_vn : "" . isset($item->agent->agent_nm_vn) ? '(' . $item->agent->agent_nm_vn . ')':"",
                        'title4' => '' . date("d-m", strtotime($item->arrival_date)),
                        'title5' => '(' . substr(date("D", strtotime($item->arrival_date)), 0, 2) . ')',
                        'title6' => '(' . $item->total_date . ' days)',
                    ];

                    $data[$cang_xep][$cang_do][$cang_transit][] = $tau_info;
                }
            }
        }

        return $this->makeDataExportoutBound($data);
    }

    public function exportOutBound() {

        $this->makeDataOutbound();
        $data = $this->data_out_bound;

        return [
            AfterSheet::class => function (AfterSheet $event) use ($data) {
                $export_number = $this->export_cound;

                $styleArray = [
                    'font' => [
                        'bold' => true,
                    ]
                ];
                $cellRange = 'A1:F'.($export_number + 5); // All headers
                $event->sheet->getSheetView()->setZoomScale(160);
                $event->sheet->getColumnDimension('A')->setAutoSize(false)->setWidth(4);
                $event->sheet->getColumnDimension('B')->setAutoSize(false)->setWidth(3);
                $event->sheet->getColumnDimension('C')->setAutoSize(false)->setWidth(20);
                $event->sheet->getColumnDimension('D')->setAutoSize(false)->setWidth(4);
                $event->sheet->getColumnDimension('E')->setAutoSize(false)->setWidth(4);
                $event->sheet->getColumnDimension('F')->setAutoSize(false)->setWidth(5);
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setName('Arial Narrow')->getColor()->setARGB('FF0000');
                $event->sheet->getStyle('A1:F1')->ApplyFromArray($styleArray);

               foreach ($data as $number => $_data) {
                    $i = $number + 1;
                    if(isset($_data['cang_do']) && $_data['cang_do'] != "") {
                        $cellRange = 'A'.$i.':F'.$i;
                        $event->sheet->getDelegate()->getRowDimension($i)->setRowHeight(14);
                        $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(10);
                        $event->sheet->getStyle($cellRange)->ApplyFromArray($styleArray)->getAlignment()->setVertical('center');
                        $event->sheet->mergeCells($cellRange);
                    } elseif (isset($_data['cang_xep']) && $_data['cang_xep'] != "") {
                        $cellRange = 'A'.$i.':F'.$i;
                        $event->sheet->getDelegate()->getRowDimension($i)->setRowHeight(10);
                        $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(7);
                        $event->sheet->getStyle($cellRange)->ApplyFromArray($styleArray)->getAlignment()->setVertical('center');
                        $event->sheet->mergeCells($cellRange);
                    } elseif (isset($_data['cang_trantsis'])) {
                        $cellRange = 'B'.$i.':F'.$i;
                        $event->sheet->getDelegate()->getRowDimension($i)->setRowHeight(10);
                        $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(6);
                        $event->sheet->getStyle($cellRange)->ApplyFromArray($styleArray)->getAlignment()->setVertical('center');
                        $event->sheet->mergeCells($cellRange);
                    } else {
                        foreach ($_data as $detail) {
                            $cellRange = 'A'.$i.':F'.$i;
                            $event->sheet->getDelegate()->getRowDimension($i)->setRowHeight(10);
                            $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(6);
                            $event->sheet->getStyle($cellRange)->getAlignment()->setVertical('center');
                        }
                    }

                }
            },
        ];
    }

    public function exportInbound() {

        $this->makeDataExportInBound();
        $data = $this->data_in_bound;

        return [
            AfterSheet::class => function (AfterSheet $event) use ($data) {
                $export_number = $this->export_cound;

                $styleArray = [
                    'font' => [
                        'bold' => true,
                    ]
                ];
                $cellRange = 'A1:F'.($export_number + 5); // All headers
                $event->sheet->getSheetView()->setZoomScale(160);
                $event->sheet->getColumnDimension('A')->setAutoSize(false)->setWidth(4);
                $event->sheet->getColumnDimension('B')->setAutoSize(false)->setWidth(3);
                $event->sheet->getColumnDimension('C')->setAutoSize(false)->setWidth(20);
                $event->sheet->getColumnDimension('D')->setAutoSize(false)->setWidth(4);
                $event->sheet->getColumnDimension('E')->setAutoSize(false)->setWidth(4);
                $event->sheet->getColumnDimension('F')->setAutoSize(false)->setWidth(5);
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setName('Arial Narrow')->getColor()->setARGB('FF0000');
                $event->sheet->getStyle('A1:F1')->ApplyFromArray($styleArray);

                foreach ($data as $number => $_data) {
                    $i = $number + 1;
                    if(isset($_data['cang_do']) && $_data['cang_do'] != "") {
                        $cellRange = 'A'.$i.':F'.$i;
                        $event->sheet->getDelegate()->getRowDimension($i)->setRowHeight(14);
                        $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);
                        $event->sheet->getStyle($cellRange)->ApplyFromArray($styleArray)->getAlignment()->setVertical('center');
                        $event->sheet->mergeCells($cellRange);
                    } elseif (isset($_data['cang_xep']) && $_data['cang_xep'] != "") {
                        $cellRange = 'A'.$i.':F'.$i;
                        $event->sheet->getDelegate()->getRowDimension($i)->setRowHeight(10);
                        $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(7);
                        $event->sheet->getStyle($cellRange)->ApplyFromArray($styleArray)->getAlignment()->setVertical('center');
                        $event->sheet->mergeCells($cellRange);
                    } else {
                        foreach ($_data as $detail) {
                            $cellRange = 'A'.$i.':F'.$i;
                            $event->sheet->getDelegate()->getRowDimension($i)->setRowHeight(10);
                            $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(6);
                            $event->sheet->getStyle($cellRange)->getAlignment()->setVertical('center');
                        }
                    }

                }
            },
        ];
    }

    public function makeDataExportInBound() {

        //Sap xep aphabet theo ky tu dau
        $data_sort = [];
        foreach ($this->data as $key => $item) {
            if(isset($item->unloading->port_nm_vn) && $item->unloading->port_nm_vn != "" && isset($item->unloading->country->country_nm_vn) && $item->unloading->country->country_nm_vn != "") {
                $cang_xep = mb_strtoupper($item->boss->port_nm_vn).','.mb_strtoupper($item->boss->country->country_nm_vn);
                if(!isset($data_sort[$cang_xep])) {
                    $data_sort[$cang_xep] = array();
                }
            }
        }

        $goup = $this->sortDataArray($data_sort);

        // Group data follow cang xep
//        $goup = [];
        foreach ($this->data as $key => $item) {
            if(isset($item->unloading->port_nm_vn) && $item->unloading->port_nm_vn != "" && isset($item->unloading->country->country_nm_vn) && $item->unloading->country->country_nm_vn != "") {
                $cang_xep = mb_strtoupper($item->boss->port_nm_vn).','.mb_strtoupper($item->boss->country->country_nm_vn);

                if(isset($item->unloading->port_nm_vn) && $item->unloading->port_nm_vn != "") {
                    $cang_do =  mb_strtoupper($item->unloading->port_nm_vn);
                    $tau_info = [
                        'title1' => '' . date("d-m", strtotime($item->departure_day)),
                        'title2' => '(' . substr(date("D", strtotime($item->departure_day)), 0, 2) . ')',
                        'title3' => '' . $item->ship->ship_nm_vn . '(' . $item->agent->agent_nm_vn . ')',
                        'title4' => '' . date("d-m", strtotime($item->arrival_date)),
                        'title5' => '(' . substr(date("D", strtotime($item->arrival_date)), 0, 2) . ')',
                        'title6' => '(' . $item->total_date . ' days)',
                    ];

                    $goup[$cang_xep][$cang_do][] = $tau_info;
                }

            }
        }

        // Create array to write file excel
        $data_in_bound = [];
        $i = 0;

        foreach ($goup as $key => $_group) {
            // Data cang nuoc ngoai
            $data_in_bound[$i] = [
                'cang_do' => '' . $key,
                'title2' => '',
                'title3' => '',
                'title4' => '',
                'title5' => '',
                'title6' => ''
            ];
            $i += 1;
            //Data cang trong nuoc
            foreach ($_group as $_key => $item) {
                $data_in_bound[$i] = [
                    'cang_xep' => '' . $_key,
                    'title2' => '',
                    'title3' => '',
                    'title4' => '',
                    'title5' => '',
                    'title6' => ''
                ];

                $i+=1;

                //Data thong tin tau va ngay
                foreach ($item as $_item_key => $child) {

                    $data_in_bound[$i] = $child;
                    $i+=1;
                }

            }
        }

        $this->export_cound = $i;
        return $this->data_in_bound = $data_in_bound;
    }

    public function registerEvents(): array
    {

        $cond = $this->conditions;
        if(isset($cond['is_inbound']) && $cond['is_inbound'] == 1){
            return $this->exportOutBound();
        } else {
            return $this->exportInbound();
        }
    }
}