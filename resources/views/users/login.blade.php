<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">

</head>

<body class="antialiased">
    <h1 class="text-center text-4xl font-semibold leading-relaxed text-gray-900 mt-16">Login</h1>

    <form action="{{ route('login.post') }}" method="POST" class="mt-4">
        <!-- Errors list coming from the store validation request -->
        @if ($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4" role="alert">
            <p class="font-semibold">There are errors in your form:</p>
            <ul class="mt-2 list-disc list-inside text-sm text-red-600">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @csrf
        <div class="d-block w-1/2 mx-auto mt-16 flex flex-col items-center justify-center">
            <input required type="email" name="email" id="email" class="w-1/2 h-16 px-6 mt-6 rounded-lg bg-gray-100 focus:outline-none" placeholder="Email">
            <input required type="password" name="password" id="password" class="w-1/2 h-16 px-6 mt-6 rounded-lg bg-gray-100 focus:outline-none" placeholder="Password">
            <button type="submit" class="py-2 px-6 mt-4 rounded-lg bg-red-500 text-white focus:outline-none">Login</button>
        </div>
    </form>
</body>

</html>