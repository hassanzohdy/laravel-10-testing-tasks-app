<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class ListController extends Controller
{
    /**
     * List tasks.
     */
    public function index(Request $request)
    {
        // we will paginate tasks, per page will list only 10 records
        $query = Task::with('assignee')->with('administrator')->latest();

        if ($request->assigned_to) {
            $query->where('assigned_to', $request->assigned_to);
        }

        $tasks = $query->paginate(10);

        // mainly will be used for testing
        if ($request->json) {
            return response()->json([
                'tasks' => collect(($tasks->items()))->map(function ($task) {
                    return [
                        'id' => $task->id,
                        'title' => $task->title,
                        'description' => $task->description,
                        'assignee' => $task->assignee->name,
                        'administrator' => $task->administrator->name,
                    ];
                })
            ]);
        }

        return view('tasks.list', [
            'tasks' => $tasks,
        ]);
    }
}
