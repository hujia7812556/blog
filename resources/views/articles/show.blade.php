@extends('_layouts.default')

@section('main')
    <article class="am-article">
        <div class="am-g am-g-fixed">
            <div class="am-u-sm-12">
                <br/>
                <div class="am-article-hd">
                    <h1 class="am-article-title">{{{ $article->title }}}</h1>
                    <a href="{{ URL::to('user/' . $article->user->id . '/articles') }}" style="cursor: pointer;">{{{ $article->user->nickname }}}</a> {{Lang::get('message.articles.datetime')}}: {{ $article->updated_at }}</p>
                </div>
                <div class="am-article-bd">
                    <blockquote>
                        {{Lang::get('message.articles.tags')}}:
                        @foreach ($article->tags as $tag)
                            <a class="am-badge am-badge-success am-radius" href="{{ URL::to('tag/' . $tag->id . '/articles') }}">{{ $tag->name }}</a>
                        @endforeach
                    </blockquote>
                    </p>
                    <p>{!! $article->resolved_content !!}</p>
                </div>
                <br/>
            </div>
        </div>
    </article>
@stop