<?php
if(!defined('EMLOG_ROOT')) {exit('error!');}
require_once (getViews('module'));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="keywords" content="<?php echo $site_key; ?>" />
<meta name="generator" content="emlog" />
<title><?php echo $blogtitle; ?></title>
<link rel="alternate" type="application/rss+xml" title="RSS"  href="<?php echo BLOG_URL; ?>rss.php">
<link href="<?php echo CERTEMPLATE_URL; ?>/main.css" rel="stylesheet" type="text/css" />
<script src="<?php echo BLOG_URL; ?>lib/js/common_tpl.js" type="text/javascript"></script>
<?php doAction('index_head'); ?>
</head>
<body>
<!-- wrap START -->
<div id="wrap">

<!-- container START -->
<div id="container">

<!-- header START -->
<div id="header">
	<div id="caption">
		<h1 id="title"><a href="./"><?php echo $blogname; ?></a></h1>
		<div id="tagline"><?php echo $bloginfo; ?></div>
	</div>

	<!-- navigation START -->
	<div id="navigation">
			<ul id="menus">
				<li class="current_page_item"><a href="./">首页</a></li>
				<?php foreach ($navibar as $key => $val):
				if ($val['hide'] == 'y'){continue;}
				if (empty($val['url'])){$val['url'] = './?post='.$key;}
				?>
				<li class="page_item page-item-2"><a href="<?php echo $val['url']; ?>" target="<?php echo $val['is_blank']; ?>"><?php echo $val['title']; ?></a></li>
				<?php endforeach;?>
				<?php doAction('navbar', '<li class="page_item page-item-2">', '</li>'); ?>
				<?php if(ROLE == 'admin' || ROLE == 'writer'): ?>
				<li class="page_item page-item-2"><a href="./admin/write_log.php">写日志</a></li>
				<li class="page_item page-item-2"><a href="./admin/">管理中心</a></li>
				<li class="page_item page-item-2"><a href="./admin/?action=logout">退出</a></li>
				<?php else: ?>
				<li class="page_item page-item-2"><a href="./admin/">登录</a></li>
				<?php endif; ?>
			</ul>

		<!-- searchbox START -->
		<div id="searchbox">
							<form name="keyform" method="get" action="./">
					<div class="content">
						<input class="textfield" name="keyword"  type="text" value="" style="width:130px;"/>
						<span class="switcher" >切换搜索引擎</span>
					</div>
				</form>
					</div>
		<!-- searchbox END -->

		<div class="fixed"></div>
	</div>
	<!-- navigation END -->

	<div class="fixed"></div>
</div>
<!-- header END -->
<!-- content START -->
<div id="content">

	<!-- main START -->
	<div id="main">