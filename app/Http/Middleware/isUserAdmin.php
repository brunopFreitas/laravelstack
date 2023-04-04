<?php

namespace App\Http\Middleware;

use App\Models\Role;
use App\Models\Users;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class isUserAdmin
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
        $isUserAdmin = false;
        if(Auth::user() !== null) {
            $myRoles = DB::table('role_users')
                ->where('users_id','=',Auth::user()->id)
                ->join('roles','roles.id','=','role_users.role_id')
                ->select('roles.name')
                ->get();
            foreach ($myRoles as $myRole) {
                if($myRole->name=='User Administrator') {
                    $isUserAdmin = true;
                }
            }
            if($isUserAdmin) {
                return $next($request);
            } else {
                session()->flash('message', 'Denied - You do not have permissions to access User Management.');
                return redirect(route('posts'));
            }
        } else {
            session()->flash('message', 'Denied - You need to be authenticated.');
            return redirect(route('posts'));
        }


    }
}
