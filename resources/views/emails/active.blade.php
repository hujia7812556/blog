<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<p>
    亲爱的{{$nickname}}:<br/>
    感谢您在我站注册了新帐号。<br/>
    请点击链接激活您的帐号。<br/>
    <a href='{{URL::route('user_active')}}?email={{$email}}&activication={{$activication}}' target='_blank'>{{URL::route('user_active')}}?email={{$email}}&activication={{$activication}}</a><br/>
    如果以上链接无法点击，请将它复制到你的浏览器地址栏中进入访问。";
</p>

</body>
</html>