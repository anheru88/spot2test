<?php

namespace App\Http\Controllers;

use App\Models\ShortenedUrl;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UrlsController extends Controller
{
    public function index()
    {
        $urls = ShortenedUrl::all()->toArray();
        return Inertia::render('Urls', ['urls' => $urls]);
    }
}
