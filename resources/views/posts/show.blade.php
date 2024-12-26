@extends('layouts.app')

@section('content')
 
<div class="container">
    <article id="article_{{ $post->id }}" class="post">
        <h1>{{ $post->title }}</h1>
        <div class="d-flex">
            <p>
                <span class="fw-bold">Published: </span>{{ $post->created_at }}
                @if ($post->updated_at > $post->created_at)
                    , <span class="fw-bold">Updated at: </span>{{ $post->updated_at }}
                @endif
            </p>
        </div>
        <p>{{ $post->content }}</p>
    </article>

    <hr>

    <!-- Comments Section -->
    <div class="comments mt-4">
        <h3>Comments ({{ $post->comments->count() }})</h3>
        
        @forelse ($post->comments as $comment)
            <div class="border rounded p-3 mb-3">
                <p class="mb-1"><strong>Comment #{{ $comment->id }}</strong></p>
                <p class="mb-0">{{ $comment->content }}</p>
                <small class="text-muted">Posted at {{ $comment->created_at }}</small>
            </div>
        @empty
            <p>No comments yet.</p>
        @endforelse
    </div>

    <!-- Add Comment Form -->
    <div class="add-comment mt-4">
        <h3>Add a Comment</h3>
        
        <!-- Replace 'posts.comments.store' with your actual route name -->
        <form action="{{ route('posts.comments.store', $post->id) }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="content" class="form-label">Your Comment</label>
                <textarea 
                    name="content" 
                    id="content" 
                    rows="3" 
                    class="form-control" 
                    placeholder="Write something...">{{ old('content') }}</textarea>
                @error('content')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                Add Comment
            </button>
        </form>
    </div>
</div>
@endsection
