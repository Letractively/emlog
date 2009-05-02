<?php
/**
 * 模型：用户管理
 * @copyright (c) Emlog All Rights Reserved
 * @version emlog-3.1.0
 * $Id$
 */


class emUser {

	var $dbhd;

	function emUser($dbhandle)
	{
		$this->dbhd = $dbhandle;
	}

	function getUsers($role = 'writer')
	{
		$res = $this->dbhd->query("SELECT * FROM ".DB_PREFIX."user where role='$role'");
		$users = array();
		while($row = $this->dbhd->fetch_array($res))
		{
			$row['name'] = htmlspecialchars($row['nickname']);
			$row['login'] = htmlspecialchars($row['username']);
			$users[] = $row;
		}
		return $users;
	}

	function updateUser($userData, $sid)
	{
		$Item = array();
		foreach ($userData as $key => $data)
		{
			$Item[] = "$key='$data'";
		}
		$upStr = implode(',', $Item);
		$this->dbhd->query("update ".DB_PREFIX."user set $upStr where uid=$sid");
	}

	function addUser($login, $password, $name, $description, $email, $role)
	{
		$sql="insert into ".DB_PREFIX."user (username,password,nickname,description,email,role) values('$login','$password','$name','$description','$email','$role')";
		$this->dbhd->query($sql);
	}
	
	function deleteUser($sid)
	{
		$this->dbhd->query("update ".DB_PREFIX."blog set sortid=-1 where sortid=$sid");
		$this->dbhd->query("DELETE FROM ".DB_PREFIX."user where sid=$sid");
	}

}

?>
