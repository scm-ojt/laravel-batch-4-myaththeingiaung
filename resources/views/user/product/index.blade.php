@extends('user.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
    </div>
</div>
@endsection
@push('js')
    <!-- Sweet Alert 2 -->
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

