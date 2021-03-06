<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

use App\Models\Article;
use App\Models\Tag;
use App\Models\User;
use Lang;

class AdminController extends Controller
{

    /**
     * Display a listing of the resource.
     * GET /admin
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     * GET /admin/create
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * POST /admin
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     * GET /admin/{id}
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
     * GET /admin/{id}/edit
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
     * PUT /admin/{id}
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
     * DELETE /admin/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function articles()
    {
        return view('admin.articles.list')->with('articles', Article::with('user', 'tags')->orderBy('created_at', 'desc')->get())->with('page', 'articles');
    }

    public function tags()
    {
        return view('admin.tags.list')->with('tags', Tag::orderBy('count', 'desc')->orderBy('updated_at', 'desc')->get())->with('page', 'tags');
    }

    public function users()
    {
        return view('admin.users.list')->with('users', User::all())->with('page', 'users');
    }

    public function resetUser($user)
    {
        $user->password = Hash::make('123456');
        $user->save();
        return Redirect::to('admin/users')->with('message', array('type' => 'success', 'content' => Lang::get('message.admin.users.reset.success')));
    }

    public function blockUser($user)
    {
        $user->block = 1;
        $user->save();
        return Redirect::to('admin/users')->with('message', array('type' => 'success', 'content' => Lang::get('message.admin.users.block.success')));
    }

    public function unblockUser($user)
    {
        $user->block = 0;
        $user->save();
        return Redirect::to('admin/users')->with('message', array('type' => 'success', 'content' => Lang::get('message.admin.users.unblock.success')));
    }

}