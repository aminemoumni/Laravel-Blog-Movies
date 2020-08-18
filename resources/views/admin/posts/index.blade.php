@extends('layouts.admin')
@section('content')
<h1>Posts</h1>
<table class="table table-bordered text-center">
    <thead>
      <tr >
        <th class="text-center" width="20%">Photo</th>
        <th class="text-center" width="10%">Title</th>
        <th class="text-center" >Category</th>
        <th class="text-center" >Created by</th>
        <th class="text-center" width="35%" >Action</th>
      </tr>
    </thead>
    <tbody>
     @foreach ($posts as $post)
     <tr>
        <td class="text-center">
            @if($post->photo)
                <img class="img-thumbnail img-fluid rounded" src= "{{$post->photo->file}} " alt="" height="200" width="200">

            @else 
                No image 
            @endif
        </td>
        <td ><a href="#" class="href">{{$post->title}}</a></td>
        <td>{{$post->category->name}}</td>
        <td>{{$post->user->name}}</td>
        <td >
            <div style="display: inline-block">

            
            <form action="{{route('posts.destroy', $post->id)}}" method="POST">
            @csrf
            @method('DELETE')
           
            <a href="{{route('posts.edit', $post->id)}}"class="btn btn-info " >Update</a>
            <a href="{{route('post.home', $post->slug)}}"class="btn btn-info " >View post</a>
            <a href="{{route('comments.show', $post->id)}}"class="btn btn-info " >View comment</a>
            
            <button type="submit" class="btn btn-danger" onclick="archiveFunction()" >Delete</button>
            </form>
           

            </div>
        </td>

      </tr> 
     @endforeach
     
      
    </tbody>
  </table>

  <div class="row">
      <div class="col-sm-6 col-sm-offset-5">
          {{$posts->render()}}
      </div>
  </div>
@endsection

@section('script')

<script>
  function archiveFunction() {
event.preventDefault(); // prevent form submit
var form = event.target.form; // storing the form

        swal({
  title: "Are you sure?",
  text: "You will delete post permentaly.",
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