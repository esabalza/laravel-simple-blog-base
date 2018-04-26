@extends('layouts.master')

@section('title', 'List users')

@section('sidebar')
  @parent
@stop

@section('content')


  <br/>
  <div class="card">
    <div class="card-header"><span class="card-title"><h3>Users</h3></span></div>
    <div class="card-body">


      <div class="alert alert-primary" role="alert">
        Welcome, manage your users with a single click!
      </div>

      @if(\Session::has('success'))
        <div class="alert alert-success">
          {{\Session::get('success')}}
        </div>
      @endif

      <a href="{{ route('users.create') }}"  class="btn btn-primary">Create a user</a>
      <br/>
      <br/>


        {{ $users->render() }}
      <table class="table table-responsive">

        <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th></th>
          <th></th>
        </tr>
        </thead>

        <tbody>
        @foreach ($users as $user)
          <tr>
            <td>#{{$user->id}}</td>
            <td>{{$user->name}} </td>
            <td>{{$user->email}}</td>
            <td>
                <a class="btn btn-default" href="{{route('users.edit', $user->id)}}" >Edit</a>
            </td>
              <td>
                  <form action="{{route('users.destroy', $user->id)}}" method="post">
                      @method('delete')
                      @csrf
                      <button class="btn btn-danger">Delete</button>
                  </form>
              </td>
          </tr>
        @endforeach
        </tbody>


      </table>

      {{ $users->render() }}
    </div>
  </div>

@stop