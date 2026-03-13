<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AutoLoginForTesting
{
    /**
     * Handle an incoming request.
     *
     * Automatically logs in a user for testing purposes when USER_TESTING_ID
     * environment variable is set. This should only be used in development/testing
     * environments and NEVER in production.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if USER_TESTING_ID is set in environment
        $testingUserId = env('USER_TESTING_ID');

        // Only auto-login if:
        // 1. USER_TESTING_ID is set
        // 2. User is not already authenticated
        // 3. Not in production environment (safety check)
        // 4. Not in testing environment (to avoid interfering with tests)
        if ($testingUserId && !Auth::check() && !app()->environment('production', 'testing')) {
            try {
                $user = \App\Models\User::find($testingUserId);

                if ($user) {
                    Auth::login($user);
                }
            } catch (\Exception $e) {
                // Silently fail if database query fails (e.g., during tests or migrations)
                // This prevents the middleware from breaking the application
            }
        }

        return $next($request);
    }
}
