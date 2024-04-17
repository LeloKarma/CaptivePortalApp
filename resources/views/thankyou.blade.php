<!Doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
  <!-- Logo area and branding name -->
  <div class="bg-gray-800 py-4">
      <div class="max-w-6xl mx-auto flex items-center justify-center">
          <img src="" alt="Logo" class="h-12 mr-2">
          <span class="text-xl font-semibold text-white">SDM Wi-Fi Portal</span>
      </div>
  </div>
  
  <!-- resources/views/thankyou.blade.php -->

<div class="max-w-md mx-auto mt-8">
    <h2 class="text-2xl font-bold mb-4">Thank You for Your Payment!</h2>
    <p class="mb-4">Your Wi-Fi plan has been successfully purchased.</p>
    
    <!-- Display generated logins and instructions -->
    <p class="mb-4">Your login credentials:</p>
    <ul class="mb-4">
        <li><strong>Username:</strong> {{ $username }}</li>
        <li><strong>Password:</strong> {{ $password }}</li>
    </ul>

    <p class="mb-4">Please follow the instructions below to connect to the Wi-Fi network:</p>
    <ol class="mb-4">
        <li>Connect to the Wi-Fi network named XYZ.</li>
        <li>Enter the provided username and password when prompted.</li>
        <li>You are now connected to the internet.</li>
    </ol>

    <!-- Link to the login page -->
    <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Login
    </a>
</div>
