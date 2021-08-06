@extends('layouts.master-pegawai')
@section('section-header','Daftar Meja')
@section('content-pegawai')

<div class="card">
    <div class="card-header">
        <h2>Daftar Meja</h2>
    </div>
    <div class="card-body">
        <div class="row justify-content-left">
            @foreach($meja as $item)
                <div class="col-md-3 col-sm-6 md-mx-3 col-lg-4">
                    <div class="card @if($item->ketersediaan) bg-success @else bg-danger @endif mb-1">
                        <div class="card-body">
                            <h2 class="text-center mt-3">{{ $item->no_meja }}</h2>
                        </div>
                    </div>
                    @if($item->ketersediaan)
                        <a href="{{ route('pelayan-pesanan.create',$item->id_meja) }}" class="btn btn-primary mb-5">Pesan</a>
                    @else
                    <button data-id="{{ $item->id_meja }}" class="btn btn-info mb-5 done">Selesai</button>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>


@endsection
@push('script')
    <script>
        $(".done").click(function(){
            let _token = $('meta[name="csrf-token"]').attr('content');
            let idMeja = $(this).attr('data-id');
            swal({
                title: 'Konfirmasi',
                text: 'Anda Yakin Pelanggan di meja ini telah selesai berkunjung?',
                icon: 'warning',
                buttons:  ["Tidak", "Ya"],
                })
                .then((isConfirm) => {
                    if(isConfirm){
                        let data = {
                            _token,
                            idMeja,
                        }
                        $.ajax({
                            method:'PUT',
                            url:'meja/'+idMeja,
                            data:data,
                            success:function(res){
                                if(res.code == 200){
                                    window.location.reload();
                                }
                            }
                        });
                    }
                });
        })
    </script>
@endpush