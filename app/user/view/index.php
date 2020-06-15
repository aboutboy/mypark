<?php require 'header.php';?>
  <!-- content -->
  <div id="content" class="app-content" role="main">
  	<div class="app-content-body ">

<div class="hbox hbox-auto-xs hbox-auto-sm" ng-init="
    app.settings.asideFolded = false; 
    app.settings.asideDock = false;
  ">
  <!-- main -->
  <div class="col">
    <!-- main header -->
    <div class="bg-light lter b-b wrapper-md">
      <div class="row">
        <div class="col-sm-4 col-xs-12">
          <h1 class="m-n font-thin h3 text-black">系统管理中心</h1>
          <small class="text-muted">欢迎使用域名停靠系统系统所开发的产品</small>
        </div>
       
      </div>
    </div>
    <!-- / main header -->
    <div class="wrapper-md" ng-controller="FlotChartDemoCtrl">
    
      <!-- tasks -->
        <div class="panel">
            <div class="wrapper-lg">
                <h2 class="m-t-none"><a href="#" target="_blank">使用帮助</a></h2>
                <div>
                    <p>1.先在后台添加域名</p>
                    <p>2.再去修改你的域名解析，将域名CNAME到yqkxs.com</p>
                    <p>3.大功告成，最好在资料设置中填入自己的邮箱和统计代码</p>
                </div>
                <div class="line line-lg b-b b-light"></div>
                <div class="text-muted">
                    <i class="fa fa-user text-muted"></i> 作者 <a href="#" target="_blank" class="m-r-sm">管理员</a>
                    <i class="fa fa-clock-o text-muted"></i> 2020-06-09
                </div>
            </div>
        </div>
      <!-- / tasks -->
    </div>
  </div>
  <!-- / main -->
  <!-- right col -->

  <!-- / right col -->
</div>



	</div>
  </div>
  <!-- /content -->
  
<?php require 'footer.php';?>