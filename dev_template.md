# 模板开发基础指南（适用于emlog5.0） #

本文分析emlog5下的模板基本结构以及基本变量、函数的作用，详细了解本文，有助于更快掌握emlog5的模板开发基础。

emlog的模板位于安装目录content\templates\文件夹下，每个模板都是一个单独的文件夹，文件夹以模板名字命名。通过后台上传安装的模板都保存在这个目录下。


## 模板文件目录说明 ##
一般来说，一个模板都会包含以下几个部分：

  * images文件夹：存放模板所需图片。
  * echo\_log.php：显示日志内容。
  * footer.php：页面底部。
  * header.php：页面头部。
  * log\_list.php：显示日志列表内容。
  * main.css：模板的css文件。
  * module.php：模板公共代码，包含侧边widgets、评论、引用、编辑等，该文件是模板最核心的模块。
  * page.php：自定义的页面内容的模板。
  * preview.jpg：在后台模板选择界面显示的模板预览图，300X225 jpg格式。
  * side.php：模板侧边栏文件，如制作单栏模板则该文件不是必须的。
  * t.php：显示emlog系统自带的微博（碎语）内容。
  * 404.php 自定义404页面未找到时的报错页面

在一般的emlog模板开发中，以上提及的部分中echo\_log.php、log\_list.php、module.php、page.php、t.php、header.php以及preview.jpg是不可或缺的，一旦缺省，模板将无法运行。此外的side.php、footer.php、main.css、images文件夹等，只需要对模板代码做小部分更改，那么它们都是可以改名、移动、甚至删除的。

下面我们将对以上各模块进行简要分析：

## 公共代码分析 ##

