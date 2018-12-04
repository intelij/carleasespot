<?php namespace App\Http\Middleware;

use Closure;
use Redirect;
class RedirectIfAdminAuthenticated {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$guard = 'admin')
    {
        if (!auth()->guard($guard)->check()) {
            if ($request->ajax()) {
                return response()->json(['success'=>false,'message'=>'You need to login first'], 422);
            }
            return Redirect::route('admin.login')->withErrors('login', 'Please Login to access admin area');
        }
        return $next($request);
    }
}
