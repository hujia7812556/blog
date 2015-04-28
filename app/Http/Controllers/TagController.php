<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

use App\Pagination\PaginationPresenter;
use App\Models\Tag;
use Lang;

class TagController extends Controller {

    public function __construct()
    {
        $this->middleware('auth', array('only' => array('create', 'store', 'edit', 'update', 'destroy')));
    }

	/**
	 * Display a listing of the resource.
	 * GET /tag
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /tag/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /tag
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /tag/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return view('tags.list')->with('tags', Tag::all());
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /tag/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return view('tags.edit')->with('tag', Tag::find($id));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /tag/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $rules = array(
            'name' => array('required', 'regex:/^\w+$|^\p{Han}+$/u'),
        );
        $updateData = Input::only('name');
        $updateData['name'] = mb_convert_encoding($updateData['name'],'UTF-8');
        $validator = Validator::make($updateData, $rules);
        if ($validator->passes()) {
            Tag::find($id)->update($updateData);
            return Redirect::back()->with('message', array('type' => 'success', 'content' => Lang::get('message.tags.modify.success')));
        } else {
            return Redirect::back()->withInput()->withErrors($validator);
        }
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /tag/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $tag = Tag::find($id);
        $tag->count = 0;
        $tag->save();
        foreach ($tag->articles as $article) {
            $tag->articles()->detach($article->id);
        }
        $tag->destroy($id);
        return Redirect::back();
	}

    //属于某个标签的所有文章
    public function articles($id)
    {
        $tag = Tag::find($id);
        $articles = $tag->articles()->orderBy('created_at', 'desc')->paginate(10);
        $presenter  = new PaginationPresenter($articles);
        return view('articles.specificTag')->with('tag', $tag)->with('articles', $articles)->with('presenter',$presenter);
    }
}