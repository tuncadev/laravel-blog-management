<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// 1. GET /api/posts — List of articles.
//
Route::get('/posts', function () {
    // Retrieve all articles
    $articles = Article::all();

    // Return as JSON
    return response()->json($articles, 200);
});

//
// 2. GET /api/posts/{id} — Detailed information about an article.
//
Route::get('/posts/{id}', function ($id) {
    // Retrieve article by ID, including related comments if desired
    $article = Article::with('comment')->findOrFail($id);


    // Return as JSON
    return response()->json($article, 200);
});

//
// 3. POST /api/posts/{id}/comments — Add a comment.
//
Route::post('/posts/{id}/comments', function (Request $request, $id) {
    // Validate incoming data
    $validatedData = $request->validate([
        'content' => 'required|string',
    ]);

    // Find the article
    $article = Article::findOrFail($id);

    // Create the comment in the database
    $comment = new Comment();
    $comment->post_id = $article->id;
    $comment->content = $validatedData['content'];
    // If you have user relationships, you might also set $comment->user_id
    $comment->save();

    // Return success message
    return response()->json([
        'message' => 'Comment added successfully.',
        'comment' => $comment
    ], 201);
});

//
// 4. POST /api/login — Authorization and obtaining an API token.
//
Route::post('/login', function (Request $request) {
    // Validate the login credentials
    $credentials = $request->validate([
        'email'    => 'required|email',
        'password' => 'required|string',
    ]);

    // Attempt to find user by email
    $user = User::where('email', $credentials['email'])->first();

    // Check the user's existence and verify the password
    if (! $user || ! Hash::check($credentials['password'], $user->password)) {
        return response()->json(['error' => 'Invalid credentials'], 401);
    }

    // In a real application, you might generate a token (e.g., via Sanctum/JWT)
    // For simplicity, let’s just store a random token on the user record
    $token = Str::random(60);
    $user->api_token = hash('sha256', $token);
    $user->save();

    // Return the token in the response
    return response()->json([
        'message' => 'Login successful',
        'token'   => $token
    ], 200);
});