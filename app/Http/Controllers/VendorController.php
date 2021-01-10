<?php

namespace App\Http\Controllers;
use RealRashid\SweetAlert\Facades\Alert;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use DB;
use App\Vendor;
use App\Perusahaan;
use Auth;
use App\Exports\VendorExport;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $vendors = Vendor::all()->sortBy('vendor_number');
        return view('vendors.index', compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_vendor' => 'required|max:50|unique:vendors',
            'vendor_number' => 'required|max: 3|unique:vendors',
            'alamat' => 'max:100',
            'negara' => 'max:50',
            'no_telp' => 'max: 13'
        ]);
        
        $vendors = Vendor::create([
                    'nama_vendor' => strtolower($request['nama_vendor']),
                    'vendor_number' => $request['vendor_number'],
                    'alamat' => strtolower($request['alamat']),
                    'negara' => strtolower($request['negara']),
                    'no_telp' => strtolower($request['no_telp']),
                    'createduser_id' => Auth::user()->id
                    ]);
    
        Alert::success('Berhasil', 'Berhasil Menambahkan Data');
        return redirect('/vendors'); 

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vendor = Vendor::find($id);

	    return response()->json([
	      'data' => $vendor
        ]);
         
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_vendor' => 'required|max:50',
            'alamat' => 'max:100',
            'negara' => 'max:50',
            'no_telp' => 'max: 13'
        ]);

        $update = Vendor::where('id', $id)->update([
            'nama_vendor' => strtolower($request['nama_vendor']),
            'alamat' => strtolower($request['alamat']),
            'negara' => strtolower($request['negara']),
            'no_telp' => strtolower($request['no_telp']),
            ]);

        Alert::success('Berhasil', 'Berhasil Mengedit Data');
        return redirect('/vendors');   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function hapus($id)
    {
        // menghapus data pegawai berdasarkan id yang dipilih
        $vendor = Vendor::destroy($id);
        Alert::success('Berhasil', 'Berhasil Menghapus User');
        return redirect('/vendors');
    }

    public function exportexcel(Request $request)
    {
        return Excel::download(new VendorExport, 'datavendor.xlsx');
        
    }

    public function printdata()
    {
        $perusahaan = Perusahaan::find(1)->get();
        $vendors = Vendor::all()->sortBy('name');
        return view('vendors.printdata', compact('vendors', 'perusahaan'));
    }

    public function number()
    {
        $vendor = DB::select("SELECT MAX(vendor_number)+1 lanjutan FROM vendors");
        $vendor1 = sprintf("%03s", $vendor[0]->lanjutan);
        
        return response()->json([
            'data' => $vendor1
          ]);
    }
}
