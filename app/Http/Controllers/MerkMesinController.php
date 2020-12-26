<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

use DB;
use App\MerkMesin;
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
            'merk_mesin' => 'required|max:45|unique:merk_mesin'
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
        $user = Auth::user();
        $merkmesin1 = MerkMesin::all()->sortBy('merk_mesin');

        $merkmesin = MerkMesin::find($id);
        return view('merkmesin.edit', compact('merkmesin', 'merkmesin1'));
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
        //
    }
}
