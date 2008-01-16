<?php
/* emlog 2.6.0 Emlog.Net */

/*
	加载模板文件
	@param string $template 模板名
	@param string $EXT 模板后缀名
	@return string 模板路径
*/
function getViews($template,$EXT=".php")
{
	global $em_tpldir;
	if (!$template)
	{
		$template = 'none';
	}
	$path=$em_tpldir.$template.$EXT;
	return $path;
}

/*
	执行去除转义字符
*/
function doStripslashes()
{
	if (get_magic_quotes_gpc()) 
	{
	    $_GET = stripslashesArray($_GET);
	    $_POST = stripslashesArray($_POST);
	    $_COOKIE = stripslashesArray($_COOKIE);
	    $_REQUEST = stripslashesArray($_REQUEST);
	}
}

/*
	去除转义字符
	@param array $myarray
*/
function stripslashesArray($myarray)
{
	while(list($key,$var) = each($myarray))
	{
		if ($key != 'argc' && $key != 'argv' && (strtoupper($key) != $key || ''.intval($key) == "$key"))
		{
			if (is_string($var))
			{
				$myarray[$key] = stripslashes($var);
			}
			if (is_array($var))
			{
				$myarray[$key] = stripslashesArray($var);
			}
		}
	}
	return $myarray;
}

/*
	转换HTML代码函数
	@param string $content
*/
function htmlClean($content)
{
	$content = htmlspecialchars($content);
    $content = str_replace("\n", '<br>', $content);
	$content = str_replace('  ', '&nbsp;&nbsp;', $content);
	$content = str_replace("\t", '&nbsp;&nbsp;&nbsp;&nbsp;', $content);
	return $content;
}

/*
	转换HTML代码函数(mk_cache.php 65 line)
	@param string $content
*/
function htmlClean2($content)
{
	$content = htmlspecialchars($content);
	$content = str_replace('  ', '&nbsp;&nbsp;', $content);
	$content = str_replace("\t", '&nbsp;&nbsp;&nbsp;&nbsp;', $content);
	return $content;
}

/*
	错误处理函数
	@param string $msg
	@param string $url 
*/
function msg($msg,$url)
{
	global $tpl_dir;
	require_once getViews('message');
	exit;
}

/*
	获取用户ip
*/
function getIp()
{
	if (isset($_SERVER)) 
	{
		if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$realip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
			$realip = $_SERVER['HTTP_CLIENT_IP'];
		} else {
			$realip = $_SERVER['REMOTE_ADDR'];
		}
	} else {
		if (getenv("HTTP_X_FORWARDED_FOR")) {
			$realip = getenv( "HTTP_X_FORWARDED_FOR");
		} elseif (getenv("HTTP_CLIENT_IP")) {
			$realip = getenv("HTTP_CLIENT_IP");
		} else {
			$realip = getenv("REMOTE_ADDR");
		}
	}
	return $realip;
}

/*
	验证email地址格式
*/
function checkMail($address) 
{
	if(ereg("^[_.0-9a-z-]+@([0-9a-z][0-9a-z-]+.)+[a-z]{2,3}$",$address))
	{
		$result=true;
	} else {
		$result=false;
	}
	return $result;
}

/*
	截取编码为utf8的字符串
	@param string $strings 预处理字符串
	@param int $start 开始处 eg:0
	@param int $length 截取长度
*/
function subString($strings,$start,$length)
{
	$str = substr($strings, $start, $length);
	$char = 0;
	for($i = 0; $i < strlen($str); $i++)
	{
			if (ord($str[$i]) >= 128)
                $char++;
	}
	$str2 = substr($strings, $start, $length+1);
	$str3 = substr($strings, $start, $length+2);
	if ($char%3 == 1)
	{
		if ($length <= strlen($strings))
		{
			$str3 = $str3 .= '...';
		}
		return $str3;
	}
	if ($char%3 == 2)
	{
		if ($length <= strlen($strings))
		{
			$str2 = $str2 .= '...';
		}
		return $str2;
	}
	if ($char%3 == 0)
	{
		if ($length <= strlen($strings))
		{
			$str = $str .= '...';
		}
		return $str;
	}
}

/*
	转换附件大小单位
	@param string $filesize 文件大小 kb
*/
function changeFileSize($filesize)
{
	if($filesize >= 1073741824)
	{
		$filesize = round($filesize / 1073741824  ,2) . ' Gb';
	} elseif($filesize >= 1048576)
	{
		$filesize = round($filesize / 1048576 ,2) . ' Mb';
	} elseif($filesize >= 1024)
	{
		$filesize = round($filesize / 1024, 2) . ' Kb';
	} else
	{
		$filesize = $filesize . ' Bytes';
	}
	return $filesize;
}

