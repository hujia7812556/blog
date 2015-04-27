@extends('_layouts.default')

@section('main')
    <div class="am-g am-g-fixed">
        <div class="am-u-sm-12">
            <br/>
            @if (Session::has('message'))
                <div class="am-alert am-alert-{{ Session::get('message')['type'] }}" data-am-alert>
                    <p>{{ Session::get('message')['content'] }}</p>
                </div>
            @endif
            <table class="am-table am-table-hover am-table-striped ">
                <thead>
                <tr>
                    <th>{{Lang::get('message.admin.users.id')}}</th>
                    <th>{{Lang::get('message.admin.users.email')}}</th>
                    <th>{{Lang::get('message.admin.users.nickname')}}</th>
                    <th>{{Lang::get('message.admin.users.management')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->email }}</td>
                        <td><a href="{{ URL::to('user/' . $user->id . '/articles') }}">{{{ $user->nickname }}}</a></td>
                        <td>
                            <a href="{{ URL::to('user/'. $user->id . '/edit') }}" class="am-btn am-btn-xs am-btn-primary">{{Lang::get('message.admin.users.edit')}}</a>
                            {!! Form::open(array('url' => 'user/' . $user->id . '/reset', 'method' => 'PUT', 'style' => 'display: inline;')) !!}
                            <button type="button" class="am-btn am-btn-xs am-btn-warning" id="reset{{ $user->id }}">{{Lang::get('message.admin.users.reset')}}</button>
                            {!! Form::close() !!}
                            @if ($user->block)
                                {!! Form::open(array('url' => 'user/' . $user->id . '/unblock', 'method' => 'PUT', 'style' => 'display: inline;')) !!}
                                <button type="button" class="am-btn am-btn-xs am-btn-danger" id="unblock{{ $user->id }}">{{Lang::get('message.admin.users.unblock')}}</button>
                                {!! Form::close() !!}
                            @else
                                {!! Form::open(array('url' => 'user/' . $user->id, 'method' => 'DELETE', 'style' => 'display: inline;')) !!}
                                <button type="button" class="am-btn am-btn-xs am-btn-danger" id="delete{{ $user->id }}">{{Lang::get('message.admin.users.block')}}</button>
                                {!! Form::close() !!}
                            @endif
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
            $('[id^=reset]').on('click', function() {
                $('.am-modal-bd').text('{{Lang::get('message.admin.users.reset.sure')}}');
                $('#my-confirm').modal({
                    relatedTarget: this,
                    onConfirm: function(options) {
                        $(this.relatedTarget).parent().submit();
                    },
                    onCancel: function() {
                    }
                });
            });

            $('[id^=delete]').on('click', function() {
                $('.am-modal-bd').text('{{Lang::get('message.admin.users.lock.sure')}}');
                $('#my-confirm').modal({
                    relatedTarget: this,
                    onConfirm: function(options) {
                        $(this.relatedTarget).parent().submit();
                    },
                    onCancel: function() {
                    }
                });
            });

            $('[id^=unblock]').on('click', function() {
                $('.am-modal-bd').text('{{Lang::get('message.admin.users.unlock.sure')}}');
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