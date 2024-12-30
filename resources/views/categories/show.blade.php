@extends('layouts.app')

@section('content')
 
<div class="container">
    <section id="article_{{ $category->id }}" class="post">
        <h1>{{ $category->name }}</h1>
        <div class="d-flex">
            <p>
                <span class="fw-bold">Published: </span>{{ $category->created_at }}
                @if ($category->updated_at > $category->created_at)
                    , <span class="fw-bold">Updated at: </span>{{ $category->updated_at }}
                @endif
            </p>
        </div>
    </section>
    <hr>
</div>
@endsection
