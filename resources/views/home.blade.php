@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-primary">Welcome {{ $value->name }}</h1>
    <h4 class="text-success ml-2">{{ $value->title }}</h4>
    <hr class="divider bg-success">
</div>
<br><br>
@endsection
