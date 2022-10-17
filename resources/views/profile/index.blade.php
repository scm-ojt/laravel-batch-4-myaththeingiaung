@extends('../layouts.adminlte')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mt-4">
                <div class="card-header clearfix">
                    <div class="lft" style="float: left"><h4>User List</h4></div>      
                    <form action="" class="rgt d-flex align-items-start justify-content-end" style="float: right;">
                      <div class="mb-3 d-inline-block">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name">
                      </div>
                      <input type="submit" class="btn btn-primary" value="search" style="margin-left: 5px">
                    </form>       
                </div>
                <div class="card-body">
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
                                    <form class="userDeleteForm{{$user->id}}" style="margin-right: 10px;" action="{{ route('admin.profile.destroy',$user->id) }}"  method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger del-user-btn" style="width:100px" data-id="{{ $user->id }}">
                                          <a href="javascript:;" class="d-block del-user-btn text-decoration-none text-white ">
                                              <i class="fa-solid fa-trash" style="margin-right: 10px"></i>Delete
                                          </a>
                                      </button>
                                    </form>
                                    <div class="col2">
                                      <a class="btn btn-secondary d-block text-decoration-none text-white" style="width:100px" href="{{ route('admin.profile.edit',$user->id) }}"><i class="fa-solid fa-pen" style="margin-right: 10px"></i>Edit</a>
                                    </div>
                                </div>
                              </td>
                              @elseif(auth()->user()->id == $user->id)
                              <td>
                                  <div class="d-flex">
                                      <form class="userDeleteForm{{$user->id}}" style="margin-right: 10px;" action="{{ route('admin.profile.destroy',$user->id) }}"  method="post">
                                          @csrf
                                          @method('delete')
                                          <button class="btn btn-danger del-user-btn" data-id="{{ $user->id }}">
                                            <a href="javascript:;" class="d-block del-user-btn text-decoration-none text-white ">
                                                <i class="fa-solid fa-trash" style="margin-right: 10px"></i>Delete
                                            </a>
                                        </button>
                                      </form>
                                      <div class="col2">
                                        <a class="btn btn-info d-block text-decoration-none text-white" href="{{ route('admin.profile.edit',$user->id) }}"><i class="fa-solid fa-pen" style="margin-right: 10px"></i>Edit</a>
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
