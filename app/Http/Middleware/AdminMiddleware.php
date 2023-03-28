<?php

namespace App\Http\Middleware;

use App\Models\Review;
use Closure;
use Illuminate\Http\Request;
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
        $reviewId = $request->route('review');
        $review = Review::find($reviewId);
    
        if (!$review) {
            return abort(404);
        }
    
        if ($review->user_id !== auth()->user()->id) {
            abort(403, 'Unauthorized action.');
        }
    
        return $next($request);
    }
    
}
