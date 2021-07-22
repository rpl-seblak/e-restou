@extends('layouts.master-pegawai')
@section('section-header','Data Detail Pesanan')
@section('content-pegawai')

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="h3">Detail Pesanan</div>
            </div>
            <div class="card-body">
               <div class="row">
                   <div class="col-md-4">
                       <p>Id Pesanan : 1</p>
                       <p>No Meja : 2</p>
                       <p>Status : waiting</p>
                   </div>
               </div>
                <div class="table-responsive">
                    <table class="table table-striped dataTable no-footer" id="table-1">
                        <thead>
                            <tr role="row">
                                <th>No</th>
                                <th>Nama Menu</th>
                                <th>Qty</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Es Teh</td>
                                <td>3</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <a href="#" class="btn btn-primary">Masak</a>
            </div>
        </div>
    </div>
</div>

@endsection
