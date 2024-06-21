<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\ProfilePicture;

class UserController extends Controller
{
    //Show Register page
    public function create(){
        return view('users.register');
    }
    // Create New User
    public function store(Request $request) {
        $formFields = $request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email'],
            'password' => 'required|confirmed',
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // Handle Profile Picture
        if ($request->hasFile('profile_picture')) {
            $profilePicture = $request->file('profile_picture');
            $profilePicturePath = $profilePicture->storeAs('images', $profilePicture->getClientOriginalName(), 'public');
            $formFields['profile_picture'] = $profilePicturePath;
        }

        // Hash Password
        $formFields['password'] = bcrypt($formFields['password']);
        
        // Create User
        $user = User::create($formFields);
        
       
        // Login 

        auth()->login($user);

        return redirect('/dashboard')->with('message', 'User created and logged in');
    }

    // Logout

    public function logout(Request $request){
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out!');
    }

    // Show Login Form
    public function login(){
        return view('users.login');
    }

    //Authenticate User
    public function authenticate(Request $request){
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if(auth()->attempt($formFields)){
            $request->session()->regenerate();

            return redirect('/dashboard')->with('message', 'You have been logged in!');;
        }

        return back()->withErrors([
            'email' => 'Invalid Email'])->onlyInput('email');
    }

    public function follow(User $user)
    {
        auth()->user()->following()->attach($user->id);
        return redirect()->back()->with('message', 'You are now following '. $user->first_name);
    }

    public function unfollow(User $user)
    {
        auth()->user()->following()->detach($user->id);
        return redirect()->back()->with('message', 'You have unfollowed '. $user->first_name);
    }

     public function isFollowed(User $user)
     {
        
         return auth()->user()->following->contains($user);
     }

     public function followers(User $user)
     {
        $followersCount = $user->followers->count();
        return $followersCount;
     }

     public function following(User $user)
     {
        $followingCount = $user->following->count();
        return $followingCount;
     }

     public function showUserProfile($userId)
{
    $loggedInUser = auth()->user();
    $userBeingFollowed = User::find($userId);
   
    $isFollowing = $loggedInUser->following->contains($userBeingFollowed);

    return view('user.profile', compact('isFollowing'));
}

}   

