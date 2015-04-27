@extends('_layouts.default')

@section('main')
    <div class="am-g am-g-fixed blog-g-fixed">
        <div class="am-u-sm-12">
            <table class="am-table am-table-hover am-table-striped ">
                <thead>
                <tr>
                    <th>{{Lang::get('message.articles.title')}}</th>
                    <th>{{Lang::get('message.articles.tags')}}</th>
                    <th>{{Lang::get('message.articles.author')}}</th>
                    <th>{{Lang::get('message.articles.management')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($articles as $article)
                    <tr>
                        <td><a href="{{ URL::route('article.show', $article->id) }}">{{{ $article->title }}}</a></td>
                        <td>
                            @foreach ($article->tags as $tag)
                                <span class="am-badge am-badge-success am-radius" ><a href="{{ URL::to('tag/' . $tag->id . '/articles') }}">{{ $tag->name }}</a></span>
                            @endforeach
                        </td>
                        <td><a href="{{ URL::to('user/' . $article->user->id . '/articles') }}">{{{ $article->user->nickname }}}</a></td>
                        <td>
                            <a href="{{ URL::to('article/'. $article->id . '/edit') }}" class="am-btn am-btn-xs am-btn-primary"><span class="am-icon-pencil"></span> {{Lang::get('message.articles.edit')}}</a>
                            {!! Form::open(array('url' => 'article/' . $article->id, 'method' => 'DELETE', 'style' => 'display: inline;')) !!}
                            <button type="button" class="am-btn am-btn-xs am-btn-danger" id="delete{{ $article->id }}"><span class="am-icon-remove"></span> {{Lang::get('message.articles.delete')}}</button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="am-modal am-modal-confirm" tabindex="-1" id="my-confirm">
        <div class="am-modal-dialog">
            <div class="am-modal-bd">
            </div>
            <div class="am-modal-footer">
                <span class="am-modal-btn" data-am-modal-cancel>{{Lang::get('message.no')}}</span>
                <span class="am-modal-btn" data-am-modal-confirm>{{Lang::get('message.yes')}}</span>
            </div>
        </div>
    </div>
    <script>
        $(function() {
            $('[id^=delete]').on('click', function() {
                $('.am-modal-bd').text('{{Lang::get('message.articles.delete.sure')}}');
                $('#my-confirm').modal({
                    relatedTarget: this,
                    onConfirm: function(options) {
                        $(this.relatedTarget).parent().submit();
                    },
                    onCancel: function() {
                    }
                });
            });
        });
    </script>
@stop