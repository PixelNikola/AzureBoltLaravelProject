<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/custom-scrollbar.css') }}">
    <title>Azure Bolt</title>
    <link rel="icon" type="image/x-icon" href="/images/ab.png">
</head>
<body style="background: url(images/reg.jpg);">
<nav class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 left-0 border-b border-gray-200 dark:border-gray-600">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
  <a href="/" class="flex items-center">
      <img src="images/azurebolt.png" class="h-8 mr-3" alt="AzureBolt Logo">
      <span class="self-center mr-100 text-2xl font-semibold whitespace-nowrap dark:text-white">Azure Bolt™</span>
  </a>
</div>
</nav>
<br><br><br><br><br>
<h1 class="text-center text-white text-3xl font-semibold">Login</h1>
<div class=" bg-white rounded-xl login-form">
  <form class="p-4 container" method="POST" action="/users/authenticate">
  @csrf
  <div class="relative z-0 w-full mb-6 group">
      <input type="email" value="{{old('email')}}" name="email" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
      <label for="floating_email" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email address</label>
      @error('email')
  <p class="text-red-500 text-xs mt-1">{{$message}}</p>
      @enderror
  </div>
  <div class="relative z-0 w-full mb-6 group">
      <input type="password" value="{{old('password')}}" name="password" id="floating_password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
      <label for="floating_password" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
  </div>
  <div class="grid md:grid-cols-2 md:gap-6">
  <button type="submit" name="signup_submit" class="text-white bg-blue-700 hover:bg-blue-800 self-center focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Sign in</button>
  <p>Don't have an account? <a href="/register" class="text-blue-600">Register</a></p>
  </div>
  

</form>
  </div>
</body>
<script src="https://cdn.tailwindcss.com/"></script>
</html>