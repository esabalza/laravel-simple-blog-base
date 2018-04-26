@extends('layouts.master')

@section('title', 'List posts')

@section('sidebar')
    @parent
@stop

@section('content')


    <br/>
    <div class="card">
        <div class="card-header"><span class="card-title"><h3>Posts</h3></span></div>
        <div class="card-body">


            <div class="alert alert-primary" role="alert">
                Welcome, manage your posts with a single click!
            </div>

            @if(\Session::has('success'))
                <div class="alert alert-success">
                    {{\Session::get('success')}}
                </div>
            @endif

            <a href="{{ route('posts.create') }}" class="btn btn-primary">Create a post</a>
            <br/>
            <br/>


            {{ $posts->render() }}
            <table class="table table-responsive">

                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Creator</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>

                <tbody>

                @foreach ($posts as $post)

                    <tr>
                        <td>#{{$post->id}}</td>
                        <td>
                            {{$post->title}}
                        </td>
                        <td>
                            <a href="{{ route('users.edit', $post->user->id) }}">{{$post->user->name}}</a>
                        </td>
                        <td>
                            <a class="btn btn-default" href="{{route('posts.edit', $post->id)}}" >Edit</a>
                        </td>
                        <td>
                            <form action="{{route('posts.destroy', $post->id)}}" method="post">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>


            </table>

            {{ $posts->render() }}
        </div>
    </div>

@stop