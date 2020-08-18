@extends('layouts.admin')
@section('content')
<h1>Media</h1>



@if($photos)
<form action="{{route('media.deleteall')}}" method="post" class="form-inline">
    {{ csrf_field() }}
    {{method_field('delete')}}
    <div class="form-group">
        <select name="checkBoxArray" class="form-control" id="">
            <option value="delete">Delete</option>
        </select>
    </div>
    <div class="form-group">
        <input type="submit" value="Delete" class="btn btn-danger">
    </div>
       
    <table class="table">
        <thead>
            <tr>
                <th> <input type="checkbox" name="" id="options"> </th>
                <th>ID</th>
                <th>Name</th>
                <th>Created</th>
                <th>Email / Post</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($photos as $photo)
                <tr>
                <td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="{{$photo->id}}"> </td>
                    <td>{{$photo->id}}</td>
                    <td>
                        <img class="img-thumbnail img-fluid rounded" height="200" width="200" src="{{$photo->file}}" alt=""><br>
                        <span>{{$photo->file}}</span>
                    
                    </td>
                    <td>{{$photo->created_at}}</td>
                    <td>
                        @if($photo->post)
                        {{$photo->post->title }}
                        @endif
                        @if($photo->user)
                        {{$photo->user->email }}
                        @endif

                    </td> 
                   
                </tr>
            @endforeach
        </tbody>

    </table>
</form>
<script>
   
</script>
@endif

@endsection

@section('script')

    <script>
      function archiveFunction() {
    event.preventDefault(); // prevent form submit
    var form = event.target.form; // storing the form
    
            swal({
      title: "Are you sure?",
      text: "You will delete image permentaly.",
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



    $(document).ready(function(){
        $('#options').click(function(){
            if(this.checked){
                $('.checkBoxes').each(function(){
                    this.checked = true;
                });
            }
            else {
                $('.checkBoxes').each(function(){
                    this.checked = false;
                });
            }
        });
    });
    </script>
    
@endsection