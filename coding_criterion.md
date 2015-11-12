# emlog PHP 编码规范 #

如果您已经决定向emlog贡献代码，请详细阅读以下规范，并严格遵守。这样在保证您代码可读性的同时还可以大大减少我们的工作量。


### 文件编码 ###
emlog的所有php核心代码以及模板、插件文件均采用UTF-8编码。请调整您的编辑器文件编码为UTF-8，并关闭UTF-8 BOM的功能。请不要使用windows自带的记事本编辑项目文件。

### 缩进 ###
emlog项目中的代码缩进使用的是4个空格(space)，而不是制表符(tab)，需每个参与项目的开发人员在编辑器(Zend Studio、UltraEdit、EditPlus 等)中进行强制设定，以防在编写代码时遗忘而造成格式上的不规范。

### 换行 ###
emlog使用UNIX风格的换行符，即只有换行(LF或”\n”)没有回车(CR或”\r”)，请在你的编辑器内调整


### 文件命名 ###

文件名统一使用小写,如文件名由多个单词组成，用下划线或点分割，文件命要有意义。
```
函数库文件 以 function. 开头 如：function.base.php
类文件 以 class. 开头 如：class.mysql.php
```

### 类命名 ###

首字母大写（包含各组合单词），专有名词保持其默认大小写规范。

```
class MakeCache{
```

### 函数命名 ###

首字母小写，其他组合单词首字母大写
```
function viewCount() {

}
```

### 变量命名 ###

首字母小写，其他组合单词首字母大写
```
$callbackFunctions;
```

### 常量命名 ###

所有字母大写，单词之间用下划线分割
```
define('EMLOG_ROOT', dirname(__FILE__));
```

### 注释 ###

注释是开源项目的重点，请务必重视。

### 头部注释 ###

头部注释主要用来阐述此文件的用途、版权、版本。请按照下列形式书写(你可以把它设置为代码模板)。
```
<?php
/**
 * 前端全局项加载主程序
 * @copyright (c) 2008, Emlog All Rights Reserved
 * @version emlog-2.7.0
 * $Id: common.php 585 2008-07-30 14:51:59Z emloog $
 */
```

2.7.0 为当前emlog的版本号
其中$Id 是为了匹配svn的关键字，设置此文件的svn:keywords属性为id，每次提交以后,$Id$就会被替换为具体的版本信息


### 类注释 ###

一个类在声明的时候必须声明其作用。
```
/**
 * MYSQL数据操方法封装类
 * 
 */

class MySql {

……

}
```


### 函数注释 ###

函数的声明注释参考phpdoc规范。
说明函数的作用
各个参数的数据类型以及说明
返回值的数据类型以及说明，如果是无返回函数，必须指明@return void

```
/**
 * 加载模板文件
 *
 * @param string $template 模板名
 * @param string $EXT 模板后缀名
 * @return string 模板路径
 */
function getViews($template,$EXT=".php"){
	global $em_tpldir;
	if (!$template){
		$template = 'none';
	}
	$path=$em_tpldir.'/'.$template.$EXT;
	return $path;
}
```

### 大括号{}、if和switch ###

  * 首尾括号与关键字同列；
  * if结构中，else和elseif与前后两个大括号同行。另外，即便if后只有一行语句，仍然需要加入大括号，以保证结构清晰,但if开始第一个{要另起一行，和if保持同列 ；
  * switch结构中，通常当一个case块处理后，将跳过之后的case块处理，因此大多数情况下需要添加break。break的位置视程序逻辑，与case同在一行，或新起一行均可，但同一switch体中，break的位置格式应当保持一致。
以下是符合上述规范的例子：

```
if($condition){
	switch($var) {
		case 1: 	echo ‘var is 1’; break;
		case 2: 	echo ‘var is 2’; break;
		default: 	echo ‘var is neither 1 or 2’; break;
	}
} else {
	Switch($str) {
		case ‘abc’:
			$result = ‘abc’;
			break;
		default:
			$result = ‘unknown’;
			break;
	}
}
```


### 运算符、小括号、空格、关键词 ###

  * 每个运算符与两边参与运算的值或表达式中间要有一个空格，唯一的特例是字符连接运算符号两边不加空格；
  * 除字符串中特意需要，一般情况下，在程序以及HTML中不出现两个连续的空格
  * 任何情况下，PHP程序中不能出现空白的带有TAB或空格的行，即：这类空白行应当不包含任何TAB或空格。同时，任何程序行尾也不能出现多余的TAB或空格。多数编辑器具有自动去除行尾空格的功能，如果习惯养成不好，可临时使用它，避免多余空格产生；
  * 每段较大的程序体，上、下应当加入空白行，两个程序块之间只使用1个空行，禁止使用多行；
  * 程序块划分尽量合理，过大或者过小的分割都会影响他人对代码的阅读和理解。一般可以以较大函数定义、逻辑结构、功能结构来进行划分；
  * 说明或显示部分中，内容如含有中文、数字、英文单词混杂，应当在数字或者英文单词的前后加入空格。

根据上述原则，以下举例说明正确的书写格式：

```
$result = (($a + 1) * 3 / 2 + $num)).’Test’;
$condition ? func1($var) : $func2($var); 
$condition ? $long_statement
	: $another_long_statement;
if($flag) {

    //Statements(more than 15 lines)

}
```

### 字符串的单引号和双引号 ###

纯字符串、关联数组索引（key）使用用单引号''

```
$myString = 'hello world';
$log = $row['blog'];
```

只要在字符串中包含转义字符，变量 等复杂情况使用双引号

```
$myStr = "hello \n $body";
```


### 函数定义 ###

  * 参数的名字和变量的命名规范一致；
  * 具有默认值的参数应该位于参数列表的后面；
  * 必须仔细检查并切实杜绝函数起始缩进位置与结束缩进位置不同的现象。

```
/**
 * 日志分割
 *
 * @param string $content 日志内容
 * @param int $lid 日志id
 * @return unknown
 */
function breakLog($content,$lid){
	$a = explode("[break]",$content,2);
	if(!empty($a[1]))
		$a[0].='<p><a href="./?action=showlog&gid='.$lid.'">阅读全文&gt;&gt;</a></p>';
	return $a[0];
}
```