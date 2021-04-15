@extends('layouts.app')

@section('content')
<h2 class="">Add Operator</h2>
<hr class="divider bg-success">
<form action="{{ url('/buatUsers') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="exampleInputEmail1">Username</label>
      <input type="text" class="form-control" name="name" placeholder="username" required>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail2">Nama Lengkap</label>
        <input type="text" class="form-control" name="nama_lengkap" placeholder="nama_lengkap" required>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail3">Email</label>
        <input type="email" class="form-control" name="email" placeholder="Email" required>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail4">password</label>
        <input type="password" class="form-control" name="password" placeholder="Password" required>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail5">Telephone</label>
        <input type="number" class="form-control" name="telp" placeholder="username" required>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail6">Role</label>
        <select name="role" id="role" class="form-control">
           <option value="1">Administrator</option>
           <option value="2">Petugas</option>
        </select>
      </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>

@endsection
