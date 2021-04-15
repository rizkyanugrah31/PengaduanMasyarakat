<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use app\User;
use Illuminate\Support\Facades\Hash;
use app\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

     //HALAMAN HOME
    public function index()
    {
        $value = DB::table('users')->
        join('roles', 'roles.id', '=', 'users.role')->where('users.id', 'like', Auth::user()->id)
        ->get(array(
            'name', 'title'
        ))->first();
        return view('home', compact('value'));
    }

    //HALAMAN LIHAT PROFILE
    public function showProfile($id){

        $profile   = User::find($id);

        return view('profile', ['profile' => $profile]);
    }

    //PROSES MENGEDIT PROFILE
    public function storeProfile($id, Request $request){
        $this->validate($request,[
            'nik'   => 'unique:users',
        ]);


        $user_profile  = User::findorfail($id);

        if ($request->has('foto')){
            $foto    = $request->foto;
            $newFoto= time().$foto->getClientOriginalName();

            $foto = $request->file('foto');
            $tujuan_upload = 'profiles';
            $foto->move($tujuan_upload,$newFoto);

            $users_data =[
                'name'   => $request->name,
                'nama_lengkap'  => $request->nama_lengkap,
                'telp' => $request->telp,
                'foto'    => 'profiles/'.$newFoto
            ];
        }
        else{

            $users_data =[
                'name'   => $request->name,
                'nama_lengkap'  => $request->nama_lengkap,
                'telp' => $request->telp
            ];

        }

        $user_profile->update($users_data);


        if ($user_profile) {
            return redirect('/profile/'.Auth::user()->id)->with('edit', 'Data berhasil diubah');
        }else{
            return redirect('/profile/'.Auth::user()->id)->with(['error' => ' Data Gagal diedit']);
        }
    }


    public function showChangePasswordForm(){
        return view('auth.changePassword');
    }

    public function changePassword($id, Request $request){

        if (!(Hash::check($request->currentpassword, Auth::user()->password))) {
        // The passwords matches
             return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }

        if(strcmp($request->currentpassword, $request->newpassword) == 0){
        //Current password and new password are same
             return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }
        if(!(strcmp($request->newpassword, $request->newpasswordconfirmation)) == 0){
                    //New password and confirm password are not same
                    return redirect()->back()->with("error","New Password should be same as your confirmed password. Please retype new password.");
        }
        //Change Password
        $user = User::findorfail($id);
        $data = [
            'password' => bcrypt($request->newpassword)
        ];

        $user->update($data);
        return redirect()->back()->with("success","Password changed successfully !");

        }
}
