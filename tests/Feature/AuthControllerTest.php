<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test user login with valid credentials.
     *
     * @return void
     */
    public function test_user_can_login_with_valid_credentials()
    {
        $user = User::create([
            'name' => 'jr user',
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $response = $this->post('/api/auth/login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['access_token', 'token_type', 'expires_in']);
    }

    /**
     * Test user cannot login with invalid credentials.
     *
     * @return void
     */
    public function test_user_cannot_login_with_invalid_credentials()
    {
        $response = $this->post('/api/auth/login', [
            'email' => 'nonexistent@example.com',
            'password' => 'invalidpassword',
        ]);

        $response->assertStatus(401);
        $response->assertJson(['error' => 'Unauthorized']);
    }

    /**
     * Test user can access their own profile with a valid token.
     *
     * @return void
     */
    public function test_user_can_access_own_profile()
    {
        $user = User::create([
            'name' => 'jr user',
            'email' => 'test@example.com',
            'password' => 'password',
        ]);
        
        $response = $this->actingAs($user)->post('/api/auth/me');

        $response->assertStatus(200);
        $response->assertJson(['email' => $user->email]);
    }
}
