@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Latest Articles</h1>

    @if ($articles->count())
        <form action="{{ route('homepage') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search articles..." value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </form>

        <div class="row">
            @foreach ($articles as $article)
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $article->title }}</h5>
                            <p class="card-text">
                                {{ Str::limit($article->content, 100) }} <!-- Limit content preview -->
                            </p>
                            <p class="card-text">
                                <small class="text-muted">Category: {{ $article->category->name ?? 'Uncategorized' }}</small>
                            </p>
                            <a href="{{ route('articles.show', $article)  }}" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $articles->links() }}
        </div>
    @else
        <p>No articles available.</p>
    @endif
</div>
@endsection
