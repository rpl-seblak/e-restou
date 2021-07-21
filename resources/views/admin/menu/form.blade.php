@extends('layouts.master-pegawai')
@section('section-header','Data Menu')
@section('content-pegawai')

<div class="card">
            <div class="card-body">
            @if (@session('pesan'))
            <div class="alert alert-success pesan">
                <p>{{ session('pesan') }}</p>
            </div>
            @endif
                <!-- <h5 class="card-title">Special title treatment</h5> -->
                <div class="row">
                    <div class="col-md-12">
                    <form method="POST" action="{{route('menu.store')}}" enctype="multipart/form-data">
                    @csrf
                       
                        <div class="form-group">
                            <label>Nama Menu</label>
                            <input type="text" name="nama_menu" class="form-control" id="formGroupExampleInput" >
                            @error('nama_menu')
                                <h6 class="text-danger">{{ $message }}</h6>
                            @enderror
                        </div>
              <!--         <div class="form-group">
                            <label>Satuan</label>
                            <input type="text" name="satuan" id="satuan" class="form-control" id="inlineFormInputGroup">
                        </div>-->
                        <div class="form-row">
                            <div class="form-group">
                                <label>Harga</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Rp</div>
                                    </div>
                                    <input type="number" name="harga" class="form-control" id="inlineFormInputGroup">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Stok</label>
                            <input type="number" name="stok" class="form-control" id="inlineFormInputGroup" min="1">
                        </div>
                        <!-- <div class="form-group">
                            <label>Foto</label>
                            <input type="file" name="foto" class="form-control" id="inlineFormInputGroup" >
                        </div> -->

                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </form>
                    </div>
                </div>
            </div>
</div>

@endsection
@push('script')
@endpush