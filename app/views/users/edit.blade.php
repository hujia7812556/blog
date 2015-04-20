@extends('_layouts.default')

@section('main')
    <div class="am-g am-g-fixed">
        <div class="am-u-lg-6 am-u-md-8">
            <br/>
            @if (Session::has('message'))
                <div class="am-alert am-alert-{{ Session::get('message')['type'] }}" data-am-alert>
                    <p>{{ Session::get('message')['content'] }}</p>
                </div>
            @endif
            @if ($errors->has())
                <div class="am-alert am-alert-danger" data-am-alert>
                    <p>{{ $errors->first() }}</p>
                </div>
            @endif
            {{ Form::model($user, array('url' => 'user/' . $user->id, 'method' => 'PUT', 'class' => 'am-form')) }}
            {{ Form::label('email', Lang::get('message.user.edit.email')) }}
            <input id="email" name="email" type="email" readonly="readonly" value="{{ $user->email }}"/>
            <br/>
            {{ Form::label('nickname', Lang::get('message.user.edit.nickname')) }}
            <input id="nickname" name="nickname" type="text" value="{{{ $user->nickname }}}"/>
            <br/>
            {{ Form::label('old_password', Lang::get('message.user.edit.oldpassword')) }}
            {{ Form::password('old_password') }}
            <br/>
            {{ Form::label('password', Lang::get('message.user.edit.newpassword')) }}
            {{ Form::password('password') }}
            <br/>
            {{ Form::label('password_confirmation', Lang::get('message.user.edit.confirmpassword')) }}
            {{ Form::password('password_confirmation') }}
            <br/>
            <div class="am-cf">
                {{ Form::submit(Lang::get('message.user.edit.modify'), array('class' => 'am-btn am-btn-primary am-btn-sm am-fl')) }}
            </div>
            {{ Form::close() }}
            <br/>
        </div>
    </div>
@stop