@extends('layouts.app')
@section('content')
<div class="main-wrapper">
@include('layouts.navbar')
@include('layouts.sidebar')
    <div class="main-content">
        <section class="section">
        <div class="section-header">
            <h1>@yield('section-header')</h1>
            <div class="section-header-breadcrumb">
            </div>
          </div>

          <div class="section-body">
            @yield('content-admin')
          </div>
        </section>
    </div>
</div>
@include('layouts.footer')
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