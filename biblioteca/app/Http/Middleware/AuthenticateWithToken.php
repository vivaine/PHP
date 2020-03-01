<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticateWithToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
    	$tokens = Config::get('auth.tokens');

    	$header = $request->header('Authorization');

    	$check_token = explode(' ', $header);

    	if(!isset($check_token[1]) || !in_array($check_token, $tokens)){
    		return response()->json(["message"=>"Unauthorized"], 401);
    	}
        return $next($request);
    }
}
