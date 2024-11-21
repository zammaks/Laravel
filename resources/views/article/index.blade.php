@extends('layout')
@section('content')
@use ('App\Models\User', 'User')

@if (session('status'))
  <div class="alert alert-success" role="alert">
    {{ session('status') }}
  </div>
@endif

<table class="table">
  <thead>
    <tr>
      <th scope="col">Date</th>
      <th scope="col">Name</th>
      <th scope="col">Description</th>
      <th scope="col">Author</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($articles as $article)
    <tr>
      <th scope="row">{{$article->date}}</th>
      <td><a href="/article/{{$article->id}}">{{$article->name}}</a></td>
      <td>{{$article->desc}}</td>
      <!-- <td>{{ $article->user_id }}</td>  -->
      <td>{{ User::findOrFail($article->user_id)->name}}</td> 
    </tr>
    @endforeach
  </tbody>
</table>
{{$articles->links() }}
@endsection
