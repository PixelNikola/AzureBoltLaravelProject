<?php

use App\Http\Controllers\ChatsController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\Profile;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('index');
});
// Show Register Form
Route::get('/register', [UserController::class, 'create']);

// Show Dashboard Page
Route::get('/dashboard', [PostController::class, 'create']);

// Show Profile Page
Route::get('/profile', [ProfileController::class, 'create'])->name('profiles.profile');

// Show Users Posts in Profile
Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile.show');

// Show Chat 
Route::get('/chat', [ChatsController::class, 'create'])->name('chat');

Route::post('/chat', [ChatsController::class, 'store'])->name('messages.store');

Route::get('/chat/receiverId', [ChatsController::class, 'displayReceiver'])->name('displayReceiver');

Route::get('/chat/receiverId', [ChatsController::class, 'displayMessages'])->name('displayMessages');

Route::get('/login', function () {
    return view('login');
});



Route::get('/dbcon.php', function () {
    return view('dbcon');
});
// Create New User in Database
Route::post('/users',[UserController::class, 'store']);

// Enter Profile Info
Route::get('/profiles', [ProfileController::class, 'store'])->name('profiles.store');

// Log Off The User
Route::post('/logout',[UserController::class, 'logout']);

// Show Login Form
Route::get('/login', [UserController::class, 'login']);

//Log In User
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

// Store Posts in Database

Route::post('/posts', [PostController::class, 'store'])->name('store.posts');

// Fetch Posts

Route::get('/dashboard', [PostController::class, 'fetchPosts']);

// Autocomplete
Route::get('/dashboard/autocompleteResults', [PostController::class, 'searchAutocomplete'])->name('search.users');

// Liking Posts
Route::post('/posts/{post}/like', [PostController::class, 'like'])->name('posts.like');

// Delete Posts
Route::delete('/profile/delete/{id}', [ProfileController::class, 'deletePost'])->name('posts.delete');

// Delete Posts 
Route::delete('/dashboard/delete/{id}', [PostController::class, 'deletePost'])->name('post.delete');

// Edit User Info
Route::get('/profiles/{id}/edit', [ProfileController::class, 'edit'])->name('profiles.edit');

// Update User Info
Route::match(['put', 'patch'], '/profiles/{id}/updated', [ProfileController::class, 'updateProfileInfo'])->name('profiles.updateProfile');

// update profile photo page
Route::get('/profiles/ProfilePage/{id}/editPhoto', [ProfileController::class, 'editPhoto'])->name('profiles.photoPage');

// Update Profile Photo
Route::match(['put', 'patch'], '/profiles/ProfilePage/{id}', [ProfileController::class, 'updateProfilePhoto'])->name('profiles.photo');

// Route for search method
Route::get('/profile/search', [ProfileController::class, 'search'])->name('users.search');

// Follow User
Route::post('/profile/{user}/follow', [UserController::class, 'follow'])->name('users.follow');

// Unfollow User 
Route::post('/profile/{user}/unfollow', [UserController::class, 'unfollow'])->name('users.unfollow');

//Show Users Based on Their Followers Count
Route::get('/dashboard', [PostController::class, 'showUsersByFollowers']);

//Save Interests
Route::post('/profile/interests', [ProfileController::class, 'storeInterests'])->name('interests.store');

//Update Interests
Route::post('/profile/interestsUpdated', [ProfileController::class, 'updateInterests'])->name('interests.update');

//Update Interests Page
Route::get('/profile/UpdateInterests',[ProfileController::class, 'UpdateInterestsShow']);

// Fetch Selected Interests
Route::get('/profile/ProfilePage', [ProfileController::class, 'fetchInterests']);

// Feedback Section View
Route::get('/feedback', function() {
    return view('emails.email');
});

// Send Feedback
Route::post('/sendFeedback', [FeedbackController::class, 'sendFeedback']);