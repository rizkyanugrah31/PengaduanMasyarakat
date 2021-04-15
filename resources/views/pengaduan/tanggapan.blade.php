@extends('layouts.app')

@section('content')
<h1>Tanggapan Petugas</h1>
<hr class="divider">
<br>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Pengaduan</th>
            <th>Tanggapan</th>
            <th>Nama Petugas</th>
            <th>tanggal</th>
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
