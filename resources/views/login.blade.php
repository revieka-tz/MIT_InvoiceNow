<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>MIT InvoiceNow</title>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col justify-between">

  <!-- Main content to ensure login form is centered -->
  <div class="flex-grow flex items-center justify-center">
      <div class="w-full max-w-xs">
          <form method="POST" action="{{ route('login.submit') }}" class="bg-white shadow-md rounded-xl px-8 pt-6 pb-8 mb-4">
              @csrf
              <!-- Logo Image -->
              <div class="flex justify-center mb-6">
                  <img class="h-8" src="https://mit.com.sg/wp-content/uploads/2024/03/mit-semiconductor-logo-blue.png" alt="Company Logo">
              </div>

              <div class="mb-4">
                  <h2 class="text-center text-xl font-semibold text-indigo-900 mb-6">Sign in to your account</h2>
                  <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                      Username
                  </label>
                  <input id="username" type="text" name="username" required autofocus
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
              </div>

              <div class="mb-6">
                  <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                      Password
                  </label>
                  <input id="password" type="password" name="password" required
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline">
              </div>

              <div class="w-full">
                  <button type="submit"
                      class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                      Sign In
                  </button>
              </div>

              @if ($errors->any())
                  <div class="mt-4 bg-red-100 text-red-700 p-3 rounded">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
          </form>
      </div>
  </div>

  <!-- Footer for Developer's Company Name -->
  <footer class= "w-full text-center text-gray-600 py-4 text-xs">
      Developed by OCG
  </footer>

</body>
</html>
