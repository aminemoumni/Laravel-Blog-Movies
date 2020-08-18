<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog Home - Start Bootstrap Template</title>
    
    <!-- Bootstrap Core CSS -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
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

    <!-- Custom CSS -->
    <link href="css/blog-home.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    @include('includes.topnav')

    <!-- Page Content -->
    @yield('content')
    <!-- /.container -->

    <!-- jQuery -->
    <script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('assets/js/libs/jquery.js')}}"></script>
<script src="{{asset('assets/js/libs/bootstrap.js')}}"></script>
<script src="{{asset('assets/js/libs/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/libs/sb-admin-2.js')}}"></script>
<script src="{{asset('assets/js/libs/metisMenu.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>



<script src="{{asset('assets/js/libs/scripts.js')}}"></script>


@yield('script')

</body>

</html>
