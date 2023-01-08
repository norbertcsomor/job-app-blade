<?php

namespace Tests\Feature;

use App\Models\Cv;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Testing\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CvTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function cvs_store_route_works_as_expected()
    {
        // arrange
        $this->withoutMiddleware();
        Storage::fake('public');
        Session::put('cv_url', 'kiindulási oldal');
        $jobseeker = $this->createAuthenticatedUser(['role' => 'jobseeker']);
        $file = File::fake()->create('cv.pdf', 2000);
        $cv = Cv::factory()->make([
            'user_id' => $jobseeker->id,
            'title' => 'Teszt Önéletrajz',
            'path' => $file
        ]);
        // act
        $response = $this->post(route('cvs.store'), $cv->toArray());
        // assert
        $response->assertRedirect();
        $this->assertCount(1, Cv::where('title', $cv->title)->get());
        $this->assertDatabaseHas('cvs', ['title' => $cv->title]);
    }

    /** @test */
    public function cvs_show_route_works_as_expected()
    {
        // arrange
        Storage::fake('public');
        $jobseeker = $this->createAuthenticatedUser(['role' => 'jobseeker']);
        $file = File::fake()->create('cv.pdf', 2000);
        Cv::create([
            'user_id' => $jobseeker->id,
            'title' => 'Teszt Önéletrajz',
            'path' => $file->store('cvs', 'public')
        ]);
        $cv = Cv::first();
        // act
        $response = $this->get('cvs/' . $cv->id);
        // assert
        $response->assertOk();
    }

    public function cvs_destroy_route_works_as_expected()
    {
        // arrange
        $this->withoutMiddleware();
        Session::put('cv_url', 'kiindulási oldal');
        Storage::fake('public');
        $jobseeker = $this->createAuthenticatedUser(['role' => 'jobseeker']);
        $file = File::fake()->create('cv.pdf', 2000);
        $cv = Cv::factory()->make([
            'user_id' => $jobseeker->id,
            'title' => 'Teszt Önéletrajz',
            'path' => $file
        ]);
        $response = $this->post(route('cvs.store'), $cv->toArray());
        $cv = Cv::first();
        // act
        $response = $this->delete('cvs/' . $cv->id);
        // assert
        $response->assertRedirect();
        $this->assertCount(0, Cv::all());
        $this->assertDatabaseMissing('cvs', ['title' => $cv->title]);
        Storage::disk('public')->assertMissing($cv->path);
    }
}
