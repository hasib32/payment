<?php

namespace Tests\Feature;

use Tests\TestCase;

class EndpointsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testHomePage()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testPaymentPage()
    {
        $response = $this->get('/payment');

        $response->assertStatus(400);
    }

    public function testCompanyPage()
    {
        $response = $this->get('/company');

        $response->assertStatus(200);
    }

    public function testHospitalPage()
    {
        $response = $this->get('/hospital');

        $response->assertStatus(200);
    }

    public function testInvalidPage()
    {
        $response = $this->get('/jisbfd');

        $response->assertStatus(404);
    }
}
