@extends('layouts.master-pegawai')
@section('content-pegawai')

<div class="card">
    <div class="card-header">
        Laporan
    </div>
    <div class="card-body">

        

        <div class="row">
        <div class="col-sm-4">
                <div class="form-group">
                    <label for="">Pilih Bulan : </label>
                    <input type="month" class="form-control" name="" id="bulan">
                </div>
            </div>
        </div>
        <button class="btn btn-primary mb-5" id="filter">Cari</button>
        <div class="row">
            <div class="col-lg-12">
            <div class="table-responsive mr-0">
                    <table class="table table-striped dataTable no-footer" id="table-laporan">
                        <thead>
                            <tr role="row">
                                <th>Tanggal</th>
                                <th>Pendapatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <p>Total : <span id="totalpendapatan"></span></p>
    </div>
</div>


@endsection
@push('script')
<script>
    window.onload = function(){
        $(document).ready(function(){
        let periode = new Date().toLocaleDateString('en-CA');
        console.log(periode);
        const num2curr = num => 'Rp'+new Intl.NumberFormat('id-ID', { style: 'decimal', currency: 'IDR' }).format(num);
        console.log(num2curr(184300))
        let pesan = `Tanggal : ${periode} \n Total Pendapatan : `+$('#totalpendapatan').text();
        let tblLaporan = $('#table-laporan').DataTable({
            "processing": true,
            "serverSide": true,
            ajax:{
                    url:"{{ route('kasir.laporan') }}",
                    data: function (d) {
                        d.bulan = $('#bulan').val();
                    }
                },
            columns: [
                {data: 'tanggal_pemesanan', name: 'email'},
                {data: 'pendapatan', name: 'pendapatan'},
            ],
            dom: 'Bfrtip',
            buttons: [
                {
                    messageTop : function(){
                        return `Tanggal : ${periode} \n Total Pendapatan : ${$("#totalsalary").text()}`;
                    },
                    text: 'Download',
                    extend: 'pdfHtml5',
                    title:'Laporan Pendapatan E-restou',
                    filename:'report-'+periode,
                    customize: function ( doc ) {
                        // Splice the image in after the header, but before the table
                        // doc.content.splice( 1, 0, {
                        //     margin: [ 0, 0, 0, 12 ],
                        // } );
                        // Data URL generated by http://dataurl.net/#dataurlmaker
                        doc.content[2].table.widths = [
                            '*',200
                        ];
                        doc.content[2].layout = "borders";
                        console.log(doc);
                    }
                }
                
            ],
            drawCallback: function(){
            const totalSalary = this
            .api()
            .column(1)
            .data()
            .toArray()
            //remove '$',',', keep decimal separator '.', summarize
            .reduce((total,salary) => total+=Number(salary.split(' ')[1].replace('.','')),0);
            //insert result into the <span> text
            $('#totalpendapatan').text(`${num2curr(totalSalary)}`);
        }
        } );

        $('#filter').click(function(){
            tblLaporan.draw();
            
        })
        console.log(pesan);
        console.log($('#totalsalary').text());
    })
    }
</script>
@endpush