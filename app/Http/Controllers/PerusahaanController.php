<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PerusahaanController extends Controller
{
    public function create(){
        return view('perusahaan.create');
    }

    public function store(Request $request){
        $request->validate([
            'nama_perusahaan' => 'required|max:45',
            'email' => 'unique:perusahaan'
        ]);

        $query = DB::table('perusahaan')->insert([
            'nama_perusahaan' => $request['nama_perusahaan'], 
            'alamat' => $request['alamat'],
            'no_telp' => $request['no_telp'],
            'email' => $request['email'],
            'created_at'=> date('Y-m-d H:i:s')
        ]);
        return redirect('perusahaan')->with('success', 'Post Berhasil Disimpan !');
    }

    public function index(){
        $perusahaan = DB::table('perusahaan')->get();
        // dd($perusahaan);
        return view('perusahaan.index', compact('perusahaan'));
    }

    public function show($id){
        $perusahaan = DB::table('perusahaan')->where('id', $id)->first();
        return view('perusahaan.show', compact('perusahaan'));
    }

    public function edit($id){
        $perusahaan = DB::table('perusahaan')->where('id', $id)->first();
        return view('perusahaan.edit', compact('perusahaan'));
    }

    public function update($id, Request $request){
        $request->validate([
            'nama_perusahaan' => 'required|max:45',
        ]);

        $query = DB::table('perusahaan')
              ->where('id', $id)
              ->update([
                  'nama_perusahaan' => $request['nama_perusahaan'],
                  'alamat' => $request['alamat'],
                  'no_telp' => $request['no_telp'],
                  'email' => $request['email']
                  ]);
        return redirect('/perusahaan')->with('success', 'Berhasil update data');
    }

    public function destroy($id){
        $query = DB::table('perusahaan')->where('id', $id)->delete();
        return redirect('/perusahaan')->with('success', 'Berhasil hapus data');
    }
}
