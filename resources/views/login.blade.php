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
            {!! Form::open(array('url' => 'login', 'class' => 'am-form')) !!}
            {!! Form::label('email', Lang::get('message.login.email')) !!}
            {!! Form::email('email', Input::old('email')) !!}
            <br/>
            {!! Form::label('password', Lang::get('message.login.password')) !!}
            {!! Form::password('password') !!}
            <br/>
            <label for="remember_me">
                <input id="remember_me" name="remember_me" type="checkbox" value="1">
                {{Lang::get('message.login.rememberme')}}
            </label>
            <br/>
            <div class="am-cf">
                {!! Form::submit(Lang::get('message.login.login'), array('class' => 'am-btn am-btn-primary am-btn-sm am-fl')) !!}
            </div>
            {!! Form::close() !!}
            <br/>
        </div>
    </div>
@stop