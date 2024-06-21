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
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
</head>
<body class="bg-yellow-100 scroll-black">
<nav class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 left-0 border-b border-gray-200 dark:border-gray-600">
<x-flash-message />
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
  <a href="/dashboard" class="flex items-center">
      <img src="images/azurebolt.png" class="h-8 mr-3" alt="">
      <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Azure Bolt™</span>
  </a>
  <div class="flex md:order-2">
    @auth
    @if (!empty($showInterestsColumns))
      <a href="/profile/ProfilePage" class="font-bold uppercase text-black  rounded-lg text-sm px-4 py-2 text-center mr-3 md:mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Welcome {{auth()->user()->first_name}}</a>
      @else
      <a href="/profile" class="font-bold uppercase text-black  rounded-lg text-sm px-4 py-2 text-center mr-3 md:mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Welcome {{auth()->user()->first_name}}</a>
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
<header>
<div class="mx-24 mt-24">

<form action="{{ route('profiles.store') }}" id="profileForm" class="{{ $profileExists ? '' : 'gone' }}"  method="GET">
        @csrf

        <div class="relative z-0 w-full mb-6 group">
        <input type="text" name="about" value="{{old('about')}}" id="floating_about" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
        <label for="floating_about" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">About</label>
        </div>
        <br>
        <div class="relative z-0 w-full mb-6 group">
        <input type="text" name="city" value="{{old('city')}}" id="floating_city" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
        <label for="floating_city" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">City</label>
        </div>
        <br>
        <div class="relative z-0 w-full mb-6 group">
        <input type="text" name="country" value="{{old('country')}}" id="floating_country" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
        <label for="floating_country" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Country</label>
        <br>
        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
        </div>
        <button class="text-white center-me bg-blue-700 hover:bg-blue-800 self-center focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="submit">Save</button>
    </form>
    @if ($user->profile)
    <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" class="profilePhoto" alt="Profile Picture">
    <h2 class="text-4xl font-bold dark:text-white text-center">{{ $user->first_name }} {{ $user->last_name }}</h2>
    <p class="text-center"><b>About:</b> {{ $user->profile->about }}</p>
    <p class="text-center"><b>City:</b> {{ $user->profile->city }}</p>
    <p class="text-center"><b>Country:</b> {{ $user->profile->country }}</p>
    @if (!empty($showInterestsColumns))
    <p class="text-center"><b>Interests:</b> {{ $showInterestsColumns }}</p>
