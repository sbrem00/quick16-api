<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Creation;

class CreationsTest extends TestCase
{
    //Test creations can be created
    public function testsCreationsAreCreatedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $payload = [
            'title' => 'Lorem',
            'body' => 'Ipsum',
        ];

        $this->json('GET', '/api/creations', $payload, $headers)
            ->assertStatus(200)
            ->assertJson(['id' => 1, 'title' => 'Lorem', 'body' => 'Ipsum']);
    }

    //Test Creations can be updated
    public function testsCreationsAreUpdatedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $article = factory(Creation::class)->create([
            'title' => 'First Article',
            'body' => 'First Body',
        ]);

        $payload = [
            'title' => 'Lorem',
            'body' => 'Ipsum',
        ];

        $response = $this->json('PUT', '/api/creations/' . $article->id, $payload, $headers)
            ->assertStatus(200)
            ->assertJson([
                'id' => $article->id,
                'title' => 'Lorem',
                'body' => 'Ipsum'
            ]);
    }

    //Test creations can be deleted
    public function testsCreationsAreDeletedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $article = factory(Creation::class)->create([
            'title' => 'First Article',
            'body' => 'First Body',
        ]);

        $this->json('DELETE', '/api/creations/' . $article->id, [], $headers)
            ->assertStatus(204);
    }

    public function testCreationsAreListedCorrectly()
    {
        factory(Creation::class)->create([
            'title' => 'First Article',
            'body' => 'First Body'
        ]);

        factory(Creation::class)->create([
            'title' => 'Second Article',
            'body' => 'Second Body'
        ]);

        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];

        $response = $this->json('GET', '/api/creations', [], $headers)
            ->assertStatus(200)
            ->assertJson([
                [ 'title' => 'First Article', 'body' => 'First Body' ],
                [ 'title' => 'Second Article', 'body' => 'Second Body' ]
            ])
            ->assertJsonStructure([
                '*' => ['id', 'body', 'title', 'created_at', 'updated_at'],
            ]);
    }

}
