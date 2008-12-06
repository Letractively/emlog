<?php
/**
 * 前端页面加载主程序
 * @copyright (c) 2008, Emlog All Rights Reserved
 * @version emlog-3.0.0
 * $Id$
 */

require_once('./common.php');

viewCount();

define('CURPAGE','index');

//当前模板目录
$em_tpldir = $tpl_dir.$nonce_templet.'/';
if (!is_dir($em_tpldir))
{
	exit('Template Error: no template directory!');
}
$blogtitle = $blogname;
$calendar_url = isset($_GET['record']) ? 'calendar.php?record='.intval($_GET['record']) : 'calendar.php?' ;
$job = array('showlog','search','addcom','taglog','');
if (!in_array($action,$job))
{
	msg('error!','./index.php');
}
//日志列表
if (!isset($action) || empty($action))
{
	require_once(EMLOG_ROOT.'/model/C_blog.php');
	require_once(EMLOG_ROOT.'/model/C_tag.php');

	$emBlog = new emBlog($DB);
	$emTag = new emTag($DB);

	$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
	$record = isset($_GET['record']) ? intval($_GET['record']) : '' ;
	$tag = isset($_GET['tag']) ? addslashes(strval(trim($_GET['tag']))) : '';
	$sortid = isset($_GET['sort']) ? intval($_GET['sort']) : '';
	$keyword = isset($_GET['keyword']) ? addslashes(trim($_GET['keyword'])) : '';

	$start_limit = ($page - 1) * $index_lognum;
	$pageurl= './index.php';

	if ($record)
	{
		$blogtitle = $blogname.' - '.$record;
		$sqlSegment = "and from_unixtime(date, '%Y%m%d') LIKE '%".$record."%' order by top desc ,date desc";
		$lognum = $emBlog->getLogNum('n', $sqlSegment);
		$pageurl .= "?record=$record&page";
	} elseif ($tag) {
		$blogtitle = $blogname.' - '.$tag;
		$blogIdStr = $emTag->getTagByName($tag);
		if($blogIdStr === false)
		{
			msg('不存在该标签','./index.php');
		}
		$sqlSegment = "and gid IN ($blogIdStr) order by date desc";
		$lognum = $emBlog->getLogNum('n', $sqlSegment);
		$pageurl .= '?tag='.urlencode($tag).'&page';
	} elseif($keyword) {
		$keyword = str_replace('%','\%',$keyword);
		$keyword = str_replace('_','\_',$keyword);
		if (strlen($keyword) > 30 || strlen($keyword) < 3)
		{
			msg('错误的关键字长度','./index.php');
		}
		$sqlSegment = "and title like '%{$keyword}%' order by date desc";
		$lognum = $emBlog->getLogNum('n', $sqlSegment);
		$pageurl .= '?keyword='.urlencode($keyword).'&page';
	} elseif($sortid) {
		$sqlSegment = "and sortid=$sortid order by date desc";
		$lognum = $emBlog->getLogNum('n', $sqlSegment);
		$pageurl .= "?sort=$sortid&page";
	} else {
		$sqlSegment ="ORDER BY top DESC ,date DESC";
		$lognum = $emBlog->getLogNum('n', $sqlSegment);
		$pageurl .= "?page";
	}
	$logs = $emBlog->getLog($sqlSegment, 'n', $page, $index_lognum, 'homepage');
	$page_url = pagination($lognum, $index_lognum, $page, $pageurl);

	include getViews('header');
	include getViews('log_list');
}
//显示日志
if ($action == 'showlog')
{
	require_once(EMLOG_ROOT.'/model/C_blog.php');
	require_once(EMLOG_ROOT.'/model/C_comment.php');
	require_once(EMLOG_ROOT.'/model/C_trackback.php');

	isset($_GET['gid']) ? $logid = intval($_GET['gid']) : msg('提交参数错误','./index.php');

	$emBlog = new emBlog($DB);
	$emComment = new emComment($DB);
	$emTrackback = new emTrackback($DB);

	$logData = $emBlog->getOneLog($logid, 'n', 'homepage');
	if($logData === false)
	{
		msg('不存在该日志','./index.php');
	}
	extract($logData);
	$blogtitle = $blogname.' - '.$log_title;
	$log_author = $user_cache['name'];
	$blogurl    = $blogurl;
	//add viewcount
	$emBlog->updateViewCount($logid);
	//neighborlog
	$neighborLog = $emBlog->neighborLog($logid);
	extract($neighborLog);
	//comments
	$cheackimg = $comment_code == 'y' ? "<img src=\"./lib/C_checkcode.php\" align=\"absmiddle\" /><input name=\"imgcode\"  type=\"text\" class=\"input\" size=\"5\">" : '';
	$ckname = isset($_COOKIE['commentposter']) ? htmlspecialchars(stripslashes($_COOKIE['commentposter'])) : '';
	$ckmail = isset($_COOKIE['postermail']) ? $_COOKIE['postermail'] : '';
	$ckurl = isset($_COOKIE['posterurl']) ? $_COOKIE['posterurl'] : '';
	$comments = $emComment->getComment($logid, 'n');
	//trackback
	$tb = $emTrackback->getTrackback(null, $logid);

	include getViews('header');
	require_once getViews('echo_log');
}
//添加评论
if ($action == 'addcom')
{
	require_once(EMLOG_ROOT.'/model/C_comment.php');

	$emComment = new emComment($DB);
	$comment = isset($_POST['comment']) ? addslashes(trim($_POST['comment'])) : '';
	$commail = isset($_POST['commail']) ? addslashes(trim($_POST['commail'])) : '';
	$comurl = isset($_POST['comurl']) ? addslashes(trim($_POST['comurl'])) : '';
	$comname = isset($_POST['comname']) ? addslashes(trim($_POST['comname'])) : '';
	$imgcode = strtoupper(trim(isset($_POST['imgcode']) ? $_POST['imgcode'] : ''));
	$gid = isset($_POST['gid']) ? intval($_POST['gid']) : '';

	$ret = $emComment->addComment($comname, $comment, $commail, $comurl, $imgcode, $comment_code, $ischkcomment, $localdate, $gid);
	
	if($ret === 0)
	{
		$CACHE->mc_sta();
		$CACHE->mc_comment();
		msg('评论发表成功!',"?action=showlog&gid=$gid#comment");
	}elseif ($ret === 1){
		msg('评论发表成功!请等待管理员审核!',"?action=showlog&gid=$gid#comment");
	}
}

cleanPage(true);

?>
