<?php

class ArticleController extends \BaseController
{

    public function __construct()
    {
        $this->beforeFilter('auth', array('only' => array('create', 'store', 'edit', 'update', 'destroy')));
    }

    /**
     * Display a listing of the resource.
     * GET /article
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     * GET /article/create
     *
     * @return Response
     */
    public function create()
    {
        return View::make('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     * POST /article
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     * GET /article/{id}
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
     * GET /article/{id}/edit
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
     * PUT /article/{id}
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
     * DELETE /article/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}