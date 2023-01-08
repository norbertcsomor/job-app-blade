<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmployerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function employers_create_route_works_as_expected()
    {
        // arrange
        // act
        $response = $this->get(route('employers.create'));
        $view = $this->withViewErrors(
            [
                'name',
                'address',
                'telephone',
                'email',
                'password',
                'password_confirmation',
                'accept1',
                'accept2'
            ]
        )
            ->view('employers.create');
        // assert
        $response->assertOk();
        $response->assertViewIs('employers.create');
        $view->assertSee('Munkaadó létrehozása');
    }

    /** @test */
    public function employers_store_route_works_as_expected()
    {
        // arrange
        $this->withoutMiddleware();
        $employer = User::factory()->make([
            'password_confirmation' => '123123123123',
            'accept1' => true,
            'accept2' => true
        ]);
        // act
        $response = $this->post(route('employers.store'), $employer->toArray());
        // assert
        $response->assertRedirect();
        $this->assertCount(1, User::where('email', $employer->email)->get());
        $this->assertDatabaseHas('users', ['email' => $employer->email]);
    }

    /** @test */
    public function employers_edit_route_works_as_expected()
    {
        // arrange
        $employer = $this->createAuthenticatedUser(['role' => 'employer']);
        // act
        $response = $this->get('employers/' . $employer->id . '/edit');
        // assert
        $response->assertOk();
        $response->assertViewIs('employers.edit');
        $response->assertSee('Munkaadó szerkesztése');
    }

    /** @test */
    public function employers_update_route_works_as_expected()
    {
        // arrange
        $this->withoutMiddleware();
        $employer = $this->createAuthenticatedUser(['role' => 'employer']);
        // act
        $response = $this->put('employers/' . $employer->id, [
            'name' => 'Új Munkaadó',
            'address' => 'Cím',
            'telephone' => '+36-00-123-456',
        ]);
        // assert
        $response->assertRedirect();
    }

    /** @test */
    public function employers_destroy_route_works_as_expected()
    {
        // arrange        
        $this->withoutMiddleware();
        $employer = $this->createAuthenticatedUser(['role' => 'employer']);
        // act
        $response = $this->delete('employers/' . $employer->id);
        // assert
        $response->assertRedirect();
    }

    /** @test */
    public function employers_index_route_works_as_expected()
    {
        // arrange
        $this->createAuthenticatedUser(['role' => 'employer']);
        // act
        $response = $this->get(route('employers.index'));
        // assert
        $response->assertOk();
        $response->assertViewIs('employers.index');
    }

    /** @test */
    public function employers_jobadvertisements_route_works_as_expected()
    {
        // arrange
        $employer = $this->createAuthenticatedUser(['role' => 'employer']);
        $this->createJobadvertisement(['user_id' => $employer->id]);
        // act
        $response = $this->get(route('employers.jobadvertisements'));
        // assert
        $response->assertOk();
        $response->assertViewIs('employers.jobadvertisements');
    }
}
