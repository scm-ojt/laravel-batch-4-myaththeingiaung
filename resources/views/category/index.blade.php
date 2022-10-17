@extends('../layouts.adminlte')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <div><h4>Category List</h4></div>
                  <a href="{{ route('admin.category.create') }}" class="btn btn-primary ml-auto d-block text-white text-decoration-none"><i class="fa-solid fa-plus" style="margin-right: 10px"></i>Create</a>
                </div>
                <div class="card-body">
                  <form action="" class="mt-2 d-flex align-items-start justify-content-end" style="margin-left: 15px">
                    <div class="mb-3 d-inline-block">
                      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name">
                    </div>
                    <button class="btn btn-primary" style="margin-left: 5px;"><i class="fas fa-search fa-fw"></i>Search</button>
                  </form>
                    <table class="table" id="category-table">
                        <thead>
                          <tr>
                            <th class="cat-th" scope="col">No</th>
                            <th class="cat-th" scope="col">Name</th>
                            <th class="cat-th" scope="col">Created_at</th>
                            <th class="cat-th" scope="col">Updated_at</th>
                            <th class="cat-th" scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        @if($categories->count() <= 0)
                        <tr>
                            <td class="text-center" colspan="7">There is no record</td>
                        </tr>
                        @else
                            @foreach($categories as $category)
                            <tr style="vertical-align: middle;">
                                <td>{{ ++$i }}</td>
                                <td>{{ $category['name'] }}</td>
                                <td>{{ $category['created_at'] }}</td>
                                <td>{{ $category['updated_at'] }}</td>
                                <td>
                                    <div class="d-flex">
                                        <form class="" style="margin-right: 10px;" action="{{ route('admin.category.destroy',$category->id) }}"  method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger"><i class="fa-solid fa-trash" style="margin-right: 10px"></i>Delete</button>
                                        </form>
                                        <div class="col2">
                                        <a class="btn btn-secondary d-block text-decoration-none text-white" href="{{ route('admin.category.edit',$category->id) }}"><i class="fa-solid fa-pen" style="margin-right: 10px"></i>Edit</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                        </tbody>
                      </table>
                      {{ $categories->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
