<?php

namespace Tests\Unit;

use App\Models\Itinerary;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_user_id_login_correct(): void
    {
        $response = $this->postJson('api/login', [
            'email' => 'wissam@gmail.com',
            'password' => '123456789'
        ]);

        $response->assertStatus(201);
    }

    public function test_user_id_register_correct(): void
    {
        $response = $this->postJson('api/register', [
            "name" => 'ahmed',
            'email' => 'ahmed@gmail.com',
            'password' => '123456789'
        ]);

        $response->assertStatus(201);
    }
}
