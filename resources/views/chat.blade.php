<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Azure Bolt</title>
    <link rel="icon" type="image/x-icon" href="/images/ab.png">
    <link rel="stylesheet" href="{{ asset('assets/css/custom-scrollbar.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="{{ asset('assets/js/script.js') }}" defer></script>
</head>
<body>
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
<div class="chat-box mt-11">
  <div class="chat-messages mx-48">
    <!-- Display chat messages here -->
    <div class="message">
    @foreach ($messages as $message) 
      <div class="message-container  @if(!Auth::check() || $message->sender_id != auth()->user()->id) right-side @endif">
      <img src="{{ asset('storage/' . ($message->sender_id == auth()->user()->id ? auth()->user()->profile_picture : $user->profile_picture)) }}" class="pfphoto inline" alt="Profile Picture">
      <div class="message-content bubble inline">{{ $message->message }}</div>
      <div class="message-sender text-xs">
        @if(Auth::check() && $message->sender_id == auth()->user()->id)
      {{ auth()->user()->first_name}} 
      @else 
      {{ $first_name }}
      @endif
      </div>
      </div>
      @endforeach
    </div>
<form action="/chat" class="mt-48" id="message-form" method="POST">
    @csrf
    <input type="text" class="width-box rounded-2xl p-4 ml-24" name="message" id="message-input" placeholder="Type your message">
    <input type="text" class="gone" id="receiverIdInput" name="receiverId" value="">
    <button type="submit" class=" sendMessage ml-2 p-4 rounded-2xl bg-green-600 hover:bg-green-400 font-semibold"><i class="fa-solid fa-message"></i> Send</button>
</form>
  </div>
</div>

</body>
<script src="https://cdn.tailwindcss.com/"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  // Get the URL value
const urlParams = new URLSearchParams(window.location.search);
const receiverId = urlParams.get('receiverId');

// Set the value of the input field
document.getElementById('receiverIdInput').value = receiverId;
</script>
</html>