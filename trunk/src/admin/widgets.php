<?php
/**
 * Widgets 侧边栏目管理
 * @copyright (c) 2008, Emlog All Rights Reserved
 * @version emlog-3.0.1
 * $Id: comment.php 654 2008-09-07 10:36:15Z emloog $
 */

require_once('./globals.php');

//显示组件管理面板
if($action == '')
{
	$wgNum = isset($_GET['wg']) ? intval($_GET['wg']) : 1;
	$widgets = $options_cache['widgets'.$wgNum] ? @unserialize($options_cache['widgets'.$wgNum]) : array();
	$widgetTitle = $options_cache['widget_title'] ? @unserialize($options_cache['widget_title']) : array();
	$custom_widget = $options_cache['custom_widget'] ? @unserialize($options_cache['custom_widget']) : array();

	$customWgTitle = array();
	foreach ($widgetTitle as $key => $val)
	{
		if(preg_match("/^.*\s\((.*)\)/", $val, $matchs))
		{
			$customWgTitle[$key] = $matchs[1];
		}else{
			$customWgTitle[$key] = $val;
		}
	}

	//music
	$music = @unserialize($options_cache['music']);
	if(isset($music['auto']) && $music['auto'])
	{
		$auto1 = "checked=\"checked\"";
		$auto2 = '';
	}else{
		$auto2 = "checked=\"checked\"";
		$auto1 = '';
	}
	if(isset($music['randplay']) && $music['randplay'])
	{
		$randplay1 = "checked=\"checked\"";
		$randplay2 = '';
	}else{
		$randplay2 = "checked=\"checked\"";
		$randplay1 = '';
	}
	$content = '';
	if(isset($music['mlinks']) && $music['mlinks'])
	{
		foreach($music['mlinks'] as $key=>$val)
		{
			$content .= urldecode($val)."\t".$music['mdes'][$key]."\n";
		}
	}

	include getViews('header');
	require_once(getViews('widgets'));
	include getViews('footer');
	cleanPage();
}

