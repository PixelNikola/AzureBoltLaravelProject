<?php

namespace App\Http\Controllers;

use App\Models\Interest;
use App\Models\Post;
use App\Models\Profile;
use App\Models\ProfilePicture;
use App\Models\User;
use GuzzleHttp\Psr7\Message;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function create(){
        return view('profiles.profile');
    }

    public function store(Request $request)
{
    $data = $request->validate([
        'about' => ['required'],
        'city' => ['required'],
        'country' => ['required'],
        'user_id' => 'required|exists:users,id',
    ]);

    Profile::create($data);

    return redirect()->back()->with('message', 'Profile data saved');
}
    public function showProfile()
    {
        $submitted = true;
        $user = Auth::user();
        $timestamp = $user->created_at;
        $date = Carbon::parse($timestamp);
        $year = $date->year;
        $profileExists = $user->profile ? true : false;
        $posts = Post::where('user_id', $user->id)->get();
        $profile = auth()->user()->profile;
        
        
        return view('profiles.profile', compact('user', 'posts','profile', 'submitted', 'profileExists', 'year'));
    }
   
    public function edit($id)
    {   
        $user = Auth::user();
        $profile = Profile::findOrFail($id);
        return view('profiles.edit', compact('profile', 'user'));
    }

    public function updateProfileInfo(Request $request, $id)
    {
        $profile = Profile::findOrFail($id);
        $profile->about = $request->input('about');
        $profile->city = $request->input('city');
        $profile->country = $request->input('country');
        $profile->save();
        $validatedData = $request->validate([
            'about' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
        ]);

        
        
        $profile->update($validatedData);
        $user = Auth::user();
        $profileExists = $user->profile ? true : false;
        $posts = Post::where('user_id', $user->id)->get();
        $profile = auth()->user()->profile;
    
        return view('profiles.profile', compact('user', 'posts','profile', 'profileExists'))->with('message', 'Profile data updated');
    }

    public function search(Request $request)
    {
        $user = Auth::user();
        $query = $request->input('query');
        $keywords = explode(' ', $query);

        $users = User::where(function ($queryBuilder) use ($keywords) {
        foreach ($keywords as $keyword) {
            $queryBuilder->where(function ($subQueryBuilder) use ($keyword) {
                $subQueryBuilder->where('first_name', 'LIKE', "%$keyword%")
                    ->orWhere('last_name', 'LIKE', "%$keyword%");
            });
        }
        })->get();

    $timestamp = $user->created_at;
    $date = Carbon::parse($timestamp);
    $year = $date->year;
        
        return view('profiles.search_results', compact('users', 'year'));
    }


    public function updateProfilePhoto(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if ($request->hasFile('profile_picture')) {
            // Delete the old profile picture if it exists
            if ($user->profile_picture) {
                Storage::delete('public/' . $user->profile_picture);
            }
    
            $image = $request->file('profile_picture');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public', $imageName);
            $user->profile_picture = $imageName;

            
        }
    
        $user->save();
        $profileExists = $user->profile ? true : false;
        $profile = auth()->user()->profile;
        $posts = Post::where('user_id', $user->id)->get();
        return view('profiles.profile', compact('profileExists', 'user', 'profile', 'posts'));
    }

    public function editPhoto($id)
    {   
        $user = Auth::user();
        $profile = Profile::findOrFail($id);
        return view('profiles.update_photo', compact('profile', 'user'));
    }
    
    public function deletePost($id)
{
    $post = Post::find($id);

    if ($post) {
        $post->delete();
    }
    else {
        $user = Auth::user();
        $profileExists = $user->profile ? true : false;
        $posts = Post::where('user_id', $user->id)->get();
        $profile = auth()->user()->profile;
        return view('profiles.profile', compact('user','profileExists', 'posts', 'profile'))->with('message', "Post not deleted!");
    }


    return redirect()->back();
}
public function storeInterests(Request $request)
{
    $selectedInterests = $request->input('interests');



    $selectedInterests = $request->input('interests');
    $userId = $request->input('user_id');
    
    $interest = new Interest();
    $interest->user_id = $userId;
    $interest->football = isset($request->football) ? 1 : 0;
    $interest->basketball = isset($request->basketball) ? 1 : 0;
    $interest->volleyball = isset($request->volleyball) ? 1 : 0;
    $interest->table_tennis = isset($request->table_tennis) ? 1 : 0;
    $interest->swimming = isset($request->swimming) ? 1 : 0;
    $interest->workout = isset($request->workout) ? 1 : 0;
    $interest->riding = isset($request->riding) ? 1 : 0;
    $interest->drawing = isset($request->drawing) ? 1 : 0;
    $interest->movies = isset($request->movies) ? 1 : 0;
    $interest->gaming = isset($request->gaming) ? 1 : 0;
    $interest->travelling = isset($request->travelling) ? 1 : 0;
    $interest->music = isset($request->music) ? 1 : 0;
    $interest->walking = isset($request->walking) ? 1 : 0;
    $interest->baseball = isset($request->baseball) ? 1 : 0;
    $interest->skiing = isset($request->skiing) ? 1 : 0;
    $interest->bowling = isset($request->bowling) ? 1 : 0;
    $interest->save();
    
    return redirect('/profile/ProfilePage')->with('message', 'Interests stored successfully.');
}
public function fetchInterests()
{
    $userId = auth()->id();
    $interest = Interest::where('user_id', $userId)->first();
    $user = User::find($userId);
    $interests = Interest::where('user_id', $userId)->get();
    $columnNames = Schema::getColumnListing('interests');
    $stringColumnNames = implode(', ', $columnNames);
    $showStringColumns = htmlspecialchars($stringColumnNames);
    foreach ($interests as $interest) {
        
        $interestsNames = [];
        $columnValues = [];
    
        foreach ($interest->getAttributes() as $columnName => $columnValue) {
            if ($columnValue == 1  && $columnName !== 'user_id') {
                $interestsNames[] = $columnName;
                $columnValues[] = $columnValue;
            }
        }
        $stringInterestsNames = implode(', ', $interestsNames);
        $showInterestsColumns = htmlspecialchars($stringInterestsNames);
        $profileExists = $user->profile ? true : false;
        $posts = Post::where('user_id', $user->id)->get();
        $profile = auth()->user()->profile;

    return view('profiles.profile', compact('showInterestsColumns', 'user','profileExists', 'posts', 'profile', 'interest'));

   
}
}
public function updateInterests(Request $request)
{
    $selectedInterests = $request->input('interests');
    $userId = $request->input('user_id');
    
    $interest = Interest::where('user_id', $userId)->first();
    
    if ($interest) {
        $interest->football = isset($request->football) ? 1 : 0;
        $interest->basketball = isset($request->basketball) ? 1 : 0;
        $interest->volleyball = isset($request->volleyball) ? 1 : 0;
        $interest->table_tennis = isset($request->table_tennis) ? 1 : 0;
        $interest->swimming = isset($request->swimming) ? 1 : 0;
        $interest->workout = isset($request->workout) ? 1 : 0;
        $interest->riding = isset($request->riding) ? 1 : 0;
        $interest->drawing = isset($request->drawing) ? 1 : 0;
        $interest->movies = isset($request->movies) ? 1 : 0;
        $interest->gaming = isset($request->gaming) ? 1 : 0;
        $interest->travelling = isset($request->travelling) ? 1 : 0;
        $interest->music = isset($request->music) ? 1 : 0;
        $interest->walking = isset($request->walking) ? 1 : 0;
        $interest->baseball = isset($request->baseball) ? 1 : 0;
        $interest->skiing = isset($request->skiing) ? 1 : 0;
        $interest->bowling = isset($request->bowling) ? 1 : 0;
        $interest->save();
        
        return redirect('/profile/ProfilePage')->with('message', 'Interests updated successfully.');

    }
}
function UpdateInterestsShow(){

    $userId = auth()->id();
    $interest = Interest::where('user_id', $userId)->first();
    return view('profiles.update_interests', compact('interest'));
}
}