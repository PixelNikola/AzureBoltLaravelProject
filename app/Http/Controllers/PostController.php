<?php

namespace App\Http\Controllers;

use App\Models\Interest;
use App\Models\Post;
use App\Models\Like;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function create(){
        return view('dashboard');
    }

    public function store(Request $request){
        
        $post = new Post();
        $post->user_id = auth()->user()->id;
        $post->content = $request->input('content');
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images', $filename);
            
            $post->image = $filename;
        }
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg|max:5120',
        ]);
    
        $post->save();

        return redirect()->back()->with('message', 'Post created successfully!');
    }
    public function fetchPosts()
{
    $user = auth()->user();
    $followingUserIds = $user->following()->pluck('users.id')->toArray();
    $followingUserIds[] = $user->id; 

    $posts = Post::whereIn('user_id', $followingUserIds)
    ->orderBy('created_at', 'desc')
    ->get();
    $noPosts = $posts->isEmpty();
    $userId = auth()->id();
    $interestExists = Interest::where('user_id', $userId)->exists();
    return view('dashboard', compact('posts', 'noPosts','interestExists'));
}

    public function like(Request $request, Post $post)
{
   // Checking if the user has already liked the post
   $user = $request->user();
   if ($post->likes()->where('user_id', $user->id)->exists()) {
       // If user has already liked the post
       return redirect()->back()->with('message', 'You have already liked this post.');
   }

   // Create a new like for the post
   $like = new Like();
   $like->user_id = $user->id;
   $like->post_id = $post->id;
   $like->save();

   $post->increment('likes');

   return redirect()->back()->with('message', 'Post liked successfully.');
}

public function showUsersByFollowers()
{
    $users = User::withCount('followers')
        ->orderBy('followers_count', 'desc')
        ->get();
        $user = auth()->user();
        $followingUserIds = $user->following()->pluck('users.id')->toArray();
        $followingUserIds[] = $user->id; 
    $posts = Post::whereIn('user_id', $followingUserIds)
    ->orderBy('created_at', 'desc')
    ->get();
    $noPosts = $posts->isEmpty();
    
       
    return view('dashboard', compact('users', 'posts', 'noPosts'));
}

public function deletePost($id){
    $post = Post::find($id);

    if ($post) {
        $post->delete();
    }

    return redirect()->back()->with('message', 'Post deleted');
}

public function searchAutocomplete(Request $request)
{
    $query = $request->input('query');
    $users = User::where('first_name', 'LIKE', "%$query%")
        ->orWhere('last_name', 'LIKE', "%$query%")
        ->get(['first_name', 'last_name']);

    return response()->json(['results' => $users]);
}
}
