<?php

namespace Tests\Feature\Users;

use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    /**
     * Test Admin user login
     */
    public function test_admin_user_can_create_task(): void
    {
        // first off, we will login as an admin
        // then we will try to access /tasks/create page
        // it should not be redirected

        $response = $this->post('/login', [
            "email" => "admin@demo.com",
            "password" => "password",
        ]);

        $response->assertStatus(302);

        // assert redirect to /tasks
        $response->assertRedirect('/tasks');

        // now we will try to access /tasks/create page
        $response = $this->get('/tasks/create');

        // it should response with 200
        $response->assertStatus(200);
    }

    /**
     * Test Normal user can not create task
     */
    public function test_normal_user_can_not_create_task(): void
    {
        // first off, we will login as a normal user
        // then we will try to access /tasks/create page
        // it should be redirected

        $response = $this->post('/login', [
            "email" => "user@demo.com",
            "password" => "password",
        ]);

        $response->assertStatus(302);

        // assert redirect to /tasks
        $response->assertRedirect('/tasks');

        // now we will try to access /tasks/create page
        $response = $this->get('/tasks/create');

        // it should response with 302
        $response->assertStatus(302);
    }
}
