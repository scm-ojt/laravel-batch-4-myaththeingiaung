@extends('user.layouts.app')

@section('content')
<div class="container" style="margin-top: 80px">
    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            @guest
                            <img src="{{ asset('img/phone.jpg') }}" width="40px" height="40px" class="rounded-circle elevation-2" alt="User Photo">
                            @else   
                            <img src="{{ asset('img/user.png') }}" class="rounded-circle"  width="40px" height="40px" alt="User Image">
                            @endguest
                            <h4 class="mt-2 ms-2">{{ $product->user->name }}</h4>
                        </div>
                        <hr>
                        <h3>{{ $product->title }}</h3>
                        <p class="" style="font-weight: bolder">$ {{ $product->price }}</p>
                        
                        @if($product->images->isEmpty())                           
                            <img src="{{ asset('img/car1.jfif') }}" class="mb-4 rounded" width="382px" height="300px"  alt="Product Image">
                        @else
                            @foreach ($product->images as $image)
                                <img src="{{ asset('img/products/'.$image->name) }}" class="mb-4 rounded"  width="382px" height="300px" alt="Product Image">
                            @endforeach
                        @endif 
                        <p class="text-black-50 mb-4">{{ Str::words($product->description, 13) }}</p>
                        <div class="d-flex justify-content-between">
                            @guest
                                <a href="{{ route('product.show',$product->id) }}" class="btn btn-primary ml-auto"><i class="fa-solid fa-circle-info" style="margin-right: 10px"></i>See More</a>
                            @else
                                <a href="{{ route('product.show',$product->id) }}" class="btn btn-primary ml-auto"><i class="fa-solid fa-circle-info" style="margin-right: 10px"></i>See More</a>
                                @can('update-product')
                                    <div class="d-flex">
                                        <a href="{{ route('product.edit',$product->id) }}" class="btn btn-secondary"><i class="fa-solid fa-pen" style="margin-right: 10px"></i>Edit</a>
                                        <form class="" style="margin-left: 5px;" action="{{ route('product.destroy',$product->id) }}"  method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger"><i class="fa-solid fa-trash" style="margin-right: 10px"></i>Delete</button>
                                        </form>
                                    </div>
                                @endcan
                            @endguest
                        </div>
                    </div>
                </div>   
            </div>
        @endforeach
        <div class="d-flex justify-content-end">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection
