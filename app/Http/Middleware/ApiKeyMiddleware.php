<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiKeyMiddleware
{
    /**
     * Simple API key protection middleware.
     * Sends 401 when key is missing/invalid, or 500 when API_KEY is not configured (production).
     */
    public function handle(Request $request, Closure $next)
    {
        $apiKey = env('API_KEY');

        // If no API key is configured and we're not in production, allow for local development
        if (!$apiKey && env('APP_ENV') !== 'production') {
            return $next($request);
        }

        if (!$apiKey) {
            return response()->json(['message' => 'API key not configured. Set API_KEY in .env'], 500);
        }

        // accept either X-API-KEY header or Bearer token
        $provided = $request->header('X-API-KEY') ?: $request->bearerToken();

        if (!$provided || !function_exists('hash_equals') || !hash_equals((string) $apiKey, (string) $provided)) {
            return response()->json(['message' => 'Unauthorized.'], 401);
        }

        return $next($request);
    }
}
