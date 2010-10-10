<?php
/**
 * RSS输出
 * @copyright (c) Emlog All Rights Reserved
 * $Id$
 */

require_once './init.php';

header('Content-type: application/xml');

$sort = isset($_GET['sort']) ? intval($_GET['sort']) : '';

$URL = BLOG_URL;
$blog = GetBlog($sort);

echo '<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0">
<channel>
<title><![CDATA['.Option::get('blogname').']]></title> 
<description><![CDATA['.Option::get('bloginfo').']]></description>
<link>{$URL}</link>
<language>zh-cn</language>
<generator>www.emlog.net</generator>';

foreach($blog as $value)
{
	$link = $URL."?post=".$value['id'];
	$abstract = str_replace('[break]','',$value['content']);
	$pubdate =  gmdate('r',$value['date']);
	$author = $user_cache[$value['author']]['name'];
	doAction('rss_display');
	echo <<< END

<item>
	<title>{$value['title']}</title>
	<link>$link</link>
	<description><![CDATA[{$abstract}]]></description>
	<pubDate>$pubdate</pubDate>
	<author>$author</author>
	<guid>$link</guid>

</item>
END;
}
echo <<< END
</channel>
</rss>
END;

/**
 * 获取日志信息
 *
 * @return array
 */
function GetBlog($sort = null) {
	$DB = MySql::getInstance();
	$subsql = $sort ? "and sortid=$sort" : '';
	$sql = "SELECT * FROM ".DB_PREFIX."blog  WHERE hide='n' and type='blog' $subsql ORDER BY date DESC limit 0," . Option::get('rss_output_num');
	$result = $DB->query($sql);
	$blog = array();
	while ($re = $DB->fetch_array($result))
	{
		$re['id'] 		= $re['gid'];
		$re['title']    = htmlspecialchars($re['title']);
		$re['date']		= $re['date'];
		$re['content']	= $re['content'];
		if(!empty($re['password']))
		{
			$re['content'] = '<p>[该日志已设置加密]</p>';
		}elseif(!Option::get('rss_output_fulltext') && !empty($re['excerpt'])){
		    $re['content'] = $re['excerpt'] . '<p><a href="'.BLOG_URL.'?post='.$re['id'].'">阅读全文&gt;&gt;</a></p>';
		}

		$blog[] = $re;
	}
	return $blog;
}
