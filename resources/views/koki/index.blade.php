@extends('layouts.master-pegawai')
@section('section-header','Dashboard')
@section('content-pegawai')

<h5 class="section-lead ml-0">
    Dashboard
</h5>

<h4 class="section-lead ml-0 my-3">
    Selamat Datang Koki
</h4>

<div class="row">
    <div class="col-lg-4">
        <div class="card card-primary">
            <div class="card-body">
                <h4>Jumlah Menu</h4>
                <p>{{ $total_menu['jumlah'] }}</p>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card card-primary">
            <div class="card-body">
                <h4>Total Stok Menu</h4>
                <p>{{ $total_menu['stok'] }}</p>
            </div>
        </div>
    </div>

</div>

@endsection
