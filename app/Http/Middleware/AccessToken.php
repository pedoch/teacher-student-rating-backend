<?php

namespace App\Http\Middleware;
use App\SessionToken;
use Carbon\Carbon;
use Closure;

class AccessToken
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
        $header = substr($request->header('Authorization'), 7);
        $token = SessionToken::where('token', $header)->first();
        if($token){
            $to = Carbon::now();
            $from = Carbon::createFromFormat('Y-m-d H:s:i', $token['expired_at']);
            $diff_in_hours = $from->diffInHours($to);
            if($diff_in_hours >1){
                return response()->json('Session expired', 403);
            }
        }else{
            return response()->json('Session expired', 403);
        }
        return $next($request);
    }
}
