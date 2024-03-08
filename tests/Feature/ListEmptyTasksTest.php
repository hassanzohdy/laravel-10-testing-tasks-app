<?php

namespace Tests\Feature;

use Tests\TestCase;

class ListEmptyTasksTest extends TestCase
{
    /**
     * A Test for empty tasks list
     */
    public function test_empty_tasks_list(): void
    {
        $response = $this->get('/tasks?assigned_to=UNKNOWN_USER_ID');

        $response->assertStatus(200);

        // assert the response content contains <tr id="empty-tasks-row"> string
        // and not contains <tr class="task-row"> string
        $this->assertStringContainsString('<tr id="empty-tasks-row">', $response->getContent());
        $this->assertStringNotContainsString('<tr class="task-row">', $response->getContent());
    }

    /**
     * Test empty tasks list but this time count the returned tasks from the json response
     */
    public function test_empty_tasks_list_json(): void
    {
        $response = $this->get('/tasks?assigned_to=UNKNOWN_USER_ID&json=1');

        $response->assertStatus(200);

        // decode the json response
        $json = json_decode($response->getContent(), true);

        // count the tasks
        $this->assertEquals(0, count($json['tasks']));
    }
}