@endif
    <div class="grid grid-cols-2 gap-1">
    <div class="text-center mx-10 flex justify-end"><b class="mr-2">Followers: </b> {{ $user->followers()->count() }}</div>
    <div class="text-center mx-10 flex justify-start"><b class="mr-2">Following: </b> {{ $user->following()->count() }}</div>
    </div>
    <a href="{{ route('profiles.edit', $profile->id) }}" class="px-4 py-2 rounded-2xl font-semibold hover:bg-yellow-400 bg-yellow-500 ">Edit Profile</a>
    <a href="{{ route('profiles.photoPage', $profile->id) }}" class=" px-4 py-2 rounded-2xl font-semibold hover:bg-yellow-400 bg-yellow-500 centerPFP"> Update Profile Photo</a>
    @if (empty($showInterestsColumns))
    <a href="#" id="openModalLink" class=" px-4 py-2 rounded-2xl font-semibold text-white hover:bg-teal-200 bg-teal-400 centerPFP">Choose your interests</a>
    @else
    <a href="/profile/UpdateInterests" class=" px-4 py-2 rounded-2xl font-semibold text-white hover:bg-teal-500 bg-teal-800 centerPFP">Update interests</a>
    @endif
    <div id="modalContainer" style="display: none; background: url('images/interests.jpg');">
      <h1 class="text-center interestsTitle w-full font-semibold">What are your interests?</h1>
      <small class="smallText w-full font-semibold">( Choose 3 interests )</small>
       <button id="closeModalButton"><i id="fontAwesomeElement" class="fa-regular fa-circle-xmark"></i></button>
       <form id="interestsForm" action="{{ route('interests.store') }}" method="POST">
       <br>
       @csrf
       <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
       <div class="grid grid-cols-4">
       <div class="col-span-1  mt-10 font-semibold">
       <input type="checkbox" name="football" value="1">
       <label for="checkbox" class="mr-2 mt-5">Football <i class="fa-regular fa-futbol"></i></label>
       </div>

      <div class="col-span-1  mt-10 font-semibold">
      <input type="checkbox" name="basketball" value="1">
      <label for="checkbox" class="mr-2 mt-5">Basketball <i class="fa-solid fa-basketball"></i></label>
      </div>

      <div class="col-span-1  mt-10 font-semibold">
      <input type="checkbox" name="volleyball" value="1">
      <label for="checkbox" class="mr-2 mt-5">Volleyball <i class="fa-solid fa-volleyball"></i></label>
      </div>

      <div class="col-span-1  mt-10 font-semibold">
      <input type="checkbox" name="table_tennis" value="1">
      <label for="checkbox" class="mr-2 mt-5">Table tennis <i class="fa-solid fa-table-tennis-paddle-ball"></i></label>
      </div>
      </div>
      <div class="grid grid-cols-4">
      <div class="col-span-1 mt-20 font-semibold">
      <input type="checkbox" name="swimming" value="1">
      <label for="checkbox" class="mr-2 mt-5">Swimming <i class="fa-solid fa-person-swimming"></i></label>
      </div>

      <div class="col-span-1 mt-20 font-semibold">
      <input type="checkbox" name="workout" value="1">
      <label for="checkbox" class="mr-2 mt-5">Working out <i class="fa-solid fa-dumbbell"></i></label>
      </div>

      <div class="col-span-1 mt-20 font-semibold">
      <input type="checkbox" name="riding" value="1">
      <label for="checkbox" class="mr-2 mt-5">Riding <i class="fa-solid fa-bicycle"></i></label>
      </div>

       <div class="col-span-1 mt-20 font-semibold">
       <input type="checkbox" name="drawing" value="1">
       <label for="checkbox" class="mr-2 mt-5">Drawing <i class="fa-solid fa-palette"></i></label>
       </div>
       </div>
      
      <div class="grid grid-cols-4">
      <div class="col-span-1 mt-20 font-semibold">
      <input type="checkbox" name="movies" value="1">
      <label for="checkbox" class="mr-2 mt-5">Movies <i class="fa-solid fa-film"></i></label>
      </div>

      <div class="col-span-1 mt-20 font-semibold">
      <input type="checkbox" name="gaming" value="1">
      <label for="checkbox" class="mr-2 mt-5">Gaming <i class="fa-solid fa-gamepad"></i></label>
      </div>

      <div class="col-span-1 mt-20 font-semibold">
      <input type="checkbox" name="travelling" value="1">
      <label for="checkbox" class="mr-2 mt-5">Travelling <i class="fa-solid fa-plane-up"></i></label>
      </div>

      <div class="col-span-1 mt-20 font-semibold">
      <input type="checkbox" name="music" value="1">
      <label for="checkbox" class="mr-2 mt-5">Music <i class="fa-solid fa-music"></i></label>
      </div>
      </div>
      <div class="grid grid-cols-4">
      <div class="col-span-1 mt-20 font-semibold">
      <input type="checkbox" name="walking" value="1">
      <label for="checkbox" class="mr-2 mt-5">Walking <i class="fa-solid fa-person-walking"></i></label>
      </div>

      <div class="col-span-1 mt-20 font-semibold">
      <input type="checkbox" name="baseball" value="1">
      <label for="checkbox" class="mr-2 mt-5">Baseball <i class="fa-solid fa-baseball-bat-ball"></i></label>
      </div>

      <div class="col-span-1 mt-20 font-semibold">
      <input type="checkbox" name="skiing" value="1">
      <label for="checkbox" class="mr-2 mt-5">Skiing <i class="fa-solid fa-person-skiing"></i></label>
      </div>

      <div class="col-span-1 mt-20 font-semibold">
      <input type="checkbox" name="bowling" value="1">
      <label for="checkbox" class="mr-2 mt-5">Bowling <i class="fa-solid fa-bowling-ball"></i></label>
      </div>
      </div>
       <div class="flex justify-center saveButton">
         <button type="submit" class="p-4 border-2 font-semibold rounded-3xl bg-green-400 hover:bg-white hover:text-black w-full">Save Interests</button>
         </div>
       </form>
     </div>
    <div class="float-right bg-yellow-500 rounded-2xl">
  <form action="{{ route('users.search') }}" method="get">
    <p class=" px-4 py-2 font-semibold">Find people: </h2>
    <input class="rounded-md" type="text" name="query" placeholder="Search" autocomplete="off" required>
    <button type="submit" class="px-3 py-2 font-semibold bg-black rounded-2xl text-white hover:bg-gray-700">Search</button>
    <div id="search-results"></div>
  </form>
