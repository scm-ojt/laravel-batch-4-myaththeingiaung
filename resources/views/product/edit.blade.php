@extends('../layouts.backend')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div><h4>Product Edit</h4></div>
                    <a href="{{ route('product.index') }}" class="btn btn-color d-block text-white text-decoration-none"><i class="fa-solid fa-arrow-left-long" style="margin-right:7px"></i>Back</a>
                  </div>

                <div class="card-body">
                    <form action="{{ route('product.update',$product->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input id="phone" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title',$product->title) }}" autocomplete="title">
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price',$product->price) }}" autocomplete="price">
                            @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="category-name" class="form-label">Category Name</label>
                            <select class="form-select" id="pre-selected-options" name="category-names[]" aria-label="Choose Category Name" multiple>
                                @foreach ($product->categories as $category)
                                    {{ $cId[] = $category->pivot->category_id; }}
                                @endforeach
                                @foreach ($categories as $cname)
                                    <option value="{{ $cname['id'] }}" @if(in_array($cname->id, $cId) ) selected @endif>{{ $cname['name'] }}</option>
                                @endforeach
                            </select>
                            @error('category-names')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" class="w-100" id="" cols="" rows="4">{{ @old('description',$product->description) }}</textarea>
                            @error('description')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button class="btn btn-color">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- Select 2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function(){
        $('#pre-selected-options').select2({
            placeholder: "Select Category Name",
            allowClear:true,
        });
    });
</script>