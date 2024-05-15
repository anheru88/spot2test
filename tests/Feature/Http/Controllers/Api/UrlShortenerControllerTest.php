<?php

use App\Models\ShortenedUrl;
use Symfony\Component\HttpFoundation\Response as HttpResponse;


it('can retrieve all shortened URLs', function () {
    $urls = ShortenedUrl::factory()->count(3)->create();

    $response = $this->getJson('/api/urls');

    $response->assertStatus(200)->assertJsonStructure([
        '*' => ['id', 'original_url', 'shortened_url', 'created_at', 'updated_at'],
    ]);
});


it('can store a new shortened URL', function () {
    $data = ['original_url' => 'https://example123123.com'];

    $this->post('/api/urls', $data)
        ->assertJsonStructure(['id', 'original_url', 'shortened_url', 'created_at', 'updated_at'])
        ->assertStatus(HttpResponse::HTTP_CREATED);

    $this->assertDatabaseHas('shortened_urls', $data);
});

it('can delete a shortened URL', function () {
    $url = ShortenedUrl::factory()->create();

    $this->delete('/api/urls/' . $url->id)
        ->assertStatus(HttpResponse::HTTP_NO_CONTENT);

    $this->assertDatabaseMissing('shortened_urls', ['id' => $url->id]);
});

it('can redirect to the original URL', function () {
    $url = ShortenedUrl::factory()->create();

    $this->get('api/urls/' . $url->shortened_url)
        ->assertStatus(HttpResponse::HTTP_FOUND)
        ->assertJsonStructure(['original_url']);
});
