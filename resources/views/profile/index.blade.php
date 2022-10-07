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
                    <table class="table" id="category-table">
                        <thead>
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Address</th>
                            <th scope="col">Updated_at</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($users as $user)
                          <tr style="vertical-align: middle;">
                            <td>{{ $user['id'] }}</td>
                            <td>{{ $user['name'] }}</td>
                            <td>{{ $user['email'] }}</td>
                            <td>{{ $user['phone'] }}</td>
                            <td>{{ $user['address'] }}</td>
                            <td>{{ $user['updated_at'] }}</td>
                            @if(auth()->user()->id == $user['id'])
                            <td>
                                <div class="d-flex">
                                    <form class="" style="margin-right: 10px;" action="{{ route('profile.destroy',$user->id) }}"  method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger"><i class="fa-solid fa-trash" style="margin-right: 10px"></i>Delete</button>
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
  $('#category-table').DataTable();
} );
</script>