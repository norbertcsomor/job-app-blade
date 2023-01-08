<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_should_get_contact_page()
    {
        // arrange
        // act
        $response = $this->get('/contact');
        // assert
        $response->assertOk();
        $response->assertViewIs('pages.contact');
    }

    public function test_should_get_informations_page()
    {
        // arrange
        // act
        $response = $this->get('/informations');
        // assert
        $response->assertOk();
        $response->assertViewIs('pages.informations');
    }
}
