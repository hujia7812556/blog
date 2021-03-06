<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use GrahamCampbell\Markdown\Facades\Markdown;

use App\Models\Article;
use App\Models\Tag;
use App\Models\User;

class ArticleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', array('only' => array('create', 'store', 'edit', 'update', 'destroy')));
        $this->middleware('article.canOperation', array('only' => array('edit', 'update', 'destroy')));
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
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     * POST /article
     *
     * @return Response
     */
    public function store()
    {
        $rules = [
            'title' => 'required|max:100',
            'content' => 'required',
            'tags'    => array('required', 'regex:/^\w+$|^(\w+,)+\w+$|^\p{Han}+$|^(\p{Han}+,)+\p{Han}$/u'),
        ];
        $newData = Input::all();
        $newData['tags'] = mb_convert_encoding(Input::get('tags'),'UTF-8');
        $validator = Validator::make($newData, $rules);
        if ($validator->passes()) {
            $article = Article::create(Input::only('title', 'content'));
            $article->user_id = Auth::id();
            $resolved_content = Markdown::convertToHtml(Input::get('content'));
            $article->resolved_content = $resolved_content;
            $tags = array_unique(explode(',', $newData['tags']));
            if (str_contains($resolved_content, '<p>')) {
                $start = strpos($resolved_content, '<p>');
                $length = strpos($resolved_content, '</p>') - $start - 3;
                $article->summary = substr($resolved_content, $start + 3, $length);
            } else if (str_contains($resolved_content, '</h')) {
                $start = strpos($resolved_content, '<h');
                $length = strpos($resolved_content, '</h') - $start - 4;
                $article->summary = substr($resolved_content, $start + 4, $length);
            }
            $article->save();
            foreach ($tags as $tagName) {
                $tag = Tag::withTrashed()->whereName($tagName)->first();
                if (!$tag) {
                    $tag = Tag::create(array('name' => $tagName));
                } elseif ($tag->deleted_at) {//该tag已被软删除
                    $tag->restore();
                }
                $tag->count++;
                $article->tags()->save($tag);
            }
            return Redirect::route('article.show', $article->id);
        } else {
            return Redirect::route('article.create')->withInput()->withErrors($validator);
        }
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
        return view('articles.show')->with('article', Article::find($id));
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
        $article = Article::with('tags')->find($id);
        $tags = '';
        for ($i = 0, $len = count($article->tags); $i < $len; $i++) {
            $tags .= $article->tags[$i]->name . ($i == $len - 1 ? '' : ',');
        }
        $article->tags = $tags;
        return view('articles.edit')->with('article', $article);
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
        $rules = [
            'title'   => 'required|max:100',
            'content' => 'required',
            'tags'    => array('required', 'regex:/^\w+$|^(\w+,)+\w+$|^\p{Han}+$|^(\p{Han}+,)+\p{Han}$/u'),
        ];
        $updateData = Input::all();
        $updateData['tags'] = mb_convert_encoding(Input::get('tags'),'UTF-8');
        $validator = Validator::make($updateData, $rules);
        if ($validator->passes()) {
            $article = Article::with('tags')->find($id);
            $article->update(Input::only('title', 'content'));
            $resolved_content = Markdown::convertToHtml(Input::get('content'));
            $article->resolved_content = $resolved_content;
            $tags = array_unique(explode(',', $updateData['tags']));
            if (str_contains($resolved_content, '<p>')) {
                $start = strpos($resolved_content, '<p>');
                $length = strpos($resolved_content, '</p>') - $start - 3;
                $article->summary = substr($resolved_content, $start + 3, $length);
            } elseif (str_contains($resolved_content, '</h')) {
                $start = strpos($resolved_content, '<h');
                $length = strpos($resolved_content, '</h') - $start - 4;
                $article->summary = substr($resolved_content, $start + 4, $length);
            }
            $article->save();
            foreach ($article->tags as $tag) {
                if (($index = array_search($tag->name, $tags)) !== false) {//原文章已存在该标签
                    unset($tags[$index]);
                } else {
                    $tag->count--;
                    $tag->save();
                    $article->tags()->detach($tag->id);
                }
            }
            foreach ($tags as $tagName) {
                $tag = Tag::withTrashed()->whereName($tagName)->first();
                if (!$tag) {
                    $tag = Tag::create(array('name' => $tagName));
                } elseif ($tag->deleted_at) {//该tag已被软删除
                    $tag->restore();
                }
                $tag->count++;
                $article->tags()->save($tag);
            }
            return Redirect::route('article.show', $article->id);
        } else {
            return Redirect::route('article.edit', $id)->withInput()->withErrors($validator);
        }
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
        $article = Article::find($id);
        foreach ($article->tags as $tag) {
            $tag->count--;
            $tag->save();
            $article->tags()->detach($tag->id);
        }
        $article->delete();
        return Redirect::back();
    }

    public function preview() {
        return Markdown::convertToHtml(Input::get('content'));
    }
}