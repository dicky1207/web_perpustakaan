<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        // Jika memang redirect, test redirect-nya
        if ($response->status() === 302) {
            $response->assertRedirect('/login');
        } else {
            $response->assertStatus(200);
        }
    }
}
