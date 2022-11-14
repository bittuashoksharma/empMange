<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SuperAdminUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        if (!\Auth::check()) {
            return $this->sendErrorMessage('Unauthenticated', ["error" => "Access Token has been expired!"], 404);
        }

        if (\Auth::user()->role == 1) {
            return $next($request);
        }else{
            return $this->sendErrorMessage('Forbidden', ["error" => "You don't have permission to access this URL!"], 403);
        }

    }
    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendErrorMessage($error, $errorMessages = [], $code = 404)
    {
    	$response = [
            'success' => false,
            'message' => $error,
        ];


        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }


        return response()->json($response, $code);
    }
}
