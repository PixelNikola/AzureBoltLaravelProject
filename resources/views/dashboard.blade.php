<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <script src="//unpkg.com/alpinejs" defer></script>
    <title>Azure Bolt</title>
    <link rel="icon" type="image/x-icon" href="/images/ab.png">
    <link rel="stylesheet" href="{{ asset('assets/css/custom-scrollbar.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="{{ asset('assets/js/script.js') }}" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Taviraj:wght@500&family=Wellfleet&display=swap" rel="stylesheet">
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/lightbox.min.css') }}">
    <script src="{{ asset('assets/js/lightbox.min.js') }}"></script>
</head>
<body class="bg-blue-200 scroll-black">
<nav class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 left-0 border-b border-gray-200 dark:border-gray-600">
<x-flash-message />
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
  <a href="/" class="flex items-center">
      <img src="images/azurebolt.png" class="h-8 mr-3" alt="AzureBolt Logo">
      <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Azure Bolt™</span>
  </a>
  <div class="flex md:order-2">
    @auth
      <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" class="pfphoto" alt="Profile Picture">
      @if(DB::table('profiles')->where('user_id', auth()->user()->id)->exists())
    <a href="/profile/ProfilePage" class="font-bold uppercase text-black rounded-lg text-sm px-4 py-2 text-center mr-3 md:mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Welcome {{ auth()->user()->first_name }}</a>
@else
    <a href="/profile" class="font-bold uppercase text-black rounded-lg text-sm px-4 py-2 text-center mr-3 md:mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Welcome {{ auth()->user()->first_name }}</a>
@endif
      <ul>
        <li>
            <form action="/logout" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center mr-3 md:mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" method="post">
                @csrf
                <button class="font-bold" type="submit">
                    <i class="fa-solid fa-door-closed"></i> Logout
                </button>
            </form>
        </li>
      </ul>
    @else
      <a href="/register" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center mr-3 md:mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><i class="fa-solid fa-user-plus px-2"></i>Sign up</a>
      <a href="/login" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><i class="fa-solid fa-arrow-right-to-bracket"></i> Login</a>
      @endauth
  </div>
  </div>
</nav>

<main>

   <section class="">
        <div class="flex justify-center items-start mt-6">
        <form action="{{ route('store.posts') }}" class="w-1/2 bg-blue-400 p-6 mt-10 rounded-lg" enctype="multipart/form-data" method="post">
            @csrf
            <textarea name="content" id="content" style="width: 719px; height: 200px; resize: none;" placeholder="What's happening?" required></textarea><br>
            <input type="file" name="image" class="inline w-full text-white text-sm file:text-sm file:rounded file:px-2 file:py-2 file:border-0 file:font-semibold file:text-white file:bg-indigo-600 hover:file:bg-indigo-700 hover:file:cursor-pointer" id="image" accept=".jpeg, .jpg, .png" multiple>
            <button type="submit" class="px-2 inline  py-2 text-white font-semibold bg-indigo-600 hover:bg-indigo-700 float-right justify-end w-24 rounded">Post</button>
         
        </form>
        </div>
   </section>
   <section class=" float-left mx-10 p-6 bg-amber-400  popularUsers rounded-3xl">
    <div class="title-Popularity">
        <h2 class="font-semibold text-white text-center">Users you might want to follow!</h2>
        <hr>
        <br>
        @php
            $userCount = 0;
        @endphp
        @foreach ($users as $user)
            @if ($user->id !== auth()->user()->id && $userCount < 4)
                <div class="grid grid-cols-3 mb-2"> 
                    <div class="col-span-1 pfpPhoto">
                        <img src="{{ asset('storage/' . $user->profile_picture) }}" class="pfphoto inline" alt="Profile Picture">
                        <p class="text-white mr-12"></p>
                    </div>
                    <div class="col-span-1 basicInfo -ml-10 mt-1 font-semibold">
                        <p>{{ $user->first_name }} {{ $user->last_name}}</p>
                    </div>
                    <div class="col-span-1">
                        <div class="flex-end mt-0 space-x-3">
                            @php
                                $isFollowing = auth()->user()->following->contains($user);
                            @endphp
                            @if($isFollowing)
                                <form action="{{ route('users.unfollow', $user) }}" class="inline-flex items-center px-4 py-2 text-sm hover:text-black font-medium text-center text-white bg-red-600 rounded-2xl hover:bg-white focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" method="POST">
                                    @csrf
                                    <button type="submit">Unfollow</button>
                                </form>
                            @else
                                <form action="{{ route('users.follow', $user) }}" class="inline-flex items-center px-4 py-2 text-sm hover:text-black font-medium text-center text-white bg-blue-600 rounded-2xl hover:bg-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" method="POST">
                                    @csrf
                                    <button type="submit">Follow</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
                @php
                    $userCount++;
                @endphp
            @endif
        @endforeach
    </div>
