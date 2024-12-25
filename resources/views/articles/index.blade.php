@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Articles</h1>
    <a href="{{ route('articles.create') }}" class="btn btn-primary mb-3">Create Article</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form action="{{ route('articles.index') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search articles..." value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articles as $article)
            <tr>
                <td>{{ $article->id }}</td>
                <td>{{ $article->title }}</td>
                <td>{{ $article->category->name ?? 'Uncategorized' }}</td>
                @auth
                    <td>
                        <a href="{{ route('articles.edit', $article) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('articles.destroy', $article) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                @else
                    <td>
                        <a class="btn btn-warning btn-sm" href="{{ route('login') }}">Login for actions</a>
                    </td>
                @endauth
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="mt-4">
    {{ $articles->links() }}
</div>
@endsection
