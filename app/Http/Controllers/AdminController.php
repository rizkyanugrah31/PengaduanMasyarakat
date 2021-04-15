<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Tanggapan;
use App\Pengaduan;
use Illuminate\Support\Facades\Hash;
use App\Exports\LaporanExport;
use App\Exports\LaporanPengaduan;
use Maatwebsite\Excel\Facades\Excel;
use App\Roles;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     //HALAMAN USER LIST
    public function index()
    {
        if (Auth::user()->role == 1) {
            $administrator = User::where('role', 'like', '1')->get()->all();
            $petugas = User::where('role', 'like', '2')->get()->all();
            $masyarakat = User::where('role', 'like', '3')->get()->all();

            return view('admin.userlist', compact('administrator', 'petugas', 'masyarakat'));
        }
        else{
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     //HALAMAN TAMBAHKAN PETUGAS ATAU ADMIN
    public function create()
    {
        if (Auth::user()->role == 1) {
            return view('admin.addusers');
        }
        else{
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     //PROSES BUAT AKUN PETUGAS ATAU ADMIN
    public function store(Request $request)
    {
        if (Auth::user()->role == 1) {
            $messages = [
                'required' => ':attribute wajib diisi!',
                'min' => ':attribute harus diisi minimal :min karakter',
                'foto.max' => ' maksimal ukuran :attribute adalah 10 MB',
                'mimes'=> 'Tipe file :attribute hanya boleh jpeg, png, dan jpg',
                'image'=> 'Tipe file :attribute hanya boleh jpeg, png, dan jpg',

            ];

            $this->validate($request,[
                  'email' => 'required|unique:users',
                  'name' => 'unique:users'
            ],$messages);

            $value = User::create([
                'name' => $request->name,
                'nama_lengkap' => $request->nama_lengkap,
                'telp' => $request->telp,
                'role' => $request->role,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            if ($value->save()) {
                return redirect('/listusers')->with('success', 'Data Berhasil ditambahkan');
            }else{
                return redirect('/addusers')->with(['erorr' => ' Data Gagal ditambahkan']);
            }

        }
        else{
            return redirect()->back();
        }
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


    //HALAMAN DASHBOARD
    public function dashboard()
    {
        if (Auth::user()->role == 1) {
            $tanggapan = Tanggapan::count();
            $pengaduan = Pengaduan::count();
            $user = User::count();

            return view('admin.dashboard', compact('tanggapan', 'pengaduan', 'user'));
        }
        else{
            return redirect()->back();
        }
    }


    //PROSES DOWNLOAD LAPORAN TANGGAPAN
    public function export_tanggapan()
	{
        if (Auth::user()->role == 1) {
            return Excel::download(new LaporanExport, 'laporan_tanggapan.xlsx');
        }
        else{
            return redirect()->back();
        }
	}

    //PROSES DOWNLOAD LAPORAN TANGGAPAN
    public function export_pengaduan()
	{
        if (Auth::user()->role == 1) {
            return Excel::download(new LaporanPengaduan, 'laporan_pengaduan.xlsx');
        }
        else{
            return redirect()->back();
        }
	}
}

