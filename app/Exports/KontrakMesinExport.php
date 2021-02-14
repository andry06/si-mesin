<?php

namespace App\Exports;

use App\KontrakMesin;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use DB;

class KontrakMesinExport implements FromView, WithDrawings, ShouldAutoSize, WithStyles
{

    protected $filtertahun;
    protected $filterketerangan;
    protected $filtervendor_id;
    protected $filterstatus;

    function __construct($filtertahun, $filterketerangan, $filtervendor_id, $filterstatus)
    {
        $this->filtertahun = $filtertahun;
        $this->filterketerangan = $filterketerangan;
        $this->filtervendor_id = $filtervendor_id;
        $this->filterstatus = $filterstatus;
    }
    
    public function view(): View
    {
        
        $data = KontrakMesin::Select([
            'kontrak_mesin.*',
            'vendors.nama_vendor',
            'users.name' 
            ])->join('vendors', 'vendors.id', '=', 'kontrak_mesin.vendor_id')
            ->join('users', 'users.id', '=', 'kontrak_mesin.createduser_id');

        if($this->filtertahun!=null){
            $data = $data->where('tgl_awal_kontrak', 'like',  '%'.$this->filtertahun.'%')->get();
        }

        if($this->filterketerangan!=null){
            $data = $data->where('keterangan', $this->filterketerangan)->get();
        }

        if($this->filtervendor_id!=null){
            $data = $data->where('vendor_id', $this->filtervendor_id)->get();
        }

        if($this->filterstatus!=null){
            $data = $data->where('status', $this->filterstatus)->get();
        }
        
        return view('kontrakmesin.excel', compact('data'));
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(public_path('/img/fgx.png'));
        $drawing->setHeight(50);
        $drawing->setCoordinates('B1');

        return $drawing;
    }    

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            2    => ['font' => ['size' => 16]],

        ];

    }
}
