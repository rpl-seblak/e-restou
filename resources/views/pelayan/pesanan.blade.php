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
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pesanan as $value)
                            <tr>
                                <td>{{$value->id_pesanan}}</td>
                                <td>{{$value->nama_pelanggan}}</td>
                                <td>{{$value->id_meja}}</td>
                                <td>
                                    {{ $value->status }}
                                </td>
                                <td>
                                <button type="button" data-id="{{$value->id_pesanan}}" class="btn btn-primary detail" data-toggle="modal" data-target="#exampleModal">
                                    Detail
                                </button>
                                    @if($value->status == 'cooked')
                                    <form action="{{ route('pelayan-pesanan.served',$value->id_pesanan) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-primary">Disajikan</button>
                                    </form>
                                    @endif
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
<script>
    $(document).ready(function(){
        $(".detail").click(function(){
            let id = $(this).attr('data-id');
            $.ajax({
                url: "/pesanan/"+id,
                method:'GET',
                success:function(res){
                    console.log(res);
                    let elm = '';
                    for(data of res.data){
                        elm += `
                            <tr>
                                <td>${data.nama_menu}</td>
                                <td>${data.qty}</td>
                            </tr>
                        `;
                    }
                    $(".detail-table tbody").html(elm);
                }
            })
        })
    })
</script>
@endpush