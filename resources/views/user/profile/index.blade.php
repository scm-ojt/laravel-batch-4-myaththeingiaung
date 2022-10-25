@extends('user.layouts.app')

@section('content')
<div class="container" style="margin-top: 70px">
    <div class="row mb-4 justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="align-items-center">
                        @if(Auth::user()->images()->exists())
                        <img width="40px" height="40px" class="rounded-circle" style="margin-right: 10px" src="{{ asset(Auth::user()->images[0]->path) }}" alt="User Photo">
                        @else
                        <img width="40px" height="40px" class="rounded-circle" style="margin-right: 10px" src="{{ asset('img/user.png') }}" alt="User Photo">                                   
                        @endif
                        <span class="mb-0" style="font-size: 22px;font-weight:600;">{{ Auth::user()->name }}</span>
                    </div>
                  <a href="{{ route('product.create') }}" class="btn btn-primary ml-auto d-block text-white text-decoration-none"><i class="fa-solid fa-plus" style="margin-right: 10px"></i>Create</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        @foreach ($products as $product)
        <div class="col-9">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-7 mt-2">
                            <div class="align-items-start">
                                <h3>{{ $product->title }}</h3>
                                <p class="" style="font-weight: bolder">$ {{ $product->price }}</p>
                                <p class="text-black-50 mb-4">{{ $product->description }}</p>
                            </div>
                            <div class="d-flex align-items-end">
                                <a href="{{ route('product.show',$product->id) }}" style="margin-right: 5px;" class="btn btn-primary ml-auto"><i class="fa-solid fa-circle-info" style="margin-right:3px"></i>See More</a>
                                <form class="" style="margin-right: 5px;" action="{{ route('product.destroy',$product->id) }}"  method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger"><i class="fa-solid fa-trash"  style="margin-right:3px"></i>Delete</button>
                                </form>
                                <a href="{{ route('product.edit',$product->id) }}" class="btn btn-secondary"><i class="fa-solid fa-pen"  style="margin-right:3px"></i>Edit</a>                            
                            </div>
                        </div>
                        <div class="col-md-4 mt-2">
                            @if($product->images->isEmpty())                           
                                <img src="{{ asset('img/car1.jfif') }}" class="mb-4 rounded" width="202px" height="200px"  alt="Product Image">
                            @else
                                @foreach ($product->images as $image)
                                    <img src="{{ asset('img/products/'.$image->name) }}" class="mb-4 rounded"  width="270px" height="200px" alt="Product Image">
                                @endforeach
                            @endif 
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        @endforeach
        
    </div>
    {{-- <div class="arrow" style="font-size: 30px">
        <i class="fa-solid fa-arrow-up-long"></i>
    </div> --}}
</div>
@endsection
@push('js')
    <!-- Sweet Alert 2 -->
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush