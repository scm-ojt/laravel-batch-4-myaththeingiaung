@extends('user.layouts.app')

@section('content')
<div class="container" style="margin-top: 60px">
    <div class="row">
        @foreach ($products as $product)
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <h3>{{ $product->title }}</h3>
                        <p class="" style="font-weight: bolder">$ {{ $product->price }}</p>
                        
                        @if($product->images->isEmpty())                           
                            <img src="{{ asset('img/car1.jfif') }}" class="mb-4 rounded" width="202px" height="200px"  alt="Product Image">
                        @else
                            @foreach ($product->images as $image)
                                <img src="{{ asset('img/products/'.$image->name) }}" class="mb-4 rounded"  width="270px" height="200px" alt="Product Image">
                            @endforeach
                        @endif 
                        <p class="text-black-50 mb-4">{{ Str::words($product->description, 13) }}</p>
                        <div class="d-flex justify-content-between">
                            <div class="d-flex">
                                <a href="{{ route('product.show',$product->id) }}" style="margin-right: 5px;" class="btn btn-primary ml-auto"><i class="fa-solid fa-circle-info" style="margin-right:3px"></i>See More</a>
                                <form class="" style="margin-right: 5px;" action="{{ route('product.destroy',$product->id) }}"  method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger"><i class="fa-solid fa-trash"  style="margin-right:3px"></i>Delete</button>
                                </form>
                                <a href="{{ route('product.edit',$product->id) }}" class="btn btn-secondary"><i class="fa-solid fa-pen"  style="margin-right:3px"></i>Edit</a>                            
                            </div>
                        </div>
                </div>
            </div>
        </div> 
        @endforeach
        
    </div>
</div>
@endsection