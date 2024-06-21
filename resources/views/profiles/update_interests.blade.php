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
<br><br>
<div id="modalContainerTwo" class="mt-4 mx-56" style=" background-color:skyblue; width:1000px;">
      <h1 class="text-center interestsTitle w-full font-semibold">Update your interests</h1>
      <small class="smallText w-full font-semibold">( Choose 3 interests )</small>
       <button id="closeModalButton"><i id="fontAwesomeElement" class="fa-regular fa-circle-xmark"></i></button>
       <form id="interestsForm" action="{{ route('interests.update') }}" method="POST">
       <br>
       @csrf
       <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
       <div class="grid grid-cols-4">
       <div class="col-span-1  mt-10 font-semibold">
       <input type="checkbox" name="football" value="1" {{ $interest->football ? 'checked' : '' }}>
       <label for="checkbox" class="mr-2 mt-5">Football <i class="fa-regular fa-futbol"></i></label>
       </div>

      <div class="col-span-1  mt-10 font-semibold">
      <input type="checkbox" name="basketball" value="1" {{ $interest->basketball ? 'checked' : '' }}>
      <label for="checkbox" class="mr-2 mt-5">Basketball <i class="fa-solid fa-basketball"></i></label>
      </div>

      <div class="col-span-1  mt-10 font-semibold">
      <input type="checkbox" name="volleyball" value="1" {{ $interest->volleyball ? 'checked' : '' }}>
      <label for="checkbox" class="mr-2 mt-5">Volleyball <i class="fa-solid fa-volleyball"></i></label>
      </div>

      <div class="col-span-1  mt-10 font-semibold">
      <input type="checkbox" name="table_tennis" value="1" {{ $interest->table_tennis ? 'checked' : '' }}>
      <label for="checkbox" class="mr-2 mt-5">Table tennis <i class="fa-solid fa-table-tennis-paddle-ball"></i></label>
      </div>
      </div>
      <div class="grid grid-cols-4">
      <div class="col-span-1 mt-20 font-semibold">
      <input type="checkbox" name="swimming" value="1" {{ $interest->swimming ? 'checked' : '' }}>
      <label for="checkbox" class="mr-2 mt-5">Swimming <i class="fa-solid fa-person-swimming"></i></label>
      </div>

      <div class="col-span-1 mt-20 font-semibold">
      <input type="checkbox" name="workout" value="1" {{ $interest->workout ? 'checked' : '' }}>
      <label for="checkbox" class="mr-2 mt-5">Working out <i class="fa-solid fa-dumbbell"></i></label>
      </div>

      <div class="col-span-1 mt-20 font-semibold">
      <input type="checkbox" name="riding" value="1" {{ $interest->riding ? 'checked' : '' }}>
      <label for="checkbox" class="mr-2 mt-5">Riding <i class="fa-solid fa-bicycle"></i></label>
      </div>

       <div class="col-span-1 mt-20 font-semibold">
       <input type="checkbox" name="drawing" value="1" {{ $interest->drawing ? 'checked' : '' }}>
       <label for="checkbox" class="mr-2 mt-5">Drawing <i class="fa-solid fa-palette"></i></label>
       </div>
       </div>
      
      <div class="grid grid-cols-4">
      <div class="col-span-1 mt-20 font-semibold">
      <input type="checkbox" name="movies" value="1" {{ $interest->movies ? 'checked' : '' }}>
      <label for="checkbox" class="mr-2 mt-5">Movies <i class="fa-solid fa-film"></i></label>
      </div>

      <div class="col-span-1 mt-20 font-semibold">
      <input type="checkbox" name="gaming" value="1" {{ $interest->gaming ? 'checked' : '' }}>
      <label for="checkbox" class="mr-2 mt-5">Gaming <i class="fa-solid fa-gamepad"></i></label>
      </div>

      <div class="col-span-1 mt-20 font-semibold">
      <input type="checkbox" name="travelling" value="1" {{ $interest->travelling ? 'checked' : '' }}>
      <label for="checkbox" class="mr-2 mt-5">Travelling <i class="fa-solid fa-plane-up"></i></label>
      </div>

      <div class="col-span-1 mt-20 font-semibold">
      <input type="checkbox" name="music" value="1" {{ $interest->music ? 'checked' : '' }}>
      <label for="checkbox" class="mr-2 mt-5">Music <i class="fa-solid fa-music"></i></label>
      </div>
      </div>
      <div class="grid grid-cols-4">
      <div class="col-span-1 mt-20 font-semibold">
      <input type="checkbox" name="walking" value="1" {{ $interest->walking ? 'checked' : '' }}>
      <label for="checkbox" class="mr-2 mt-5">Walking <i class="fa-solid fa-person-walking"></i></label>
      </div>

      <div class="col-span-1 mt-20 font-semibold">
      <input type="checkbox" name="baseball" value="1" {{ $interest->baseball ? 'checked' : '' }}>
      <label for="checkbox" class="mr-2 mt-5">Baseball <i class="fa-solid fa-baseball-bat-ball"></i></label>
      </div>

      <div class="col-span-1 mt-20 font-semibold">
      <input type="checkbox" name="skiing" value="1" {{ $interest->skiing ? 'checked' : '' }}>
      <label for="checkbox" class="mr-2 mt-5">Skiing <i class="fa-solid fa-person-skiing"></i></label>
      </div>

      <div class="col-span-1 mt-20 font-semibold">
      <input type="checkbox" name="bowling" value="1" {{ $interest->bowling ? 'checked' : '' }}>
      <label for="checkbox" class="mr-2 mt-5">Bowling <i class="fa-solid fa-bowling-ball"></i></label>
      </div>
      </div>
       <div class="flex justify-center saveButton">
         <button type="submit" class="p-4 border-2 font-semibold rounded-3xl bg-green-400 hover:bg-white hover:text-black w-full">Save Interests</button>
         </div>
       </form>
     </div>
</body>
</html>