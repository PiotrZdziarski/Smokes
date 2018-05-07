<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use DB;

class admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!isset(Auth::user()->name)) {
          return redirect()->route('mainpage');
        }

        $user = Auth::user()->name;
        $usersDB = DB::table('users')->where('name', $user)->get();
        foreach($usersDB as $userfromdb) {
          $admin = $userfromdb->admin;
        }

        if($admin == 0) {
          return redirect()->route('mainpage');
        }
        return $next($request);
    }
}
