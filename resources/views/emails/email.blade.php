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
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Kanit&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Zen+Loop&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kalam&display=swap" rel="stylesheet">
</head>
<body class="scroll-black" style="background: url(images/feedbackPicture.jpg);">
<nav class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 left-0 border-b border-gray-200 dark:border-gray-600">
<x-flash-message />
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
  <a href="/" class="flex items-center">
      <img src="images/azurebolt.png" class="h-8 mr-3" alt="AzureBolt Logo">
      <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Azure Bolt™</span>
  </a>
  </div>
</nav>

<main class="mt-24">
<div class="grid grid-cols-2">
<div class="formFeedback ml-10">
<h1 class="text-center FeedbackTitle">We want to hear from you!</h1>
<h2 class="text-center FeedbackSubtitle">Got something you want to share? An idea? A new feature? Let us know and you might just be responsible for Azure Bolt's improvement!</h2>
<form action="/sendFeedback" method="POST">
    @csrf
    <div class="input-container">
    <label for="name">Name:</label>
    <input type="text" class="p-2 feedbackLabel" name="name" placeholder="Your Name..."><br>
    <label for="email">Email:</label>
    <input type="email" class="p-2 feedbackLabel" name="email" placeholder="example@gmail.com"><br>
    <label for="subject">Subject:</label>
    <input type="text" class="p-2 feedbackLabel" name="subject" placeholder="What do you want to talk about?"><br>
    <label for="message">Write your messsage!</label>
    <textarea name="message" class="feedbackMessageBox p-2" placeholder="Type your message..."></textarea><br>
    <button type="submit" class="px-10 py-4 text-white hover:border-blue-500 hover:border-4 border-4 border-blue-900 bg-blue-500 hover:bg-blue-900 transition duration-500 ease font-semibold rounded"><i class="fa-solid fa-paper-plane"></i> Send</button>
    </div>
</form>
</div>
<div class="imgFeedback"><img class="imageFeedback" src="images/friends.jpg" alt="picture"></div>
</div>
</main>
</body>
<script src="https://cdn.tailwindcss.com/"></script>
</html>