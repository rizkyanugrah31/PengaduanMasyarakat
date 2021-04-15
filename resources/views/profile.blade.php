@extends('layouts.app')

@section('content')
<h2 class="">Edit Profile</h2>
<hr class="divider bg-success">
@if(session('edit'))
<div class="alert alert-success" role="alert">
    Data berhasil diubah
</div>
@endif
@if(session('error'))
<div class="alert alert-danger" role="alert">
    Data Gagal diubah
</div>
@endif
<br>
<form action="/storeProfile/{{ Auth::user()->id }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group text-center">
        @if (Auth::user()->foto == null)
        <img id="preview" class="rounded-circle" height="30%" width="30%" src="{{ asset('img/undraw_profile.svg') }}" alt="Photo Profile"><br><br>
        @else
        <img id="preview" class="rounded-circle" height="30%" width="30%" src="{{ asset($profile->foto) }}" alt="Photo Profile"><br><br>
        @endif
        <label for="fp" class="text-dark">Photo Profile</label><br>
        <input type="file" accept=".png, .jpg, .jpeg" id="fp" style="border: 2px solid black" class="" width="10%" name="foto" value="{{ $profile->foto }}" placeholder="Foto">
      </div>
      @if (Auth::user()->role == 3)
      <div class="form-group">
        <label for="nik">Nik</label>
        <input type="text" id="nik" disabled class="form-control" name="nik" value="{{ $profile->nik }}" placeholder="username">
      </div>
      @endif
    <div class="form-group">
      <label for="exampleInputEmail1">Username</label>
      <input type="text" class="form-control" name="name" value="{{ $profile->name }}" placeholder="username">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail2">Nama Lengkap</label>
        <input type="text" class="form-control" name="nama_lengkap" value="{{ $profile->nama_lengkap }}" placeholder="nama_lengkap">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail3">Email</label>
        <input type="email" class="form-control" name="email" disabled value="{{ $profile->email }}" placeholder="Email">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail4">password</label>
        <input type="text" class="form-control" name="password" placeholder="Password telah Terenkripsi" disabled>
        <a href="/showChangePasswordForm/{{ Auth::user()->id }}" class="btn btn-link mt-2">Ubah Password...</a>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail5">Telephone</label>
        <input type="number" class="form-control" name="telp" value="{{ $profile->telp }}" placeholder="username">
      </div>

    <button type="submit" class="btn btn-primary">Ubah Data</button>
  </form>
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <script>
      function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
            $('#preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
        }

        $("#fp").change(function() {
        readURL(this);
        });
  </script>
@endsection
