@extends('layouts.admin')

@section('content')


<h1>Users</h1>

<table class="table table-bordered">
    <thead>
      <tr>
        <th width='10%' >Name</th>
        <th width="15%">Photo</th>
        <th width="20%">Email</th>
        <th  width='10%'>Role</th>
        <th  width='10%'>Active</th>
        <th class="text-center">Action</th>
      </tr>
    </thead>
    <tbody>
     @foreach ($users as $user)
     <tr>
        <td >{{$user->name}}</td>
        <td class="text-center"><img class="img-thumbnail img-fluid rounded" src= "{{$user->photo ? $user->photo->file : '/storage/images/avatar.png'}} " alt="" height="100" width="100"></td>
        <td>{{$user->email}}</td>
        <td>{{$user->role->name}}</td>
        <td>{{$user->is_active ? 'Enable' : 'Disabled'}}</td>
        <td class="text-center">
            
            <form action="{{route('users.destroy', $user->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <a href="{{route('users.edit' , $user->id)}}"class="btn btn-info " >Update</a>
            <a href="" class="btn btn-info">Show</a>
            <button type="submit" class="btn btn-danger" onclick="archiveFunction()" >Delete</button>
            </form>
            
        </td>

      </tr> 
     @endforeach
     
      
    </tbody>
  </table>
    
@endsection

@section('script')

<script>
  function archiveFunction() {
event.preventDefault(); // prevent form submit
var form = event.target.form; // storing the form

        swal({
  title: "Are you sure?",
  text: "You will delete user and all his posts permentaly.",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#e74c3c",
  cancelButtonColor: '#3085d6',
  confirmButtonText: "Yes, Delete it",
  cancelButtonText: "Cancel !",
  
},
function(isConfirm){
  if (isConfirm) {
    form.submit();          // submitting the form when user press yes
  } 
});
}
    
</script>

@endsection