<?php

namespace Tests\Feature\Tasks;

use App\Models\Task;
use Tests\Utils\ActingAsUser;
use Tests\TestCase;

class CreateTaskTest extends TestCase
{
    use ActingAsUser;

    /**
     * Test successful created task
     */
    public function test_successful_created_task(): void
    {
        $lastTaskId = Task::latest()->first()->id;

        $response = $this->actingAsAdmin()->post('/tasks/store', [
            'title' => 'Task $i',
            'description' => 'Successfully created task from test',
            'assigned_to' => 1,
            "status" => "open",
            'admin_id' => 1,
        ]);

        $response->assertStatus(302);

        // now remove any created task
        Task::where('id', '>', $lastTaskId)->delete();
    }

    /**
     * Test successful created task and return json
     */
    public function test_successful_created_task_json(): void
    {
        $lastTaskId = Task::latest()->first()->id;

        $response = $this->actingAsAdmin()->post('/tasks/store', [
            'title' => 'Task $i',
            'description' => 'Successfully created task from test',
            'assigned_to' => 1,
            "status" => "open",
            'admin_id' => 1,
            'jsonResponse' => true,
        ]);

        $response->assertStatus(200);

        // now remove any created task
        Task::where('id', '>', $lastTaskId)->delete();
    }

    /**
     * Test a user that does not exist
     */
    public function test_user_does_not_exist(): void
    {
        $response = $this->actingAsAdmin()->post('/tasks/store', [
            'title' => 'Task $i',
            'description' => 'Successfully created task from test',
            'assigned_to' => 1001111,
            'admin_id' => 10000,
            'jsonResponse' => true,
        ]);

        $response->assertStatus(302);

        $response->assertSessionHasErrors([
            'assigned_to' => 'The selected assigned to is invalid.',
            'admin_id' => 'The selected admin id is invalid.',
        ]);
    }
}
