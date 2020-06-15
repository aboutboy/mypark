<?php require 'header.php'; ?>
<!-- content -->
<div id="content" class="app-content" role="main">

    <div class="app-content-body ">

        <div class="bg-light lter b-b wrapper-md hidden-print">
            <h1 class="m-n font-thin h3">域名分类管理</h1>
        </div>
        <div class="wrapper-md control"><div class="panel panel-default">
                <div class="tab-container ng-isolate-scope">
                    <ul class="nav nav-tabs">
                        <li class="ng-isolate-scope <?php
                        if ($_GET['do'] == null) {
                            echo 'active';
                        }
                        ?>">
                            <a href="class" class="ng-binding">域名分类</a>
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
                                    echo '添加分类';
                                } else {
                                    echo '编辑分类';
                                }
                                ?></a>
                        </li>
                        <li class="ng-isolate-scope pull-right">
                            <a href="domain" class="ng-binding">管理域名</a>
                        </li>
                    </ul>

                    <?php if ($_GET['do'] == 'add' || $_GET['do'] == 'edit') { ?>
                        <div class="panel-body">
                            <form class="form-horizontal devform" method="post" action="?do=<?php
                            if ($_GET['do'] == 'add') {
                                echo 'adds';
                            } elseif ($_GET['do'] == 'edit') {
                                echo 'edits&id=' . $row['id'];
                            }
                            ?>">
                                <div class="form-group form-inline">
                                    <label class="col-sm-2 control-label">上级分类</label>
                                    <div class="col-sm-9">
                                        <select class="input-sm form-control" name="tid">
                                            <option value="0" <?php
                                            if (@$row['tid'] == '0') {
                                                echo 'selected';
                                            }
                                            ?>>顶级分类</option>
                                                    <?php
                                                    $list = categoryTree($rows, 0, 0);
                                                    echo showSelect($list, $row['tid'], $_GET['id'], $row['id']);
                                                    ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group form-inline">
                                    <label class="col-sm-2 control-label">分类名称</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="name" value="<?= @$row['name'] ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">分类描述</label>
                                    <div class="col-sm-9">
                                        <textarea name="info" rows="3" class="form-control"><?= @$row['info'] ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                <label class="col-sm-2 control-label">状态</label>
                                <div class="col-sm-9">
                                    <div class="radio">
                                        <label class="i-checks">
                                            <input type="radio" name="status" value="1" <?php if($row['status']==1){echo 'checked=""';} ?>>
                                            <i></i> 正常 </label>
                                        <label class="i-checks">
                                            <input type="radio" name="status" value="2" <?php if($row['status']==2){echo 'checked=""';} ?>>
                                            <i></i> 隐藏 </label>
                                        <label class="i-checks">
                                            <input type="radio" name="status" value="-1" <?php if($row['status']==-1){echo 'checked=""';} ?>>
                                            <i></i> 禁用 </label>
                                    </div>
                                </div>
                            </div>
                                <div class="form-group form-inline">
                                    <label class="col-sm-2 control-label">排序</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="sort" value="<?= @$row['sort'] ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-1"><input type="submit" name="submit" value="确定提交" class="btn btn-primary form-control"/> </div>

                                    <div class="line line-dashed b-b line-lg pull-in"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2"></label>
                                        <div class="col-sm-6">
                                            <h4><span class="glyphicon glyphicon-info-sign"></span>注意事项</h4>
                                            1.顶级分类请选择无模型，仅分类功能！<br/>
                                            2.如果子分类也选择无模型将没用丰富的模型字段信息。<br/>
                                            3.如如在跳转中填写信息，此分类将会使用跳转功能。</div>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="panel-heading font-bold">
                    <a href="?do=add" class="btn btn-sm btn-success btn-addon"><i class="fa fa-plus"></i>添加分类</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead><tr><th>排序</th><th>分类ID</th><th>分类名称</th><th>分类描述</th><th>操作</th></tr></thead>
                        <tbody>
                            <?php
                            $list = categoryTree($rows, 0, 0);
                            echo showlist($list);
                            ?>
                        </tbody>
                    </table>
                    　<a href="javascript:sort()" class="btn btn-default"  id="button">保存排序</a>
                </div>
            <?php } ?>
        </div>
    </div>

</div>
</div>

</div>
<!-- /content -->
<?php require 'footer.php'; ?>

<script>
    function sort() {
        var id = document.getElementsByName('id');
        var value = new Array();
        for (var i = 0; i < id.length; i++) {
            if (id[i].value)
                value.push(id[i].value);
        }
        var ids = value;
        var sort = document.getElementsByName('sort');
        var values = new Array();
        for (var i = 0; i < sort.length; i++) {
            if (sort[i].value)
                values.push(sort[i].value);
        }
        var sorts = values;
        $.post('?do=sort', {
            id: ids,
            sort: sorts
        }, function (text) {
            layer.alert(text);
            setInterval(function () {
                window.location.reload();
            }, 1000);
        });
    }
</script>