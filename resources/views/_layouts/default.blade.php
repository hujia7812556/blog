<!DOCTYPE html>
<html>
<head lang="zh">
    <meta charset="UTF-8"/>
    <title>HuJia Blog</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no"/>
    <meta name="renderer" content="webkit"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="alternate icon" type="image/x-icon" href="{{ URL::asset('i/favicon.ico') }}"/>
    {{--{{ HTML::style('css/amazeui.min.css') }}--}}
    <link media="all" type="text/css" rel="stylesheet" href="{{ URL::asset('/css/amazeui.min.css') }}">
    {{--{{ HTML::style('css/custom.css') }}--}}
    <link rel="stylesheet" type="text/css" rel="stylesheet" href="{{URL::asset('/css/custom.css')}}"/>
    {{--{{ HTML::script('js/jquery.min.js') }}--}}
    <script src="{{URL::asset('js/jquery.min.js')}}"></script>
    {{--{{ HTML::script('js/amazeui.min.js') }}--}}
    <script src="{{URL::asset('js/amazeui.min.js')}}"></script>
</head>
<body>
<header class="am-topbar am-topbar-fixed-top">
    <div class="am-container">
        <h1 class="am-topbar-brand">
            <a href="{{URL::to('/')}}">{{Lang::get('message.topbar.name')}}</a>
        </h1>
        @include('_layouts.nav')
    </div>
</header>

@yield('main')

@include('_layouts.footer')

</body>
</html>