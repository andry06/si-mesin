<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\Exports\JenisMesinExport;

use DB;
use App\JenisMesin;
use App\Perusahaan;
use Auth;


class JenisMesinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        //untuk pengecualian pakai except
        // $this->middleware('auth')->except('index');

        //untuk yg disetujui di berlakukan autentifikasi
        // $this->middleware('auth')->only('delete');

        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $jenismesin = JenisMesin::all()->sortBy('kode_number');
        return view('jenismesin.index', compact('jenismesin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // / Dengan Query Builder    
        
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
            'kode_number' => 'required|max:3|unique:jenis_mesin',
            'jenis_mesin' => 'required|max:45|unique:jenis_mesin'            
        ]);
        
        $jenismesin = JenisMesin::create([
                    'kode_number' => $request['kode_number'],
                    'jenis_mesin' => strtolower($request['jenis_mesin']),
                    'createduser_id' => Auth::user()->id
                    ]);
    
        Alert::success('Berhasil', 'Berhasil Menambahkan Data');
        return redirect('/jenismesin');    
        // return redirect('/jenismesin')->with('success', 'Post Berhasil Disimpan !');
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
        $jenismesin = JenisMesin::find($id);

	    return response()->json([
	      'data' => $jenismesin
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
            'jenis_mesin' => 'required|max:45'
        ]);

        $update = JenisMesin::where('id', $id)->update([
            'jenis_mesin' => $request['jenis_mesin']
        ]);

        Alert::success('Berhasil', 'Berhasil Mengedit Data');
        return redirect('/jenismesin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
    }

    public function number()
    {
        $jenismesin = DB::select("SELECT MAX(kode_number)+1 lanjutan FROM jenis_mesin");
        $jenismesin1 = sprintf("%02s", $jenismesin[0]->lanjutan);

        return response()->json([
            'data' => $jenismesin1
          ]);
    }

    public function hapus($id)
    {
        // menghapus data pegawai berdasarkan id yang dipilih
        $jenismesin = JenisMesin::destroy($id);
        Alert::success('Berhasil', 'Berhasil Menghapus User');
        return redirect('/jenismesin');
    }

    public function exportexcel(Request $request)
    {
        return Excel::download(new JenisMesinExport, 'jenismesin.xlsx');
        
    }

    public function printdata()
    {
        $perusahaan = Perusahaan::find(1)->get();
        $jenismesin = JenisMesin::all()->sortBy('kode_number');
        return view('jenismesin.printdata', compact('jenismesin', 'perusahaan'));
    }
}
