<?php 
if(!defined('EMLOG_ROOT')) {exit('error!');}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">

	<title><?php echo $blogtitle;?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="Content-Language" content="zh-CN" />
	<meta name="description" content="$sitekey" />
	<meta name="keywords" content="emlog,blog,$sitekey" />
	<meta name="copyright" content="emlog" />
	<meta name="author" content="emlog" />

	<link rel="alternate" type="application/rss+xml" title="订阅我的博客"  href="./rss.php">
	<link href="<?php echo $tpl_dir;?>g7_v2/main.css" rel="stylesheet" type="text/css" />
	<script src="./lib/js/common_tpl.js" type="text/javascript">
	</script>
</head>
<body>
<div id="header">
	<div id="info"><h1><a href="./"><?php echo $blogname;?></a></h1></div>
	<div id="des"><?php echo $bloginfo;?></div>
	<div id="menu">
		<ul>
<?php if(ISLOGIN): ?>
	<li><a href="./adm/add_log.php">写日志</a></li>
	<li><a href="./adm/">管理中心</a></li>
	<li><a href="./index.php?action=logout">退出</a></li>
<?php endif; ?>
		</ul>
	</div>
</div>
<div id="sell">
<div id="top"></div>
<div id="page">
<?php
include getViews('side');
?>