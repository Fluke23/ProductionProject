<?php
namespace App\Http\Middleware;
use Closure;
use App\Group_user;
use Auth;
class Admin
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
        
        $username = Auth::user()->username;
       
        $permission = Group_user::select('groups_id')->where('username', '=', $username)->first();
        if($permission->groups_id == 'ADMIN'){
            $permission = $permission->groups_id;
            $request->merge(compact('permission'));
            return $next($request);
        }elseif($permission->groups_id == 'STUDENT'){
            return $next($request);
        }
        
        
    }
}