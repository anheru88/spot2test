<?php

use App\Models\ShortenedUrl;

it('can create a shortened URL', function () {
    $originalUrl = 'https://example.com';
    $shortenedUrl = ShortenedUrl::create(['original_url' => $originalUrl]);

    expect($shortenedUrl->original_url)->toBe($originalUrl)
        ->and(strlen($shortenedUrl->shortened_url))->toBe(8);
    // Verificamos que el URL acortado tenga 8 caracteres
});

it('can retrieve the original URL', function () {
    $originalUrl = 'https://example.com';
    $shortenedUrl = ShortenedUrl::create(['original_url' => $originalUrl]);

    $retrievedUrl = ShortenedUrl::where('shortened_url', $shortenedUrl->shortened_url)->first();

    expect($retrievedUrl->original_url)->toBe($originalUrl);
});

it('automatically generates a shortened URL when saving', function () {
    $originalUrl = 'https://example.com';
    $shortenedUrl = ShortenedUrl::create(['original_url' => $originalUrl]);

    expect($shortenedUrl->shortened_url)->not()->toBeNull();
    expect(strlen($shortenedUrl->shortened_url))->toBe(8); // Verificamos que el URL acortado tenga 8 caracteres
});

it('generates a unique shortened URL', function () {
    $originalUrl = 'https://example.com';

    // Creamos dos enlaces con la misma URL original
    $shortenedUrl1 = ShortenedUrl::create(['original_url' => $originalUrl]);
    $shortenedUrl2 = ShortenedUrl::create(['original_url' => $originalUrl]);

    expect($shortenedUrl1->shortened_url)->not->toBe($shortenedUrl2->shortened_url);
});
