@extends('layouts.app')

@section('content')
<div class="container">
    <article id="article_{{$article->id}}" class="article">
        <h1>{{ $article->title }}</h1>
        <div class="d-flex"><p><span class="fw-bold">Published: </span>{{ $article->created_at }} {!! $article->updated_at > $article->created_at ? ", <span class='fw-bold'>Updated at: </span>" . $article->updated_at : "" !!}</p></div>
        <p>{{ $article->content }}</p>
    </article>

@endsection