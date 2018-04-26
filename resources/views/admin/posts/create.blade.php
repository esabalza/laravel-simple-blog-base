@extends('layouts.master')

@section('title', 'Create post')

@section('sidebar')
    @parent
@stop

@section('content')


    <br/>
    <div class="card">
        <div class="card-header"><span class="card-title"><h3>Create a post</h3></span></div>
        <div class="card-body">

        @if (count($errors))
            <!--Errors while saving a user-->
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        {{ $error }}
                    </div>
                @endforeach
            @endif


            <form action="{{ route('posts.store') }}" method="post">
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-4 col-form-label">Title</label>
                    <div class="col-8">
                        <input id="title" name="title" placeholder="My post title" type="text" class="form-control here">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="text" class="col-4 col-form-label">Tags<br/><span class="text-muted">One by one separated by spaces</span></label>
                    <div class="col-8">
                        <input id="text" name="tags" placeholder="Laravel Analytics Leads" type="text" class="form-control here">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="offset-4 col-8">
                        <a class="btn btn-default" href="{{route('posts.index')}}">Err </a><button name="submit" type="submit" class="btn btn-primary">Create</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

@stop