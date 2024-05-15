<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ShortenedUrl;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

/**
 * Class UrlShortenerController
 */
class UrlShortenerController extends Controller
{

    /**
     * Retrieve all shortened URLs.
     *
     * @return JsonResponse
     *
     * @group ShortenedURLs
     * @Request({
     *     summary: Retrieve all shortened URLs,
     *     description: Retrieves all shortened URLs stored in the database.
     * })
     * @Response({
     *      code: 200
     *      description: return all urls information
     *      ref: ShortenedUrl
     *  })
     */
    public function index(): JsonResponse
    {
        $urls = ShortenedUrl::all();

        return response()->json($urls, HttpResponse::HTTP_OK);
    }

    /**
     * Store a newly created shortened URL.
     *
     * @param  Request  $request
     * @return JsonResponse
     *
     * @group ShortenedURLs
     * @Request({
     *     summary: Store a new shortened URL,
     *     description: Stores a new shortened URL in the database.
     * })
     * @Response({
     *      code: 201
     *      description: Successfully stored the shortened URL.
     *      ref: ShortenedUrl
     *  })
     * @Response({
     *      code: 500
     *      description: Internal Server Error
     *  })
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
     *
     * @param  string  $id
     * @return JsonResponse
     *
     * @group ShortenedURLs
     * @Request({
     *     summary: Remove a shortened URL,
     *     description: Removes the specified shortened URL from storage.
     * })
     * @Response({
     *      code: 204
     *      description: Successfully removed the shortened URL.
     *  })
     * @Response({
     *       code: 500
     *       description: Internal Server Error
     *   })
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
     * @return JsonResponse
     *
     * @group ShortenedURLs
     * @Request({
     *     summary: Redirect to the original URL,
     *     description: Redirects to the original URL corresponding to the given shortened URL.
     * })
     * @Response({
     *      code: 302
     *      description: Redirects to the original URL.
     *  })
     * @Response({
     *       code: 500
     *       description: Internal Server Error
     *   })
     */
    public function redirect($shortenedUrl): JsonResponse
    {
        $shortenedUrlModel = ShortenedUrl::where('shortened_url', $shortenedUrl)->firstOrFail();

        return response()->json(['original_url' => $shortenedUrlModel->original_url], HttpResponse::HTTP_FOUND);
    }
}
