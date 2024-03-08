<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tasks Statistics</title>

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
                    Tasks Statistics
                </div>
            </div>

        </h1>
        <!-- List Tasks in the table -->
        <table>
            <thead>
                <tr>
                    <th>User</th>
                    <th>Total Tasks</th>
                    <th>Opened</th>
                    <th>Closed</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($statistics as $statisticsUser)
                <tr>
                    <td>{{ $statisticsUser->user->name }}</td>
                    <td>{{ $statisticsUser->total_tasks }}</td>
                    <td>{{ $statisticsUser->total_opened }}</td>
                    <td>{{ $statisticsUser->total_closed }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>