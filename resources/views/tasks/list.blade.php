<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>List Tasks</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Import tailwindcss from CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">

    <style>
        /* Make the table looks great :) */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1.5rem;
        }

        th,
        td {
            padding: 0.5rem;
            border-bottom: 1px solid #e5e7eb;
        }

        th {
            text-align: left;
            font-weight: 600;
        }

        tr:nth-child(even) {
            background-color: #f3f4f6;
        }

        tr:hover {
            background-color: #f9fafb;
        }

        th,
        td {
            padding: 0.75rem;
            border-bottom: 1px solid #e5e7eb;
        }

        /* Color the open and closed status using a badge-like color */
        /* Green badge for open */
        .open {
            background-color: #d1fae5;
            color: #065f46;
            padding: 0.25rem 0.5rem;
            border-radius: 0.5rem;
        }

        /* Red Badge For Closed */
        .closed {
            background-color: #fee2e2;
            color: #991b1b;
            padding: 0.25rem 0.5rem;
            border-radius: 0.5rem;
        }
    </style>
</head>

<body class="antialiased">

    <div class="px-10">
        <h1 class="leading-relaxed text-gray-900 mt-16">
            <div class="font-semibold text-4xl flex justify-between">
                <div>
                    Tasks List
                </div>
                <!-- Now add the create new task link -->
                <a href="{{ route('tasks.create') }}" class="bg-blue-500 text-xl hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create New Task</a>
                <!-- Now add the view statistics link -->
                <a href="{{ route('tasks.statistics') }}" class="bg-green-500 text-xl hover:bg-green-700 text-white font-bold py-2 px-4 rounded">View Statistics</a>
            </div>

        </h1>
        <!-- List Tasks in the table -->
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Assigned To</th>
                    <th>Admin</th>
                    <th>Status</th>
                    <th>Control</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                <tr class="task-row">
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ $task->assignee->name }}</td>
                    <td>{{ $task->administrator->name }}</td>
                    <td>
                        <span class="{{ $task->status }}">
                            {{ $task->status }}
                        </span>
                    </td>
                    <td>
                        <button onclick="alert('This is just a demo, no Edit available, sorry :))')">Edit</button>
                        <button onclick="alert('This is just a demo, no Delete available, sorry :))')">Delete</button>
                    </td>
                </tr>
                @endforeach

                <!-- Now check if there are no tasks, then display no tasks empty row -->
                @if ($tasks->isEmpty())
                <tr id="empty-tasks-row">
                    <td colspan="6" class="text-center py-4">No tasks available</td>
                </tr>
                @endif
            </tbody>
        </table>
        <!-- Now Display pagination links -->
        <div class="my-2">
            {{ $tasks->onEachSide(5)->links() }}
        </div>
    </div>
</body>

</html>