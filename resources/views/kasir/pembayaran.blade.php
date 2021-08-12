@extends('layouts.master-pegawai')
@section('section-header','Dashboard')
@section('content-pegawai')

<div class="card">
    <div class="card-body">
    <div class="table-responsive">
                    <table class="table table-striped dataTable no-footer" id="table-1">
                        <thead>
                            <tr role="row">
                                <th>Id Pesanan</th>
                                <th>Nama Pelanggan</th>
                                <th>No Meja</th>
                                <th>Total Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pembayaran as $value)
                            <tr>
                                <td>{{$value->id_pesanan}}</td>
                                <td>{{$value->nama_pelanggan}}</td>
                                <td>{{$value->id_meja}}</td>
                                <td>
                                    {{ $value->total_pembayaran }}
                                </td>
                                <td>
                                    <a href="{{ route('kasir.form-pembayaran',$value->id_pesanan) }}" class="btn btn-info">Bayar</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
    </div>
</div>


@endsection

@push('script')
@if (session('pesan'))
    <script>
      swal({
                            title: 'Pesan',
                            text: `{{ session('pesan') }}`,
                            icon: 'success',
                            });
    </script>
@endif
@endpush