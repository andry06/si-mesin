<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

        $query = DB::table('jenis_mesin')->insert([
            'jenis_mesin' => ucwords($request['jenis_mesin']), 
        ]);

    
        return redirect('/jenismesin')->with('success', 'Post Berhasil Disimpan !');

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
        //
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
}
