<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class SecureFileController extends Controller
{
    /**
     * Serve a file securely from the local storage disk.
     *
     * Files stored in storage/app/ are not publicly accessible.
     * This controller validates the path and serves the file
     * with proper content-type headers.
     */
    public function serve(string $path): Response
    {
        // Prevent directory traversal attacks
        $path = str_replace(['..', "\0"], '', $path);

        // Check if the file exists on the local disk (storage/app/)
        if (!Storage::disk('local')->exists($path)) {
            abort(404);
        }

        $fullPath = Storage::disk('local')->path($path);
        $mimeType = mime_content_type($fullPath) ?: 'application/octet-stream';

        return response()->file($fullPath, [
            'Content-Type' => $mimeType,
            'Cache-Control' => 'public, max-age=86400',
        ]);
    }
}
