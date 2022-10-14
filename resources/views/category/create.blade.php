@extends('../layouts.backend')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div><h4>Category Create</h4></div>
                    <a href="{{ route('admin.category.index') }}" style="background-color:rgba(138, 0, 212,0.9);color:white;" class="btn d-block text-white text-decoration-none"><i class="fa-solid fa-arrow-left-long" style="margin-right:7px"></i>Back</a>
                  </div>

                <div class="card-body">
                    <form action="{{ route('admin.category.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Category Name</label>
                            <input id="phone" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button style="background-color:rgba(138, 0, 212,0.9);color:white;" class="btn">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection