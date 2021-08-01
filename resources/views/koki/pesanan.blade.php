@extends('layouts.master-pegawai')
@section('section-header','Data Pesanan')
@section('content-pegawai')

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="h3">Daftar Pesanan</div>
            </div>
            <div class="card-body">
                @if (@session('pesan'))
                <div class="alert alert-success pesan">
                    <p>{{ session('pesan') }}</p>
                </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-striped dataTable no-footer" id="table-1">
                        <thead>
                            <tr role="row">
                                <th>Id pesanan</th>
                                <th>No Meja</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($pesanan as $value)
                            <tr>
                                <td>{{$value->id_pesanan}}</td>
                                <td>{{$value->id_meja}}</td>
                                <td>
                                    {{ $value->status }}
                                </td>
                                <td>
                                    @if($value->status == 'waiting')
                                    <a href="{{ route('koki.detail-pesanan',$value->id_pesanan) }}" class="btn btn-primary">Proses</a>
                                    @elseif($value->status == 'cooking')
                                    <form action="{{ route('koki-pesanan.masak',$value->id_pesanan) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-success">Selesai</button>
                                    </form>
                                    @else
                                    <p></p>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('script')
<script>
    // $("#table-1").dataTable({
    //     "columnDefs": [
    //         { "sortable": false, "targets": [2,3] }
    //     ]
    // });
    $(document).ready(function () {
        $('#table-1').DataTable();
    });
</script>
@endpush