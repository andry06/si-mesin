<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

use DB;
use App\JenisMesin;
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
        $jenismesin = JenisMesin::all()->sortBy('jenis_mesin');
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
            'jenis_mesin' => 'required|max:45|unique:jenis_mesin'
        ]);
        
        $jenismesin = JenisMesin::create([
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
        $user = Auth::user();
        $jenismesin1 = JenisMesin::all()->sortBy('jenis_mesin');

        $jenismesin = JenisMesin::find($id);
        return view('jenismesin.edit', compact('jenismesin', 'jenismesin1'));
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
            'jenis_mesin' => 'required|max:45',
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
        $jenismesin = JenisMesin::destroy($id);
        Alert::success('Berhasil', 'Berhasil Menghapus Data');
        return redirect('/jenismesin');
    }
}
