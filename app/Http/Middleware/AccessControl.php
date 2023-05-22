<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Illuminate\Support\Facades\Session;


class AccessControl extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $logged_in_required = preg_match('/^admin/i',$request->path());
        if($logged_in_required) {
            $user_id = Session::get('user');
            if(!$user_id) {
                // must be logged in 
                Session::put('message','Access Denied');
                return redirect('/login');
            } else {
                // Check password not changed
                $User1 = User::find($user_id);
                $pass = Session::get('pass');
                
                if(!Hash::check($pass, $User1->password)) {
                    echo $pass; die(); 
                    Session::put('message','The account you are logged into was logged out.');
                    return redirect('/login');
                }
            }
        }
        return $next($request);
    }
}
