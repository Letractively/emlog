<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
<div id="navi">
<a href="./">日志</a> 
<a href="./?action=tw">碎语</a> 
<a href="./?action=com">评论</a> 
<?php if(ROLE == 'admin' || ROLE == 'writer'): ?>
<a href="./?action=logout">退出</a>
<?php else:?>
<a href="./?action=login" id="active">登录</a>
<?php endif;?>
</div>
<div id="m">
	<form method="post" action="./?action=auth">
	<div class="login-main">
	    <div class="login-input">
	        <span>用户名</span>
	        <div><input type="text" name="user" id="user" /></div>
	        <span>密码</span>
	        <div><input type="password" name="pw" id="pw" /></div>
	        <?php echo $ckcode; ?>
	    </div>
	    <div class="button"><input type="submit" value=" 登 录" class="submit"></div>
	</div>
	</form>
</div>