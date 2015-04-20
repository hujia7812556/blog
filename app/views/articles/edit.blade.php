@extends('_layouts.default')

@section('main')
    <div class="am-g am-g-fixed">
        <div class="am-u-sm-12">
            <h1>{{Lang::get('message.editarticle')}}</h1>
            <hr/>
            @if ($errors->has())
                <div class="am-alert am-alert-danger" data-am-alert>
                    <p>{{ $errors->first() }}</p>
                </div>
            @endif
            {{ Form::model($article, array('url' => URL::route('article.update', $article->id), 'method' => 'PUT', 'class' => "am-form")) }}
            <div class="am-form-group">
                {{ Form::label('title', Lang::get('message.articles.title')) }}
                {{ Form::text('title', Input::old('title')) }}
            </div>
            <div class="am-form-group">
                {{ Form::label('content', Lang::get('message.articles.content')) }}
                {{ Form::textarea('content', Input::old('content'), array('rows' => '20')) }}
                <p class="am-form-help">
                    <button id="preview" type="button" class="am-btn am-btn-xs am-btn-primary"><span class="am-icon-eye"></span> {{Lang::get('message.articles.preview')}}</button>
                </p>
            </div>
            <div class="am-form-group">
                {{ Form::label('tags', Lang::get('message.articles.tags')) }}
                {{ Form::text('tags', Input::old('tags')) }}
                <p class="am-form-help">{{Lang::get('message.articles.tags.hint')}}</p>
            </div>
            <p><button type="submit" class="am-btn am-btn-success">
                    <span class="am-icon-pencil"></span> {{Lang::get('message.articles.modify')}}</button>
            </p>
            {{ Form::close() }}
        </div>
    </div>

    <div class="am-popup" id="preview-popup">
        <div class="am-popup-inner">
            <div class="am-popup-hd">
                <h4 class="am-popup-title"></h4>
      <span data-am-modal-close
            class="am-close">&times;</span>
            </div>
            <div class="am-popup-bd">
            </div>
        </div>
    </div>
    <script>
        $(function() {
            $('#preview').on('click', function() {
                $('.am-popup-title').text($('#title').val());
                $.post('preview', {'content': $('#content').val()}, function(data, status) {
                    $('.am-popup-bd').html(data);
                });
                $('#preview-popup').modal();
            });
        });
    </script>
@stop