<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Perusahaan;
use Auth;


class PerusahaanController extends Controller
{

    public function __construct(){
        //untuk pengecualian pakai except
        // $this->middleware('auth')->except('index');

        //untuk yg disetujui di berlakukan autentifikasi
        // $this->middleware('auth')->only('delete');

        $this->middleware('auth');
    }

    public function create(){
        return view('perusahaan.create');
    }

    public function store(Request $request){
        $request->validate([
            'nama_perusahaan' => 'required|max:45',
            'email' => 'unique:perusahaan'
        ]);
        // Dengan Query Builder    
        // $query = DB::table('perusahaan')->insert([
        //     'nama_perusahaan' => $request['nama_perusahaan'], 
        //     'alamat' => $request['alamat'],
        //     'no_telp' => $request['no_telp'],
        //     'email' => $request['email'],
        //     'created_at'=> date('Y-m-d H:i:s')
        // ]);

        // Dengan ORM 
        // $perusahaan = new Perusahaan;
        // $perusahaan->nama_perusahaan = $request['nama_perusahaan'];
        // $perusahaan->alamat = $request['alamat'];
        // $perusahaan->no_telp = $request['no_telp'];
        // $perusahaan->email = $request['email'];
        // $perusahaan->save();

        //Dengan Miss Asignment
        // $perusahaan = Perusahaan::create([
        //     'nama_perusahaan' => $request['nama_perusahaan'], 
        //         'alamat' => $request['alamat'],
        //         'no_telp' => $request['no_telp'],
        //         'email' => $request['email'],
        //         'createduser_id' => Auth::user()->id

        // ]);

        
        
        // $user = Auth::user();
        // $perusahaan = $user->perusahaan()->create([
        //         'nama_perusahaan' => $request['nama_perusahaan'], 
        //         'alamat' => $request['alamat'],
        //         'no_telp' => $request['no_telp'],
        //         'email' => $request['email']
        // ]);
        // return redirect('perusahaan')->with('success', 'Post Berhasil Disimpan !');

         $perusahaan = Perusahaan::create([
            'nama_perusahaan' => $request['nama_perusahaan'], 
                'alamat' => $request['alamat'],
                'no_telp' => $request['no_telp'],
                'email' => $request['email'],
        ]);

        $user = Auth::user();
        $user->perusahaan()->associate($perusahaan);

        $user->save;
    }

    public function index(){
        // Pakai query builder
        // $perusahaan = DB::table('perusahaan')->get(); 

        //pakai ERM
        // $perusahaan = Perusahaan::all();
        // dd($perusahaan[0]);

        // one to many
        $user = Auth::user();
        $perusahaan = $user->perusahaan;
        return view('perusahaan.index', compact('perusahaan'));
    }

    public function show($id){
        //metode query builder
        // $perusahaan = DB::table('perusahaan')->where('id', $id)->first();

        //metode erm
        $perusahaan = Perusahaan::find($id);
        return view('perusahaan.show', compact('perusahaan'));
    }

    public function edit($id){
        //query builder
        // $perusahaan = DB::table('perusahaan')->where('id', $id)->first();
        
        //metode erm
        $perusahaan = Perusahaan::find($id);
        return view('perusahaan.edit', compact('perusahaan'));
    }

    public function update($id, Request $request){
        $request->validate([
            'nama_perusahaan' => 'required|max:45',
        ]);
        
        // query builder
        // $query = DB::table('perusahaan')
        //       ->where('id', $id)
        //       ->update([
        //           'nama_perusahaan' => $request['nama_perusahaan'],
        //           'alamat' => $request['alamat'],
        //           'no_telp' => $request['no_telp'],
        //           'email' => $request['email']
        //           ]);

        // dengan ORM
        $update = Perusahaan::where('id', $id)->update([
            'nama_perusahaan' => $request['nama_perusahaan'],
            'alamat' => $request['alamat'],
            'no_telp' => $request['no_telp'],
            'email' => $request['email']
        ]);
        return redirect('/perusahaan')->with('success', 'Berhasil update data');
    }

    public function destroy($id){
        //query builder
        // $query = DB::table('perusahaan')->where('id', $id)->delete();

        //orm
        $perusahaan = Perusahaan::destroy($id);
        return redirect('/perusahaan')->with('success', 'Berhasil hapus data');
    }


}
