@extends('layouts.app')
@section('content')
<div class="main-wrapper">
@include('layouts.navbar')
@include('layouts.sidebar')
    <div class="main-content">
        <section class="section mt-4">
        <div class="section-header d-none">
            
          </div>

          <div class="section-body">
            @yield('content-pegawai')
          </div>
        </section>
    </div>
</div>
@include('layouts.footer')
@include('layouts.modal-detail')
@endsection

@push('script')
    <script>
       $('body').attr("class",'');
    if($(".pesan").length>0){
        setTimeout(() => {
            $(".pesan").remove();
        }, 2000);
    }
    </script>
@endpush