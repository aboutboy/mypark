<!DOCTYPE html>
<html lang="zh-cn" class="">
    <head>
        <meta charset="utf-8" />
        <title>后台管理 - 多域名管理系统 | Powered by 域名停靠系统</title>
        <meta name="description" content="app, web app, responsive, responsive layout, admin, admin panel, admin dashboard, flat, flat ui, ui kit, AngularJS, ui route, charts, widgets, components" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <link rel="stylesheet" href="/public/min/libs/assets/animate.css/animate.css" type="text/css" />
        <link rel="stylesheet" href="/public/min/libs/assets/font-awesome/css/font-awesome.min.css" type="text/css" />
        <link rel="stylesheet" href="/public/min/libs/assets/simple-line-icons/css/simple-line-icons.css" type="text/css" />
        <link rel="stylesheet" href="/public/min/libs/jquery/bootstrap/dist/css/bootstrap.css" type="text/css" />
        <link rel="stylesheet" href="/public/min/css/font.css" type="text/css" />
        <link rel="stylesheet" href="/public/min/css/app.css" type="text/css" />
        <style type="text/css">
            #down1, .adsbygoogle, #gaosu, [id^="gg_"], #con_all, #logo_m, #logo_r, #contsec, #contbot, .topk2, .logom.fl, #txtlink, .logor.fr, .blank6, .topimg {
                display: none !important;
                disiplay: none
            }
        </style>
    </head>
    <body>
        <div class="app app-header-fixed ">

            <!-- header -->
            <header id="header" class="app-header navbar" role="menu"> 
                <!-- navbar header -->
                <div class="navbar-header bg-dark">
                    <button class="pull-right visible-xs dk" ui-toggle-class="show" target=".navbar-collapse"> <i class="glyphicon glyphicon-cog"></i> </button>
                    <button class="pull-right visible-xs" ui-toggle-class="off-screen" target=".app-aside" ui-scroll="app"> <i class="glyphicon glyphicon-align-justify"></i> </button>
                    <!-- brand --> 
                    <a href="/<?= $_cp->url()[1] ?>" class="navbar-brand text-lt"> <img src="/public/min/img/logo.png"> <span class="hidden-folded m-l-xs">
                            ParkSys
                            <span class="text-muted text-xs">
                                v1.0
                            </span></span> </a> 
                    <!-- / brand --> 
                </div>
                <!-- / navbar header --> 

                <!-- navbar collapse -->
                <div class="collapse pos-rlt navbar-collapse box-shadow bg-white-only"> 
                    
                    <!-- link and dropdown -->
                    <ul class="nav navbar-nav hidden-sm">
                        <li><a href="/<?= $_cp->url()[1] ?>"><span><i class="fa fa-home"></i> 后台首页</span></a></li>
                        <li class="dropdown"> <a data-toggle="dropdown" class="dropdown-toggle"> <span class="font-bold">快捷操作</span><span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="/<?= $_cp->url()[1] ?>/system"><span><i class="icon-settings icon"></i> 系统设置</span></a></li>
                                <li><a href="/<?= $_cp->url()[1] ?>/domain"><span><i class="fa fa-sliders"></i> 域名管理</span></a></li>
                            </ul>
                        </li>
                    </ul>
                    <!-- / link and dropdown --> 

                    <!-- search form -->
                    <form class="navbar-form navbar-form-sm navbar-left shift">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control input-sm bg-light no-border rounded padder" placeholder="功能搜索">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-sm bg-light rounded"><i class="fa fa-search"></i></button>
                                </span> </div>
                        </div>
                    </form>
                    <!-- / search form --> 
                    <div class="btn no-shadow navbar-btn" style="position:absolute;z-index:1"><span class="label bg-danger"><?= @$_sysupdate ?></span> </div>
                    <!-- nabar right -->
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown"> <a href="/" target="_blank"> <i class="icon-home"> 前台首页</i></a> </li>
                        <li class="dropdown"> 
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle clear" data-toggle="dropdown"><span class="text-muted text-xs">超级管理员</span>
                                <span class="thumb-sm avatar pull-right m-t-n-sm m-b-n-sm m-l-sm"> <img src="/public/min/img/a0.jpg" alt="..."> <i class="on md b-white bottom"></i> </span> 
                                <b class="caret"></b> </a> 
                            <!-- dropdown -->
                            <ul class="dropdown-menu animated fadeInRight w">
                                <li> <a href="/<?= $_cp->url()[1] ?>/system"><span>系统设置</span></a> </li>
                                <li class="divider"></li>
                                <li> <a href="/<?= $_cp->url()[1] ?>/quit">注销登录</a> </li>
                            </ul>
                            <!-- / dropdown --> 
                        </li>
                    </ul>
                    <!-- / navbar right --> 
                </div>
                <!-- / navbar collapse --> 
            </header>
            <!-- / header --> 

            <!-- aside -->
            <aside id="aside" class="app-aside hidden-xs bg-dark">
                <div class="aside-wrap">
                    <div class="navi-wrap"> 
                        <!-- user -->

                        <!-- / user --> 

                        <!-- nav -->
                        <nav class="navi clearfix">
                            <ul class="nav">
                                <li class="hidden-folded padder m-t m-b-sm text-muted">
                                    <span class="ng-scope"><i class="icon-speedometer"></i> 控制面板</span>
                                </li>
                                <li <?php if($_cp->url()[2]=='index' || $_cp->url()[2]==''){echo 'class="active"';}?>> <a href="/<?= $_cp->url()[1] ?>/index" target="_self"> <i class="fa fa-home"></i><span class="font-bold ng-scope">后台首页</span></a></li>
                                <li <?php if($_cp->url()[2]=='system'){echo 'class="active"';}?>> <a href="/<?= $_cp->url()[1] ?>/system" target="_self"> <i class="icon-settings icon"></i><span class="font-bold ng-scope">系统设置</span></a></li>
                                <li <?php if($_cp->url()[2]=='domain'){echo 'class="active"';}?>> <a href="/<?= $_cp->url()[1] ?>/domain" target="_self"> <i class="fa fa-outdent"></i><span class="font-bold ng-scope">域名管理</span></a></li>
                                <li <?php if($_cp->url()[2]=='class'){echo 'class="active"';}?>> <a href="/<?= $_cp->url()[1] ?>/class" target="_self"> <i class="fa fa-sliders"></i><span class="font-bold ng-scope">域名分类</span></a></li>
                                <li <?php if($_cp->url()[2]=='registrar'){echo 'class="active"';}?>> <a href="/<?= $_cp->url()[1] ?>/registrar" target="_self"> <i class="fa fa-outdent"></i><span class="font-bold ng-scope">域名注册商</span></a></li>
                            </ul>
                        </nav>
                        <!-- nav --> 

                    </div>
                </div>
            </aside>
            <!-- / aside -->