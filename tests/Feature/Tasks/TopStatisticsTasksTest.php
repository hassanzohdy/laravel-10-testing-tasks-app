<?php

/**
 * Please note that this test needs the `php artisan queue:work` command to be running because 
 * the statistics are updated in the background.
 */

namespace Tests\Feature\Tasks;

use App\Models\Statistics;
use App\Models\Task;
use App\Models\User;
use Tests\Utils\ActingAsUser;
use Tests\TestCase;

class TopStatisticsTasksTest extends TestCase
{
    /**
     * Count Top Statistics Tasks
     */
    public function test_top_statistics_tasks(): void
    {
        $statistics = Statistics::top();

        // get the first one from the list
        $topUser = $statistics->first();

        // get the second one
        $secondUser = $statistics->skip(1)->first();

        // now count the difference between the first and the second user
        $remaining = $topUser->total_tasks - $secondUser->total_tasks;

        $admin = User::where('is_admin', 1)->first();

        if ($remaining > 0) {
            $lastTaskId = Task::latest()->first()->id;

            // now we need to create the remaining tasks for the second user + 1
            // then we will check if the second user is now the top user
            for ($i = 0; $i < $remaining + 1; $i++) {
                Task::create([
                    'title' => 'Task $i',
                    'description' => 'Successfully created task from test',
                    'assigned_to' => $secondUser->user_id,
                    "status" => "open",
                    'admin_id' => $admin->id,
                ]);
            }

            // now we need to count again
            $statistics = Statistics::top();

            // get the first one from the list
            $newTopUser = $statistics->first();

            // get the second one
            $newSecondUser = $statistics->skip(1)->first();

            // now we need to compare the first user id with the second user id and vice versa
            $this->assertEquals($topUser->user_id, $newSecondUser->user_id);

            $this->assertEquals($secondUser->user_id, $newTopUser->user_id);

            // now remove any created task
            Task::where('id', '>', $lastTaskId)->delete();
        } else {
            $this->assertTrue(true);
        }
    }
}
