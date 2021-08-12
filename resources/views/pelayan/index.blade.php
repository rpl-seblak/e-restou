@extends('layouts.master-pegawai')
@section('section-header','Dashboard')
@section('content-pegawai')

<h5 class="section-lead ml-0">
    Dashboard
</h5>

<h4 class="section-lead ml-0 my-3">
    Selamat Datang Pelayan
</h4>

<div class="row">
    <div class="col-lg-4">
        <div class="card card-primary">
            <div class="card-body">
                <h4>Total Meja</h4>
                <p>{{ $total_meja }}</p>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card card-primary">
            <div class="card-body">
                <h4>Meja Kosong</h4>
                <p>{{ $kosong }}</p>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card card-primary">
            <div class="card-body">
                <h4>Meja Terisi</h4>
                <p>{{ $terisi }}</p>
            </div>
        </div>
    </div>
</div>
@if (session('pesan'))
    <script>
      swal({
                            title: 'Pesan',
                            text: `{{ session('pesan') }}`,
                            icon: 'success',
                            });
    </script>
@endif
@endsection
