<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Article;
use App\Models\Tag;


class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     * GET /login
     *
     * @return Response
     */
    public function index()
    {
        return view('login');
    }

    /**
     * Show the form for creating a new resource.
     * GET /login/create
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * POST /login
     *
     * @return Response
     */
    public function store()
    {
        $rules = array(
            'email' => 'required|email',
            'password' => 'required|min:6',
            'remember_me' => 'boolean',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->passes()) {
            if (Auth::attempt(array(
                'email' => Input::get('email'),
                'password' => Input::get('password'),
                'block' => 0), (boolean)Input::get('remember_me'))
            ) {
                return Redirect::intended('home');
            } else {
                return Redirect::to('login')->withInput()->with('message', array('type' => 'danger', 'content' => 'E-mail or password error'));
            }
        } else {
            return Redirect::to('login')->withInput()->withErrors($validator);
        }
    }

    /**
     * Display the specified resource.
     * GET /login/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * GET /login/{id}/edit
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * PUT /login/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /login/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * 显示用户
     *
     * @return Response
     */
    public function showHome()
    {
        return view('home')->with('user', Auth::user())->with('articles', Article::with('tags')->where('user_id', '=', Auth::id())->orderBy('created_at', 'desc')->get());
    }
}