<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function test_register_page_is_accessible()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        $response->assertSee('Register'); // Check if the word 'Register' appears on the page
    }

    public function test_user_can_register()
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        //$response->assertRedirect('/dashboard'); // Assuming registration redirects to /dashboard
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
        ]);
    }
}
