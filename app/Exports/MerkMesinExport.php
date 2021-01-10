<?php

namespace App\Exports;

use App\MerkMesin;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MerkMesinExport implements FromView, WithDrawings, ShouldAutoSize, WithStyles
{

    public function view(): View
    {
        $merkmesin = MerkMesin::all()->sortBy('merk_mesin');
        
        return view('merkmesin.excel', compact('merkmesin'));
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
