<?php

namespace App\Http\Controllers;

use App\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use DataTables;


class PetugasController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    //HALAMAN LIST PENGADUAN PADA PETUGAS
    public function listpengaduan(){
        if (Auth::user()->role == '1' || Auth::user()->role == '2' ) {
            $value = DB::table('pengaduan')->
        join('users', 'users.id', '=', 'pengaduan.id_masyarakat')->get(array(
            'pengaduan.id', 'pengaduan.foto', 'nik', 'users.nama_lengkap', 'pengaduan.isi_laporan', 'pengaduan.created_at', 'pengaduan.status'
        ))->sortByDesc('created_at');
            return view('petugas.pengaduan', compact('value'));
        }
        else{
            return redirect()->back();
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
