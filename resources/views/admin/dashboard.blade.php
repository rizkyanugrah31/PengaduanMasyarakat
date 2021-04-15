@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <h1>Dashboard Admin</h1>
        <hr class="divider bg-primary">
        <br><br>

        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-md-12 mb-4">
                <a href="{{ url('/export_pengaduan')}}" class="btn btn-primary" target="_blank">Generate Laporan Pengaduan<i class="fas fa-download"></i></a>
                <hr class="divider bg-success">
                <div class="card border-left-primary shadow h-100 py-2 mt-3">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    <a href="{{ url('/listpengaduan') }}">Total Jumlah Pengaduan</a></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pengaduan }}<br><br>
                                <h6>jumlah total pengaduan yang masuk pada tanggal {{ Carbon\Carbon::now()->day }} adalah {{ $pengaduan }}. Klik generate laporan untuk mengunduh file laporan berupa excel. Klik <span style="font-weight: bold">TOTAL JUMLAH PENGADUAN</span> Untuk melihat Detail.</h6></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-print fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Earnings (Annual) Card Example -->
            <div class="col-md-12 mb-5 mt-5">
                <a href="{{ url('/export_tanggapan')}}" class="mt-5 btn btn-primary" target="_blank">Generate Laporan Tanggapan<i class="fas fa-download"></i></a>

                <hr class="divider bg-success">
                <div class="card border-left-success shadow h-100 py-2 mt-3">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    <a href="{{ url('/listtanggapan') }}">Total Jumlah Tanggapan</a></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $tanggapan }}<br><br>
                                    <h6>jumlah total Tanggapan yang masuk pada tanggal {{ Carbon\Carbon::now()->day }} adalah {{ $tanggapan }}. Klik generate laporan untuk mengunduh file laporan Tanggapan berupa excel. Klik <span style="font-weight: bold">TOTAL JUMLAH TANGGAPAN</span> Untuk melihat Detail.</h6>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-pen-fancy fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12 mt-5">
                <div class="card border-left-warning shadow h-100 py-2 mt-3">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    <a href="{{ url('/listusers') }}">Total Users</a></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $user }}<br><br>
                                    <h6>jumlah total pengaduan yang masuk pada tanggal {{ Carbon\Carbon::now()->day }} adalah {{ $user }}. Klik <span style="font-weight: bold">TOTAL JUMLAH USER</span> Untuk melihat Detail.</h6>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
