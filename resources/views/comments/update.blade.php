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



<form action="/comment/{{$comment->id}}/update" method="POST">
  @csrf
  <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ $comment->name}}">
  </div>
  <div class="mb-3">
    <label for="desc" class="form-label">Description</label>
    <textarea name="desc" class="form-control" id="desc">{{ $comment->desc}}</textarea>
  </div>
  <input type="hidden" value="{{ $comment->article_id }}" name="article_id">
  <input type="hidden" value="{{ $comment->user_id }}" name="user_id">
  <!-- <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
  </div> -->
  <button type="submit" class="btn btn-primary">Update article</button>
</form>
@endsection