@extends('layouts.master-pegawai')
@section('content-pegawai')

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="h3">Pembayaran</div>
            </div>
            <div class="card-body">
            <div class="form-group row">
                    <label for="text" class="col-1 col-form-label">Id Pesanan</label> 
                    <div class="col-2">
                    <input id="text" name="text" type="text" class="form-control" value="{{ $pesanan->id_pesanan }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="text" class="col-1 col-form-label">Nama Pelanggan</label> 
                    <div class="col-2">
                    <input id="text" name="text" type="text" class="form-control" value="{{ $pesanan->nama_pelanggan }}" readonly>
                    </div>
                </div> 
                <div class="form-group row">
                    <label for="text" class="col-1 col-form-label">No Meja</label> 
                    <div class="col-2">
                    <input id="text" name="text" type="text" class="form-control" value="{{ $pesanan->id_meja }}" readonly>
                    </div>
                </div> 
                <div class="table-responsive">
                    <table class="table table-striped dataTable no-footer" id="table-1">
                        <thead>
                            <tr role="row">
                                <th>No</th>
                                <th>Nama Menu</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($detail as $value)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $value->menu->nama_menu }}</td>
                                <td>{{ $value->qty }}</td>
                                <td>Rp {{number_format($value->qty*$value->menu->harga_menu,0,'','.')}}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="3">Total Harga</td>
                                <td id="total"> Rp {{number_format($pesanan->total_pembayaran,0,'','.')}} </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <form action="{{ route('kasir.proses-pembayaran',$pesanan->id_pesanan) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">Tunai</label>
                        <div class="col-2">
                        <input type="number" class="form-control" id="uang" name="uang">
                    </div>
                    </div>

                    <div class="form-group">
                        <label for="">Kembalian</label>
                        <div class="col-2">
                        <input type="number" readonly id="kembalian" class="form-control" name="kembalian">
                    </div>
                    </div>
                    <button class="btn btn-primary">Bayar</button>
                    <a class="btn btn-info" id="cetak" href="{{ route('struk',$pesanan->id_pesanan) }}" target="_blank" data-id="{{ $pesanan->id_pesanan }}">Cetak Struk</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@push('script')
<script>
    let kembalian = 0;
    const total = $("table tbody tr").find('#total').text();
    $("#uang").keyup(function(){
        let uang = $(this).val();
        kembalian += uang*1 - total*1;
        if(kembalian < 0){
            kembalian = 0;
        }
        console.log(kembalian);
        $("#kembalian").val(kembalian);
    })

    // $("#cetak").click(function(){
    //     let id = $(this).attr('data-id');
    //     $.ajax({
    //         url:"/struk/"+id,
    //         method:'GET',
    //         success:function(res){
    //             if(res.code == 200){
    //                 window.open()
    //             }
    //         }
    //     })
    // })
</script>
@endpush