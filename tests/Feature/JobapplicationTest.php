<?php

namespace Tests\Feature;

use App\Models\Cv;
use App\Models\Jobadvertisement;
use App\Models\Jobapplication;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JobapplicationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function jobapplications_create_route_works_as_expected()
    {
        // arrange
        $this->withoutExceptionHandling();
        $employer = $this->createEmployer();
        $jobadvertisement = $this->createJobadvertisement(['user_id' => $employer->id]);
        $jobseeker = $this->createAuthenticatedUser(['role' => 'jobseeker']);
        $this->createCv(['user_id' => $jobseeker->id]);
        // act
        $response = $this->get('/jobadvertisements/' . $jobadvertisement->id . '/jobapplications/create');
        // assert
        $response->assertOk();
        $response->assertViewIs('jobapplications.create');
        $response->assertSee('Jelentkezés');
    }

    /** @test */
    public function jobapplications_store_route_works_as_expected()
    {
        // arrange
        $this->withoutMiddleware();
        $jobseeker = $this->createAuthenticatedUser(['role' => 'jobseeker']);
        $jobapplication = Jobapplication::factory()->make([
            'user_id' => $jobseeker->id,
            'jobadvertisement_id' => Jobadvertisement::factory()->create()->id,
            'cv_id' => Cv::factory()->create()->id,
            'status' => 'Nincs megnézve'
        ]);
        // act
        $response = $this->post(route('jobapplications.store'), $jobapplication->toArray());
        // assert
        $response->assertRedirect();
        $this->assertCount(1, Jobapplication::where('status', $jobapplication->status)->get());
        $this->assertDatabaseHas('jobapplications', ['status' => $jobapplication->status]);
    }

    /** @test */
    public function jobapplications_destroy_route_works_as_expected()
    {
        // arrange
        $this->withoutMiddleware();
        $jobseeker = $this->createAuthenticatedUser(['role' => 'jobseeker']);
        $jobapplication = $this->createJobapplication(['user_id' => $jobseeker]);
        // act
        $response = $this->delete('jobapplications/' . $jobapplication->id);
        // assert
        $response->assertRedirect();
    }

    /** @test */
    public function jobapplications_status_route_works_as_expected()
    {
        // arrange
        $this->withoutMiddleware();
        $jobseeker = $this->createAuthenticatedUser(['role' => 'jobseeker']);
        $jobapplication = $this->createJobapplication(['user_id' => $jobseeker]);
        // act
        $response = $this->patch('jobapplications/' . $jobapplication->id . '/status', [
            'status' => 'Elfogadva.',
        ]);
        // assert
        $response->assertRedirect();
    }
}
