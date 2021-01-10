<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Exports\MerkMesinExport;
use DB;
use App\MerkMesin;
use App\Perusahaan;
use Auth;

class MerkMesinController extends Controller
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
        $merkmesin = MerkMesin::all()->sortBy('merk_mesin');
        return view('merkmesin.index', compact('merkmesin'));
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
            'merk_mesin' => 'required|max:45|unique:merk_mesin',
        ]);
        
        $merkmesin = MerkMesin::create([
                    'merk_mesin' => strtolower($request['merk_mesin']),
                    'createduser_id' => Auth::user()->id
                    ]);
    
        Alert::success('Berhasil', 'Berhasil Menambahkan Data');
        return redirect('/merkmesin'); 
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
        $merkmesin = MerkMesin::find($id);

	    return response()->json([
	      'data' => $merkmesin
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
            'merk_mesin' => 'required|max:45'
        ]);

        $update = MerkMesin::where('id', $id)->update([
            'merk_mesin' => $request['merk_mesin']
        ]);

        Alert::success('Berhasil', 'Berhasil Mengedit Data');
        return redirect('/merkmesin');
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

    
    public function hapus($id)
    {
        // menghapus data pegawai berdasarkan id yang dipilih
        $merkmesin = MerkMesin::destroy($id);
        Alert::success('Berhasil', 'Berhasil Menghapus User');
        return redirect('/merkmesin');
    }

    public function exportexcel(Request $request)
    {
        return Excel::download(new MerkMesinExport, 'merkmesin.xlsx');
        
    }
    
    public function printdata()
    {
        $perusahaan = Perusahaan::find(1)->get();
        $merkmesin = MerkMesin::all()->sortBy('merk_mesin');
        return view('merkmesin.printdata', compact('merkmesin', 'perusahaan'));
    }
}
