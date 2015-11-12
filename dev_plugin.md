# 插件开发指南（适用于emlog5.0） #

emlog支持插件机制，这样使得开发者可以方便地向emlog中添加自己需要的功能。

## 一、插件实现原理 ##

在emlog整个运行过程中我们设定了一些动作事件，遇到这些事件时emlog会自动的调用插件绑定到该事件的上的所有插件函数，从而实现插件的功能。

## 二、插件挂载点 ##

挂载点函数：doAction
本函数内置于emlog核心代码中，就是传说中的插件挂载点。
本函数有一个固定的参数：
> $hook，$hook是执行动作的名称
> 其他的参数则可以在调用本函数时依次传入,函数会自动的发送给钩子函数
例子:
> > doAction('save\_log',$id);
> > 这是emlog的添加日志事件,在添加日志后会触发,参数为新日志的$id号码.
> > 那么系统会自动的将$id传入到每一个绑定到本事件的钩子函数中。

添加事件调用方法 函数: addAction
本函数是插件用来想挂载点挂载方法的函数，写在插件文件中。
函数有两个参数：$hook, $actionFunc。

> $hook 是绑定事件的名称,
> $actionFunc  是绑定到该事件钩子上的函数名称
例子:
> > addAction('save\_log','plugin\_addlog');
> > 例子中将plugin\_addlog函数绑定到系统的save\_log事件中,只要系统执行到了save\_log挂载点时,就会调用plugin\_addlog函数.

插件文件系统
插件目录：/content/plugins/
仅识别 “插件目录/插件名/插件名.php” 目录结构的插件。
例如：emlog默认的tips插件,其文件夹名称为tips,程序文件名称为tips.php

插件的激活与关闭
在emlog后台的插件管理中,点击每个插件后的状态按钮即可激活/关闭插件。
自emlog4.0.0起增加激活和关闭插件函数，来完成激活和关闭时的一些初始化工作。
如果插件需要，可以给插件增加 plugin\_callback.php 文件，其中包含两个函数：
callback\_init()为插件激活时调用
callback\_rm()为插件关闭时调用

插件前台显示页面
如果想让插件在前台输出一个页面，可以在插件中定义一个 pluginname\_show.php 的文件。
此时插件的前台显示地址为：http://博客地址/?plugin=pluginname
这样就可以在pluginname\_show.php文件构建插件的页面显示。

插件后台显示配置页面
如果你想让插件在后台输出一个设置页面，可以在插件中定义一个 pluginname\_setting.php 的文件
此时插件的后台配置地址为：http://博客地址/admin/plugin.php?plugin=pluginname

## 三、插件开发标准 ##

### 插件命名规则 ###

> 插件名只能以半角的字母、数字、下划线(_)、横杠(-) 组合而成，且只能以字母作为开头
### 函数/变量命名标准 ###
> > 插件的所有函数/变量采用 "插件名_" 作为前缀来命名
> > 例如:
> > $emlogplugin\_var
> > emlogplugin\_dosomething()
> > 采用这样的命名方式可以避免于其他插件的函数或者变量出现冲突.
### 插件文件名称 ###
> > 插件主文件名称必须与插件所在文件夹名称相同
> > 设定插件参数的配置程序文件名称必须为 “插件名称\_setting.php”
> > (注:该文件为可选,如果你的插件需要用户配置参数才需要该文件来完成配置功能)
> > 例如:
> > emlogplugin/
> > > emlogplugin.php
> > > emlogplugin\_setting.php
### 安全性 ###

> > 在插件文件开头增加限制语句
> > 插件函数文件需要增加:
> > !defined('EMLOG\_ROOT') && exit('access deined!');
> > 如果不增加该语句,那么直接访问插件的程序文件php会爆出博客的物理路径,对博客的安全造成威胁。
> > 如果你的插件需要接收一些参数,请务必严格过滤每一个变量的数据.
> > 例如：获取外部获取一个int型的参数，$id = $_GET['id']; 这样写是不安全的，要改为：$id = intval($_GET['id']);
> > 如果是一个字符型的参数，$action = $_GET['action']; 这样写也是不安全的，
> > 要改为：$action = addslashes($_GET['action']);
> > 更多安全方面的内容可以参考一下这篇文章《PHP 安全指南》
> > http://www.hhacker.com/files/200709/1/index.html
> > 前台链接使用绝对地址

