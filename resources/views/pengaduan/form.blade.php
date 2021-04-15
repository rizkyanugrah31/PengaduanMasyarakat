@extends('layouts.app')

@section('content')
<h2 class="">Form Pengaduan</h2>
<hr class="divider bg-success">
<form action="{{ url('/buatPengaduan') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id_masyarakat" value="{{ Auth::user()->id }}">
    <div class="form-group">
      <label for="exampleInputEmail1">Isi Laporan</label>
      <textarea name="isi_laporan" id="isi_laporan" cols="30" rows="10" class="form-control"></textarea>
    </div>
    <div class="form-group">
      <label for="customFile">Foto</label>
      <div class="custom-file">
        <input type="file" accept=".png, .jpg, .jpeg" name="foto" class="custom-file-input" id="customFile">
        <label class="custom-file-label" for="customFile">Choose file</label>
      </div>
      </div>
    <input type="hidden" name="status" value="proses">
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>

@endsection
