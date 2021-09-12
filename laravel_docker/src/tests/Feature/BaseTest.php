<?php

namespace Tests\Feature;

use App\Traits\Base;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Storage;

class BaseTest extends TestCase
{
    use Base;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRootUrl()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('WELCOME');
    }

    public function testAffFileExists()
    {
        Storage::disk('local')->assertExists('affiliates.txt');
    }

    public function testGoodUserDistance()
    {
        // {"latitude": "53.1229599", "affiliate_id": 6, "name": "Jez Greene", "longitude": "-6.2705202"}
        $dist = $this->getDistanceBetweenPoints(53.3340285, -6.2535495, 53.1489345, -6.8422408);
        $this->assertLessThanOrEqual(100, $dist);
    }

    public function testBadUserDistance()
    {
        // {"latitude": "53.4692815", "affiliate_id": 7, "name": "Mikaeel Fenton", "longitude": "-9.436036"}
        $dist = $this->getDistanceBetweenPoints(53.3340285, -6.2535495, 53.4692815, -9.436036);
        $this->assertGreaterThanOrEqual(100, $dist);
    }
}
