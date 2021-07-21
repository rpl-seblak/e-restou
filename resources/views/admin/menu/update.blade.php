@extends('layouts.master-pegawai')
@section('section-header','Ubah Data Menu')
@section('content-pegawai')
<div class="card">
            <div class="card-body">
           
                <!-- <h5 class="card-title">Special title treatment</h5> -->
                <div class="row">
                    <div class="col-md-12">
                    <form method="POST" action="{{route('menu.update',$menu->id_menu)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                        <div class="form-group">
                            <label>Nama Menu</label>
                            <input type="text" name="nama_menu" value="{{$menu->nama_menu}}" class="form-control" id="formGroupExampleInput" placeholder="Example input placeholder">
                            @error('nama_menu')
                                <h6 class="text-danger">{{ $message }}</h6>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Harga</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp</div>
                                </div>
                                <input type="number" value="{{$menu->harga_menu}}" name="harga" class="form-control" id="inlineFormInputGroup">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Stok</label>
                            <input type="number" name="stok" class="form-control" value="{{$menu->stok}}" id="inlineFormInputGroup" min="1">
                        </div>
                        <!-- <div class="form-group">
                            <label>Foto Baru</label>
                            <input type="file" name="foto" class="form-control" id="inlineFormInputGroup" >
                        </div> -->

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                    </div>
                </div>
            </div>
</div>
@endsection