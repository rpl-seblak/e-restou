@extends('layouts.master-pegawai')
@section('content-pegawai')

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="h3">Pembayaran</div>
            </div>
            <div class="card-body">
               <div class="row">
                   <div class="col-md-4">
                       <p>Id Pesanan : {{ $pesanan->id_pesanan }}</p>
                       <p>Nama Pelanggan : {{ $pesanan->nama_pelanggan }}</p>
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
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($detail as $value)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $value->menu->nama_menu }}</td>
                                <td>{{ $value->qty }}</td>
                                <td>{{ $value->qty*$value->menu->harga_menu }}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="3">Total Harga</td>
                                <td id="total"> {{ $pesanan->total_pembayaran }} </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <form action="{{ route('kasir.proses-pembayaran',$pesanan->id_pesanan) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">Tunai</label>
                        <input type="number" class="form-control" id="uang" name="uang">
                    </div>

                    <div class="form-group">
                        <label for="">Kembalian</label>
                        <input type="number" readonly id="kembalian" class="form-control" name="kembalian">
                    </div>
                    <button class="btn btn-primary">Bayar</button>
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
</script>
@endpush