@extends('layouts.master')

@section('title', 'Welcome - Admin')

@section('sidebar')
    @parent
@stop

@section('content')

    <br/>
    <div class="jumbotron">
        <h1 class="display-3">Welcome! :)</h1>
        <p class="lead">Use the sidebar to navigate through the admin panel</p>
    </div>

@stop