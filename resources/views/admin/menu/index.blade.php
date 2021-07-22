@extends('layouts.master-pegawai')
@section('section-header','Data Menu')
@section('content-pegawai')

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="h3">Daftar Menu</div>
            </div>
            <div class="card-body">
                @if (@session('pesan'))
                <div class="alert alert-success pesan">
                    <p>{{ session('pesan') }}</p>
                </div>
                @endif
                <a href="{{route('menu.create')}}" class="btn btn-primary float-right">Tambah Menu</a>
                <div class="table-responsive">
                    <table class="table table-striped dataTable no-footer" id="table-1">
                        <thead>
                            <tr role="row">
                                <th>No</th>
                                <th>Nama Menu</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                             @foreach($menus as $value)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$value->nama_menu}}</td>
                                <td>Rp {{number_format($value->harga_menu,0,'','.')}}</td>
                                <td>{{$value->stok}}</td>
                                <td>
                                    <div class="row">
                                        <a href="{{route('menu.edit',$value->id_menu)}}"
                                            class="btn btn-info btn-icon mr-1"><i class="fas fa-pencil-alt"></i></a>
                                        <form action="{{route('menu.destroy',$value->id_menu)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onClick="return confirm('Anda Yakin Ingin Menghapus Data Ini?')"
                                                class="delete btn btn-danger btn-icon">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
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