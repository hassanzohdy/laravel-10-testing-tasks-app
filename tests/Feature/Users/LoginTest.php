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
     * Test a user that does not exist
     */
    public function test_user_does_not_exist(): void
    {
        $response = $this->post('/login', [
            "email" => "invalid@email.com",
            "password" => "password",
        ]);

        $response->assertStatus(302);
    }
}
