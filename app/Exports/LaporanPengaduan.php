<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;

class LaporanPengaduan implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $value = DB::table('pengaduan')->
        join('users', 'users.id', '=', 'pengaduan.id_masyarakat')->get(array(
            'pengaduan.id', 'pengaduan.foto', 'nik', 'users.nama_lengkap', 'pengaduan.isi_laporan', 'pengaduan.created_at', 'pengaduan.status'
        ))->sortByDesc('created_at');

        return $value;
    }
}
