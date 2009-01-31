<?php
if(!defined('EMLOG_ROOT')) {exit('error!');}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="keywords" content="<?php echo $site_key; ?>" />
<meta name="generator" content="emlog" />
<title><?php echo $blogtitle; ?></title>
<link rel="alternate" type="application/rss+xml" title="订阅我的博客"  href="./rss.php">
<link href="<?php echo $em_tpldir; ?>main.css" rel="stylesheet" type="text/css" />
<script src="./lib/js/common_tpl.js" type="text/javascript"></script>
<!--[if IE ]>
<link type="text/css" rel="stylesheet" media="screen" href="<?php echo $em_tpldir; ?>ie.css" />
<![endif]-->
</head>
<body>
	<div class="top-line"><div class="bottom-line">
    <div id="root">
        <div id="header">
            <div class="content">
                <h1><a href="./"><?php echo $blogname; ?></a></h1>
                <div class="description"><?php echo $bloginfo; ?></div>
				<ul id="nav-bar">               
                <?php if(ISLOGIN): ?>
					<li><a href="./index.php">首页</a></li>
                    <li class="page_item page-item-2"><a href="./admin/add_log.php">写日志</a></li>
                    <li class="page_item page-item-2"><a href="./admin/">管理中心</a></li>
					<li class="page_item page-item-2"><a href="./admin/index.php?action=logout">退出</a></li>
                    <?php else: ?>
					<li><a href="./index.php">首页</a></li>
					<li><a href="./admin/index.php">登录</a></li>
                <?php endif; ?>
				</ul>
                <form id="searchform" name="keyform" method="get" action="index.php">
                    <div><input type="text" value="" name="keyword" id="s" class="text" /><input type="submit" value="Search" class="button" /></div>
                </form>
            </div>
        </div><!--#header-->
