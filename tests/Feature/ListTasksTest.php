<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListTasksTest extends TestCase
{
    /**
     * Test the existing tasks list.
     */
    public function test_existing_tasks_list(): void
    {
        $response = $this->get('/tasks');

        $response->assertStatus(200);

        // count the table rows rendered in the html with class task-row
        // assert the response contains <tr class="task-row"> string
        $this->assertStringContainsString('<tr class="task-row">', $response->getContent());
    }

    /**
     * Test the existing tasks but this time count the returned tasks from the json response
     */
    public function test_existing_tasks_list_json(): void
    {
        $response = $this->get('/tasks?json=1');

        $response->assertStatus(200);

        // decode the json response
        $json = json_decode($response->getContent(), true);

        // count the tasks
        $this->assertEquals(10, count($json['tasks']));
    }
}
