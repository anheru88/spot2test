<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ShortenedUrl;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class UrlShortenerController extends Controller
{
    /**
     * Retrieve all shortened URLs.
     */
    public function index(): JsonResponse
    {
        $urls = ShortenedUrl::all();

        return response()->json($urls, HttpResponse::HTTP_OK);
    }

    /**
     * Store a newly created shortened URL.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'original_url' => 'required|url|unique:shortened_urls,original_url',
        ]);

        $shortenedUrl = ShortenedUrl::create([
            'original_url' => $request->original_url,
        ]);

        return response()->json($shortenedUrl, HttpResponse::HTTP_CREATED);
    }

    /**
     * Remove the specified shortened URL from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $url = ShortenedUrl::findOrFail($id);
        $url->delete();

        return response()->json(null, HttpResponse::HTTP_NO_CONTENT);
    }

    /**
     * Redirect to the original URL corresponding to the given shortened URL.
     *
     * @param  mixed  $shortenedUrl
     */
    public function redirect($shortenedUrl): JsonResponse
    {
        $shortenedUrlModel = ShortenedUrl::where('shortened_url', $shortenedUrl)->firstOrFail();

        return response()->json(['original_url' => $shortenedUrlModel->original_url], HttpResponse::HTTP_FOUND);
    }
}