/*
	分页函数
	@param int $count 条目总数
	@param int $page 当前页码
	@param string $url 页码的地址  
	@param string
*/
function pagination ($count,$page,$url)
{
	global $isurlrewrite;
	if($isurlrewrite=='n')
	{
		if($page>1)
		{
			$re="\n<a href=\"$url=1\">首页</a> <a href=\"$url=".($page-1)."\">上一页</a>";
		}else{
			$re="\n首页 上一页";
		}
		for($i=$page-5;$i<$page+5&&$i<=$count;$i++)
		{
			if($i>1)
			{
				if($i==$page)
				{
					$re.="\n[$i]";
				}else{
					$re.="\n<a href=\"$url=$i\">$i</a>";
				}
			}
		}
		if($page<$count)
		{
			$re.="\n<a href=\"$url=".($page+1)."\">下一页</a> <a href=\"$url=$count\">尾页</a> ";
		}else{
			$re.="\n下一页 尾页";
		}
	}
	else
	{
		if($page>1)
		{			
			$re = "\n<a href=\"{$url}1.html\">首页</a> <a href=\"$url".($page-1).".html\">上一页</a>";
		}else{
			$re = "\n首页 上一页";
		}
		for($i=$page-5;$i<$page+5 && $i<=$count;$i++)
		{
			if($i>1)
			{
				if($i==$page)
				{
					$re .= "\n[$i]";
				}else{
					$re .= "\n<a href=\"{$url}{$i}.html\">$i</a>";
				}
			}
		}
		if($page<$count)
		{
			$re .= "\n<a href=\"{$url}".($page+1).".html\">下一页</a> <a href=\"{$url}{$count}.html\">尾页</a> ";
		}else{
			$re .= "\n下一页 尾页";
		}
	}
	return $re;
}

/*
	按照比例改变图片大小(非生成缩略图)
	@param string $img 图片路径
	@param int $max_w 最大缩放宽
	@param int $max_h 最大缩放高
*/
function chImage ($img,$max_w,$max_h)
{
	$size = @getimagesize($img);
		$w = $size[0];
		$h	 =	$size[1];
	//计算缩放比例
	@$w_ratio = $max_w / $w;
	@$h_ratio =	$max_h / $h;
	//决定处理后的图片宽和高
	if( ($w <= $max_w) && ($h <= $max_h) )
	{
		$tn['w'] = $w;
		$tn['h'] = $h;
	}
	else if(($w_ratio * $h) < $max_h)
	{
		$tn['h'] = ceil($w_ratio * $h);
		$tn['w'] = $max_w;
	}
	else 
	{
		$tn['w'] = ceil($h_ratio * $w);
		$tn['h'] = $max_h;
	}
	$tn['rc_w'] = $w;
	$tn['rc_h'] = $h;
	return $tn ;
}

/*
	日志分割
	@param string $content 日志内容
	@param int $lid 日志id
*/
function breakLog($content,$lid)
{
	$a = explode('[break]',$content,2);
	if(!empty($a[1]))
		$a[0].='<p><a href="?action=showlog&gid='.$lid.'">阅读全文&gt;&gt;</a></p>';
	return $a[0];
}

/*
	删除[break]标签
	@param string $content 日志内容
*/
function rmBreak($content)
{
	$content = str_replace('[break]','',$content);
	return $content;
}

/*
	改变图片附件的比例，用于模板中
	@param string $attstr 缓存中的附件串
	@param int $width 新的宽
	@param int $height 新的高
*/
function getAttachment($attstr,$width,$height)
{
	$re = '';
	if(!empty($attstr)){
		$att_array = explode("</a>",$attstr);
		foreach($att_array as $value){
			preg_match("/.+src=\\\"(.+)\\\" width=.+/i",$value,$imgpath);
			$image = "./".$imgpath[1];
			$size = chImage($image,$width,$height);
			$attsize = "width=\"".$size['w']."\" height=\"".$size['h']."\"";
			$t = preg_replace("/width=\\\"[0-9]{3}\\\" height=\\\"[0-9]{3}\\\"/",$attsize,$value);
			$re .=$t.'</a>';
		}
		return $re;
	}else{
		return '';
	}
}

/*
	清除模板中的注释
*/
function cleanPage()
{
	$output = str_replace(array('<!--<!---->','<!---->',"<!--\r\n-->"),array('','',''),ob_get_contents());
	ob_end_clean();
	echo $output;
	exit;
}

/*
	回显系统错误信息
*/
function sysMsg($info) 
{
print <<<EOT
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>emlog error</title>
<style type="text/css">
<!--
body {
	background-color:#D4E9EA;
	font-family: Arial;
	font-size: 12px;
	line-height:150%;
}
-->
</style>
</head>
<body>
$info
</body>
</html>
EOT;
exit;
}
?>