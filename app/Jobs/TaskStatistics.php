<?php

namespace App\Jobs;

use App\Models\Statistics;
use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TaskStatistics implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private int $assignedTo)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // find or create the statistics for the user
        // if not found, then create a new one
        $statistics = Statistics::firstOrNew(
            ['user_id' => $this->assignedTo],
            ['total_tasks' => 0, 'total_opened' => 0, 'total_closed' => 0]
        );

        // Count the total tasks
        $statistics->total_tasks = Task::where('assigned_to', $this->assignedTo)->count();
        // Count the total opened tasks
        $statistics->total_opened = Task::where('assigned_to', $this->assignedTo)->where('status', 'open')->count();
        // Count the total closed tasks
        $statistics->total_closed = Task::where('assigned_to', $this->assignedTo)->where('status', 'closed')->count();

        // save the statistics
        $statistics->save();
    }
}
