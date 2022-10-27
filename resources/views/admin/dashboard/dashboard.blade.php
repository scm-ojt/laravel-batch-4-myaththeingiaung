@extends('admin.layouts.adminlte')
@section('title') Blog | Admin Dashboard @endsection
@section('content')
<div class="container">
    <div class="row mt-4">
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <h3 class="mb-3">Total Users</h3>
                    <div class="d-flex ">
                        <i class="fa-solid fa-users px-4 text-primary" style="font-size: 26px"></i> 
                        <h4><span class="counter-up">{{ $users }}</span></h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <h3 class="mb-3">Total Products</h3>
                    <div class="d-flex ">
                        <i class="fa-solid fa-box-open px-4 text-primary" style="font-size: 26px"></i> 
                        <h4><span class="counter-up">{{ $products }}</span></h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <h3 class="mb-3">Total Categories</h3>
                    <div class="d-flex ">
                        <i class="fa-solid fa-tags px-4 text-primary" style="font-size: 26px"></i> 
                        <h4><span class="counter-up">{{ $categories }}</span></h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <h3 class="mb-3">Total Images</h3>
                    <div class="d-flex ">
                        <i class="fa-solid fa-image px-4 text-primary" style="font-size: 26px"></i> 
                        <h4><span class="counter-up">{{ $images }}</span></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    $('.counter-up').counterUp({
        delay: 10,
        time: 1000,
    });
</script> 
@endpush