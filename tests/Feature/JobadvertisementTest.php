<?php

namespace Tests\Feature;

use App\Models\Jobadvertisement;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JobadvertisementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function jobadvertisements_create_route_works_as_expected()
    {
        // arrange
        $this->createAuthenticatedUser(['role' => 'employer']);
        // act
        $response = $this->get(route('jobadvertisements.create'));
        $view = $this->withViewErrors([
            'title',
            'location',
            'description'
        ])
            ->view('jobadvertisements.create');
        // assert
        $response->assertOk();
        $response->assertViewIs('jobadvertisements.create');
        $view->assertSee('Álláshirdetés létrehozása');
    }

    /** @test */
    public function jobadvertisements_store_route_works_as_expected()
    {
        // arrange
        $this->withoutMiddleware();
        $employer = $this->createAuthenticatedUser(['role' => 'employer']);
        $jobadvertisement = Jobadvertisement::factory()->make([
            'user_id' => $employer->id
        ]);
        // act
        $response = $this->post(route('jobadvertisements.store'), $jobadvertisement->toArray());
        // assert
        $response->assertRedirect();
        $this->assertCount(1, Jobadvertisement::where('user_id', $employer->id)->get());
        $this->assertDatabaseHas('jobadvertisements', ['user_id' => $employer->id]);
    }

    /** @test */
    public function jobadvertisements_edit_route_works_as_expected()
    {
        // arrange
        $employer = $this->createAuthenticatedUser(['role' => 'employer']);
        $jobadvertisement = $this->createJobadvertisement(['user_id' => $employer->id]);
        // act
        $response = $this->get('jobadvertisements/' . $jobadvertisement->id . '/edit');
        // assert
        $response->assertOk();
        $response->assertViewIs('jobadvertisements.edit');
        $response->assertSee('Álláshirdetés szerkesztése');
    }

    /** @test */
    public function jobadvertisements_update_route_works_as_expected()
    {
        // arrange
        $this->withoutMiddleware();
        $employer = $this->createAuthenticatedUser(['role' => 'employer']);
        $jobadvertisement = $this->createJobadvertisement(['user_id' => $employer->id]);
        $updatedJobadvertisement = [
            'title' => 'Új Álláshirdetés',
            'location' => 'Helyszín',
            'description' => 'Leírás',
        ];
        // act        
        $response = $this->put('jobadvertisements/' . $jobadvertisement->id, $updatedJobadvertisement);
        // assert
        $response->assertRedirect();
    }

    /** @test */
    public function jobadvertisements_destroy_route_works_as_expected()
    {
        // arrange
        $this->withoutMiddleware();
        $employer = $this->createAuthenticatedUser(['role' => 'employer']);
        $jobadvertisement = $this->createJobadvertisement(['user_id' => $employer->id]);
        // act
        $response = $this->delete('jobadvertisements/' . $jobadvertisement->id);
        // assert
        $response->assertRedirect();
    }

    /** @test */
    public function jobadvertisements_index_route_works_as_expected()
    {
        // arrange
        $employer = $this->createAuthenticatedUser(['role' => 'employer']);
        $this->createJobadvertisement(['user_id' => $employer->id]);
        // act
        $response = $this->get(route('jobadvertisements.index'));
        // assert
        $response->assertOk();
        $response->assertViewIs('jobadvertisements.index');
    }

    /** @test */
    public function jobadvertisements_show_route_works_as_expected()
    {
        // arrange
        $employer = $this->createAuthenticatedUser(['role' => 'employer']);
        $jobadvertisement = $this->createJobadvertisement(['user_id' => $employer->id]);
        // act
        $response = $this->get('jobadvertisements/' . $jobadvertisement->id);
        // assert
        $response->assertOk();
        $response->assertViewIs('jobadvertisements.show');
    }
}
