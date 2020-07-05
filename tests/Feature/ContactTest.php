<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $user = Employee::firstOrFail();
//        dd($user);
        $this->actingAs($user);

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
