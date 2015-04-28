<?php namespace App\Http\Middleware\Article;

use Closure;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

use App\Models\Article;

class CanOperation {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!(Auth::user()->is_admin or Auth::id() == Article::find(Route::input('article'))->user_id))
        {
            return Redirect::to('/');
        }
        return $next($request);
    }

}
