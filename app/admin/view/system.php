<?php require 'header.php'; ?>

<!-- content -->
<div id="content" class="app-content" role="main">
    <div class="app-content-body ">

        <div class="bg-light lter b-b wrapper-md hidden-print">
            <h1 class="m-n font-thin h3">系统设置</h1>
        </div>
        <div class="wrapper-md control">
            <div class="panel panel-default">
                <div class="panel-heading font-bold">
                    系统设置信息
                </div>
                <div class="panel-body">
                    <form class="form-horizontal devform" method="post">

                        <div class="form-group form-inline">
                            <label class="col-sm-2 control-label">后台路径</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="adminurl" value="<?= @$sys['adminurl'] ?>"> 不修改，请保持不变即可。
                            </div>
                        </div>
                        <div class="form-group form-inline">
                            <label class="col-sm-2 control-label">后台密码</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="admin" value="<?= @$sys['admin'] ?>">
                            </div>
                        </div>
                        <div class="form-group form-inline">
                            <label class="col-sm-2 control-label">管理员邮箱</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="email" name="email" value="<?= @$sys['email'] ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">未在系统域名提示</label>
                            <div class="col-sm-9">
                                <textarea name="null" id="null" rows="3" class="form-control" style="width: 100%;"><?= @$sys['null'] ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">站长简介</label>
                            <div class="col-sm-9">
                                <textarea name="profile" id="profile" rows="3" class="form-control" style="width: 100%;"><?= @$sys['profile'] ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">统计代码</label>
                            <div class="col-sm-9">
                                <textarea name="count" id="count" rows="3" class="form-control" style="width: 100%;"><?= @$sys['count'] ?></textarea>
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
        var adminurl = $("input[name='adminurl']").val();
        var admin = $("input[name='admin']").val();
        var email = $("input[name='email']").val();
        var nulls = $("#null").val();
        var profile = $("#profile").val();
        var count = $("#count").val();
       
        if (adminurl == '') {
            layer.alert('后台路径不能为空！');
            exit;
        } else if (admin == '') {
            layer.alert('后台密码不能为空！');
            exit;
        } else {
            $.post('?do=sys', {
                adminurl: adminurl,
                admin: admin,
                email: email,
                null: nulls,
                profile: profile,
                count: count
            }, function (text) {
                layer.alert(text);
            });
        }
    });
</script>  