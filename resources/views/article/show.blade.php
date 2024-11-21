@extends ('layout')
@section('content')
<div class="card text-center mb-3" style="width: 80rem;">
<div class="card-header">
  <b>Author:</b>{{$user->name}}
</div>
  <div class="card-body">
    <h5 class="card-title">{{$article->name}}</h5>
    <p class="card-text">{{$article->desc}}</p>
    <div class="d-flex justify-content-center gap-3">
        <a href="/article/{{$article->id}}/edit" class="btn btn-primary">Edit article</a>
        <form action="/article/{{$article->id}}" method="post">
            @Method("DELETE")
            @csrf
            <button type="submit" class="btn btn-danger">Delete article</button>
        </form>
    </div>
  </div>
</div>
<div class="card text-bg-primary mb-3" style="max-width: 20rem;">
  <div class="card-header"></div>
  <div class="card-body">
    <h5 class="card-title">Primary card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
  </div>
</div>
@endsection