<?php

namespace App\Http\Controllers;

use App\Models\ShortenedUrl;
use Inertia\Inertia;

class UrlsController extends Controller
{
    public function index()
    {
        return Inertia::render('Urls');
    }

    public function redirect($shortenedUrl)
    {
        $shortenedUrlModel = ShortenedUrl::where('shortened_url', $shortenedUrl)->firstOrFail();

        return Inertia::render('Redirect', ['redirectUrl' => $shortenedUrlModel->original_url]);
    }
}
