<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) 
        {
            if( $request->segment(2) == 'admin' )
            {
                return route('admin.login');
            }
            elseif($request->segment(2) == '/')
            {
            return route('login');

            }

            // return "ddddddddddddddddd0";
        }
    }
}
