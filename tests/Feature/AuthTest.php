<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function login_route_works_as_expected()
    {
        // arrange
        // act
        $response = $this->get(route('login'));
        $view = $this->withViewErrors(
            [
                'email',
                'password',
            ]
        )
            ->view('users.login');
        // assert
        $response->assertOk();
        $response->assertViewIs('users.login');
        $view->assertSee('Bejelentkezés');
    }

    public function authenticate_route_works_as_expected()
    {
        // arrange
        $this->withoutMiddleware();
        $employer = $this->createAuthenticatedUser(['role' => 'employer']);
        $credentials = [
            'email' => $employer['email'],
            'password' => $employer['password'],
        ];
        // act
        $response = $this->post(route('authenticate'), $credentials);
        // assert
        $response->assertRedirect();
    }
}
