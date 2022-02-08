<?php

namespace Tests\Feature\User;

use App\Models\User;
use Tests\TestCase;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function can_load_login_page()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function can_login_user()
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    /**
     * @test
     */
    public function cannot_login_with_invalid_password()
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'Invalid password',
        ]);

        $this->assertGuest();
    }
}
