<?php

namespace App\Http\Controllers;

use App\Pengaduan;
use App\Tanggapan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TanggapanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

     //HALAMAN LIST TANGGAPAN PADA PETUGAS DAN ADMIN
    public function index()
    {
        if (Auth::user()->role == 2 || Auth::user()->role == 1) {
            $value = DB::table('tanggapan')->
            join('pengaduan', 'tanggapan.id_pengaduan', '=', 'pengaduan.id')->
            join('users', 'tanggapan.id_petugas', '=', 'users.id')->get(array(
                'tanggapan.id',
                'pengaduan.isi_laporan',
                'tanggapan.isi_tanggapan',
                'users.nama_lengkap',
                'pengaduan.created_at'
            ))->sortByDesc('created_at');

            return view('petugas.listtanggapan', compact('value'));
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
        //
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

     //HALAMAN BERIKAN TANGGAPAN PETUGAS
    public function edit($id)
    {
        $edit   = Pengaduan::find($id);
        $masyarakat = DB::table('pengaduan')
                        ->join('users', 'pengaduan.id_masyarakat', '=', 'users.id')
                        ->where('pengaduan.id', 'like', $id)
                        ->first();

        if(Auth::user()->role == 2){
            return view('petugas.formtanggapan', ['edit' => $edit, 'masyarakat' => $masyarakat]);
        }
        else{
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     //PROSES BUAT TANGGAPAN
    public function update(Request $request, $id)
    {
        $data    = Pengaduan::findorfail($id);
        $status = "selesai";

            $status_data =[
                'status'   => $status
            ];

        $data->update($status_data);

        $tanggapan = Tanggapan::create([
            'isi_tanggapan' => $request->isi_tanggapan,
            'id_pengaduan' => $id,
            'id_petugas' => $request->id_petugas
        ]);

        if ($data && $tanggapan->save()) {
            return redirect('/listtanggapan')->with('success', 'Data berhasil diubah');
        }else{
            return redirect('/listtanggapan')->with(['erorr' => ' Data Gagal diedit']);
        }
    }

    //PROSES TOLAK TANGGAPAN
    public function dismiss(Request $request, $id)
    {
        $data    = Pengaduan::findorfail($id);
        $status = "0";

            $status_data =[
                'status'   => $status
            ];

        $data->update($status_data);


        if ($data) {
            return redirect('/listpengaduan')->with('success', 'Data berhasil diubah');
        }else{
            return redirect('/listpengaduan')->with(['erorr' => ' Data Gagal diedit']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     //PROSES HAPUS TANGGAPAN
    public function destroy($id)
    {
        if (Auth::user()->role == 1) {
            Tanggapan::destroy($id);
            return redirect('/listtanggapan')->with('delete', 'data berhasil dihapus');
        }
        else{
            return redirect()->back();
        }
    }
}
