@extends('layouts.master-pegawai')
@section('section-header','Data Detail Pesanan')
@section('content-pegawai')

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="h3">Detail Pesanan</div>
            </div>
            <div class="card-body">
               <div class="row">
                   <div class="col-md-4">
                       <p>Id Pesanan : {{ $pesanan->id_pesanan }}</p>
                       <p>No Meja : {{ $pesanan->id_meja }}</p>
                   </div>
               </div>
                <div class="table-responsive">
                    <table class="table table-striped dataTable no-footer" id="table-1">
                        <thead>
                            <tr role="row">
                                <th>No</th>
                                <th>Nama Menu</th>
                                <th>Qty</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($detail as $value)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $value->menu->nama_menu }}</td>
                                <td>{{ $value->qty }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <form action="{{ route('koki-pesanan.masak',$pesanan->id_pesanan) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button class="btn btn-primary">Masak</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
