@extends('_layouts.default')

@section('main')
    <div class="am-g am-g-fixed blog-g-fixed">
        <div class="am-u-sm-12">
            <table class="am-table am-table-hover am-table-striped ">
                <thead>
                <tr>
                    <th>{{Lang::get('message.tags.tagname')}}</th>
                    <th>{{Lang::get('message.tags.articlecount')}}</th>
                    <th>{{Lang::get('message.tags.createdatetime')}}</th>
                    <th>{{Lang::get('message.tags.management')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($tags as $tag)
                    <tr>
                        <td>{{{ $tag->name }}}</td>
                        <td>{{ $tag->count }}</td>
                        <td>{{ $tag->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            <a href="{{ URL::to('tag/'. $tag->id . '/edit') }}" class="am-btn am-btn-xs am-btn-primary"><span class="am-icon-pencil"></span> {{Lang::get('message.tags.edit')}}</a>
                            {!! Form::open(array('url' => 'tag/' . $tag->id, 'method' => 'DELETE', 'style' => 'display: inline;')) !!}
                            <button type="button" class="am-btn am-btn-xs am-btn-danger" id="delete{{ $tag->id }}"><span class="am-icon-remove"></span> {{Lang::get('message.tags.delete')}}</button>
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
                $('.am-modal-bd').text('{{Lang::get('message.tags.delete.sure')}}');
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