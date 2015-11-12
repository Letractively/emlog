记录emlog的每一次更新。


### emlog 5.0.1 ###
发布时间：2012/12/16
  * 优化自动保存返回数据格式，提高容错
  * 优化数据备份功能，支持导出和导入zip格式备份文件
  * 优化标签管理，增加全选功能
  * 优化ip获取函数
  * 优化月份天数获取函数
  * 优化文件上传函数，兼容禁用chmod函数环境
  * 优化插入附件，增加css样式id
  * 修复手机版本回复评论页面导航重复显示的问题
  * 修复手机版本写文章换行不起作用的问题
  * 修复导航可以为空的问题
  * 修复日志归档时间错误的问题
  * 修复博客标题过长导致后台模板变形及默认模板标题行间距太小问题
  * 增加批量删除标签功能，及标签删除确认


### emlog 5.0.0 ###
发布时间：2012/10/7
  * 碎语支持发布图片，手机版本也可以发布图片碎语。
  * 增加导航管理，方便用户调整自己的导航菜单
  * 模板增加自定义404页面
  * 日志可嵌入zip格式附件
  * 增加友情链接隐藏功能
  * 链接pr查询挂载点
  * 侧边栏增加热门文章
  * 日志编辑器增加全屏编辑按钮
  * 模板、插件安装页面增加官方推荐
  * 增加浏览器标题、描述设置
  * 增加关闭全站评论设置
  * 增加关闭碎语回复设置
  * 评论内容需要包含中文设置，用于防范垃圾评论
  * 评论增加发表频率限制
  * 增加部分插件挂载点
  * 优化附件重命名规则
  * 优化个人资料页面
  * 修复后台编辑日志页面ajax保存是否允许评论等失败
  * 修复开发遗留的调试语句：error\_log


### emlog 4.2.1 ###
发布时间：2012/3/11
  * 修复标写日志时标签无法保存报错的问题。
  * 修复用户管理无法修改已有用户角色的问题
  * 修复访问日志id缺失导致报sql错误的问题
  * 优化验证码输出，去掉引起误导的特殊字符


### emlog 4.2.0 ###
发布时间：2012/3/4
  * 增加批量上传附件功能，支持一次选择多个文件，上传显示进度条
  * 后台用户管理增加管理员角色，支持多个管理员
  * 增加jquery加载函数:emLoadJQuery，前台可选加载jquery,防止插件多次加载jq库
  * 后台日志管理页面增加搜索日志功能
  * 设置页面增加是否开启图片缩略设置
  * 后台碎语页面增加云平台最新碎语调用
  * 后台碎语设置挪到站点设置页面，方便统一修改
  * 后台页脚增加挂载点
  * 改进标签分隔方式，支持空格及逗号分隔
  * 改进后台管理全选操作，更加方便操作
  * 去掉日志管理页面的标签，管理页面更加清爽
  * 更新jquery到当前最新版本1.7.1
  * 修复导入数据库带短横线的问题
  * 修复拆卸插件未先停止插件的问题
  * 修复缓存文件被直接读取的问题
  * 修复搜索和手机版本分页问题
  * 修复日志带参数评论分页问题
  * 修复标签分类伪静态下带参数不能访问的问题




### emlog 4.1.0 ###
发布时间：2011/9/17
  * 增加评论分页功能，且后台可以设置是否分页及评论排序方式
  * 增加模板、插件后台直接上传安装，删除功能
  * 增加自定义页面底部信息功能，支持html，可方便添加流量统计代码。
  * 优化链接路由，访问不存在的页面返回404状态及错误提示，不再跳转到首页
  * 优化默认模板首页日志分页方式及部分细节
  * 修复ie6下碎语页面错位问题
  * 阅读全文字样增加css样式id，方便模板控制样式
  * 最新评论缓存，增加发布时间,方便模板调用
  * 增加插件适合版本提示
  * 修复修改日志发布时间时日期格式错误导致保存后时间错误的问题
  * 优化后台细节，包括日志撰写页面的布局优化。
  * 修复评论和碎语回复未过滤特殊字符的bug
  * 优化链接路由表，让日志链接兼容更多情况

