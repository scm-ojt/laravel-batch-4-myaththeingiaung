@extends('../layouts.backend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <div><h4>Product List</h4></div>
                  <a href="{{ route('product.create') }}" class="btn btn-color d-block text-white text-decoration-none"><i class="fa-solid fa-plus" style="margin-right: 10px"></i>Create</a>
                </div>
                
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        @if(auth()->guard('admin')->user())
                            <form action="{{ route('admin.product.import') }}" class="mt-2 d-flex align-items-start justify-content-start" style="margin-left: 15px" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3 d-inline-block">
                                <input id="file" type="file" class="form-control @error('file') is-invalid @enderror" name="file" value="{{ old('file') }}" autocomplete="file">
                                @error('file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <button class="btn btn-color" style="margin: 0 5px;">Import</button>
                                <a href="{{ route('admin.product.export') }}" class="btn btn-pink">Export</a>
                            </form>
                        @endif
                        <form action="" class="mt-2 d-flex align-items-start justify-content-end" style="margin-left: 15px">
                            <div class="mb-3 d-inline-block">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" autocomplete="title">
                            </div>
                            <button class="btn btn-color" style="margin-left: 5px">Search</button>
                        </form>
                    </div>
                  <table class="table" id="product-table">
                      <thead>
                        <tr>
                          <th scope="col">No</th>
                          <th scope="col">User Name</th>
                          <th scope="col">Title</th>
                          <th scope="col">Category Name</th>
                          <th scope="col">Price</th>
                          <th scope="col">Updated At</th>
                          <th scope="col" style="width:200px;">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if($products->count() <= 0)
                            <tr>
                                <td class="text-center" colspan="7">There is no record</td>
                            </tr>
                        @else
                            @foreach($products as $product)
                            <tr style="vertical-align: middle;">
                            <td>{{ ++$i }}</td>
                            <td>
                                {{ $product->user?->name }}
                            </td>
                            <td>{{ $product['title'] }}</td>
                            <td>  
                                @foreach ($product->categories as $category)
                                    <span class="badge bg-success">{{ $category->name }}</span>
                                @endforeach
                            </td>
                            <td>{{ $product['price'] }}</td>
                            <td>{{ $product['updated_at'] }}</td>
                            <td>
                                @if (auth()->guard('admin')->user())
                                    <div class="d-flex">
                                        <form class="" style="margin-right: 10px;" action="{{ route('product.destroy',$product->id) }}"  method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger"><i class="fa-solid fa-trash" style="margin-right: 10px"></i>Delete</button>
                                        </form>
                                        <div class="col2">
                                        <a class="btn btn-secondary d-block text-decoration-none text-white" href="{{ route('product.edit',$product->id) }}"><i class="fa-solid fa-pen" style="margin-right: 10px"></i>Edit</a>
                                        </div>
                                    </div>
                                @elseif(auth()->user()->id == $product->user?->id)
                                    <div class="d-flex">
                                        <form class="" style="margin-right: 10px;" action="{{ route('product.destroy',$product->id) }}"  method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger"><i class="fa-solid fa-trash" style="margin-right: 10px"></i>Delete</button>
                                        </form>
                                        <div class="col2">
                                        <a class="btn btn-secondary d-block text-decoration-none text-white" href="{{ route('product.edit',$product->id) }}"><i class="fa-solid fa-pen" style="margin-right: 10px"></i>Edit</a>
                                        </div>
                                    </div>
                                @endif
                            </td>
                            </tr>
                            @endforeach
                        @endif
                      </tbody>
                    </table>
                    {{ $products->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
