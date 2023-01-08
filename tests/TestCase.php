<?php

namespace Tests;

use App\Models\Course;
use App\Models\Cv;
use App\Models\Jobadvertisement;
use App\Models\Jobapplication;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Sanctum\Sanctum;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Felhasználó létrehozása a gyártófüggvény segítségével.
     * 
     * @param $args a létrehozandó felhasználó adatai.
     */
    public function createUser($args = [])
    {
        return User::factory()->create($args);
    }

    /**
     * Authentikált felhasználó létrehozása a gyártófüggvény segítségével.
     * 
     * @param $args a létrehozandó felhasználó adatai.
     */
    public function createAuthenticatedUser($args = [])
    {
        $user = $this->createUser($args);
        Sanctum::actingAs($user);
        // $this->actingAs($user, 'web');
        return $user;
    }

    /**
     * Munkaadó létrehozása a gyártófüggvény segítségével.
     * 
     * @param $args a létrehozandó munkaadó adatai.
     */
    public function createEmployer($args = ['role' => 'employer'])
    {
        return User::factory()->create($args);
    }

    /**
     * Álláskereső létrehozása a gyártófüggvény segítségével.
     * 
     * @param $args a létrehozandó álláskereső adatai.
     */
    public function createJobseeker($args = ['role' => 'jobseeker'])
    {
        return User::factory()->create($args);
    }
    /**
     * Önéletrajz létrehozása a gyártófüggvény segítségével.
     * 
     * @param $args a létrehozandó önéletrajz adatai.
     */
    public function createCv($args = [])
    {
        return Cv::factory()->create($args);
    }
    /**
     * Álláshirdetés létrehozása a gyártófüggvény segítségével.
     * 
     * @param $args a létrehozandó álláshirdetés adatai.
     */
    public function createJobadvertisement($args = [])
    {
        return Jobadvertisement::factory()->create($args);
    }
    /**
     * Jelentkezés létrehozása a gyártófüggvény segítségével.
     * 
     * @param $args a létrehozandó jelentkezés adatai.
     */
    public function createJobapplication($args = [])
    {
        return Jobapplication::factory()->create($args);
    }}
