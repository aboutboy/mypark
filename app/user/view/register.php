<!DOCTYPE html>
<html lang="zh-cn" class="app">
    <head>
        <meta charset="utf-8" />
        <title>管理登录 - 多域名管理系统 | Powered by 域名停靠系统</title>
        <meta name="description" content="app, web app, responsive, responsive layout, admin, admin panel, admin dashboard, flat, flat ui, ui kit, AngularJS, ui route, charts, widgets, components" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <link rel="stylesheet" href="/public/min/libs/assets/animate.css/animate.css" type="text/css" />
        <link rel="stylesheet" href="/public/min/libs/assets/font-awesome/css/font-awesome.min.css" type="text/css" />
        <link rel="stylesheet" href="/public/min/libs/assets/simple-line-icons/css/simple-line-icons.css" type="text/css" />
        <link rel="stylesheet" href="/public/min/libs/jquery/bootstrap/dist/css/bootstrap.css" type="text/css" />

        <link rel="stylesheet" href="/public/min/css/font.css" type="text/css" />
        <link rel="stylesheet" href="/public/min/css/app.css" type="text/css" />
        <style>input:-webkit-autofill{-webkit-box-shadow:0 0 0px 1000px white inset;-webkit-text-fill-color:#333;}</style>
    </head>
    <body>

    </body><div class="app ng-scope app-header-fixed app-aside-fixed" id="app" ng-class="{'app-header-fixed':app.settings.headerFixed, 'app-aside-fixed':app.settings.asideFixed, 'app-aside-folded':app.settings.asideFolded, 'app-aside-dock':app.settings.asideDock, 'container':app.settings.container}" ui-view="" style=""><div class="modal-over bg-black ng-scope">
            <div class="modal-center animated fadeInUp text-center" style="width:300px;margin:-100px 0 0 -100px;">
                <div class="thumb-lg">
                    <img src="/public/min/img/a3.jpg" class="img-circle">
                </div>
                <p class="h4 m-t m-b">您好，欢迎注册智能域名停靠系统</p>
                <div class="input-group" onKeyDown = "_b()">
                    <input type="text" name="username" class="form-control text-sm no-border" placeholder="请输入用户名">
                    <input type="password" name="password" class="form-control text-sm no-border" placeholder="请输入密码">
                    <input type="password" name="repassword" class="form-control text-sm no-border" placeholder="请确认密码">
                </div>
                <span class="input-group-btn">
                        <a href="javascript:register()" class="btn btn-success no-border">注册 <i class="fa fa-arrow-right"></i></a>
                    </span>
            </div>
        </div></div>

    <script src="/public/static/user/js/jquery.min.js"></script>
    <script src="/public/static/user/js/bootstrap.js"></script>
    <script src="/public/min/layer/layer.js"></script>
    <script>
                    function register() {
                        var username = $("input[name='username']").val();
                        var password = $("input[name='password']").val();
                        var repassword = $("input[name='repassword']").val();
                        if (username === '' || password === '') {
                            layer.alert('用户名或密码不能为空！');
                        } else if( password !== repassword) {
                            layer.alert('两次输入的密码不一致！');
                        }else {
                            $.post('?do=validation', {username: username, password: password}, function (text) {
                                layer.alert(text);
                            });
                        }
                    }
                    function _b() {
                        if (event.keyCode == 13) {
                            register();
                        }
                    }
    </script>
</body>
</html>
