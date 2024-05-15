<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ShortenedUrl;
use Illuminate\Http\Request;

class UrlShortenerController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $urls = ShortenedUrl::all();
        return response()->json($urls);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        $url = ShortenedUrl::findOrFail($id);
        $url->delete();

        return response()->json(null, 204);
    }

    public function redirect($shortenedUrl)
    {
        $shortenedUrlModel = ShortenedUrl::where('shortened_url', $shortenedUrl)->firstOrFail();

        return response()->json(['original_url' => $shortenedUrlModel->original_url]);
    }
}