### emlog 4.0.1 ###
发布时间：2011/5/7
  * 优化最新评论缓存，增加评论人邮箱
  * 修复部分iis6服务器默认文件首字母大写引起的路由解析的问题
  * 修复博主昵称包含引号导致无法回复评论的问题
  * 修复、默认链接样式分类、tag等分页问题
  * 修复离线写作在开启登录验证码时发布失败的问题
  * 修复iis6下非默认链接样式下中文标签打不开的问题
  * 修复发表评论框tab切换问题
  * 优化rss输出摘要部分
  * 修复部分主机处理模板目录下的index.php时报错的问题
  * 修复手机版本管理员发布评论需要审核的问题
  * 增加4.0遗漏的comment\_post挂载点，为comment\_saved挂载点增加cid参数


### emlog 4.0.0 ###
发布时间：2011/4/26
  * 全新的可定制顶部图片的默认模板
  * 支持后台界面风格切换
  * 支持自定义日志链接
  * 评论嵌套，评论人头像
  * 更换后台日志编辑器，改用群众喜闻乐见的 kindeditor 编辑器
  * 后台直接导入em备份文件
  * 优化文章页面描述和关键字，更加有利于SEO。
  * 后台可定制碎语前台导航显示名
  * 增加插件激活、禁用回调方法。方便插件初始化和拆卸
  * 增加分类别名，可以为分类定义一个更加友好的链接地址
  * 核心代码优化，重写了前台的代码结构。虽然放在最后，但这却是4.0最大的改进。


### emlog 3.5.2 ###
发布时间：2010/7/24
  * 修复手机修改日志后日志时间出错的问题
  * 增加当正在使用的模板被删除后的容错提示。
  * 评论管理页面增加 鼠标悬浮显示评论全文 功能
  * 插件管理页面增加 禁用所有插件 功能
  * widgets管理页面增加 恢复组件设置到初始安装状态 功能。调整部分连接位置。
  * 回复评论页面增加 回复并审核 按钮
  * 增加Rss全文输出全局设置项
  * 备份文件导入增加对包含BOM的文件的支持
  * 修复安装文件重复定义，EMLOG\_ROOT常量的bug
  * 修复rss输出 阅读全文 连接错误的bug

### emlog 3.5.1 ###
发布时间：2010/6/5


  * 修复使用日历查看日志偶尔不显示的bug
  * 优化自动保存，防止出现重复保存新草稿的问题。
  * 增加安装不支持php4提升
  * 打开后台碎语页面写碎语获得输入焦点
  * 调整写日志页面修改时间输入框大小
  * 调整几个挂在点位置：确保emlog核心操作顺利完成。
  * 修改固定连接设置方式。设置时写到.htaccess文件里。。
  * 修改 reply\_twitter 挂载点在开启审核时失效的bug
  * 改造获取存档日志方式，放弃使用mysql的from\_unixtime获取日期的unix时间戳（它会受到时区影响）
  * 增强缓存容错能力，当缓存文件为空时，重新生成缓存。
  * 增强插件加载和管理的容错能力。
  * 优化rss部分代码，增加rss输出条目配置
  * 修复今日访问数量在翻看日历操作时 出现清0的bug。

## emlog 3.5.0 ##
发布时间：2010/5/9

  * 重新设计的碎语功能，支持回复，简单的言语记录生活中的点点滴滴……。
  * 时区设置改造 （只需要设置自己所在时区即可）。
  * 优化核心代码 ：增加自动检测/生成缓存文件的功能 ，简化更新缓存代码、优化mysql类为单实例模式
  * 数据库结构优化，增加必要索引，提高性能
  * 增加默认模板当前页签高亮效果
  * 编辑草稿页面增加发布按钮
  * 增加插件设置页面保存失败的现实
  * 改进手机版本。
  * 修复评论发布成功挂载点失效问题。
  * 修复无碎语的时候 手机版本报错。
  * 修复数据库名包含 - 时安装出问题
  * 修复空标签写入数据库BUG
  * 修复博主描述里面。有双引号的时候 ie7 6 页面混乱。
  * 修复xmlrpc发布日志用户头像消失的问题
  * 修复php libxml模块2.7.0-2.7.3版本解析xml丢失html标签括号的bug
  * 修复url重写规则tag表参数匹配问题
  * 删除ckeditor下无用的几个文件
  * 修复分页输出内容 css不可控bug
  * 修改默认模板编码为 无bom的utf8
  * 修改rss输出改id排序为时间排序



