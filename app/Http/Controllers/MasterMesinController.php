<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use App\Exports\MasterMesinExport;
use DB;
use Illuminate\Http\Request;
use App\MasterMesin;
use App\MerkMesin;


use Auth;

class MasterMesinController extends Controller
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
        $master = MasterMesin::All();
        $jenismesin = DB::table('jenis_mesin')->select('id', 'jenis_mesin as jenismesin')->get();
        $merkmesin = DB::table('merk_mesin')->select('*')->get();
        
        $vendors = DB::select("select * from vendors order BY (nama_vendor = 'pt. fgx indonesia') DESC, nama_vendor");
        
        return view('mastermesin.index', compact('master', 'jenismesin', 'merkmesin', 'vendors'));
    }

    public function data(Request $request)
    {
        $orderBy = 'jenis_mesin.jenis_mesin';
        switch($request->input('order.0.column')){
            case "1" :
                $orderBy = 'merk_mesin.merk_mesin';
                break;
            case "2" :
                $orderBy = 'master_mesin.type';
                break;
            case "3" :
                $orderBy = 'master_mesin.no_seri';
                break;
            case "4" :
                $orderBy = 'vendors.nama_vendor';
                break;
            case "5" :
                $orderBy = 'master_mesin.barcode_mesin';
                break;
            case "6" :
                $orderBy = 'master_mesin.status';
                break;
        }

        $data = MasterMesin::Select([
            'master_mesin.*', 
            'jenis_mesin.jenis_mesin',
            'merk_mesin.merk_mesin',
            'vendors.nama_vendor' 
            ])->join('jenis_mesin', 'jenis_mesin.id', '=', 'master_mesin.jenismesin_id')
            ->join('merk_mesin', 'merk_mesin.id', '=', 'master_mesin.merkmesin_id')
            ->join('vendors', 'vendors.id', '=', 'master_mesin.vendor_id')
        ;

        if($request->input('search.value')!=null){
            $data = $data->where(function($q)use($request){
                $q->whereRaw('LOWER(jenis_mesin) like ? ', ['%'.strtolower($request->input('search.value')).'%'])
                ->orWhereRaw('LOWER(merk_mesin) like ? ', ['%'.strtolower($request->input('search.value')).'%'])
                ->orWhereRaw('LOWER(type) like ? ', ['%'.strtolower($request->input('search.value')).'%'])
                ->orWhereRaw('LOWER(no_seri) like ? ', ['%'.strtolower($request->input('search.value')).'%'])
                ->orWhereRaw('LOWER(nama_vendor) like ? ', ['%'.strtolower($request->input('search.value')).'%'])
                ->orWhereRaw('LOWER(barcode_mesin) like ? ', ['%'.strtolower($request->input('search.value')).'%'])
                ->orWhereRaw('LOWER(status) like ? ', ['%'.strtolower($request->input('search.value')).'%']);
                ;
            });
        }
        
        if($request->input('filter_jenismesin')!=null){
            $data = $data->where('jenismesin_id', $request->filter_jenismesin);
        }

        if($request->input('filter_merkmesin')!=null){
            $data = $data->where('merkmesin_id', $request->filter_merkmesin);
        }

        if($request->input('filter_vendor')!=null){
            $data = $data->where('vendor_id', $request->filter_vendor);
        }

        if($request->input('filter_status')!=null){
            $data = $data->where('status', $request->filter_status);
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
            'jenismesin_id' => 'required',
            'merkmesin_id' => 'required',
            'type' => 'required|max:20',
            'no_seri' => 'required|max:20',
            'vendor_id' => 'required',
            'barcode_mesin' => 'required',
            'status' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        
        if(empty($request['photo'])){    
            $user = MasterMesin::create([
                'jenismesin_id' => $request['jenismesin_id'],
                'merkmesin_id' => $request['merkmesin_id'],
                'type' => $request['type'],
                'no_seri' => $request['no_seri'],
                'vendor_id' => $request['vendor_id'],
                'status' => $request['status'],
                'barcode_mesin' => $request['barcode_mesin'],
                'createduser_id' => Auth::user()->id,
            ]);
        }else{
        $photo = date('d-m-Y').'_'.date('h_i_s').'_'.$request['barcode_mesin'].'.'.$request->photo->extension(); 
            $user = MasterMesin::create([
                'jenismesin_id' => $request['jenismesin_id'],
                'merkmesin_id' => $request['merkmesin_id'],
                'type' => $request['type'],
                'no_seri' => $request['no_seri'],
                'vendor_id' => $request['vendor_id'],
                'status' => $request['status'],
                'barcode_mesin' => $request['barcode_mesin'],
                'createduser_id' => Auth::user()->id,
                'photo' => $photo
            ]);
        $request->photo->move(public_path('img/mesin'), $photo);
        }

        Alert::success('Berhasil', 'Berhasil Menambahkan Mesin');
        return redirect('/mastermesin');
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
        $master = DB::select("SELECT A.*, B.kode_number, B.jenis_mesin, C.merk_mesin, D.vendor_number, D.nama_vendor
                 from master_mesin A join jenis_mesin B on A.jenismesin_id = B.id
                join merk_mesin C on A.merkmesin_id = C.id join vendors D on A.vendor_id = D.id 
                WHERE A.id = :id", ['id' => $id]);
        $barcode = (string)$master[0]->barcode_mesin;
        $src = "data:image/png;base64,{{DNS1D::getBarcodePNG('$barcode', 'C128A')}}";
        

	    return response()->json([
          'data' => $master[0],
    
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
            'jenismesin_id' => 'required',
            'merkmesin_id' => 'required',
            'type' => 'required|max:20',
            'no_seri' => 'required|max:20',
            'vendor_id' => 'required',
            'barcode_mesin' => 'required',
            'status' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        
       
        if(empty($request['photo'])){
        $update = MasterMesin::where('id', $id)->update([
                'jenismesin_id' => $request['jenismesin_id'],
                'merkmesin_id' => $request['merkmesin_id'],
                'type' => $request['type'],
                'no_seri' => $request['no_seri'],
                'vendor_id' => $request['vendor_id'],
                'status' => $request['status'],
                'barcode_mesin' => $request['barcode_mesin'],
        ]);
        }else{
            $photo = date('d-m-Y').'_'.date('h_i_s').'_'.$request['barcode_mesin'].'.'.$request->photo->extension(); 
            $update = MasterMesin::where('id', $id)->update([
                'jenismesin_id' => $request['jenismesin_id'],
                'merkmesin_id' => $request['merkmesin_id'],
                'type' => $request['type'],
                'no_seri' => $request['no_seri'],
                'vendor_id' => $request['vendor_id'],
                'status' => $request['status'],
                'barcode_mesin' => $request['barcode_mesin'],
                'photo' => $photo
            ]);
            $request->photo->move(public_path('img/mesin'), $photo);   
        }
        Alert::success('Berhasil', 'Berhasil Mengedit User');
        return redirect('/mastermesin');
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
        $user = MasterMesin::destroy($id);
        Alert::success('Berhasil', 'Berhasil Menghapus User');
        return redirect('/mastermesin');
    }

    public function barcode($idvendor, $idjm)
    {
        //dengan query builder
        $vendors = DB::table('vendors')->select('vendor_number')->where('id', $idvendor)->first();

        $jenismesin = DB::table('jenis_mesin')->select('kode_number')->where('id', $idjm)->first();;
       
        $tahun = date('ym');

        //dengan binding sql
        $barcode = DB::select("SELECT IFNULL(max(SUBSTRING(barcode_mesin, -4)), 0)+1 lanjutan from master_mesin WHERE vendor_id = :id", ['id' => $idvendor]);
        $nourut = sprintf("%04s", $barcode[0]->lanjutan);

        $gabungan = $tahun.$jenismesin->kode_number.$vendors->vendor_number.$nourut;

	    return response()->json([
          'data' => $gabungan
        ]);
    }

    public function print(Request $request)
    {
        $id = $request->id; 
        $data = implode(",", $id);
        $master = DB::select("select barcode_mesin from master_mesin where id in ($data)");
        
        return view('mastermesin.print', compact('master'));
    }

    public function exportexcel(Request $request)
    {
        // dd($request->filterjenismesin_id);
        return Excel::download(new MasterMesinExport($request->filterjenismesin_id, $request->filtermerkmesin_id, $request->filtervendor_id, $request->filterstatus), 'Master Mesin.xlsx');
    }
    
}
