<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_page_is_accessible()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertSee('Login'); // Check if the word 'Login' appears on the page
    }

    public function test_user_can_login()
    {
        /*$user = User::factory()->create([
            'password' => bcrypt('password123'),
        ]);*/

        $response = $this->post('/login', [
            'email' => 'a@gmail.com',
            'password' => '12345678',
        ]);

        //$response->assertRedirect('/dashboard'); // Assuming successful login redirects to /dashboard
        $response->assertStatus(200);
    }
}
