@extends('layout')
@section('content')
@use ('App\Models\User', 'User')
@use ('App\Models\Article', 'Article')

@if (session('status'))
  <div class="alert alert-success" role="alert">
    {{ session('status') }}
  </div>
@endif

<table class="table">
  <thead>
    <tr>
      <th scope="col">Date</th>
      <th scope="col">Article Name</th>
      <th scope="col">Name</th>
      <th scope="col">Description</th>
      <th scope="col">Author</th>
      <th scope="col">Accept/Reject</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($comments as $comment)
      <th scope="row">{{$comment->created_at}}</th>
      <!-- <th scope="row">{{$comment->article_id}} -->
      @if ($article= Article::find($comment->article_id))
        <th scope="row"><a href="/article/{{$article->id}}">{{ $article->name }}</a></th>
      @else
        <th scope="row">Article not found</th>
      @endif
      <!-- </th> -->
      <!-- <td><a href="/comment/{{$comment->id}}">{{$comment->name}}</a></td> -->
      <td>{{$comment->name}}</td>

      <td>{{$comment->desc}}</td>
      <td>{{ User::findOrFail($comment->user_id)->name}}</td>
      <td class="text-center">
        @if(!$comment->accept)
          <a href="/comment/{{$comment->id}}/accept" class="btn btn-success">Accept</a>
        @else
          <a href="/comment/{{$comment->id}}/reject" class="btn btn-warning">Reject</a>
        @endif
        </td>
    </tr>
  @endforeach
  </tbody>
</table>
{{$comments->links() }}
@endsection