@extends('layouts.master-pegawai')
@section('content-pegawai')

<div class="card">
    <div class="card-header">
        Laporan
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-sm-5">
                <div class="form-group">
                    <label>Periode : </label>
                    <select name="periode" id="periode" class="form-control">
                        <option value="">Seminggu</option>
                        <option value="">Sebulan</option>
                        <option value="">Setahun</option>
                    </select>
                </div>
            </div>
        </div>

        <button class="btn btn-primary">Export</button>
    <div class="table-responsive">
                    <table class="table table-striped dataTable no-footer" id="table-1">
                        <thead>
                            <tr role="row">
                                <th>Id Pesanan</th>
                                <th>Nama Pelanggan</th>
                                <th>Tanggal Pemesanan</th>
                                <th>Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pembayaran as $value)
                            <tr>
                                <td>{{$value->id_pesanan}}</td>
                                <td>{{$value->nama_pelanggan}}</td>
                                <td>{{$value->tanggal_pemesanan}}</td>
                                <td>
                                    {{ $value->total_pembayaran }}
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

@endpush