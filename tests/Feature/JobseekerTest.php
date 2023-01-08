<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JobseekerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function jobseekers_create_route_works_as_expected()
    {
        // arrange
        // act
        $response = $this->get(route('jobseekers.create'));
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
            ->view('jobseekers.create');
        // assert
        $response->assertOk();
        $response->assertViewIs('jobseekers.create');
        $view->assertSee('Álláskereső létrehozása');
    }

    /** @test */
    public function jobseekers_store_route_works_as_expected()
    {
        // arrange
        $this->withoutMiddleware();
        $jobseeker = User::factory()->make([
            'password_confirmation' => '123123123123',
            'accept1' => true,
            'accept2' => true
        ]);
        // act
        $response = $this->post(route('jobseekers.store'), $jobseeker->toArray());
        // assert
        $response->assertRedirect();
        $this->assertCount(1, User::where('email', $jobseeker->email)->get());
        $this->assertDatabaseHas('users', ['email' => $jobseeker->email]);
    }

    /** @test */
    public function jobseekers_edit_route_works_as_expected()
    {
        // arrange
        $jobseeker = $this->createAuthenticatedUser(['role' => 'jobseeker']);
        // act
        $response = $this->get('jobseekers/' . $jobseeker->id . '/edit');
        // assert
        $response->assertOk();
        $response->assertViewIs('jobseekers.edit');
        $response->assertSee('Álláskereső szerkesztése');
    }

    /** @test */
    public function jobseekers_update_route_works_as_expected()
    {
        // arrange
        $this->withoutMiddleware();
        $jobseeker = $this->createAuthenticatedUser(['role' => 'jobseeker']);
        $updatedJobseeker = [
            'name' => 'Új Álláskereső',
            'address' => 'Cím',
            'telephone' => '+36-00-123-456',
        ];
        // act        
        $response = $this->put('jobseekers/' . $jobseeker->id, compact('updatedJobseeker'));
        // assert
        $response->assertRedirect();
    }

    /** @test */
    public function jobseekers_destroy_route_works_as_expected()
    {
        // arrange
        $this->withoutMiddleware();
        $jobseeker = $this->createAuthenticatedUser(['role' => 'jobseeker']);
        // act
        $response = $this->delete('jobseekers/' . $jobseeker->id);
        // assert
        $response->assertRedirect();
    }

    /** @test */
    public function jobseekers_index_route_works_as_expected()
    {
        // arrange
        $this->createAuthenticatedUser(['role' => 'jobseeker']);
        // act
        $response = $this->get(route('jobseekers.index'));
        // assert
        $response->assertOk();
        $response->assertViewIs('jobseekers.index');
    }

    /** @test */
    public function jobseekers_jobapplications_route_works_as_expected()
    {
        // arrange
        $jobseeker = $this->createAuthenticatedUser(['role' => 'jobseeker']);
        $this->createJobadvertisement(['user_id' => $jobseeker->id]);
        // act        
        $response = $this->get(route('jobseekers.jobapplications'));
        // assert
        $response->assertOk();
        $response->assertViewIs('jobseekers.jobapplications');
    }
}
