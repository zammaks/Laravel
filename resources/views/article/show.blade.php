@extends ('layout')
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
@if (session('status'))
  <div class="alert alert-success" role="alert">
    {{ session('status') }}
  </div>
@endif
<div class="card text-center mb-3" style="width: 80rem;">
<div class="card-header">
  <b>Author:</b>{{$user->name}}
</div>
  <div class="card-body">
    <h5 class="card-title">{{$article->name}}</h5>
    <p class="card-text">{{$article->desc}}</p>
    <div class="d-flex justify-content-center gap-3">
    @can ('update', $article->id)
        <a href="/article/{{$article->id}}/edit" class="btn btn-primary">Edit article</a>
    @endcan
    @can ('delete', $article->id)
        <form action="/article/{{$article->id}}" method="post">
            @Method("DELETE")
            @csrf
            <button type="submit" class="btn btn-danger">Delete article</button>
        </form>
    @endcan
    </div>
  </div>
</div>
<h4>Add comment</h4>
<form action="/comment" method="POST">
  @csrf
  <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" id="name" name="name">
  </div>
  <div class="mb-3">
    <label for="desc" class="form-label">Description</label>
    <input type="text" class="form-control" id="desc" name="desc">
  </div>
  <!-- <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
  </div> -->
  <input type="hidden" value="{{ $article->id }}" name="article_id">

  <button type="submit" class="btn btn-primary mb-3">Save comment</button>
</form>
@foreach ($comments  as $comment)
  <div class="card text-bg-primary mb-3" style="max-width: 20rem;">
    <div class="card-header">{{ $comment->created_at->format('F d, Y \a\t H:i') }}</div>
    <div class="card-body">
      <h4 class="card-title">{{$comment->user->name}}</h4>
      <h5 class="card-title">{{$comment->name}}</h5>
      <p class="card-text">{{$comment->desc}}</p>
    </div>
    <div class="d-flex justify-content-center gap-3 mb-3">
      @can ('update-comment', $comment)
        <a href="/comment/{{$comment->id}}/edit" class="btn btn-primary">Edit comment</a>
        <form action="/comment/{{$comment->id}}/delete" method="get">
            @csrf
            <button type="submit" class="btn btn-danger">Delete comment</button>
        </form>
      @endcan
    </div>
  </div>
@endforeach
@endsection