@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Ubah Password</h1>
    <hr class="divider bg-success">
    <br>
           @if (session('error'))
            <div class="alert alert-danger">
            {{ session('error') }}
            </div>
            @endif
            @if (session('success'))
            <div class="alert alert-success">
            {{ session('success') }}
            </div>
            @endif
            <center><form class="form-horizontal" method="POST" action="/changePassword/{{ Auth::user()->id }}">
                @csrf
                @method('PUT')
                <div class="form-group{{ $errors->has('currentpassword') ? ' has-error' : '' }}">
                <label for="new-password" class="col-md-4 control-label">Current Password</label>

                <div class="col-md-6">
                <input id="currentpassword" type="password" class="form-control" name="currentpassword" required>

                @if ($errors->has('currentpassword'))
                <span class="help-block">
                <strong>{{ $errors->first('currentpassword') }}</strong>
                </span>
                @endif
                </div>
                </div>

                <div class="form-group{{ $errors->has('newpassword') ? ' has-error' : '' }}">
                <label for="new-password" class="col-md-4 control-label">New Password</label>

                <div class="col-md-6">
                <input id="newpassword" type="password" class="form-control" name="newpassword" required>

                @if ($errors->has('newpassword'))
                <span class="help-block">
                <strong>{{ $errors->first('newpassword') }}</strong>
                </span>
                @endif
                </div>
                </div>

            <div class="form-group">
            <label for="newpasswordconfirm" class="col-md-4 control-label">Confirm New Password</label>

            <div class="col-md-6">
            <input id="newpasswordconfirm" type="password" class="form-control" name="newpasswordconfirmation" required>
            </div>
            </div>
            <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary">Change Password</button>
            </div>
            </div>
        </center></form>
        </div>
@endsection
