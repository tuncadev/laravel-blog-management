@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Latest Posts</h1>

    @if ($posts->count())
        <form action="{{ route('homepage') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search posts..." value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </form>

        <div class="row">
            @foreach ($posts as $post)
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">
                                {{ Str::limit($post->content, 100) }} <!-- Limit content preview -->
                            </p>
                            <p class="card-text">
                                <small class="text-muted">Category: {{ $post->category->name ?? 'Uncategorized' }}</small>
                            </p>
                            <a href="{{ route('posts.show', $post)  }}" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $posts->links() }}
        </div>
    @else
        <p>No posts available.</p>
    @endif
</div>
@endsection
