<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    public function testRequiresEmailAndLogin()
    {
        $this->json('POST', 'api/login')
            ->assertStatus(422)
            ->assertJson([ 'errors' => [
                'email' => ['The email field is required.'],
                'password' => ['The password field is required.'],
            ]]);
    }

    public function testUserLoginsSuccessfully()
    {
        $user = factory(User::class)->create([
            'email' => 'testlogin@q16.com',
            'password' => bcrypt('secret'),
        ]);

        $payload = ['email' => 'testlogin@q16.com', 'password' => 'secret'];

        $this->json('POST', 'api/login', $payload)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'email',
                    'created_at',
                    'updated_at',
                    'api_token',
                ],
            ]);

    }
}
