@extends('layouts.master-pegawai')
@section('section-header','Daftar Meja')
@section('content-pegawai')

<div class="card">
    <div class="card-body">
        <div class="row justify-content-center">
            @foreach($meja as $item)
            <div class="col-md-3 col-sm-6 md-mx-3">
                <div class="card @if($item->ketersediaan) bg-success @else bg-danger @endif">
                    <div class="card-body">
                        <h2 class="text-center mt-3">{{ $item->no_meja }}</h2>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>


@endsection