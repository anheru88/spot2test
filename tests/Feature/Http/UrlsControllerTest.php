<?php

use App\Models\ShortenedUrl;
use Inertia\Testing\AssertableInertia as Assert;

it('can retrieve all shortened URLs', function () {
    $urls = ShortenedUrl::factory()->count(3)->create();

    $this->get('/urls')
        ->assertInertia(fn (Assert $page) => $page
            ->component('Urls'));
});

it('can redirect to the original URL', function () {
    $url = ShortenedUrl::factory()->create();

    $this->get('/'.$url->shortened_url)
        ->assertRedirect($url->original_url);
});