//修改组件设置
if($action == 'setwg')
{
	$widgetTitle = @unserialize($options_cache['widget_title']);//当前所有组件标题
	$custom_widget = $options_cache['custom_widget'] ? @unserialize($options_cache['custom_widget']) : array();
	$widget = isset($_GET['wg']) ? $_GET['wg'] : '';			//组件标识符
	$wgTitle = isset($_POST['title']) ? $_POST['title'] : '';	//新组件名

	preg_match("/^(.*)\s\(.*/", $widgetTitle[$widget], $matchs);
	$realWgTitle = isset($matchs[1]) ? $matchs[1] : $widgetTitle[$widget];

	$widgetTitle[$widget] = $realWgTitle != $wgTitle ? $realWgTitle.' ('.$wgTitle.')' : $realWgTitle;
	$widgetTitle = addslashes(serialize($widgetTitle));

	$DB->query("update ".DB_PREFIX."options set option_value='$widgetTitle' where option_name='widget_title'");

	switch ($widget)
	{
		case 'newcomm':
			$index_comnum = isset($_POST['index_comnum']) ? intval($_POST['index_comnum']) : 10;
			$comment_subnum = isset($_POST['comment_subnum']) ? intval($_POST['comment_subnum']) : 20;
			$DB->query("update ".DB_PREFIX."options set option_value='$index_comnum' where option_name='index_comnum'");
			$DB->query("update ".DB_PREFIX."options set option_value='$comment_subnum' where option_name='comment_subnum'");
			break;
		case 'twitter':
			$index_twnum = isset($_POST['index_twnum']) ? intval($_POST['index_twnum']) : 10;
			$DB->query("update ".DB_PREFIX."options set option_value='$index_twnum' where option_name='index_twnum'");
			break;
		case 'newlog':
			$index_newlog = isset($_POST['index_newlog']) ? intval($_POST['index_newlog']) : 10;
			$DB->query("update ".DB_PREFIX."options set option_value='$index_newlog' where option_name='index_newlognum'");
			break;
		case 'random_log':
			$index_randlognum = isset($_POST['index_randlognum']) ? intval($_POST['index_randlognum']) : 20;
			$DB->query("update ".DB_PREFIX."options set option_value='$index_randlognum' where option_name='index_randlognum'");
			break;
		case 'music':
			$links = isset($_POST['mlinks']) ? htmlspecialchars(trim($_POST['mlinks'])) : '';
			$randplay = isset($_POST['randplay']) ? intval($_POST['randplay']) : 0;
			$auto = isset($_POST['auto']) ? intval($_POST['auto']) : 0;
			$music = array(
			'mlinks'=>array(),
			'mdes'=>array(),
			'auto'=>$auto,
			'randplay'=>$randplay
			);
			if($links)
			{
				$links = explode("\n",$links);
				foreach($links as $val)
				{
					$val = str_replace(array("\r","\n"),array('',''),$val);
					if(preg_match("/^(http:\/\/).+/i",$val)>0)
					{
						$mstr = preg_split ("/[\s,]+/", $val,2);
						$music['mlinks'][] = urlencode($mstr[0]);
						if(count($mstr) == 2)
						{
							$music['mdes'][] = $mstr[1];
						}else {
							$music['mdes'][] = '';
						}
					}else{
						formMsg('有错误的音乐链接格式','javascript: window.history.back()',0);
					}
				}
			}
			$musicData = serialize($music);
			$DB->query("update ".DB_PREFIX."options set option_value='$musicData' where option_name='music'");
			break;
		case 'custom_text':
			$title = isset($_POST['title']) ? addslashes($_POST['title']) : '';
			$content = isset($_POST['content']) ? addslashes($_POST['content']) : '';
			$custom_wg_id = isset($_POST['custom_wg_id']) ? addslashes($_POST['custom_wg_id']) : '';
			$new_title = isset($_POST['new_title']) ? addslashes($_POST['new_title']) : '';
			$new_content = isset($_POST['new_content']) ? addslashes($_POST['new_content']) : '';
			//添加新自定义组件
			if($new_title && $new_content)
			{
				$custom_wg_index = count($custom_widget)+1;
				$custom_wg_index = 'custom_wg_'.$custom_wg_index;
				$custom_widget[$custom_wg_index] = array('title'=>$new_title,'content'=>$new_content);
				$custom_widget_str = serialize($custom_widget);
				$DB->query("update ".DB_PREFIX."options set option_value='$custom_widget_str' where option_name='custom_widget'");
			}elseif ($title && $content){
				$custom_widget[$custom_wg_id] = array('title'=>$title,'content'=>$content);
				$custom_widget_str = serialize($custom_widget);
				$DB->query("update ".DB_PREFIX."options set option_value='$custom_widget_str' where option_name='custom_widget'");
			}
			break;
	}
	$CACHE->mc_options();
	$CACHE->mc_comment();
	$CACHE->mc_twitter();
	$CACHE->mc_newlog();
	header("Location: ./widgets.php?activated=true");
}

//保存组件排序
if($action == 'compages')
{
	$wgNum = isset($_POST['wgnum']) ? intval($_POST['wgnum']) : 1;//侧边栏编号 1、2、3 ……

	$widgets = isset($_POST['widgets'.$wgNum]) ? serialize($_POST['widgets'.$wgNum]) : '';
	//自定义组件
	$customTextTitle = isset($_POST['custom_title'.$wgNum]) ? addslashes(serialize($_POST['custom_title'.$wgNum])) : '';
	$customTextContent = isset($_POST['custom_text'.$wgNum]) ? addslashes(serialize($_POST['custom_text'.$wgNum])) : '';

	$DB->query("update ".DB_PREFIX."options set option_value='$widgets' where option_name='widgets{$wgNum}'");
	$DB->query("update ".DB_PREFIX."options set option_value='$customTextTitle' where option_name='custom_title{$wgNum}'");
	$DB->query("update ".DB_PREFIX."options set option_value='$customTextContent' where option_name='custom_content{$wgNum}'");
	$CACHE->mc_options();
	header("Location: ./widgets.php?activated=true&wg=$wgNum");
}

?>