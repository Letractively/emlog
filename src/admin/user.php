<?php
/**
 * 用户管理
 * @copyright (c) Emlog All Rights Reserved
 * @version emlog-3.1.0
 * $Id$
 */

require_once('globals.php');
require_once(EMLOG_ROOT.'/model/C_user.php');

//加载用户管理页面
if($action == '')
{
	$emUser = new emUser($DB);
	$users = $emUser->getUsers();

	include getViews('header');
	require_once(getViews('user'));
	include getViews('footer');
	cleanPage();
}
if($action== 'new')
{
	$login = isset($_POST['login']) ? addslashes(trim($_POST['login'])) : '';
	$name = isset($_POST['name']) ? addslashes(trim($_POST['name'])) : '';
	$password = isset($_POST['password']) ? addslashes(trim($_POST['password'])) : '';
	$password2 = isset($_POST['password2']) ? addslashes(trim($_POST['password2'])) : '';
	$email = isset($_POST['email']) ? addslashes(trim($_POST['email'])) : '';
	$description = isset($_POST['description']) ? addslashes(trim($_POST['description'])) : '';
	$role = isset($_POST['role']) ? addslashes(trim($_POST['role'])) : 'writer';

	if($login == '')
	{
		header("Location: ./user.php?error_login=true");
		exit;
	}
	if(strlen($password) < 6)
	{
		header("Location: ./user.php?error_pwd_len=true");
		exit;
	}
	if($password != $password2)
	{
		header("Location: ./user.php?error_pwd2=true");
		exit;
	}
	
	require_once(EMLOG_ROOT.'/lib/C_phpass.php');
	$PHPASS = new PasswordHash(8, true);
	$password = $PHPASS->HashPassword($password);

	$emUser = new emUser($DB);
	$emUser->addUser($login, $password, $name, $description, $email, $role);

	$CACHE->mc_user();
	
	header("Location: ./user.php?active_add=true");
}
?>