<?php

namespace Tests\Feature\Users;

use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * Test successful Login
     */
    public function test_successful_login(): void
    {
        $response = $this->post('/login', [
            "email" => "admin@demo.com",
            "password" => "password",
        ]);

        $response->assertStatus(302);

        // should be redirected to /tasks
        $response->assertRedirect('/tasks');
    }


    /**
     * Logged In User Can not access login page
     */
    public function test_not_allowing_logged_in_user_to_access_login_page(): void
    {
        $response = $this->post('/login', [
            "email" => "admin@demo.com",
            "password" => "password",
        ]);

        $response->assertStatus(302);

        // should be redirected to /tasks
        $response->assertRedirect('/tasks');

        // now we will try to access /login page
        $response = $this->get('/login');

        // it should response with 302
        $response->assertStatus(302);

        // assert redirect to /tasks
        $response->assertRedirect('/tasks');
    }

    /**
     * Test a user that does not exist
     */
    public function test_user_invalid_login(): void
    {
        $response = $this->post('/login', [
            "email" => "admin@demo.com",
            "password" => "INVALID_PASSWORD",
        ]);

        $response->assertStatus(302);

        // redirect back to /login
        $response->assertRedirect('/login');
    }
}
