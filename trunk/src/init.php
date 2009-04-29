<?php
/**
 * 博客全局项加载
 * @copyright (c) Emlog All Rights Reserved
 * @version emlog-3.1.0
 * $Id: init.php 966 2009-03-06 10:00:43Z emloog $
 */

error_reporting(E_ALL);
ob_start();

require_once('config.php');
require_once(EMLOG_ROOT.'/lib/F_base.php');
require_once(EMLOG_ROOT.'/lib/F_login.php');
require_once(EMLOG_ROOT.'/lib/C_cache.php');
require_once(EMLOG_ROOT.'/lib/C_mysql.php');

//定义输出编码
header('Content-Type: text/html; charset=UTF-8');
//去除多余的转义字符
doStripslashes();
//数据库操作对象
$DB = new MySql(DB_HOST, DB_USER, DB_PASSWD,DB_NAME);
//缓存生成对象
$CACHE = new mkcache($DB,DB_PREFIX);
//读取配置参数
$options_cache = $CACHE->readCache('options');
extract($options_cache);
$timezone  = intval($timezone);
//获取操作
$action = isset($_GET['action']) ? addslashes($_GET['action']) : '';
//获取时间
$localdate = time() - ($timezone-8) * 3600;
//加载插件
$active_plugins = unserialize($active_plugins);
if ($active_plugins && is_array($active_plugins))
{
	foreach($active_plugins as $plugin)
	{
		if($plugin != '' && file_exists(EMLOG_ROOT . '/content/plugins/' . $plugin))
		{
			include_once(EMLOG_ROOT . '/content/plugins/' . $plugin);
		}
	}
}

?>