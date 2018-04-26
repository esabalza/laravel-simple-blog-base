@extends('layouts.master')

@section('title', 'Page Title')

@section('sidebar')
    @parent
@stop

@section('content')
    <section class="h-100 my-login-page">
        <div class="container h-100">
            <div class="row justify-content-md-center h-100">
                <div class="card-wrapper">
                    <div class="card fat">
                        <div class="card-body">
                            <h4 class="card-title">Login</h4>
                            <form method="POST" action="{{route('login')}}">
                                @csrf

                                <!--Login errors-->
                                @if (count($errors))
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif

                                <div class="form-group">
                                    <label for="email">E-Mail Address</label>

                                    <input id="email" type="email" class="form-control" name="email" value="" required autofocus>
                                </div>

                                <div class="form-group">
                                    <label for="password">Password
                                    </label>
                                    <input id="password" type="password" class="form-control" name="password" required data-eye>
                                </div>


                                <div class="form-group no-margin">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        Login
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="footer">
                        Copyright &copy; 2018 &mdash; Enrique Sabalza
                    </div>
                </div>
            </div>
        </div>
    </section>



@stop