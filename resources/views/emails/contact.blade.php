<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/custom-scrollbar.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Kanit&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body style="background-color:#d2effa;">
<img src="{{ $message->embed(public_path('images/AzureBoltLogo.png')) }}" style="width: 600px; height: auto; display:block; margin-left:auto; margin-right:auto;" alt="picture">
<div style="text-align: center;">
<h1 style="font-weight: bold; font-family:'Anton', sans-serif; font-family:'Kanit', sans-serif; padding:10px; background-color:#2e96ff">Feedback from {{ $formData['name'] }}</h1>
<h2 style="font-weight: bold; font-family:'Anton', sans-serif; font-family:'Kanit', sans-serif; padding:10px; background-color:#2ec7ff;">Email:</h2>
<p style="font-weight: bold;">{{ $formData['email'] }}</p>
<h2 style="font-weight: bold; font-family:'Anton', sans-serif; font-family:'Kanit', sans-serif; padding:10px; background-color:#2ec7ff;">Subject:</h2>
<p style="font-weight: bold; ">{{ $formData['subject'] }}</p>
<h2 style="font-weight: bold; font-family:'Anton', sans-serif; font-family:'Kanit', sans-serif; padding:10px; background-color:#2ec7ff;">Message:</h2>
<p style="font-weight: bold;">{{ $formData['message'] }}</p>
</div>
</body>
</html>