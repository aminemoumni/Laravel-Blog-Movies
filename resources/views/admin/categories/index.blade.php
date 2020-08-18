@extends('layouts.admin')
@section('content')
<h1>Categories</h1>
<div class="col-md-6">
    @if(isset($categoryEdit))
    
        {!! Form::model($categoryEdit , [ 'method' => 'PUT', 'action' => ['AdminCategoriesController@update', $categoryEdit->id], 'id' => 'myform']) !!}
            {!! csrf_field() !!}
        <div class="form-group @if($errors->get('name') )has-error @endif">
            {!! Form::label('name', 'Name of Category:') !!}
            {!! Form::text('name', null, ['class' => 'form-control'] ) !!}
        </div>
        @if($errors->get('name'))
            <ul>
                @foreach($errors->get('name') as $error)
                <li style="color: red; font-weight:bold">
                    {{$error}}
                </li>
                @endforeach
            </ul>
        @endif
        <div class="form-group">
            {!! Form::submit('Update Category', ['class' => 'btn btn-success', 'id'=> 'btn-success']) !!}
        </div>
        {!! Form::close() !!}

     @else 
        {!! Form::open(['method' => 'POST', 'action' => 'AdminCategoriesController@store', 'id' => 'myform']) !!}
            {!! csrf_field() !!}
        <div class="form-group @if($errors->get('name') )has-error @endif">
            {!! Form::label('name', 'Name of Category:') !!}
            {!! Form::text('name', null, ['class' => 'form-control'] ) !!}
        </div>
        @if($errors->get('name'))
            <ul>
                @foreach($errors->get('name') as $error)
                <li style="color: red; font-weight:bold">
                    {{$error}}
                </li>
                @endforeach
            </ul>
        @endif
        <div class="form-group">
            {!! Form::submit('Create Category', ['class' => 'btn btn-success', 'id'=> 'btn-success']) !!}
        </div>
        {!! Form::close() !!}

    
    @endif
</div>
<div class="col-md-6">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th >ID</th>
            <th width="10%">Name</th>
            <th >Use on posts</th>
            <th  class="text-center">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($categories as $category)
        <tr>
            
            <td >{{$category->id}}</td>
            <td>{{$category->name}}</td>
            <td>{{$category->posts->count()}}</td>
            
            <td class="text-center">
                
                <form action="{{route('categories.destroy', $category->id)}}" method="POST">
                @csrf
                @method('DELETE')
            
                <a href="{{route('categories.edit', $category->id)}}"class="btn btn-info " >Update</a>
                
                <button type="submit" class="btn btn-danger" onclick="archiveFunction()" >Delete</button>
                </form>
                
            </td>

        </tr> 
        @endforeach
        
        
        </tbody>
    </table>
</div>
@endsection
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>


<script>
    $(document).ready(function() {
    $(".btn-success").click('#btn-success',function(e){
    e.preventDefault();
    var _token      = $("input[name='_token']").val();
    var name = $("input[name='name']").val();
    if ('name' == "") {
        $('#display_info').html('Category created successfly.');
    } else {
    $.ajax({
    url: "http://localhost:8000/savedata",
    type:'POST',
    data: { _token:_token, name:name},
    success: function(data) {
    $('#btn-success').html("Register");
    $('#display_info').html('Category created successfly.');
    $("#myform")[0].reset(); 
    }
    });
    }
    }); 
    });
    </script> --}}
    @section('script')

    <script>
      function archiveFunction() {
    event.preventDefault(); // prevent form submit
    var form = event.target.form; // storing the form
    
            swal({
      title: "Are you sure?",
      text: "You will delete category permentaly.",
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
