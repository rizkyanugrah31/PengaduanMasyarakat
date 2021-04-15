@extends('layouts.app')

@section('content')
<h2 class="">Riwayat Pengaduan</h2>
<hr class="divider bg-success">

@if(session('success'))
<div class="alert alert-success" role="alert">
    Pengaduan Berhasil Terkirim
</div>
@endif
  <br>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th width="200">foto</th>
            <th>isi laporan</th>
            <th>tanggal</th>
            <th>status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($value as $values)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td> <img src="{{ asset($values->foto) }}" class="img-fluid" width="100%"></td>
            <td>{{ $values->isi_laporan }}</td>
            <td>{{ $values->created_at }}</td>
            <td>
            @if ($values->status == '0')
                <center><button class="btn btn-danger" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="left" data-content="Pengaduan Gagal diproses"><i class="fas fa-times"></i></button></center>
            @endif
            @if ($values->status == 'proses')
                <center><button class="btn btn-primary" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="left" data-content="Pengaduan sedang diproses" ><i class="fas fa-hourglass"></i></button></center>
            @endif
            @if ($values->status == 'selesai')
                <center><button class="btn btn-success" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="left" data-content="Pengaduan berhasil diproses"><i class="fas fa-check"></i></button></center>
            @endif
            </td>
        </tr>
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
