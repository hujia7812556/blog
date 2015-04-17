<?php

class IndexController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /index
	 *
	 * @return Response
	 */
	public function index()
	{
        $articles = Article::with('user', 'tags')->orderBy('created_at', 'desc')->paginate(Config::get('custom.page_size'));
        $tags = Tag::where('count', '>', '0')->orderBy('count', 'desc')->orderBy('updated_at', 'desc')->take(10)->get();
        return View::make('index')->with('articles', $articles)->with('tags', $tags);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /index/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /index
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /index/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return View::make('login');
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /index/{id}/edit
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
	 * PUT /index/{id}
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
	 * DELETE /index/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
}