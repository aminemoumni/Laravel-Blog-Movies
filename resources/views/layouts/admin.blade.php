<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title>Admin</title>

    <!-- Bootstrap Core CSS -->

   
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('assets/fonts/fontawesome-webfont.svg')}}">
    <link rel="stylesheet" href="{{asset('assets/fonts/fontawesome-webfont.eot')}}">
    <link rel="stylesheet" href="{{asset('assets/fonts/fontawesome-webfont.ttf')}}">
    <link rel="stylesheet" href="{{asset('assets/fonts/fontawesome-webfont.woff')}}">
    <link rel="stylesheet" href="{{asset('assets/fonts/FontAwesome.otf')}}">
    <link rel="stylesheet" href="{{asset('assets/fonts/glyphicons-halflings-regular.eot')}}">
    <link rel="stylesheet" href="{{asset('assets/fonts/glyphicons-halflings-regular.svg')}}">
    <link rel="stylesheet" href="{{asset('assets/fonts/glyphicons-halflings-regular.ttf')}}">
    <link rel="stylesheet" href="{{asset('assets/fonts/glyphicons-halflings-regular.woff')}}">
    <link rel="stylesheet" href="{{asset('assets/fonts/glyphicons-halflings-regular.woff2')}}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link rel="stylesheet" href="{{asset('assets/css/libs/styles.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/libs/animate.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/libs/hover.css')}}">
    <link href="{{asset('css/all.css')}}" rel="stylesheet">
    @yield('style')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->




</head>

<body id="admin-page">

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Home</a>
        </div>
        <!-- /.navbar-header -->

        

        <ul class="nav navbar-top-links navbar-right" style="display: inline-block">
            <li class="dropdown-item"><a href="{{route('home')}}"><i class="fa fa-user fa-fw "></i> Site web</a>
            </li>
            <li class="dropdown-item"><a href="#"><i class="fa fa-user fa-fw "></i> User Profile</a>
            </li>
            <li class="dropdown-item"><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
            </li>
            <li class="dropdown-item">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>
                
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>

            <!-- /.dropdown -->
            
            <!-- /.dropdown -->


        </ul>






        {{--<ul class="nav navbar-nav navbar-right">--}}
        {{--@if(auth()->guest())--}}
        {{--@if(!Request::is('auth/login'))--}}
        {{--<li><a href="{{ url('/auth/login') }}">Login</a></li>--}}
        {{--@endif--}}
        {{--@if(!Request::is('auth/register'))--}}
        {{--<li><a href="{{ url('/auth/register') }}">Register</a></li>--}}
        {{--@endif--}}
        {{--@else--}}
        {{--<li class="dropdown">--}}
        {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ auth()->user()->name }} <span class="caret"></span></a>--}}
        {{--<ul class="dropdown-menu" role="menu">--}}
        {{--<li><a href="{{ url('/auth/logout') }}">Logout</a></li>--}}

        {{--<li><a href="{{ url('/admin/profile') }}/{{auth()->user()->id}}">Profile</a></li>--}}
        {{--</ul>--}}
        {{--</li>--}}
        {{--@endif--}}
        {{--</ul>--}}





        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                        </div>
                        <!-- /input-group -->
                    </li>
                    <li>
                        <a href="/admin"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                    </li>
                    @if (Auth::user()->isAdmin())
                    <li>
                       
                        <a href="#"><i class="fa fa-wrench fa-fw"></i>Users<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{route('users.index')}}">All Users</a>
                            </li>

                            <li>
                                <a href="{{route('users.create')}}">Create User</a>
                            </li>

                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    @endif
                    <li>
                        <a href="#"><i class="fa fa-wrench fa-fw"></i> Posts<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{route('posts.index')}}">All Posts</a>
                            </li>

                            <li>
                                <a href="{{route('posts.create')}}">Create Post</a>
                            </li>
                            <li>
                                <a href="{{route('comments.index')}}">All Comments</a>
                            </li>

                        </ul>
                        <!-- /.nav-second-level -->
                    </li>


                    <li>
                        <a href="#"><i class="fa fa-wrench fa-fw"></i>Categories<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{route('categories.index')}}">All Categories</a>
                            </li>

                            <li>
                                <a href="{{route('categories.index')}}">Create Category</a>
                            </li>

                        </ul>
                        <!-- /.nav-second-level -->
                    </li>


                    <li>
                        <a href="#"><i class="fa fa-wrench fa-fw"></i>Media<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                            <a href="{{route('media.index')}}">All Media</a>
                            </li>

                            <li>
                                <a href="{{route('media.create')}}">Upload Media</a>
                            </li>

                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                </ul>


            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>
</div>






<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"></h1>
                @if (session('status'))
                <div class="alert alert-success animated bounceInDown delay-1s " role="alert">
                    {{ session('status') }}
                </div>           
                @endif
                @if (session('error'))
                <div class="alert alert-danger animated bounceInDown delay-1s" role="alert">
                    {{ session('error') }}
                </div>  
               
                @endif

                
                @yield('content')
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
@include('sweetalert::alert')






<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('assets/js/libs/jquery.js')}}"></script>
<script src="{{asset('assets/js/libs/bootstrap.js')}}"></script>
<script src="{{asset('assets/js/libs/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/libs/sb-admin-2.js')}}"></script>
<script src="{{asset('assets/js/libs/metisMenu.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>



<script src="{{asset('assets/js/libs/scripts.js')}}"></script>


@yield('script')


@yield('footer')





</body>

</html>