## emlog 3.4.0 ##
发布时间：2009/12/06

  * 全新设计的手机版本
  * 新增对windows live writer 等离线写作软件支持
  * 升级日志撰写编辑器到ckeditor3.0.1，加载速度大幅提升。
  * 支持多人联合撰写碎语（原twitter）
  * 优化评论管理操作体验
  * 去掉了编辑器上插入日志分割符按钮，但手动输入依然有效。因为该功能如果使用不当会造成页面错位，所以推荐大家在撰写日志的时候

填写高级选项里的日志摘要。
  * 将原来的URL优化独立为固定链接，并支持目录形式的URL格式
  * 优化日志搜索，减少不必要的字数限制
  * 去掉退出时删除session这一无效操作
  * 改进邮件地址验证函数，支持.name 等域的邮件地址
  * 取消前台显示评论人email 地址，只有后台管理员可见
  * 去掉前台修改博主描述功能，简化模板代码
  * 修复plugin\_setting\_view()函数拼写错误的bug
  * 修复查看作者、分类、分页输入负数时报错的bug
  * 修复导入备份文件不检测数据库前缀的bug
  * 修复附件上传扩展点失效的bug
  * 增加博客描述的meta信息


## emlog 3.3.0 ##
发布时间：2009/8/29

  * 修改emlog绝对路径定义方式，方便博客更换空间
  * 默认模板支持后台编辑器的list样式
  * 安装时判断是否存在原有数据，防止重新安装覆盖
  * 后台评论管理显示评论者ip、email、主页信息
  * 改造数据库备份方式，增加备份文件保存到本地功能
  * 修改插件加载方式，仅支持子目录形式的插件。
  * 修复友情链接、自定义页面不支持https、ftp开头的链接问题
  * 修复新建页面标题里包含单引号时无法隐藏、发布的bug
  * 修复相邻日志错误BUG
  * 修复登录验证绕过图片验证码的bug
  * 增加apache服务器能否开启url优化的检查
  * 优化后台条目列表样式，更加美观
  * 修复个别安全隐患，加强后台参数过滤
  * 增加若干挂载点，详见插件开发指南


## emlog 3.2.1 ##
发布时间：2009/6/12

  * 修复3.2.0Rss文章地址错误的问题
  * 修复3.2.0URL优化后出现的链接错误的问题
  * 修复部分3.1.0升级到3.2.0后无法增加作者的错误
  * 修复3.2.0后台评论时间错误的问题
  * 修复之前版本多次保存草稿出现js错误的问题

## emlog 3.2.0 ##
发布时间：2009/6/6

  * 增加插件功能。
  * 大幅度改进后台管理的交互和页面设计，用户体验更好。
  * 增加自建页面功能、可以方便的创建导航条、留言板
  * 增加多人联合撰写功能
  * 更换默认模板，更加美观
  * 增加Google Picasa相册插件
  * 优化模板结构

## emlog 3.1.0 ##
发布时间：2009/3/7

  * 优化日志撰写逻辑和界面，增加日志摘要、日志加密。
  * 改进widgets侧边栏组件管理，操作更加方便、人性化。
  * 修复多个之前版本遗留的bug，包括经典的草稿标签显示在首页问题
  * 改进安装流程、去掉了可能给用户带来困惑的权限设置步骤
  * 后台日志管理添加按照分类和标签检索
  * 去掉doc目录下的文本说明，改用更加优雅的readme.html
  * 安装后自动填写博客地址，无需后台设置
> ……


## emlog 3.0.1 ##
发布时间：2009/1/4

```
emlog3.0.0发布后由于我们测试的疏忽，现存如下BUG：

1、日志分类条目BUG：后台所涉及到分类数目的操作都没有正确更新缓存，手动更新缓存可以解决此问题
2、评论未清除HTML标签BUG：除默认模板外，其它模板均有此问题，系评论model漏洞所致，请大家暂时先用默认模板，以免受到危害
3、发布新日志时，若更改时间，发布时间显示将会出现异常

```

