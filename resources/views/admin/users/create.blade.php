@extends('layouts.admin')

@section('content')
<span ><a href="{{route('users.index')}}" style="color: red !important"  ><i class="fa fa-window-close fa-2x pull-right hvr-buzz "></i></a></span>

<h1>Create user</h1>


{!! Form::open(['method' => 'POST', 'action' => 'AdminUsersController@store', 'files' => true]) !!}
    <div class="row">
        <div class="col-md-6">
            <div class="form-group @if($errors->get('name') )has-error @endif">
                {!! Form::label('name', 'Name:') !!}
                {!! Form::text('name', null, ['class' => 'form-control'] ) !!}
                @if($errors->get('name'))
                <ul>
                    @foreach($errors->get('name') as $error)
                    <li style="color: red; font-weight:bold">
                        {{$error}}
                    </li>
                    @endforeach
                </ul>
            @endif
            </div>
           
        </div>
        <div class="col-md-6">
            <div class="form-group @if($errors->get('email') )has-error @endif">
                {!! Form::label('email', 'Email:') !!}
                {!! Form::email('email', null , ['class' => 'form-control'] ) !!}
            </div>
            @if($errors->get('email'))
                <ul>
                    @foreach($errors->get('email') as $error)
                    <li style="color: red; font-weight:bold">
                        {{$error}}
                    </li>
                    @endforeach
                </ul>
            @endif
        </div>        
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <div class="form-group @if($errors->get('role') )has-error @endif">
                {!! Form::label('role', 'Role:') !!}
                {!! Form::select('role_id', ['' => 'Choose option'] + $roles, null, ['class' => 'form-control'] ) !!}
            </div>
            @if($errors->get('role'))
                <ul>
                    @foreach($errors->get('role') as $error)
                    <li style="color: red; font-weight:bold">
                        {{$error}}
                    </li>
                    @endforeach
                </ul>
            @endif
        </div>
        <div class="col-md-6">
            <div class="form-group ">
                {!! Form::label('status', 'Status:') !!}
                {!! Form::select('is_active', array(1 => 'Enabled', 0 => 'Disabled'), 0 , ['class' => 'form-control'] ) !!}
            </div>
        </div>        
    </div>
    <div class="form-group ">
        {!! Form::label('file', 'Photo:') !!}
        {!! Form::file('photo',  ['class' => 'form-control'] ) !!}
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group @if($errors->get('password') )has-error @endif">
                {!! Form::label('password', 'Password:') !!}
                {!! Form::password('password',  ['class' => 'form-control'] ) !!}
            </div>
            @if($errors->get('password'))
                <ul>
                    @foreach($errors->get('password') as $error)
                    <li style="color: red; font-weight:bold">
                        {{$error}}
                    </li>
                    @endforeach
                </ul>
            @endif
        </div>
        <div class="col-md-6">
            <div class="form-group @if($errors->get('password') )has-error @endif">
                {!! Form::label('password_confirmation', 'Confirm password:') !!}
                {!! Form::password('password_confirmation',  ['class' => 'form-control'] ) !!}
            </div>
            @if($errors->get('password'))
                <ul>
                    @foreach($errors->get('password') as $error)
                    <li style="color: red; font-weight:bold">
                        {{$error}}
                    </li>
                    @endforeach
                </ul>
            @endif
        </div>        
    </div>
    
    <div class="form-group">
        {!! Form::submit('Create user', ['class' => 'btn btn-success']) !!}
    </div>
{!! Form::close() !!}


@endsection