<?php require 'header.php'; ?>

<!-- content -->
<div id="content" class="app-content" role="main">
    <div class="app-content-body ">

        <div class="bg-light lter b-b wrapper-md hidden-print">
            <h1 class="m-n font-thin h3">资料设置</h1>
        </div>
        <div class="wrapper-md control">
            <div class="panel panel-default">
                <div class="panel-heading font-bold">
                    用户资料设置
                </div>
                <div class="panel-body">
                    <form class="form-horizontal devform" method="post">

                        <div class="form-group form-inline">
                            <label class="col-sm-2 control-label">用户密码</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="password" name="password" value="<?= @$user['password'] ?>">
                            </div>
                        </div>
                        <div class="form-group form-inline">
                            <label class="col-sm-2 control-label">联系邮箱</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="email" name="email" value="<?= @$user['email'] ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">个人简介</label>
                            <div class="col-sm-9">
                                <textarea name="profile" id="profile" rows="3" class="form-control" style="width: 100%;"><?= @$user['profile'] ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">统计代码</label>
                            <div class="col-sm-9">
                                <textarea name="count" id="count" rows="3" class="form-control" style="width: 100%;"><?= @$user['statistic'] ?></textarea>
                            </div>
                        </div>

                        <div class="form-group"> 
                            <div class="col-sm-offset-2 col-sm-4"><a href="javascript:;" class="btn btn-primary btn-sm"  id="button">确定提交</a>

                            </div>
                    </form>
                    <div class="line line-dashed b-b line-lg pull-in"></div>
                    <div class="form-group">
                        <label class="col-sm-2"></label>
                        <div class="col-sm-6">
                            <h4><span class="glyphicon glyphicon-info-sign"></span>注意事项</h4>
                            1.后台路径请在系统中修改，请不要直接在app/admin修改，以免系统无法正常运行。<br>
                            2.后台密码位数不限，字符不限，设置后请妥善保存。<br>
                            3.域名白名单仅支持填写的域名，就算是子域名也需要填写。<br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</div>
<!-- /content -->
<?php require 'footer.php'; ?>
<script>
    //提交数据
    $("#button").on("click", function () {
        var password = $("input[name='password']").val();
        var email = $("input[name='email']").val();
        var profile = $("#profile").val();
        var count = $("#count").val();

        $.post('?do=sys', {
            password: password,
            email: email,
            profile: profile,
            count: count
        }, function (text) {
            layer.alert(text);
        });
    });
</script>  