通过预览整个模板中的各个文件，你会发现以下代码同时存在于多个文件中，这些代码分别有以下用途：
  * if(!defined('EMLOG\_ROOT')) {exit('error!');}   此行代码存在于模板目录下的每个php文件起始部分(事实上为了安全起见，该行代码也在admin目录下的几乎所有php文件起始部分存在)，其作用是防止代码所在的php脚本被直接访问执行。例如，常规情况下，log\_list.php是被系统整体调用作为页面的一部分进行内容输出的，但是，你也可以通过 _http://yourweb.com/content/templates/yourtemplate/logo\_list.php_ 访问到。如果不添加此行代码，那么这样访问将会输出类似下面的错误信息：
    * Fatal error: Call to undefined function doAction() in E:\workspace\emlogDevelop\content\templates\sandfish\log\_list.php on line 2`

> 该错误信息将会暴露你博客的物理路径，将对你的博客安全产生威胁。而在加上此行代码后，所有非法访问emlog系统都会输出“error!”字样，而不用担心你的博客物理路径的泄露以及其它安全问题。

  * require\_once View::getView('side');require\_once View::getView('footer'); 这两行代码存在于log\_list.php、echo\_log.php、page.php、t.php里面，其作用是调用模板文件夹下的side.php和footer.php的代码到当前文件的当前位置。View是emlog的模板视图控制器，View::getView('文件名','文件后缀')将返回当前模板安装路径下对应的文件。getView函数的第二个参数为缺省参数，在不传入值的情况下，将默认作为.php文件后缀返回文件路径。

## header.php ##

开头注释内容是模板信息，该信息显示在模板选择界面
  * Template Name:模板名称
  * Description:模板介绍描述
  * Author:模板作者
  * Author Url:作者或模板发布的URL
  * Sidebar Amount:标记该模板有几个侧边栏，一般为1，有些模板有两个侧边栏则标记2。这样可以在后台widgets里识别管理（具体可下载体验官方收录的模板G7）。

之后是具体代码部分：

if(!defined('EMLOG\_ROOT')) {exit('error!');}

该行代码同样存在于其它模板文件中，为防止该文件被直接执行。

require\_once View::getView('module');

加载模板公共代码.

  * $site\_title：站点标题
  * $site\_key：关键字
  * $site\_description：输出博客设置的摘要

  * BLOG\_URL：博客首页的URL，输出形如http://simue.com/blog/
  * TEMPLATE\_URL：模板文件夹的URL，用于加载模板内的css、js及其他内容，输出形如http://simue.com/blog/content/templates/simue-tuso/
  * BLOG\_URL.Option::get('topimg')：这句可以无视，因为只默认模板可以自定义banner，其它模板没这功能（卡片语：很没营养的设定，嗯。）

<?php echo $curpage == CURPAGE\_HOME ? 'current' : 'common';?>

判断当前是否首页，是则给导航加current类，用于表现当前位置。

<?php if($istwitter == 'y'):?>.......<?php endif;?>

如后台设置在前台显示碎语，则输出.......中的内容。

<?php echo $curpage == CURPAGE\_TW ? 'current' : 'common';?>

判断当前URL是否为碎语并选择加类名。

<?php foreach ($navibar as $key => $val):?>.......<?php endforeach;?>

输出自定义页面的链接

## footer.php ##

Option::EMLOG\_VERSION：获得版本号。

$icp：获得后台设置的ICP备案号。

<?php doAction('index\_footer'); ?> 页脚底部挂载点加入。

## log\_list.php ##

<?php doAction('index\_loglist\_top'); ?> 页脚底部挂载点加入。

$value['logid'] 该变量为当前日志的id

<?php topflg($value['top']); ?> 显示置顶标记，该函数位于模板module.php内。

<?php echo $value['log\_url']; ?> 输出日志URL

<?php echo $value['log\_title']; ?> 输出日志标题

<?php blog\_author($value['author']); ?>

输出日志的作者，该函数位于模板module.php内。

<?php echo gmdate('Y-n-j G:i l', $value['date']); ?>

输出日志发布时间，参数'Y-n-j G:i l'用于定义日期格式。

<?php blog\_sort($value['logid']); ?>

输出日志所属的分类，该函数位于模板module.php内。

<?php editflg($value['logid'],$value['author']); ?>

当管理员或作者登陆时显示“编辑”链接，该函数位于模板module.php内。

<?php echo $value['log\_description']; ?>

输出日志摘要（没有摘要则输出全文）。

<?php blog\_att($value['logid']); ?>

如日志有附件则输出附件，该函数位于模板module.php内。

<?php blog\_tag($value['logid']); ?> 输出日志的标签，该函数位于模板module.php内。

<?php echo $value['comnum']; ?> 输出当前日志的评论数

<?php echo $value['tbcount']; ?> 输出当前日志的引用量

<?php echo $value['views']; ?> 输出当前日志的浏览量

<?php echo $page\_url;?> 显示当前列表页的翻页功能。

<?php
> include View::getView('side');
> include View::getView('footer');
?>

加入侧边栏及加入页脚。

## echo\_log.php ##

该文件功能函数与列表页一致，但参数有区别，注意区分。
$logid 该变量为当前日志的id

<?php topflg($top); ?>  显示置顶标记，该函数位于模板module.php内。

<?php echo $log\_title; ?> 输出日志标题。

<?php blog\_author($author); ?> 输出日志的作者，该函数位于模板module.php内。

<?php echo gmdate('Y-n-j G:i l', $date); ?>
输出日志发布时间，参数'Y-n-j G:i l'用于定义日期格式。

<?php blog\_sort($logid); ?> 输出日志所属的分类，该函数位于模板module.php内。

<?php editflg($logid,$author); ?> 当管理员或作者登陆时显示“编辑”链接，该函数位于模板module.php内。

<?php echo $log\_content; ?> 输出日志全文内容。

<?php blog\_att($logid); ?> 如日志有附件则输出附件，该函数位于模板module.php内。

<?php blog\_tag($logid); ?> 输出日志的标签，该函数位于模板module.php内。

<?php echo $comnum; ?> 日志页显示评论数

<?php echo $tbcount; ?> 日志页显示引用数

<?php echo $views; ?> 日志页显示浏览量

<?php doAction('log\_related', $logData); ?> 相关日志的挂载点，与3.x版本不同，4.0带第二参数。

<?php neighbor\_log($neighborLog); ?> 输出邻近，就是上一篇及下一篇，该函数位于模板module.php内。

<?php blog\_trackback($tb, $tb\_url, $allow\_tb); ?> 输出该日志被引用的信息列表，与3.x不同注意区分。

<?php blog\_comments($comments); ?> 输出该日志评论列表，与3.x不同注意区分。

<?php blog\_comments\_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow\_remark); ?>
输出发表评论框，与3.x不同注意区分。

## page.php ##

该文件写法与echo\_log.php类似，不再重复。

## t.php ##

与之前相同的内容不再重复。
<?php echo $avatar; ?> 输出头像。

<?php echo $author; ?> 输出作者名。

<?php echo $val['t'];?> 输出碎语内容。

<?php echo DYNAMIC\_BLOGURL; ?> 根据当前url输出博客地址，主要用于js，解决跨域问题。

<?php echo $tid;?> 输出碎语所在数据库中的id号。

<?php echo $val['date'];?> 发布碎语的时间。

$reply\_code ：其值为‘n’或‘y’，后台设置是否启用碎语回复验证码。

<?php echo $rcode; ?> 输出验证码。

## side.php ##

侧边栏，主要负责根据后台widgets设置信息输出侧边栏内容。建议该文件内代码保持不变。
doAction('diff\_side'); //侧边栏挂载点。

## module.php ##

模板公共代码，包含侧边widgets、评论、引用、编辑等。
该文件由若干函数组成，被博客前台文件调用，可在内自定义函数实现更多功能。
如在自定义函数内调用emlog缓存时，假设读取user缓存信息，则形如：
global $CACHE;
$user\_cache = $CACHE->readCache('user');
如需要操作数据库，则形如：
$DB = MySql::getInstance();
$res = $DB->query($sql);
以上两点与3.x不同，请注意区分。


## 404.php ##

用于自定义404页面的模板。


## 最后附：前台模板部分挂载点一览 ##

doAction('index\_footer'); //页脚底部挂载点

doAction('index\_loglist\_top'); //首页日志列表顶部挂载点

doAction('log\_related', $logData); //相关日志挂载点

doAction('diff\_side'); //侧边栏挂载点