## emlog 3.0.0 ##
发布时间：2008/12/29

重要新特性及优化：
```
1.新增侧边栏组件（widget）管理，实现侧边栏的高度可定制性
2.改进登录验证部分，实现用户状态的长久保存，不必频繁登录
3.大幅优化代码结构，后续开发、维护更加方便快捷，代码可读性更好
4.优化后台界面，后台用户体验得到提升
5.新增日志分类功能
6.改进日志管理，可以按照标签和分类检索
7.新增侧边栏项目：随机日志、最新日志 
8.改进评论显示顺序
```

BUG修复

```
1.日历在9月时下翻到10月变成1月的
2.IE6不支持中文标签超链接
```


## emlog 2.7.0 ##
发布时间：2008/8/3

变更记录:

  * 改造附件上传和管理 附件管理更加直观方便。
  * 更新FCK编辑器到2.6，完全兼容 ie6+ ff2+ safari opera
  * 优化缓存模块，速度更快，代码更优雅
  * 重构了前后台的模板标识，让模板制作更加方便清晰。
  * 重构了URL重写的逻辑，可维护性和扩展性提高
  * 优化前台标签对应日志和搜索日志列表呈现方式
  * 新增前台恢复评论和修改个人状态功能
  * 增加博客Gzip压缩功能,让博客打开速度更快,流量更小
  * 优化标签字体大小的算法，去掉了更多标签的页面。

BUG修复

  * 修复了时差导致的twitter 发布日期错误
  * 修复了wap的相关不足
  * 修复后台草稿管理多于1页后的bug


## emlog2.6.5 ##
发布时间：2008/5/3
#### 新增特性： ####
  * wap功能 手机上的emlog 让你随身随地浏览博客书写心情（wap第一版暂不支持写日志，但可以写twitter）
  * twitter 功能 一句话博客
  * 日志自动保存，你只管认真的写日志，其他的交给emlog吧。

#### 功能优化： ####
  * 优化数据库备份功能，兼容性更好。使得备份体验和成功率更高
  * 优化图片生成缩略图部分，提高兼容性可靠性
  * 登录方式的改进，前台也可以进行简单的管理操作
  * 验证码好看了点，字母数字混合
  * 附件上传，用户体验有所改善

## emlog2.6.0 ##
发布时间：2008/3/8

新增特性：
  * 博主回复评论
  * 日志上下相邻日志标题的显示
  * URL REWRITE 博客伪静态
  * 增加评论人个人主页项
  * 日志评论审核开启时，后台首页提示未审核的评论数
  * 增加引用通告开关，可以关闭和开启所有博客的trackback功能
  * 反垃圾引用
  * emlog开始采用GPLv2发布源代码 标志着emlog正式开源
功能优化：
  * 日志禁止评论时，不显示撰写评论表单
  * 日志禁止引用时，不显示引用地址
  * 优化后台友站管理，友站列表显示“友站描述”
  * 优化日志管理页面，可以直接查找该日志对应的评论进行管理
BUG修复
  * 图片附件添加到编辑器时，带有蓝色边框

## emlog2.5.0 ##

发布时间：2007/11/24

更新记录：
  * 优化了日志附件的管理。
  * 图片附件可以直观的嵌入到日志内容，现在开始可以写一篇图文并茂的日志
  * 增加用户自定义html功能，加一些其他站的api 或是其他内容就不用老去修改模板
  * 日志归档同时显示当月日志数目
  * 优化一些细节（本次修改程序以及界面上小的修改和优化比较多）

## emlog2.4.0 ##

发布时间：2007/9/15

## emlog2.3.0 ##

发布时间：2007/7/29

## emlog2.2.0 ##

发布时间：2006/10/13

## emlog2.1.6 sp1 ##

发布时间：2006/9/3

## emlog2.1.6 ##

发布时间：2006/8/5

## emlog2.0.0 ##

发布时间：2006/5/14
更新记录：


## emlog1.0.3 ##

发布时间：2006/3/16

## emlog1.0.0正式版 ##

发布时间：2005/12/29


## emlog1.0.0预览版 ##

发布时间：2005/10/27