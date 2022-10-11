@extends('../layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <div>Product List</div>
                  <a href="{{ route('product.create') }}" class="btn btn-primary d-block text-white text-decoration-none"><i class="fa-solid fa-plus" style="margin-right: 10px"></i>Create</a>
                </div>
                <form action="{{ route('import') }}" class="mt-4 d-flex align-items-start justify-content-start" style="margin-left: 15px" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="mb-3 d-inline-block">
                    <input id="file" type="file" class="form-control @error('file') is-invalid @enderror" name="file" value="{{ old('file') }}" autocomplete="file">
                    @error('file')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <button class="btn btn-primary">Import</button>
                  <a href="{{ route('export') }}" class="btn btn-success">Export</a>
                </form>
                <div class="card-body">
                    <table class="table" id="product-table">
                        <thead>
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">User Name</th>
                            <th scope="col">Title</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Updated At</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($products as $product)
                          <tr style="vertical-align: middle;">
                            <td>{{ $product['id'] }}</td>
                            <td>{{ $product->user->name }}</td>
                            <td>{{ $product['title'] }}</td>
                            <td>
                              
                                @foreach ($product->categories as $category)
                                  <span class="badge bg-success">{{ $category->name }}</span>
                                @endforeach
                            </td>
                            <td>{{ $product['price'] }}</td>
                            <td>{{ $product['updated_at'] }}</td>
                            <td>
                                @if(auth()->user()->id == $product->user->id)
                                    <div class="d-flex">
                                        <form class="" style="margin-right: 10px;" action="{{ route('product.destroy',$product->id) }}"  method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger"><i class="fa-solid fa-trash" style="margin-right: 10px"></i>Delete</button>
                                        </form>
                                        <div class="col2">
                                        <a class="btn btn-info d-block text-decoration-none text-white" href="{{ route('product.edit',$product->id) }}"><i class="fa-solid fa-pen" style="margin-right: 10px"></i>Edit</a>
                                        </div>
                                    </div>
                                @endif
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
<!-- Datatable -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<script>
$(document).ready( function () {
  $('#product-table').DataTable();
} );
</script>