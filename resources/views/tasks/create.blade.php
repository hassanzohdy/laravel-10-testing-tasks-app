<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Create A New Task</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">

</head>

<body class="antialiased">
    <h1 class="text-center text-4xl font-semibold leading-relaxed text-gray-900 mt-16">Create a new task</h1>

    <form action="{{ route('tasks.store') }}" method="POST" class="mt-4">
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
            <input required type="text" name="title" id="title" class="w-1/2 h-16 px-6 mt-6 rounded-lg bg-gray-100 focus:outline-none" placeholder="Task title">
            <textarea name="description" id="description" class="w-1/2 h-16 px-6 pt-5 mt-6 ml-4 rounded-lg bg-gray-100 focus:outline-none" placeholder="Task description"></textarea>
            <select required name="assigned_to" id="assigned_to" class="w-1/2 h-16 px-6 mt-6 ml-4 rounded-lg bg-gray-100 focus:outline-none">
                <option value="">Assign to</option>
                @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            <select required name="admin_id" id="admin" class="w-1/2 h-16 px-6 mt-6 ml-4 rounded-lg bg-gray-100 focus:outline-none">
                <option value="">Admin</option>
                @foreach($administrators as $admin)
                <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                @endforeach
            </select>
            <select name="status" id="status" class="w-1/2 h-16 px-6 mt-6 ml-4 rounded-lg bg-gray-100 focus:outline-none">
                <option value="">Status</option>
                <option value="open">Open</option>
                <option value="closed">Closed</option>
            </select>
            <button type="submit" class="py-2 px-6 mt-4 rounded-lg bg-red-500 text-white focus:outline-none">Create</button>
        </div>
    </form>
</body>

</html>