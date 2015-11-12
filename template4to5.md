# 模板升级参考（4.2.1到5.0.0） #

# 1、header.php #

为实现浏览器标题的设置需要：

查找 $blogtitle 替换为  $site\_title

查找 $description 替换为 $site\_description

导航管理的增加需要将原来导航部分内容替换为 ：
```
<?php blog_navi();?>
```
以默认模板为例：
```
<div id="nav">
    <ul>
	<li class="<?php echo $curpage == CURPAGE_HOME ? 'current' : 'common';?>"><a href="<?php echo BLOG_URL; ?>">首页</a></li>
	<?php if($istwitter == 'y'):?>
	<li class="<?php echo $curpage == CURPAGE_TW ? 'current' : 'common';?>"><a href="<?php echo BLOG_URL; ?>t/"><?php echo Option::get('twnavi');?></a></li>
	<?php endif;?>
	<?php 
	foreach ($navibar as $key => $val):
	if ($val['hide'] == 'y'){continue;}
	if (empty($val['url'])){$val['url'] = Url::log($key);}
	?>
	<li class="<?php echo isset($logid) && $key == $logid ? 'current' : 'common';?>"><a href="<?php echo $val['url']; ?>" target="<?php echo $val['is_blank']; ?>"><?php echo $val['title']; ?></a></li>
	<?php endforeach;?>
	<?php doAction('navbar', '<li class="common">', '</li>'); ?>
	<?php if(ROLE == 'admin' || ROLE == 'writer'): ?>
	<li class="common"><a href="<?php echo BLOG_URL; ?>admin/write_log.php">写日志</a></li>
	<li class="common"><a href="<?php echo BLOG_URL; ?>admin/">管理中心</a></li>
	<li class="common"><a href="<?php echo BLOG_URL; ?>admin/?action=logout">退出</a></li>
	<?php else: ?>
	<li class="common"><a href="<?php echo BLOG_URL; ?>admin/">登录</a></li>
	<?php endif; ?>
   	</ul>
  </div><!-- end #nav-->
```
替换为：
```
<div id="nav"><?php blog_navi();?></div>
```

# 2、module.php #
侧边栏碎语增加有图片提示

如模板模板79行
```
<li><?php echo $value['t']; ?><p><?php echo smartDate($value['date']); ?> </p></li>
```
改为：
```
<?php $img = empty($value['img']) ? "" : '<a title="查看图片" class="t_img" href="'.BLOG_URL.str_replace('thum-', '', $value['img']).'" target="_blank">&nbsp;</a>';?>
<li><?php echo $value['t']; ?><?php echo $img;?><p><?php echo smartDate($value['date']); ?></p></li>
```

增加侧边栏热门日志模块

以默认模板为例：在120行下面插入如下代码：
```
<?php
//widget：热门日志
function widget_hotlog($title){
	$index_hotlognum = Option::get('index_hotlognum');
	$Log_Model = new Log_Model();
	$randLogs = $Log_Model->getHotLog($index_hotlognum);?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="hotlog">
	<?php foreach($randLogs as $value): ?>
	<li><a href="<?php echo Url::log($value['gid']); ?>"><?php echo $value['title']; ?></a></li>
	<?php endforeach; ?>
	</ul>
	</li>
<?php }?>
```

增加菜单导航模块

以默认模板为例：在187行下面增加：
```
<?php
//blog：导航
function blog_navi(){
	global $CACHE; 
	$navi_cache = $CACHE->readCache('navi');
	?>
	<ul>
	<?php 
	foreach($navi_cache as $value):
		if($value['url'] == 'admin' && (ROLE == 'admin' || ROLE == 'writer')):
			?>
			<li class="common"><a href="<?php echo BLOG_URL; ?>admin/write_log.php">写日志</a></li>
			<li class="common"><a href="<?php echo BLOG_URL; ?>admin/">管理站点</a></li>
			<li class="common"><a href="<?php echo BLOG_URL; ?>admin/?action=logout">退出</a></li>
			<?php 
			continue;
		endif;
		$newtab = $value['newtab'] == 'y' ? 'target="_blank"' : '';
		$value['url'] = $value['isdefault'] == 'y' ? BLOG_URL . $value['url'] : trim($value['url'], '/');
		$current_tab = (BLOG_URL . trim(Dispatcher::setPath(), '/') == $value['url']) ? 'current' : 'common';
		?>
		<li class="<?php echo $current_tab;?>"><a href="<?php echo $value['url']; ?>" <?php echo $newtab;?>><?php echo $value['naviname']; ?></a></li>
	<?php endforeach; ?>
	</ul>
<?php }?>
```

# 3、t.php #
增加碎语显示图片：
以默认模板为例：
在
```
$tid = (int)$val['id'];
```
这行下面增加：
```
$img = empty($val['img']) ? "" : '<a title="查看图片" href="'.BLOG_URL.str_replace('thum-', '', $val['img']).'" target="_blank"><img style="border: 1px solid #EFEFEF;" src="'.BLOG_URL.$val['img'].'"/></a>';
```
这行
```
<p class="post1"><span><?php echo $author; ?></span><br /><?php echo $val['t'];?></p>
```
替换为：
```
<p class="post1"><span><?php echo $author; ?></span><br /><?php echo $val['t'].'<br/>'.$img;?></p>
```

# 4、page.php #

里面删除了下面一句，去掉附件的直接显示：
```
<p class="att"><?php blog_att($logid); ?></p>
```

# 5、log\_list.php #
去掉查看日志页面附件显示相关代码

以默认模板为例：需要删除掉17行：
```
<p class="att"><?php blog_att($value['logid']); ?></p>
```

# 6、echo\_log.php #
去掉了附件显示相关代码

以默认模板为例：需要删除掉14行：
```
<p class="att"><?php blog_att($logid); ?></p>
```

# 7、main.css #

里面增加了下面几行
```
#twitter li .t_img{background:url(images/img.gif) no-repeat;padding: 0 7px;margin: 0 0 0 10px;}
#tw .loading{background:url(images/loading.gif) no-repeat 200px 2px; height:20px;}
#tw p .t_img{background:url(images/img.gif) no-repeat;padding: 0 7px;margin: 0 0 0 10px;}
```

# 8、其他 #
从默认模板images目录下复制img.gif图标到自己模板的images目录下，如果没有images目录就放在其他你模板存放图片的地方，不过需要修改main.css增加的几行中图标的路径到你存放图标的位置。

# 以上内容仅供参考，具体操作还需要开发者根据自己的模板实际情况进行调试 #