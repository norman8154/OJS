<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Session\Store;
use Auth;
use DB;
use Illuminate\Support\Facades\Redirect;

class SessionTimeout
{

    protected $session;
    protected $timeout = 60;

    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            if (!session('lastActivityTime'))
                $this->session->put('lastActivityTime', time());
            elseif (time() - $this->session->get('lastActivityTime') > $this->timeout) {
                $this->session->forget('lastActivityTime');
                DB::table('users')->where('email', Auth::user()->email)->update(['online' => 'off']);
                auth()->logout();
                return Redirect::to('/')->with('timeout', true)->with('message', 'You had not activity in ' . $this->timeout / 60 . ' minutes.');
            }
            $this->session->put('lastActivityTime', time());
        } else {
            $this->session->forget('lastActivityTime');
        }
        return $next($request);
    }

}
