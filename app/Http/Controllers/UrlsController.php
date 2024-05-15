<?php

namespace App\Http\Controllers;

use App\Models\ShortenedUrl;
use Inertia\Inertia;

class UrlsController extends Controller
{
    public function index()
    {
        $urls = ShortenedUrl::all()->toArray();

        return Inertia::render('Urls', ['urls' => $urls]);
    }

    public function redirect($shortenedUrl): \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
    {
        $shortenedUrlModel = ShortenedUrl::where('shortened_url', $shortenedUrl)->firstOrFail();

        return redirect($shortenedUrlModel->original_url);
    }
}
