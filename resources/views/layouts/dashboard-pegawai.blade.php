@extends('layouts.master-pegawai')
@section('section-header','Dashboard')
@section('content-pegawai')

<div class="card">
    <div class="card-body">
        <h2 class="text-center">
            Selamat Datang {{ Auth::user()->role }}
        </h2>
    </div>
</div>


@endsection
