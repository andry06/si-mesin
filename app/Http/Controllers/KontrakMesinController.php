<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use App\Exports\KontrakMesinExport;
use DB;
use App\KontrakMesin;
use App\Perusahaan;
use Auth;


class KontrakMesinController extends Controller
{

    public function __construct(){
        
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        
        $vendors = DB::select("select * from vendors order by nama_vendor");
        $tahunkontrak = DB::select("select DISTINCT DATE_FORMAT(tgl_awal_kontrak, '%Y') tahun from kontrak_mesin");
        
        return view('kontrakmesin.index', compact('vendors', 'tahunkontrak'));
    }

    public function data(Request $request)
    {
        $orderBy = 'kontrak_mesin.no_kontrak';
        switch($request->input('order.0.column')){
            case "1" :
                $orderBy = 'vendors.nama_vendor';
                break;
            case "2" :
                $orderBy = 'kontrak_mesin.tgl_awal_kontrak';
                break;
            case "3" :
                $orderBy = 'kontrak_mesin.tgl_jatuh_tempo';
                break;
            case "4" :
                $orderBy = 'kontrak_mesin.keterangan';
                break;
            case "5" :
                $orderBy = 'kontrak_mesin.status';
                break;
        }

        $data = KontrakMesin::Select([
            'kontrak_mesin.*',
            'vendors.nama_vendor' 
            ])->join('vendors', 'vendors.id', '=', 'kontrak_mesin.vendor_id');

       
            
        if($request->input('search.value')!=null){
            $data = $data->where(function($q)use($request){
                $q->whereRaw('LOWER(vendor_id) like ? ', ['%'.strtolower($request->input('search.value')).'%'])
                ->orWhereRaw('LOWER(nama_vendor) like ? ', ['%'.strtolower($request->input('search.value')).'%'])
                ->orWhereRaw('LOWER(tgl_awal_kontrak) like ? ', ['%'.strtolower($request->input('search.value')).'%'])
                ->orWhereRaw('LOWER(tgl_jatuh_tempo) like ? ', ['%'.strtolower($request->input('search.value')).'%'])
                ->orWhereRaw('LOWER(keterangan) like ? ', ['%'.strtolower($request->input('search.value')).'%'])
                ->orWhereRaw('LOWER(status) like ? ', ['%'.strtolower($request->input('search.value')).'%'])
                ;
            });
        }
        
        if($request->input('filtertahun')!=null){
            $data = $data->where('tgl_awal_kontrak', 'like', '%'.$request->filtertahun.'%');
        }

        if($request->input('filterketerangan')!=null){
            $data = $data->where('keterangan', $request->filterketerangan);
        }

        if($request->input('filtervendor')!=null){
            $data = $data->where('vendor_id', $request->filtervendor);
        }

        if($request->input('filterstatus')!=null){
            $data = $data->where('status', $request->filterstatus);
        }
        
        $recordsFiltered = $data->get()->count();
        if($request->input('length')!=-1) $data =  $data->skip($request->input('start'))->take($request->input('length'));
        $data = $data->orderBy($orderBy, $request->input('order.0.dir'))->get();
        $recordsTotal = $data->count();
        
        return response()->json([
            'draw'=>$request->input('draw'),
            'recordsTotal'=>$recordsTotal,
            'recordsFiltered'=>$recordsFiltered,
            'data'=>$data
        ]);
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
            'no_kontrak' => 'required|max:30|unique:kontrak_mesin',
            'vendor_id' => 'required',
            'tgl_awal_kontrak' => 'required',
            'tgl_jatuh_tempo' => 'required',
            'keterangan' => 'required',
            'status' => 'required'
        ]);    
    
        $user = KontrakMesin::create([
            'no_kontrak' => $request['no_kontrak'],
            'vendor_id' => $request['vendor_id'],
            'tgl_awal_kontrak' => $request['tgl_awal_kontrak'],
            'tgl_jatuh_tempo' => $request['tgl_jatuh_tempo'],
            'keterangan' => $request['keterangan'],
            'status' => $request['status'],
            'createduser_id' => Auth::user()->id
            ]);
        
        Alert::success('Berhasil', 'Berhasil Membuat Kontrak Baru');
        return redirect('/kontrakmesin');
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
        //
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
            'no_kontrak' => 'required|max:30',
            'vendor_id' => 'required',
            'tgl_awal_kontrak' => 'required',
            'tgl_jatuh_tempo' => 'required',
            'keterangan' => 'required',
            'status' => 'required'
        ]);

        $update = KontrakMesin::where('id', $id)->update([
            'no_kontrak' => $request['no_kontrak'],
            'vendor_id' => $request['vendor_id'],
            'tgl_awal_kontrak' => $request['tgl_awal_kontrak'],
            'tgl_jatuh_tempo' => $request['tgl_jatuh_tempo'],
            'keterangan' => $request['keterangan'],
            'status' => $request['status']
        ]);
        
        Alert::success('Berhasil', 'Berhasil Mengedit Data');
        return redirect('/kontrakmesin');

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
        $kontrak = KontrakMesin::destroy($id);
        Alert::success('Berhasil', 'Berhasil Menghapus Kontrak');
        return redirect('/kontrakmesin');
    }

    public function printdata(Request $request)
    {
        $perusahaan = Perusahaan::find(1)->get();

        $data = KontrakMesin::Select([
            'kontrak_mesin.*',
            'vendors.nama_vendor' 
            ])->join('vendors', 'vendors.id', '=', 'kontrak_mesin.vendor_id');

        if($request->filtertahun!=null){
            $data = $data->where('tgl_awal_kontrak', 'like',  '%'.$request->filtertahun.'%')->get();
        }

        if($request->filterketerangan!=null){
            $data = $data->where('keterangan', $request->filterketerangan)->get();
        }

        if($request->filtervendor_id!=null){
            $data = $data->where('vendor_id', $request->filtervendor_id)->get();
        }

        if($request->filterstatus!=null){
            $data = $data->where('status', $request->filterstatus)->get();
        }
        
        return view('kontrakmesin.printdata', compact('data', 'perusahaan'));
    }

    public function exportexcel(Request $request)
    {

        return Excel::download(new KontrakMesinExport($request->filtertahun, $request->filterketerangan, $request->filtervendor_id, $request->filterstatus), 'Kontrak Mesin.xlsx');
    }
}