</section>
<section class="float-right bg-amber-400  searchBar rounded-3xl">
<div>
  <form action="{{ route('users.search') }}" method="get">
    <p class=" px-4 py-2 font-semibold">Find people: </h2>
    <input class="rounded-md" type="text" id="search" name="query" placeholder="Search" required>
    <button type="submit" class="px-3 py-2 font-semibold bg-black hover:bg-white rounded-2xl text-white hover:text-black">Search</button>
    <div id="search-results"></div>
  </form>
</div>
</section>
<div class="container">
       <div class="post-container mr-32" style="margin-left: 280px;">
           @foreach ($posts as $post)
           
               <div class="post ml-24 fix bg-blue-400 p-6 mt-10 rounded-lg text-white">
                   <div class="grid grid-cols-1 gap-1">
                       <p class="font-semibold text-left inline">
                           <img src="{{ asset('storage/' . $post->user->profile_picture) }}" class="pfphoto inline" alt="Profile Picture">
                           {{ $post->content }}
                       </p>
                       @if ($post->image)
                           <a href="{{ asset('storage/images/' . $post->image) }}" data-lightbox="roadtrip">
                               <img src="{{ asset('storage/images/' . $post->image) }}" id="imgSize" alt="Post Image">
                           </a>
                       @endif
                       <form class="ml-12" action="{{ route('posts.like', $post) }}" method="POST">
                           @csrf
                           <button id="likeButton" class="float-right top-5" type="submit">
                               <i id="likeIcon" class="fa-regular fa-heart top-5"></i>
                           </button>
                       </form>
                   </div>
                   <p class="float-right">{{ $post->likes }}</p>
                   <small class="text-semibold text-black">Posted by: {{ $post->user->first_name }}</small>
                   <small class="text-semibold text-black">{{ $post->created_at->diffForHumans() }}</small>
                   @if(Auth::check() && $post->user_id == Auth::user()->id)   
                   <form action="{{ route('post.delete', ['id' => $post->id]) }}" method="POST">
                   @method('DELETE')
                   @csrf
                   <button type="submit" class="float-right top-5">
                   <i class="fa-solid fa-trash-can"></i>
                   </button>
                   </form>
                   @endif
        </div>     
           @endforeach
            @if ($noPosts)
       <div class="noPosts">
           <h2 class="font-bold text white">No posts to show. Find people to follow!</h2><br>
       </div>
            @endif
        </div>
   </div>
</main>
</body>
<script src="https://cdn.tailwindcss.com/"></script>
<script>
  $(document).ready(function() {
    var searchInput = $('#search');
    var searchResults = $('#search-results');

    searchInput.keyup(function() {
      var query = $(this).val();

      $.ajax({
        url: "{{ route('search.users') }}",
        method: 'GET',
        data: { query: query },
        dataType: 'json',
        success: function(response) {
          var results = response.results;
          var html = '';

          $.each(results, function(index, result) {
            html += '<div class="result text-center">' + result.first_name + ' ' + result.last_name + '</div>';
          });

          searchResults.html(html);
          searchResults.show();
        }
      });
    });

    searchResults.on('click', '.result', function() {
      var selectedResult = $(this).text();
      searchInput.val(selectedResult);
      searchResults.hide();
    });

    $(document).click(function(event) {
      if (!searchInput.is(event.target) && !searchResults.is(event.target) && searchResults.has(event.target).length === 0) {
        searchResults.hide();
      }
    });
  });
</script>
</html>