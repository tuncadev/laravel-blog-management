<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Post;
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
    $articles = Post::all();

    // Return as JSON
    return response()->json($articles, 200);
});

//
// 2. GET /api/posts/{id} — Detailed information about an article.
//
Route::get('/posts/{id}', function ($id) {
    // Retrieve article by ID, including related comments if desired
    $article = Post::with('comment')->findOrFail($id);


    // Return as JSON
    return response()->json($article, 200);
});

//
Route::middleware(['auth:sanctum'])->group( function() {

    // Protected routes


    // 3. POST /api/posts/{id}/comments — Add a comment.

    Route::post('/posts/{id}/comments', function (Request $request, $id) {
        // Validate incoming data
        $validatedData = $request->validate([
            'content' => 'required|string',
        ]);
    
        // Find the article
        $article = Post::findOrFail($id);
    
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

});



// 4. POST /api/login — Authorization and obtaining an API token.
//

Route::post('/login', function (Request $request) {
    // Validate the login credentials
    $credentials = $request->validate([
        'email'    => 'required|email',
        'password' => 'required|string',
    ]);

    // Attempt login
    if (!Auth::attempt($credentials)) {
        return response()->json(['error' => 'Invalid credentials'], 401);
    }

    // Get the authenticated user
    $user = Auth::user();

    // Generate a Sanctum token
    $token = $user->createToken('api-token')->plainTextToken;
    $user->api_token = $token;
    $user->update();
    // Return the token in the response
    return response()->json([
        'message' => 'Login successful',
        'token'   => $token,
    ], 200);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/debug', function (Request $request) {
        return response()->json([
            'user' => $request->user(),
        ]);
    });
});