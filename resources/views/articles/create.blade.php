@extends('_layouts.default')

@section('main')
    <div class="am-g am-g-fixed">
        <div class="am-u-sm-12">
            <h1>发表文章</h1>
            <hr/>
            @if ($errors->has())
                <div class="am-alert am-alert-danger" data-am-alert>
                    <p>{{ $errors->first() }}</p>
                </div>
            @endif
            {!! Form::open(array('url' => 'article', 'class' => 'am-form')) !!}
            <div class="am-form-group">
                <label for="title">{{Lang::get('message.articles.title')}}</label>
                <input id="title" name="title" type="text" value="{{ Input::old('title') }}"/>
            </div>
            <div class="am-form-group">
                <label for="content">{{Lang::get('message.articles.content')}}</label>
                <textarea id="content" name="content" rows="20">{{ Input::old('content') }}</textarea>
                <p class="am-form-help">
                    <button id="preview" type="button" class="am-btn am-btn-xs am-btn-primary"><span class="am-icon-eye"></span> {{Lang::get('message.articles.preview')}}</button>
                </p>
            </div>
            <div class="am-form-group">
                <label for="tags">{{Lang::get('message.articles.tags')}}</label>
                <input id="tags" name="tags" type="text" value="{{ Input::old('tags') }}"/>
                <p class="am-form-help">{{Lang::get('message.articles.tags.hint')}}</p>
            </div>
            <p><button type="submit" class="am-btn am-btn-success"><span class="am-icon-send"></span> {{Lang::get('message.articles.publish')}}</button></p>
            {!! Form::close() !!}
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
                $_token = "{{ csrf_token() }}";
                $.post('preview', {'content': $('#content').val(), _token: $_token}, function(data, status) {
                    $('.am-popup-bd').html(data);
                });
                $('#preview-popup').modal();
            });
        });
    </script>
@stop