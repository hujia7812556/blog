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
            {!! Form::open(array('url' => 'register', 'class' => 'am-form')) !!}
            {!! Form::label('email', Lang::get('message.register.email')) !!}
            {!! Form::email('email', Input::old('email')) !!}
            <br/>
            {!! Form::label('nickname', Lang::get('message.register.nickname')) !!}
            {!! Form::text('nickname', Input::old('nickname')) !!}
            <br/>
            {!! Form::label('password', Lang::get('message.register.password')) !!}
            {!! Form::password('password') !!}
            <br/>
            {!! Form::label('password_confirmation', Lang::get('message.register.confirmpassword')) !!}
            {!! Form::password('password_confirmation') !!}
            <br/>
            <div class="am-cf">
                {!! Form::submit(Lang::get('message.register.register'), array('class' => 'am-btn am-btn-primary am-btn-sm am-fl')) !!}
            </div>
            {!! Form::close() !!}
            <br/>
        </div>
    </div>
@stop