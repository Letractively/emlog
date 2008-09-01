<?php
/**
 * Rss输出函数库
 * @copyright (c) 2008, Emlog All Rights Reserved
 * @version emlog-2.6.5
 */

//获取url地址
function GetURL()
{
	global $db_prefix;
	$path = $_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'];
	$path = str_replace("/rss.php","",$path);
	Return $path;
}
//获取日志信息
function GetBlog()
{
	global $db_prefix,$DB;
	$sql = "SELECT * FROM {$db_prefix}blog  WHERE hide='n' ORDER BY gid DESC limit 0,20";
	$result = $DB->query($sql);
	while($re = $DB->fetch_array($result))
	{
		$re['id'] 		= $re['gid'];
		$re['title']		= htmlspecialchars($re['title']);
		$re['date']		= $re['date'];
		$re['content']	= $re['content'];

		$blog[] = $re;
	}
	return $blog;
}
//获取日志数目
function GetBlogNum()
{
	$blog_t =  GetBlog();
	return count($blog_t);
}

$URL		= GetURL();
$site		=  $config_cache;
$blog		= GetBlog();
$blognum	 = GetBlogNum();
$author = $user_cache['name'];
?>