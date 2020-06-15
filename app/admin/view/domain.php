<?php require 'header.php'; ?>
<?php if ($_GET['do'] == null) { ?>
    <!-- content -->
    <div id="content" class="app-content" role="main">

        <div class="app-content-body ">

            <div class="bg-light lter b-b wrapper-md hidden-print">
                <h1 class="m-n font-thin h3">域名管理</h1>
            </div>
            <div class="wrapper-md control"><div class="panel panel-default">
                    <div class="tab-container ng-isolate-scope">
                        <ul class="nav nav-tabs">

                            <li class="ng-isolate-scope">
                                <select class="input-sm form-control" style="height: 42px;line-height: 42px;" name="type" onchange="window.open(options[selectedIndex].value, '_self')">
                                    <option value="?cid=all">查看全部分类</option>
                                    <?php
                                    $list = categoryTree(DB('domain_class')->select());
                                    echo showSelect($list);
                                    ?>
                                </select>
                            </li>

                            <li class="ng-isolate-scope pull-right">
                                <a href="<?= $adminurl ?>domain_class" class="ng-binding">分类管理</a>
                            </li>
                        </ul> <div class="line" style="margin: 2px 0;"></div>
                        <form action="?cid=<?= $_GET['cid'] ?>&page=1" method="POST" class="form-inline">
                            <div class="form-group">
                                                　域名查询：
                            </div>
                            <div class="form-group">
                                <input type="text" class="input-sm form-control" name="search" value="<?= $_POST['search'] ?>">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-sm btn-default" type="submit">查询</button>　
                                <a href="domain?do=add&cid=<?= $_GET['cid'] ?>" class="btn btn-sm btn-success btn-addon"><i class="fa fa-plus"></i>添加</a>
                            </div>
                        </form>
                        <div class="line" style="margin: 2px 0;"></div>
                        <div class="panel-heading font-bold">当前共计(<?= $count ?>)条</div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead><tr><th>内容ID</th><th>注册商</th><th>所属分类</th><th>简称</th><th>域名</th><th>注册时间</th><th>到期时间</th><th>状态</th><th>操作</th></tr></thead>
                                <tbody>
                                    <?php
                                    foreach ($rows as $res) {
                                        if ($res['status'] == 1) {
                                            $status = '<font color="green">正常</font>';
                                        } elseif ($res['status'] == 2) {
                                            $status = '<font color="red">隐藏</font>';
                                        }
                                        echo '<tr><th>' . $res['id'] . '</th><th>' . $res['rname'] . '</th><th>' . $res['bname'] . '</th><th><a href="http://' . $res['domain'] . '" target="_blank">' . $res['name'] . '</a></th><th><a href="http://' . $res['domain'] . '" target="_blank">' . $res['domain'] . '</a></th><th>' . date('Y-m-d H:i:s', $res['regtime']) . '</th><th>' . date('Y-m-d H:i:s', $res['stoptime']) . '</th><th>' . $status . '</th><th><a href="' . $adminurl . 'domain?do=edit&id=' . $res['id'] . '&cid=' . $res['cid'] . '" class="btn btn-sm btn-info btn-addon"><i class="fa fa-edit"></i>编辑</a> <a href="' . $adminurl . 'domain?do=delete&id=' . $res['id'] . '&cid=' . $res['cid'] . '" class="btn btn-sm btn-danger btn-addon"> <i class="fa fa-trash-o"></i>删除</a></th></tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <?= pages($page, $class, $pages, '&cid=' . $_GET['cid']) ?>
                    </div>
                </div>

            </div>
        </div>

    </div>
<?php } else { ?>
    <script language="javascript" type="text/javascript" src="/public/min/My97/WdatePicker.js"></script>
    <!-- content -->
    <div id="content" class="app-content" role="main">

        <div class="app-content-body ">

            <div class="bg-light lter b-b wrapper-md hidden-print">
                <h1 class="m-n font-thin h3">域名管理</h1>
            </div>
            <div class="wrapper-md control"><div class="panel panel-default">
                    <div class="tab-container ng-isolate-scope">
                        <ul class="nav nav-tabs">
                            <li class="ng-isolate-scope">
                                <a href="domain" class="ng-binding">域名管理</a>
                            </li>
                            <li class="ng-isolate-scope <?php
                            if ($_GET['do'] == null) {
                                echo 'disabled';
                            } elseif ($_GET['do'] == 'add' || $_GET['do'] == 'edit') {
                                echo 'active';
                            }
                            ?>">
                                <a class="ng-binding"><?php
                                    if ($_GET['do'] == 'add') {
                                        echo '添加域名';
                                    } else {
                                        echo '编辑域名';
                                    }
                                    ?></a>
                            </li>
                            <li class="ng-isolate-scope pull-right">
                                <a href="class" class="ng-binding">管理分类</a>
                            </li>
                        </ul>
                        <div class="panel-body">
                            <form class="form-horizontal devform" method="post" action="?do=<?php
                            if ($_GET['do'] == 'add') {
                                echo 'adds&cid=' . $cid;
                            } elseif ($_GET['do'] == 'edit') {
                                echo 'edits&id=' . $row['id'] . '&cid=' . $cid;
                            }
                            ?>">

                                <div class="form-group form-inline">
                                    <label class="col-sm-2 control-label">所属</label>
                                    <div class="col-sm-9">
                                        分类 <select class="input-sm form-control" name="cid">
                                            <option value="0" <?php
                                            if (@$row['cid'] == '0' && $_GET['cid'] == null) {
                                                echo 'selected';
                                            }
                                            ?>>请选择分类</option>
                                                    <?php
                                                    $class = categoryTree(DB('domain_class')->select(), 0, 0);
                                                    echo showSelect($class, $row['cid']);
                                                    ?>
                                        </select>
                                        注册商 <select class="input-sm form-control" name="rid">
                                            <option value="0" <?php
                                            if (@$row['rid'] == '0' && $_GET['rid'] == null) {
                                                echo 'selected';
                                            }
                                            ?>>请选择</option>
                                                    <?php
                                                    foreach (DB('domain_registrar')->select() as $res){
                                                        if($row['rid']==$res['id']){
                                                            $selected = 'selected';
                                                        }else{
                                                            $selected = '';
                                                        }
                                                        echo '<option value="'.$res['id'].'" '.$selected.'>'.$res['name'].'</option>';
                                                    }
                                                    ?>
                                        </select>
                                    </div>
                                </div>
                                <?php
                                if ($_GET['do'] == 'edit') {
                                    echo '<input style="display:none" class="form-control" type="text" name="id" value="' . $row['id'] . '">';
                                }
                                ?>

                                <div class="form-group form-inline">
                                    <label class="col-sm-2 control-label">简标题</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="name" value="<?= $row['name'] ?>">
                                    </div>
                                </div>
                                <div class="form-group form-inline">
                                    <label class="col-sm-2 control-label">域名</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="domain" value="<?= $row['domain'] ?>">
                                        不含www与http
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">标题</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="title" value="<?= $row['title'] ?>">
                                    </div>
                                </div>

                                <div class="form-group form-inline">
                                    <label class="col-sm-2 control-label">综合项目</label>
                                    <div class="col-sm-9">
                                        注册时间：<input class="form-control" type="text" name="regtime" value="<?php
                                        if ($_GET['do'] == 'edit') {
                                            echo date('Y-m-d H:i:s', $row['regtime']);
                                            //$disabled = 'disabled';
                                        } else {
                                            echo date('Y-m-d H:i:s');
                                        }
                                        ?>" <?= $disabled ?> onClick="WdatePicker({el: this, dateFmt: 'yyyy-MM-dd HH:mm:ss'})">
                                        到期时间：<input class="form-control" type="text" name="stoptime" value="<?= date('Y-m-d H:i:s', $row['stoptime']) ?>" onClick="WdatePicker({el: this, dateFmt: 'yyyy-MM-dd HH:mm:ss'})">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">关键词</label>
                                    <div class="col-sm-10">
                                        <input name="keywords" ui-jq="tagsinput" ui-options="" class="form-control w-md" value="<?= $row['keywords'] ?>" /> 
                                        <span class="help-block m-b-none">输入英文逗号或回车进行分隔!</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">内容描述</label>
                                    <div class="col-sm-9">
                                        <textarea name="description" rows="3" class="form-control"><?= $row['description'] ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">LOGO</label>
                                    <div class="col-sm-9">
                                        <input class="ke-input-text form-control w-md" style="background-color:#fff;line-height: 34px;height: 34px;" type="text" name="logo" id="url" value="<?= @$row['logo'] ?>" >
                                        <input type="button" id="uploadButton" value="选择文件" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">内容</label>
                                    <div class="col-sm-9">
                                        <textarea cols="0" rows="5" name="data" class="form-control" id="kindeditor" style="margin: 0px -0.5px 0px 0px; height: 300px; width:100%;"><?= unserialize(base64_decode($row['data'])) ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group form-inline">
                                    <label class="col-sm-2 control-label">跳转</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="url" style="width: 300px;" value="<?= $row['url'] ?>"> <code>填写后将会301形式直接跳转到此网址</code>
                                    </div>
                                </div>
                                <div class="form-group form-inline">
                                    <label class="col-sm-2 control-label">邮箱</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="email" name="email" style="width: 300px;" value="<?= $row['email'] ?>"> <code>域名联系邮箱</code>
                                    </div>
                                </div>
                                <div class="form-group form-inline">
                                    <label class="col-sm-2 control-label">QQ</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="qq" style="width: 300px;" value="<?= $row['qq'] ?>"> <code>域名联系QQ</code>
                                    </div>
                                </div>
                                <div class="form-group form-inline">
                                    <label class="col-sm-2 control-label">电话</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="tel" style="width: 300px;" value="<?= $row['tel'] ?>"> <code>域名联系电话</code>
                                    </div>
                                </div>
                                <div class="form-group form-inline">
                                    <label class="col-sm-2 control-label">手机</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="mobile" style="width: 300px;" value="<?= $row['mobile'] ?>"> <code>域名联系手机</code>
                                    </div>
                                </div>
                                <div class="form-group form-inline">
                                    <label class="col-sm-2 control-label">售价</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="price" style="width: 300px;" value="<?= $row['price'] ?>"> <code>域名出售价格</code>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">状态</label>
                                    <div class="col-sm-9">
                                        <label class="i-switch m-t-xs m-r">
                                            <input type="checkbox" name="status" value="1" <?php
                                            if (@$row['status'] == 1) {
                                                echo 'checked';
                                            } elseif (@$row['status'] == null) {
                                                echo 'checked';
                                            }
                                            ?>>
                                            <i></i>
                                        </label>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-1"><input type="submit" name="submit" value="确定提交" class="btn btn-primary form-control"/> </div>

                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    </div>
    <!-- /content -->
    <script charset="utf-8" src="/public/min/kindeditor/kindeditor-all-min.js"></script>
    <script charset="utf-8" src="/public/min/kindeditor/lang/zh-CN.js"></script>
    <script>
                                            KindEditor.ready(function (K) {
                                                var uploadbutton = K.uploadbutton({
                                                    button: K('#uploadButton')[0],
                                                    fieldName: 'imgFile',
                                                    url: 'upload_json?dir=image',
                                                    afterUpload: function (data) {
                                                        if (data.error === 0) {
                                                            var url = K.formatUrl(data.url, 'absolute');
                                                            K('#url').val(url);
                                                        } else {
                                                            alert(data.message);
                                                        }
                                                    },
                                                    afterError: function (str) {
                                                        alert('系统内部错误: ' + str);
                                                    }
                                                });
                                                uploadbutton.fileBox.change(function (e) {
                                                    uploadbutton.submit();
                                                });
                                            });

                                            initkindEditor();
                                            //初始化富文本
                                            function initkindEditor() {
                                                KindEditor.ready(function (K) {
                                                    var editor = K.create('#kindeditor', {
                                                        themeType: "simple",
                                                        uploadJson: 'upload_json?action=upload_base',
                                                        resizeType: 1,
                                                        pasteType: 2,
                                                        syncType: "",
                                                        filterMode: true,
                                                        allowPreviewEmoticons: false,
                                                        items: [
                                                            'source', 'undo', 'redo', 'plainpaste', 'wordpaste', 'clearhtml', 'quickformat',
                                                            'selectall', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor',
                                                            'bold', 'italic', 'underline', 'hr', 'removeformat', '|', 'justifyleft', 'justifycenter',
                                                            'justifyright', 'insertorderedlist', 'insertunorderedlist', '|', 'image', 'multiimage', 'link',
                                                            'unlink', 'baidumap', 'emoticons', '|', 'fullscreen'
                                                        ],
                                                        afterCreate: function () {
                                                            this.sync();
                                                        },
                                                        afterBlur: function () {
                                                            this.sync();
                                                        },
                                                        afterUpload: function (url) {
                                                            //上传图片后的代码
                                                        },
                                                        allowFileManager: false,
                                                        allowFlashUpload: false,
                                                        allowMediaUpload: false,
                                                        allowFileUpload: false
                                                    });
                                                });
                                            }
    </script>
    <!-- /content -->
<?php } require 'footer.php'; ?>