## 四、当前插件挂载点及说明 ##

  * 挂载点：doAction('adm\_main\_top')
    * 所在文件：admin/views/header.php
    * 描述：后台红线区域扩展：


  * 挂载点：doAction('adm\_head') ===
    * 所在文件：admin/views/header.php
    * 描述：后台头部扩展：可以用于增加后台css样式、加载js等


  * 挂载点：doAction('adm\_siderbar\_ext')===
    * 所在文件：admin/views/header.php
    * 描述：后台侧边栏 功能扩展 子菜单扩展，用于插件单独页面。



  * 挂载点：doAction('save\_log', $blogid）===
    * 所在文件：admin/save\_log.php
    * 描述：新增日志、修改日志扩展点

  * 挂载点：doAction('del\_log', $key) ===
    * 所在文件：admin/admin\_log.php
    * 描述：删除日志操作扩展点

  * 挂载点：doAction('adm\_writelog\_head', $key) ===
    * 所在文件：
    * admin/add\_log.phpadmin/add\_page.phpadmin/edit\_log.php
    * admin/edit\_page.php
    * 描述：可以再红框处显示扩展内容，如插入网络相册照片的插件。

  * 挂载点：doAction('comment\_post') ===
    * 所在文件：./index.php
    * 描述：发表评论扩展点（写入评论前）。可用于垃圾评论防范

  * 挂载点：doAction('comment\_saved’) ===
    * 所在文件：include/model/comment\_model.php
    * 描述：发表评论扩展点（写入评论后）。用于发布评论成功的后续操作，如发通知邮件

  * 挂载点：doAction('log\_related',$logData) ===
    * 所在文件：content/templates/default/echo\_log.php
    * 描述：阅读日志页面扩展点、用于增加日志相关内容

  * 挂载点：doAction('index\_head') ===
    * 所在文件：Content/templates/default/header.php
    * 描述：前台头部扩展：可以用于增加前台css样式、加载js等

  * 挂载点：doAction('index\_footer') ===
    * 所在文件：content/templates/default/footer.php
    * 描述：首页底部扩展点

  * 挂载点：doAction('comment\_reply', $commentId, $reply) ===
    * 所在文件：admin/comment.php
    * 描述：回复评论扩展点

  * 挂载点：doAction('data\_prebakup') ===
    * 所在文件：admin/data.php
    * 描述：扩展备份数据库页面，可以对插件增加的表进行备份

  * 挂载点：doAction('rss\_display') ===
    * 所在文件：rss.php
    * 描述：Rss输出扩展

  * 挂载点：doAction('attach\_upload') ===
    * 所在文件：include/lib/function.base.php
    * 描述：扩展附件上传，如增加图片水印效果等

  * 挂载点：doAction('url\_rewrite') ===
    * 所在文件：include/lib/function.base.php
    * 描述：扩展url重写，可以自定义其他url优化方案

  * 挂载点：doAction('adm\_comment\_display') ===
    * 所在文件：admin/views/comment.php
    * 后台评论显示扩展，可以用于查询评论人ip所在地域

  * 挂载点：doAction('index\_loglist\_top') ===
    * 所在文件：content/templates/default/log\_list.php
    * 描述：日志列表顶部扩展点，如显示公告等

  * 挂载点：doAction('diff\_side') ===
    * 所在文件：content/templates/default/side.php
    * 描述：侧边栏控制扩展点

  * 挂载点：doAction('reply\_twitter', $r, $name, $date, $tid) ===
    * 所在文件：t/index.php
    * 描述：回复碎语扩展点，用于回复邮件提醒等

  * 挂载点：doAction('post\_twitter', $t) ===
    * 所在文件：
    * /m/index.php
    * /admin/twitter.php
    * 描述：发布碎语扩展点，用于碎语和其他微博类产品同步等

  * 挂载点：doAction('adm\_footer') ===
    * 所在文件：admin/views/footer.php
    * 描述：后台底部扩展：可以用于增加后台js等