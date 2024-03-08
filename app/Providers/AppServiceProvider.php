<?php

namespace App\Providers;

use App\Jobs\TaskStatistics;
use App\Models\Task;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // It's best to add the model events here because we don't need to statically call the dispatcher from the create controller
        // why? because a task could be created another way, i.e from factory for example.

        // Create a new statistics for the user when a new task is created
        Task::created(function ($task) {
            TaskStatistics::dispatch($task->assigned_to);
        });

        // DISCLAIMER: the demanded task does not have task update or delete, but i'll cover them both here anyway
        // modify the statistics for the user when a task is updated
        Task::updated(function ($task) {
            TaskStatistics::dispatch($task->assigned_to);
            // now update the old value of the assigned_to if it is changed
            $originalAssignedTo = $task->getOriginal('assigned_to');

            if ($task->isDirty('assigned_to') && $originalAssignedTo !== $task->assigned_to) {
                TaskStatistics::dispatch($originalAssignedTo);
            }
        });

        // modify the statistics for the user when a task is deleted
        Task::deleted(function ($task) {
            TaskStatistics::dispatch($task->assigned_to);
        });
    }
}
