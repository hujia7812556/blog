<?php

class UserController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /user
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /user/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /user
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /user/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /user/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        if (Auth::user()->is_admin or Auth::id() == $id) {
            return View::make('users.edit')->with('user', User::find($id));
        } else {
            return Redirect::to('/');
        }
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /user/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        if (Auth::user()->is_admin or (Auth::id() == $id)) {
            $user = User::find($id);
            $rules = array(
                'password' => 'required_with:old_password|min:6|confirmed',
                'old_password' => 'min:6',
            );
            if (!(Input::get('nickname') == $user->nickname)) {
                $rules['nickname'] = 'required|min:4||unique:users,nickname';
            }
            $validator = Validator::make(Input::all(), $rules);
            if ($validator->passes()) {
                if (!(Input::get('old_password') == '')) {
                    if (!Hash::check(Input::get('old_password'), $user->password)) {
                        return Redirect::route('user.edit', $id)->with('user', $user)->with('message', array('type' => 'danger', 'content' => 'Old password error'));
                    } else {
                        $user->password = Hash::make(Input::get('password'));
                    }
                }
                $user->nickname = Input::get('nickname');
                $user->save();
                return Redirect::route('user.edit', $id)->with('user', $user)->with('message', array('type' => 'success', 'content' => Lang::get('message.user.edit.modify.success')));
            } else {
                return Redirect::route('user.edit', $id)->withInput()->with('user', $user)->withErrors($validator);
            }
        } else {
            return Redirect::to('/');
        }
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /user/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

    public function articles(User $user)
    {
        return View::make('home')->with('user', $user)->with('articles', Article::with('tags')->where('user_id', '=', $user->id)->orderBy('created_at', 'desc')->get());
    }

}