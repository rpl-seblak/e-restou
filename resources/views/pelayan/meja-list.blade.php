@extends('layouts.master-pegawai')
@section('section-header','Daftar Meja')
@section('content-pegawai')

<div class="card">
    <div class="card-body">
        <div class="row justify-content-left">
            @foreach($meja as $item)
                <div class="col-md-3 col-sm-6 md-mx-3 col-lg-4">
                    <div class="card @if($item->ketersediaan) bg-success @else bg-danger @endif mb-1">
                        <div class="card-body">
                            <h2 class="text-center mt-3">{{ $item->no_meja }}</h2>
                        </div>
                    </div>
                    <a href="{{ route('pelayan-pesanan.create',$item->id_meja) }}" class="btn btn-primary mb-5">Pesan</a>
                </div>
            @endforeach
        </div>
    </div>
</div>


@endsection