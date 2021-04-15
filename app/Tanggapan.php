<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tanggapan extends Model
{
    protected $table = 'tanggapan';

    protected $fillable = ['isi_tanggapan', 'id_pengaduan', 'id_petugas'];
}
