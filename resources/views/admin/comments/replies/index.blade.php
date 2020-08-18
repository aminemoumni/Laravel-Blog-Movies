@extends('layouts.admin')

@section('content')
    

<h1>Repiles</h1>

<table class="table table-bordered">
    <thead>
    <tr>
        <th >ID</th>
        <th width="10%">Comment ID</th>
        <th width="15%">Email</th>
        <th >Replies</th>
        <th >Created_at</th>
        <th class="text-center">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($replies as $reply)
    <tr>
        
        <td>{{$reply->id}}</td>
        <td>{{$reply->comment->id}}</td>
        <td>{{$reply->email}}</td>
        <td>{{$reply->body}}</td>
        <td>{{$reply->created_at}}</td>
        

        
        <td class="text-center">
            
            {{-- <form action="{{route('categories.destroy', $category->id)}}" method="POST">
            @csrf
            @method('DELETE')
            --}}
            <div>
               <div style="display: inline-block">
                @if($reply->is_active)
                {!! Form::open([ 'method' => 'POST', 'action' => ['CommentRepliesController@unapprove', $reply->id], 'id' => 'myform']) !!}
                {!! csrf_field() !!}
                    
                {!! Form::submit('UnApprove', ['class' => 'btn btn-success', 'id'=> 'btn-success']) !!}
                {!! Form::close() !!}
                @else
                {!! Form::open([ 'method' => 'POST', 'action' => ['CommentRepliesController@approve', $reply->id], 'id' => 'myform']) !!}
                {!! csrf_field() !!}
                    
                {!! Form::submit('Approve', ['class' => 'btn btn-success', 'id'=> 'btn-success']) !!}
                {!! Form::close() !!}
                
                
                @endif
               </div>
               
                <a href="{{route('post.home', $reply->comment->post->id)}}" class="btn btn-info">View Post</a>
                {{-- <a href="{{route('replies.show', $comment->id)}}" class="btn btn-info">View Replies</a> --}}

                <div style="display: inline-block">
                    <form action="{{route('replies.destroy', $reply->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                    
                        
                        <button type="submit" class="btn btn-danger" onclick="archiveFunction()" >Delete</button>
                        </form>
                </div>
           
            </div>

            {{--
            <a href="{{route('categories.edit', $category->id)}}"class="btn btn-info " >Update</a>
            
            <button type="submit" class="btn btn-danger" onclick="archiveFunction()" >Delete</button>
            </form> --}}
            
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
      text: "You will delete reply permentaly.",
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