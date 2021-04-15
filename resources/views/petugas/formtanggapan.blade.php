@extends('layouts.app')

@section('content')
<h2 class="">Form Tanggapan</h2>
<hr class="divider bg-success">
<form action="/buatTanggapan/{{ $edit->id }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <h4>Data Pengadu</h4>
    <hr class="divider">
    <br>
    <div class="form-group">
      <label for="exampleInputEmail1">Nama Pengadu</label>
      <input type="text" class="form-control" name="nama_lengkap" placeholder="nama pengadu" required value="{{ $masyarakat->nama_lengkap }}">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail2">Isi Pengaduan</label>
        <input type="text" class="form-control" name="isi_laporan" placeholder="Laporan" required value="{{ $edit->isi_laporan }}">
      </div>
      <input type="hidden" name="status" value="selesai">
      <hr class="divider">
      <br>
      <h4>Data Tanggapan</h4>
      <div class="form-group">
        <label for="exampleInputEmail3">Tanggapan</label>
        <textarea name="isi_tanggapan" id="" cols="30" rows="10" required class="form-control"></textarea>
      </div>
      <input type="hidden" name="id_petugas" value="{{ Auth::user()->id }}">
      <center><button type="submit" class="btn btn-success">Tanggapi</button></center>
  </form>

    <form action="/tolakTanggapan/{{ $edit->id }}" method="POST">
        @csrf
        @method('PUT')
        <center><button type="submit" class="btn btn-danger mt-2">Tolak Tanggapan</button></center>
    </form>
@endsection
