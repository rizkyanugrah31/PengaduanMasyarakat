@extends('layouts.app')

@section('content')
@if(session('success'))
<div class="alert alert-success" role="alert">
    Data berhasil ditambahkan
</div>
@endif
<h1>Halaman Manage Users</h1>
<hr class="divider">
  <br>

<table class="table table-bordered">
    <div class="alert alert-success pb-4" role="alert">
        List Admin
        <a href="{{ url('/addusers') }}" class="btn btn-success" style="float: right"><i class="fas fa-plus"></i> Admin</a>
    </div>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>username</th>
            <th>email</th>
            <th>Telp</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($administrator as $admin)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{  $admin->nama_lengkap }}</td>
            <td>{{ $admin->name }}</td>
            <td>{{ $admin->email}}</td>
            <td>{{ $admin->telp }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<br>
<hr class="divider">
<br>
<table class="table table-bordered">
    <div class="alert alert-info pb-4" role="alert">
        List Petugas
        <a href="{{ url('/addusers') }}" class="btn btn-success" style="float: right"><i class="fas fa-plus"></i> Petugas</a>
    </div><thead>
        <tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>username</th>
            <th>email</th>
            <th>Telp</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($petugas as $operator)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{  $operator->nama_lengkap }}</td>
            <td>{{ $operator->name }}</td>
            <td>{{ $operator->email}}</td>
            <td>{{ $operator->telp }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<br>
<hr class="divider">
<br>
<table class="table table-bordered">
    <div class="alert alert-warning pb-4" role="alert">
        List Masyarakat
    </div>
    <thead>
        <tr>
            <th>No</th>
            <th>Nik</th>
            <th>Nama Lengkap</th>
            <th>username</th>
            <th>email</th>
            <th>Telp</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($masyarakat as $villager)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $villager->nik }}</td>
            <td>{{  $villager->nama_lengkap }}</td>
            <td>{{ $villager->name }}</td>
            <td>{{ $villager->email}}</td>
            <td>{{ $villager->telp }}</td>
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
