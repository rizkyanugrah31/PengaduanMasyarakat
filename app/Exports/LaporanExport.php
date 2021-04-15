<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class LaporanExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $laporan = DB::table('tanggapan')->
        join('pengaduan', 'tanggapan.id_pengaduan', '=', 'pengaduan.id')->
        join('users', 'tanggapan.id_petugas', '=', 'users.id')
        ->get(array(
            'tanggapan.id',
            'users.nama_lengkap',
            'pengaduan.isi_laporan',
            'tanggapan.isi_tanggapan',
            'pengaduan.created_at'
        ))->sortByDesc('created_at');

        return $laporan;
    }
}
