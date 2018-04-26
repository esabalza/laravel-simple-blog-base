<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/shop-item.css" rel="stylesheet">
    <link href="/css/my-login.css" rel="stylesheet">

</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">

                @auth
                    <li class="nav-item">
                        <a class="nav-link">Logged in as {{\Auth::User()->name}}</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link"  href="{{route('logout')}}">Logout</a>
                    </li>
                @elseauth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>

<!-- Page Content -->
<div class="container">

    <div class="row">


        @auth
        <div class="col-lg-3">

            @section('sidebar')

                <br/>
                <div class="list-group">{{ (\Request::route()->getName() == '/') ? 'active' : '' }}
                    <a href="{{route('users.index')}}" class="list-group-item  {{ (\Request::route()->getName() == 'users.index') ? 'active' : '' }}">Users</a>
                    <a href="{{route('posts.index')}}" class="list-group-item  {{ (\Request::route()->getName() == 'posts.index') ? 'active' : '' }}">Posts</a>

                </div>


            @show

        </div>

    @endauth
        <!-- /.col-lg-3 -->

        <div class="col-lg-9 @auth @else  mx-auto @endauth">
            @yield('content')
            <br/>
            <span class="text-muted">Made with ♥ in Colombia</span>
            <br/>
            <br/>
        </div>
        <!-- /.col-lg-9 -->

    </div>

</div>
<!-- /.container -->



<!-- Bootstrap core JavaScript -->
<script src="/vendor/jquery/jquery.min.js"></script>
<script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
