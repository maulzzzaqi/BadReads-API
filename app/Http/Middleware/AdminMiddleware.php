<?php

namespace App\Http\Middleware;

use App\Models\Book;
use App\Models\Review;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $currentUser = Auth::user();

        if ($currentUser -> is_admin !== 1) {
            return response()->json([
                'message' => 'You are not allowed to edit this!',
            ], 404);
        }
    
        return $next($request);
    }
    
}
