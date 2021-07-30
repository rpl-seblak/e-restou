@extends('layouts.master-pegawai')
@section('section-header','Pemesanan')
@section('content-pegawai')

<div class="card">
    <div class="card-body">
            <div class="row">
                <div class="col">
                        <div class="form-group">
                            <label for="">No Meja</label>
                            <input type="text" name="no_meja" id="meja" value="{{ request()->route('meja') }}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">Nama Pelanggan</label>
                            <input type="text" name="nama" id="nama" class="form-control">
                        </div>

                    <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Pilih Menu</button>
                    <button class="btn btn-primary" id="tes-url">Tes</button>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-lg-12">
                   <div class="table-responsive">
                   <table class="table table-bordered" id="table-pesanan">
                        <thead>
                            <tr>
                                <th>Menu</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th>Jumlah</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                    </table>
                   </div>
                </div>
                <button class="btn btn-primary" id="btn-pesan">Pesan</button>
            </div>

            

    </div>
</div>

@endsection
<div class="modal fade" id="exampleModal" data-backdrop="static" data-keyboard="false" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pilih Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <!-- row -->
            <div class="row">
            <div class="table-responsive">
                   <table class="table table-bordered" id="table-menu">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Menu</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Pilih</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($menu as $item)
                                <tr class="baris-{{ $item->id_menu }}">
                                    
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_menu }}</td>
                                    <td> {{ $item->harga_menu }} </td>
                                    <td>{{ $item->stok }}</td>
                                    <td>
                                        <input type="checkbox" name="pilih" class="pilih" value="{{ $item->id_menu }}">
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                    </table>
                   </div>
            </div>
            <!-- end row -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" id="simpan" data-dismiss="modal">Simpan</button>
      </div>
    </div>
  </div>
</div>

@push('script')
<script>
    let _token = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function(){
        // $('#myModal').on('hidden.bs.modal', function (event) {
        
    // })
    // $("#tes-url").click(function(){
    //     window.location.href = '/pelayan/meja';
    // });
        let arr = [];
        let arrPesanan = [];
        $('.pilih').click(function(){
            if($(this).is(':checked')){
                let data ={};
                let column = $(this).closest('tr').find('td:not(:first-child)');
                data.idMenu = $(column[3]).find('input:checkbox').val();
                data.namaMenu = $(column[0]).text();
                data.hargaMenu = $(column[1]).text();
                data.qty = 0;
                arr.push(data);
                // $(columns).each(function(index) {
                //     console.log("Column " + (index + 1) + " has value " + $(this).text());
                //     data.nama_menu = 
                // });
                console.log(arr);
            }    
        })

        $("#simpan").click(function(){
            let elm = '';
            for(item of arr){
                elm += `
                <tr>
                    <input type="hidden" value="${item.idMenu}" class="menu-pesanan">
                    <td>${item.namaMenu}</td>
                    <td>${item.hargaMenu}</td>
                    <td><input type="number" min="0" name="qty" class="form-control qty"></td>
                    <td class="jumlah">0</td>
                    <td>
                    <button class="btn btn-danger btn-icon hapus-pembelian" data-id="${item.idMenu}"><i class="fas fa-trash"></i></button></td>
                </tr>`;
            }
            $("#table-pesanan").find('tbody').append(elm);
        })
           $("#table-pesanan").on('click','tbody .hapus-pembelian',function(){
               console.log(3);
           })

           $("#table-pesanan").on('keyup','tbody .qty',function(){
                let baris = $(this).closest('tr');
                let harga = baris.find('td:nth-child(3)').text();
                let jumlah = harga*$(this).val();
                baris.find('td:nth-child(5)').text(jumlah);

           })

           $("#btn-pesan").click(function(){
               let objPesanan = {};
               // loop barisnya dulu (tr)
               $("#table-pesanan tbody tr").each(function(index){
                //    console.log($(this).html());
                // loop column na
                let kolom = $(this).find('td:not(:last-child)'); 
                //    $(this).find('td:not(:last-child)').each(function(index) {
                //     console.log("Column " + (index + 1) + " has value " + $(this).text());
                //  });
                    objPesanan.idMenu =  $(this).find('.menu-pesanan').val();
                    objPesanan.qty = $(kolom[2]).find('input').val();
                    objPesanan.jumlah = $(kolom[3]).text();
                    arrPesanan.push(objPesanan);
               })
               console.log(objPesanan);
               let dataPesanan = {
                   nama : $("#nama").val(),
                   idMeja: $("#meja").val(),
                   pesanan : arrPesanan
               }
                $.ajax({
                    url:'/pelayan/pesanan',
                    method:'POST',
                    data:{
                        _token : _token,
                        dataPesanan
                    },
                    success:function(res){
                        if(res.code == 200){
                            window.location.href = '/pelayan/meja';
                        }
                    }
                })               
           })
        
    })
</script>
@endpush
