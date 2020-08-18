@extends('layouts.blog-post')

@section('content')
<h1>{{$post->title}}</h1>

<!-- Author -->
<p class="lead">
    by <a href="#">{{$post->user->name}}</a>
</p>

<hr>

<!-- Date/Time -->
<p><i class="fa fa-clock-o"></i> Posted {{$post->created_at->diffForHumans()}}</p>

<hr>

<!-- Preview Image -->
<img class="img-responsive" src="{{$post->photo->file}}" alt="" width="900px" height="300px">

<hr>

<!-- Post Content -->
<p> {{$post->body}} </p>
<hr>

<!-- Blog Comments -->

<!-- Comments Form -->
<div class="well">
    <h4>Leave a Comment:</h4>

@if(Auth::check())
    

    {!! Form::open(['method' => 'POST', 'action' => 'PostCommentsController@store', 'id' => 'myform']) !!}
            {!! csrf_field() !!}
        <input type="hidden" name="post_id" value="{{$post->id}}" >
        <div class="form-group">
            {!! Form::Textarea('body', null, ['class' => 'form-control', 'rows' => 3] ) !!}
        </div>
        {{-- @if($errors->get('name'))
            <ul>
                @foreach($errors->get('name') as $error)
                <li style="color: red; font-weight:bold">
                    {{$error}}
                </li>
                @endforeach
            </ul>
        @endif --}}
        <div class="form-group">
            {!! Form::submit('Submit', ['class' => 'btn btn-primary', 'id'=> 'btn-success']) !!}
        </div>
        {!! Form::close() !!}

@else 
<p>You must be logged in to write a comment !</p>
@endif
</div>
<hr>

<!-- Posted Comments -->

<!-- Comment -->
@foreach ($comments as $comment)
    <div class="media">
        <a class="pull-left" href="#">
            <img class="media-object" src="{{$comment->photo->file}}" height="64" width="64" alt="">
        </a>
        <div class="media-body">

            <h4 class="media-heading">{{$comment->author}}
                <small>{{$comment->created_at}}</small>
            </h4>

        {{$comment->body}}

            <!-- Nested Comment -->
            

            <br>
                @if($comment->replies->count() != 0)
                    @foreach ($comment->replies as $reply)
                        @if($reply->is_active == 1)
                        <div class="media" style="padding-top: 15px">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="{{$reply->photo->file}}" height="64" width="64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">{{$reply->author}}
                                    <small>{{$reply->author}}</small>
                                </h4>
                                {{$reply->body}}
                            </div>
                        
                        </div>
                        <hr>
                        @endif
                    @endforeach
                @endif
                
              
                <div class="comment-reply-container" >
                <button class="toggle-reply btn btn-primary pull-right "  >Reply</button>
                    
                    <div class="comment-reply col-sm-11" style="display: none; padding-top:5px;">
                        @if(Auth::check())
                            <h5 style="padding-top:0    px">Reply to {{$comment->author}} </h5>
                            {!! Form::open(['method' => 'POST', 'action' => 'CommentRepliesController@store', 'id' => 'myform']) !!}
                            {!! csrf_field() !!}
                            <input type="hidden" name="comment_id" value="{{$comment->id}}" >
                            <div class="form-group">
                                {!! Form::Textarea('body', null, ['class' => 'form-control', 'rows' => 1] ) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::submit('Submit', ['class' => 'btn btn-primary', 'id'=> 'btn-success']) !!}
                            </div>
                            {!! Form::close() !!}
                        @else
                            <h5 style="padding-top: 10px">You must be logged in to reply !</h5>
                        @endif
                    </div>
                </div>
            <!-- End Nested Comment -->
        </div>
          
    </div>
    <hr>
    
@endforeach



<!-- Comment -->
{{-- <div class="media">
    <a class="pull-left" href="#">
        <img class="media-object" src="http://placehold.it/64x64" alt="">
    </a>
    <div class="media-body">
        <h4 class="media-heading">Start Bootstrap
            <small>August 25, 2014 at 9:30 PM</small>
        </h4>
        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
        <!-- Nested Comment -->
        <div class="media">
            <a class="pull-left" href="#">
                <img class="media-object" src="http://placehold.it/64x64" alt="">
            </a>
            <div class="media-body">
                <h4 class="media-heading">Nested Start Bootstrap
                    <small>August 25, 2014 at 9:30 PM</small>
                </h4>
                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
            </div>
        </div>
        <!-- End Nested Comment -->
    </div>
</div> --}}
@endsection

@section('script')
<script>
    $("comment-reply-container, .toggle-reply").click(function(){
        $(this).next().slideToggle("slow");
    });
</script>

@endsection