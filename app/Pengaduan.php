<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    protected $table = 'pengaduan';

    protected $fillable = ['isi_laporan', 'foto', 'status', 'id_masyarakat'];
}
