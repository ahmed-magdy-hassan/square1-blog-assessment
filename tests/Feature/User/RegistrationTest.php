<?php

namespace Tests\Feature\User;

use Tests\TestCase;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function can_load_registration_page()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function can_create_user()
    {
        $response = $this->post('/register', [
            'name' => 'Ahmed Magdy',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }
}