</div>
@else
    <p>No profile found.</p>
    <button id="rmGone" class="p-2 bg-green-500">Enter information</button>
@endif


<div class="mx-24 mt-1">
<h2 class="text-4xl font-bold dark:text-white text-center ml-24">Posts</h2>
</div>
</div>
<div class="mx-24 ">
@foreach ($posts as $post)
<div class="post bg-blue-400 text-white space-y-4 border-yellow-700 rounded mb-3">
<div class="grid grid-cols-3 gap-1">
<p class="text-left ml-2">{{ $post->content }}</p>
<p class="text-center">{{ $post->created_at->diffForHumans() }} </p>
<div>
<form action="{{ route('posts.delete', ['id' => $post->id]) }}" method="POST">
    @method('DELETE')
    @csrf
    <button type="submit" class="DeleteBtn mx-40 p-2 bg-red-600 text-white rounded-2xl">Delete</button>
</form>
</div>
</div>
</div>
@endforeach
</div>
</header>
</body>

<script src="https://cdn.tailwindcss.com/"></script>
<script>
  if (localStorage.getItem('formSubmitted')) {
    document.getElementById('profileForm').classList.add('gone');
  }

  // Store the formSubmitted flag in localStorage after form submission
  document.getElementById('profileForm').addEventListener('submit', function() {
    localStorage.setItem('formSubmitted', true);
  });

  document.getElementById('rmGone').addEventListener('click', function() {
    document.getElementById('profileForm').classList.remove('gone');
  });

  $(document).ready(function() {
    $('button[type="submit"]').click(function(e) {
        e.preventDefault();
        var query = $('input[name="query"]').val();
        if (query !== '') {
            $.ajax({
                url: '{{ route("users.search") }}',
                type: 'GET',
                data: { query: query },
                success: function(response) {
                    $('#search-results').html(response);
                }
            });
        } else {
            $('#search-results').html('');
        }
    });
});
</script>

<script>
   const openModalLink = document.getElementById('openModalLink');
     const modalContainer = document.getElementById('modalContainer');

     openModalLink.addEventListener('click', function(event) {
       event.preventDefault();
       modalContainer.style.display = 'block';
     });

     const closeModalButton = document.getElementById('closeModalButton');

     closeModalButton.addEventListener('click', function() {
       modalContainer.style.display = 'none';
     });
     
</script>
<script>
  const fontAwesomeElement = document.getElementById('fontAwesomeElement');

  fontAwesomeElement.addEventListener('mouseover', function() {
  fontAwesomeElement.classList.remove('fa-regular');
  fontAwesomeElement.classList.add('fa-solid');
  });

  fontAwesomeElement.addEventListener('mouseout', function() {
  fontAwesomeElement.classList.remove('fa-solid');
  fontAwesomeElement.classList.add('fa-regular');
  });
</script>
</html>