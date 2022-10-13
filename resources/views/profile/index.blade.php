@extends('../layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>User List</div>
                    @guest
                        @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-primary d-block text-white text-decoration-none"><i class="fa-solid fa-plus" style="margin-right: 10px"></i>Register</a>
                        @endif
                    @endguest
                  
                </div>
                <div class="card-body">
                  <form action="" class="mt-2 d-flex align-items-start justify-content-end" style="margin-left: 15px">
                    <div class="mb-3 d-inline-block">
                      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name">
                    </div>
                    <button class="btn btn-primary" style="margin-left: 5px">Search</button>
                  </form>
                    <table class="table" id="category-table">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Address</th>
                            <th scope="col">Updated_at</th>
                            <th scope="col" style="width: 200px;">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @if($users->count() <= 0)
                            <tr>
                                <td class="text-center" colspan="7">There is no record</td>
                            </tr>
                          @else
                            @foreach($users as $user)
                            <tr style="vertical-align: middle;">
                              <td>{{ ++$i }}</td>
                              <td>{{ $user['name'] }}</td>
                              <td>{{ $user['email'] }}</td>
                              <td>{{ $user['phone'] }}</td>
                              <td>{{ $user['address'] }}</td>
                              <td>{{ $user['updated_at'] }}</td>
                              @if(auth()->guard('admin')->user())
                              <td>
                                <div class="d-flex">
                                    <form class="userDeleteForm{{$user->id}}" style="margin-right: 10px;" action="{{ route('profile.destroy',$user->id) }}"  method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger del-user-btn" data-id="{{ $user->id }}">
                                          <a href="javascript:;" class="d-block del-user-btn text-decoration-none text-white ">
                                              <i class="fa-solid fa-trash" style="margin-right: 10px"></i>Delete
                                          </a>
                                      </button>
                                    </form>
                                    <div class="col2">
                                      <a class="btn btn-info d-block text-decoration-none text-white" href="{{ route('profile.edit',$user->id) }}"><i class="fa-solid fa-pen" style="margin-right: 10px"></i>Edit</a>
                                    </div>
                                </div>
                              </td>
                              @elseif(auth()->user()->id == $user->id)
                              <td>
                                  <div class="d-flex">
                                      <form class="userDeleteForm{{$user->id}}" style="margin-right: 10px;" action="{{ route('profile.destroy',$user->id) }}"  method="post">
                                          @csrf
                                          @method('delete')
                                          <button class="btn btn-danger del-user-btn" data-id="{{ $user->id }}">
                                            <a href="javascript:;" class="d-block del-user-btn text-decoration-none text-white ">
                                                <i class="fa-solid fa-trash" style="margin-right: 10px"></i>Delete
                                            </a>
                                        </button>
                                      </form>
                                      <div class="col2">
                                        <a class="btn btn-info d-block text-decoration-none text-white" href="{{ route('profile.edit',$user->id) }}"><i class="fa-solid fa-pen" style="margin-right: 10px"></i>Edit</a>
                                      </div>
                                  </div>
                              </td>
                              @else
                              <td></td>
                              @endif
                            </tr>
                            @endforeach
                        @endif
                        </tbody>
                      </table>
                      {{ $users->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
  $(document).ready(function(){
      $(document).on('click', '.del-user-btn', function (e) {
        e.preventDefault();
        let id = $(this).data('id');

        Swal.fire({
            title: 'Are You Sure?',
            text: "Do You Want to Delete?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK',
            cancelButtonText: 'CANCEL',
            reverseButtons: true,
        }).then((result) => {
            if (result.isConfirmed) {
                $('.userDeleteForm' + id).submit();
            }
        })
    });
  });
</script>
@endpush
