<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;


use DB;
use App\User;
use Auth;
use App\Perusahaan;

class UserController extends Controller
{   

    public function __construct(){
        //untuk pengecualian pakai except
        // $this->middleware('auth')->except('index');

        //untuk yg disetujui di berlakukan autentifikasi
        // $this->middleware('auth')->only('delete');

        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perusahaan = Perusahaan::find(1)->get();
        $users = User::all()->sortBy('name');
        return view('users.index', compact('users', 'perusahaan'));
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
        // dd($request);
        $request->validate([
            'name' => 'required|max:45|string',
            'nik' => 'required|max:15',
            'email' => 'required|unique:users|email|string',
            'password' => 'required|string|min:8|confirmed',
            'level' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $photo = date('d-m-Y').'_'.date('h_i_s').'_'.$request['name'].'.'.$request->photo->extension(); 

        $user = User::create([
            'name' => $request['name'],
            'nik' => $request['nik'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'level' => $request['level'],
            'barcode_user' => $request['barcode_user'],
            'photo' => $photo
        ]);

        $request->photo->move(public_path('img/users'), $photo);
        

        Alert::success('Berhasil', 'Berhasil Menambahkan User');
        return redirect('/users');    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $user = User::find($id);

	    return response()->json([
	      'data' => $user
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
            'name' => 'required|max:45|string',
            'nik' => 'required|max:15',
            'email' => 'required|email',
            'level' => 'required',
            'barcode_user' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        
       
        if(empty($request['photo'])){
        $update = User::where('id', $id)->update([
            'name' => $request['name'],
            'nik' => $request['nik'],
            'level' => $request['level'],
            'email' => $request['email'],
            'barcode_user' => $request['barcode_user']
        ]);
        }else{
            $photo = date('d-m-Y').'_'.date('h_i_s').'_'.$request['name'].'.'.$request->photo->extension(); 
            $update = User::where('id', $id)->update([
                'name' => $request['name'],
                'nik' => $request['nik'],
                'level' => $request['level'],
                'email' => $request['email'],
                'barcode_user' => $request['barcode_user'],
                'photo' => $photo
            ]);
            $request->photo->move(public_path('img/users'), $photo);   
        }
        Alert::success('Berhasil', 'Berhasil Mengedit User');
        return redirect('/users');    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::destroy($id);
        return redirect('/users')->with('success', 'Berhasil hapus data');
    }
}