@extends('user.layouts.app')
@section('content')
<div class="container" style="margin-top: 80px">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('dist/img/user1-128x128.jpg') }}" alt="" width="50px" class="rounded-circle mr-3">
                        <h2 class="mt-2 ms-2">{{ $product->user->name }}</h2>
                    </div>
                </div>
                
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                    @if($product->images->isEmpty())                           
                        <img src="{{ asset('img/car1.jfif') }}" class="mb-4 rounded" width="500px"  alt="Product Image">
                    @else
                        @foreach ($product->images as $image)
                            <img src="{{ asset('img/products/'.$image->name) }}" class="mb-4 rounded"  width="500px" alt="Product Image">
                        @endforeach
                    @endif          
                    </div>
                    <div class="col-md-6">
                        <h3 class="mb-3 d-block">{{ $product->title }}</h3>
                        <small class="mb-3 d-block"><h4>${{ $product->price }}</h4></small>
                        <div class="mb-3">
                            @foreach ($product->categories as $category)
                                <a href="#" class="btn btn-sm btn-success">{{ $category->name }}</a>
                            @endforeach
                        </div>
                        
                        <p>{{ $product->description }}</p>
                        <p>{{ $product->description }}</p>
                        <p>{{ $product->description }}</p>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('home') }}" class="btn btn-primary text-white text-decoration-none"><i class="fa-solid fa-arrow-left-long" style="margin-right:7px"></i>Back</a>
                            @if(auth()->user()->id == $product->user->id) 
                                <div class="d-flex">
                                    <a href="{{ route('product.edit',$product->id) }}" class="btn btn-secondary"><i class="fa-solid fa-pen" style="margin-right: 10px"></i>Edit</a>
                                    <form class="" style="margin-left: 5px;" action="{{ route('product.destroy',$product->id) }}"  method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger"><i class="fa-solid fa-trash" style="margin-right: 10px"></i>Delete</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection