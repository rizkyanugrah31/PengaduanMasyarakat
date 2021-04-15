@extends('layouts.app')

@section('content')
<h1>List Tanggapan</h1>
<hr class="divider">
<br>
@if(session('delete'))
<div class="alert alert-success" role="alert">
    Data berhasil dihapus
</div>
@endif
@if(session('success'))
<div class="alert alert-success" role="alert">
    Berhasil Menanggapi
</div>
@endif
<br>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Pengaduan</th>
            <th>Tanggapan</th>
            <th>Nama Petugas</th>
            <th>tanggal</th>
            @if (Auth::user()->role == 1)
            <th>Action</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach ($value as $values)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $values->isi_laporan }}</td>
            <td>{{ $values->isi_tanggapan }}</td>
            <td>{{ $values->nama_lengkap }}</td>
            <td>{{ $values->created_at }}</td>
            @if (Auth::user()->role == 1)
            <td>
                <a href="#" data-toggle="modal" data-target="#logoutModal" class="btn btn-danger">Hapus</a>
            </td>
            @endif
        </tr>
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">Apakah anda yakin ingin Menghapus Data ini?</div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <form action="/deleteTanggapan/{{ $values->id }}" method="POST">
                @csrf
                @method('delete')
                <button class="btn btn-danger" type="submit">Hapus</button>
            </form>
        </div>
    </div>
</div>
</div>
        @endforeach
    </tbody>
</table>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
      $(document).ready(function(){
        $('[data-toggle="popover"]').popover();
      });
</script>
@endsection
