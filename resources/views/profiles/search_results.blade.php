
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
</head>
<body class="bg-blue-200 scroll-black">
<nav class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 left-0 border-b border-gray-200 dark:border-gray-600">
<x-flash-message />
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
  <a href="/dashboard" class="flex items-center">
      <img src="images/azurebolt.png" class="h-8 mr-3" alt="">
      <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Azure Bolt™</span>
  </a>
  <div class="flex md:order-2">
    @auth
      <a href="/profile" class="font-bold uppercase text-black  rounded-lg text-sm px-4 py-2 text-center mr-3 md:mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Welcome {{auth()->user()->first_name}}</a>
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
<br> 
@foreach ($users as $user)  
<div class="bor-left w-full max-w-sm bg-white border border-gray-200 rounded-lg mt-48 shadow dark:bg-gray-800 dark:border-gray-700">
    <div class="flex justify-center px-4 pt-4"> 
    <div class="flex flex-col items-center pb-10">
        <img src="{{ asset('storage/' . $user->profile_picture) }}" class="pfphoto" alt="Profile Picture">
        <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ $user->first_name }} {{ $user->last_name }}</h5>
        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $user->profile->about }}</span>
        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $user->profile->city }}</span>
        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $user->profile->country }}</span>
        <span class="text-sm text-gray-500 dark:text-gray-400">Joined: {{ $year }}</span>
        <div class="flex-end mt-4 space-x-3 md:mt-6">
        @php
        $isFollowing = auth()->user()->following->contains($user);
        @endphp
        @if($isFollowing)
    <form action="{{ route('users.unfollow', $user) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" method="POST">
        @csrf
        <button type="submit">Unfollow</button>
    </form>
@else
    <form action="{{ route('users.follow', $user) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" method="POST">
        @csrf
        <button type="submit">Follow</button>
    </form>
@endif
            <a href="{{ route('chat', ['receiverId' => $user->id]) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center bg-black border border-gray-300 rounded-lg hover:bg-gray-500 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-800 text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-700">Message</a>
        </div>
    </div>
</div>
</div>
@endforeach
</body>
<script src="https://cdn.tailwindcss.com/"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</html>