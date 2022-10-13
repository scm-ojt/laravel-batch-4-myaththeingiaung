@extends('../layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-18">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>Category Create</div>
                    <a href="{{ route('admin.category.index') }}" class="btn btn-primary d-block text-white text-decoration-none"><i class="fa-solid fa-arrow-left-long" style="margin-right:7px"></i>Back</a>
                  </div>

                <div class="card-body">
                    <form action="{{ route('admin.category.update',$category->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="mb-3">
                            <label for="name" class="form-label">Category Name</label>
                            <input id="phone" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name',$category->name) }}" autocomplete="name">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection