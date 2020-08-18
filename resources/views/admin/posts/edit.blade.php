@extends('layouts.admin')
@section('content')
<span ><a href="{{route('posts.index')}}" style="color: red !important"  ><i class="fa fa-window-close fa-2x pull-right hvr-buzz "></i></a></span>

<h1>Update post</h1>

<div class="row">
    <div class="col-md-3 text-center ">
        @if($post->photo)
                <img class="img-thumbnail img-fluid rounded" src= "{{$post->photo->file}} " alt="" height="400" width="400"></td>

            @else 
                No image 
            @endif
    </div>
    <div class="col-md-9">
        {!! Form::model($post, ['method' => 'PUT', 'action' => ['AdminPostsController@update', $post->id], 'files' => true]) !!}
        <div class="row">
            <div class="col-md-6">
                <div class="form-group @if($errors->get('title') )has-error @endif">
                    {!! Form::label('title', 'Title:') !!}
                    {!! Form::text('title', null, ['class' => 'form-control'] ) !!}
                    
                </div>
                @if($errors->get('title'))
                <ul>
                    @foreach($errors->get('title') as $error)
                    <li style="color: red; font-weight:bold">
                        {{$error}}
                    </li>
                    @endforeach
                </ul>
                @endif
            </div>
            <div class="col-md-6">
                <div class="form-group @if($errors->get('category_id') )has-error @endif">
                    {!! Form::label('category', 'Category:') !!}
                    {!! Form::select('category_id', ['' => 'Choose option'] + $categories, null, ['class' => 'form-control'] ) !!}
                </div>
                @if($errors->get('category_id'))
                    <ul>
                        @foreach($errors->get('category_id') as $error)
                        <li style="color: red; font-weight:bold">
                            {{$error}}
                        </li>
                        @endforeach
                    </ul>
                @endif
            </div>        
        </div>
        <div class="form-group @if($errors->get('body') )has-error @endif">
            {!! Form::label('content', 'Content:') !!}
            {!! Form::textarea('body', null, ['class' => 'form-control'] ) !!}
        </div>
        @if($errors->get('body'))
            <ul>
                @foreach($errors->get('body') as $error)
                <li style="color: red; font-weight:bold">
                    {{$error}}
                </li>
                @endforeach
            </ul>
        @endif


        <div class="form-group ">
            {!! Form::label('file', 'Photo:') !!}
            {!! Form::file('photo',  ['class' => 'form-control'] ) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Update post', ['class' => 'btn btn-success ']) !!}
        </div>
        {!! Form::close() !!}

    </div>
</div>
@endsection