<?php

namespace App\Exports;

use App\MasterMesin;
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

class MasterMesinExport implements FromView, WithDrawings, ShouldAutoSize, WithStyles
{

    protected $filterjenismesin_id;
    protected $filtermerkmesin_id;
    protected $filtervendor_id;
    protected $filterstatus;

    function __construct($filterjenismesin_id, $filtermerkmesin_id, $filtervendor_id, $filterstatus)
    {
        $this->jenismesin_id = $filterjenismesin_id;
        $this->merkmesin_id = $filtermerkmesin_id;
        $this->vendor_id = $filtervendor_id;
        $this->status = $filterstatus;
    }
    
    public function view(): View
    {
        
        $data = MasterMesin::all();

        if($this->jenismesin_id!=null){
            $data = $data->where('jenismesin_id', $this->jenismesin_id);
        }

        if($this->merkmesin_id!=null){
            $data = $data->where('merkmesin_id', $this->merkmesin_id);
        }

        if($this->vendor_id!=null){
            $data = $data->where('vendor_id', $this->vendor_id);
        }

        if($this->status!=null){
            $data = $data->where('status', $this->status);
        }
        
        return view('mastermesin.excel', compact('data'));
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
