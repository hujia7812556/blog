<?php

class RegisterController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /register
	 *
	 * @return Response
	 */
	public function index()
	{
        return View::make('users.create');
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /register/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /register
	 *
	 * @return Response
	 */
	public function store()
	{
        $rules = array(
            'email' => 'required|email|unique:users,email',
            'nickname' => 'required|min:4|unique:users,nickname',
            'password' => 'required|min:6|confirmed',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->passes()) {
            $user = User::create(Input::only('email', 'password', 'nickname'));
            $user->password = Hash::make(Input::get('password'));
            if ($user->save()) {
                return Redirect::to('login')->with('message', array('type' => 'success', 'content' => 'Register successfully, please login'));
            } else {
                return Redirect::to('register')->withInput()->with('message', array('type' => 'danger', 'content' => 'Register failed'));
            }
        } else {
            return Redirect::to('register')->withInput()->withErrors($validator);
        }
	}

	/**
	 * Display the specified resource.
	 * GET /register/{id}
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
	 * GET /register/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /register/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /register/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}