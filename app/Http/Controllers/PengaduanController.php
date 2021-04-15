<?php

namespace App\Http\Controllers;

use App\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Illuminate\Support\Facades\DB;

class PengaduanController extends Controller
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

     //HALAMAN HISTORY PENGADUAN
    public function index()
    {
        if (Auth::user()->role == '3') {
            $value = Pengaduan::where('id_masyarakat', 'like', Auth::user()->id)->paginate(10);
            return view('pengaduan.history', compact('value'));
        }
        else{
            return redirect()->back();
        }
    }


    //HALAMAN TANGGAPAN DARI PETUGAS KE PENGADUANNYA
    public function tanggapan(){
        if (Auth::user()->role == 3) {
            $value = DB::table('pengaduan')->
            join('tanggapan', 'tanggapan.id_pengaduan', '=', 'pengaduan.id')->
            join('users', 'tanggapan.id_petugas', '=', 'users.id')->where('pengaduan.id_masyarakat', 'like', Auth::user()->id)
            ->get(array(
                'pengaduan.id_masyarakat',
                'pengaduan.isi_laporan',
                'tanggapan.isi_tanggapan',
                'users.nama_lengkap',
                'pengaduan.created_at'
            ))->sortByDesc('created_at');

            return view('pengaduan.tanggapan', compact('value'));
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

     //HALAMAN FORM PENGADUAN
    public function create()
    {
        if (Auth::user()->role == '3') {
            return view('pengaduan.form');
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


     //PROSES BUAT PENGADUAN
    public function store(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib diisi!',
            'min' => ':attribute harus diisi minimal :min karakter',
            'foto.max' => ' maksimal ukuran :attribute adalah 10 MB',
            'mimes'=> 'Tipe file :attribute hanya boleh jpeg, png, dan jpg',
            'image'=> 'Tipe file :attribute hanya boleh jpeg, png, dan jpg',

        ];

        $this->validate($request,[
              'isi_laporan'   => 'required',
              'foto'    => 'required|file|max:10240|image|mimes:jpeg,png,jpg',
        ],$messages);


        $foto    = $request->foto;
        $newFoto= time().$foto->getClientOriginalName();

        $value =Pengaduan::create([
            'isi_laporan'   => $request->isi_laporan,
            'foto'    => 'uploads/'.$newFoto,
            'status'  => $request->status,
            'id_masyarakat'  => $request->id_masyarakat,


        ]);

        $foto = $request->file('foto');
        $tujuan_upload = 'uploads';
        $foto->move($tujuan_upload,$newFoto);
        // $foto->move('public/uploads/',$newFoto);

        if ($value->save()) {
            return redirect('/riwayat')->with('success', 'Data Berhasil ditambahkan');
        }else{
            return redirect('/form')->with(['erorr' => ' Data Gagal ditambahkan']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function show(Pengaduan $pengaduan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengaduan $pengaduan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengaduan $pengaduan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */

     //PROSES HAPUS PENGADUAN
    public function destroy($id)
    {
        if (Auth::user()->role == 1) {
            Pengaduan::destroy($id);
            return redirect('/listpengaduan')->with('delete', 'data berhasil dihapus');
        }
        else{
            return redirect()->back();
        }
    }
}
