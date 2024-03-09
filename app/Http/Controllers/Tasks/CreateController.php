<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tasks\TaskCreateRequest;
use App\Models\Task;
use App\Models\User;

class CreateController extends Controller
{
    /**
     * Show the form for creating a new task.
     */
    public function show()
    {
        // Assuming: Logged In User can access this request
        // Assuming: Only User with admin role can access this request

        // THIS IS AN EXTREMELY BAD PRACTICE
        // It is just used for the sake of the task purpose
        // In real world, both administrators and users should be lazy `searched` from the database
        $allUsers = User::all();

        [$admin, $users] = $allUsers->partition(fn ($user) => $user->is_admin);

        return view('tasks.create', [
            'administrators' => $admin,
            'users' => $users,
        ]);
    }

    /**
     * Store a newly created task.
     */
    public function store(TaskCreateRequest $request)
    {
        Task::create($request->validated());

        if ($request->jsonResponse) {
            return response()->json(['message' => 'Task created successfully']);
        }

        return redirect()->route('tasks.list');
    }
}
