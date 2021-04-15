<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input; //untuk input::get
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Redirect; //untuk redirect


use App\Petugas;
use Illuminate\Http\Request;
use App\Masyarakat;
use DB;

class AuthController extends Controller
{
    public function login()
    {
    	return view('auth.login2');
    }

    public function postlogin(Request $request)
    {
      // echo "$request->email.$request->password "; die;
    	if(Auth::attempt($request->only('username','password'))){
            $akun = DB::table('masyarakat')->where('username', $request->username)->first();
            $akun2 = DB::table('petugas')->where('username', $request->username)->first();
            //dd($akun);
            if($akun){
                Auth::guard('masyarakat')->LoginUsingId($akun->nik);
                return redirect('/home')->with('sukses','Anda Berhasil Login');

            } else if($akun2->role =='petugas_pengaduan'){
                Auth::guard('petugas')->LoginUsingId($akun->id);
                return redirect('/listpengaduan')->with('sukses','Anda Berhasil Login');

            }elseif ($akun2->role =='admin') {
              Auth::guard('Administrator')->LoginUsingId($akun->id);
              return redirect('/listpengaduan')->with('sukses','Anda Berhasil Login');

            }
    	}
    	return redirect('/home')->with('error','Akun Belum Terdaftar');
    }

    public function logout()
    {
        if(Auth::guard('Administrator')->check()){
            Auth::guard('Administrator')->logout();
        } else if(Auth::guard('petugas')->check()){
            Auth::guard('petugas')->logout();
        } else if(Auth::guard('masyarakat')->check()){
            Auth::guard('masyarakat')->logout();
        }
    	return redirect('login')->with('sukses','Anda Telah Logout');
    }

    public function regisMasyarakat(){
    	return view('auth.register');
    }

    public function prosesRegis(Request $request){
    	$rules = [
    		'nik' => 'unique:masyarakat|required',
    		'nama' => 'required',
    		'username' => 'required',
    		'password' => 'min:8|required'
    	];

    	$this->validate($request, $rules);

    	Masyarakat::create(
    		['nik' => $request->nik,
    		'nama' => $request->nama,
    		'username' => $request->username,
    		'password' => Hash::make($request->passwords), 
    		'telp' => $request->telp]
    	);

    	 return redirect('/login')->with('success', 'Daftar Berhasil');

    }
   
}
