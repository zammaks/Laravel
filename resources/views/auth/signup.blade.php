@extends('layout')
@section('content')


@if ($errors->any())
  <div class="danger">
    <ul>
      @foreach ($errors->all() as $error)
         <li class='alert alert-danger'>
          {{$error}}
         </li>
      @endforeach
    </ul>
  </div>
@endif

<form action="/auth/registr" method="post">
  @csrf
  <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" id="name" name="name">
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary">Save</button>
</form>
@endsection