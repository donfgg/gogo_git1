<?php
	include "../include/function.php";
	$DB = new myDB;
	
	$id_user			= empty($_REQUEST["id_user"])		? null : $_REQUEST["id_user"];
	$action				= empty($_POST["action"])		? null : $_POST["action"];
	
	$email				= empty($_POST["email"])		? null : $_POST["email"];
	$id_vendor			= empty($_POST["id_vendor"])		? null : $_POST["id_vendor"];
	$user_type			= empty($_POST["user_type"])		? null : $_POST["user_type"];
	$first_name			= empty($_POST["first_name"])		? null : $_POST["first_name"];
	$last_name			= empty($_POST["last_name"])		? null : $_POST["last_name"];
	$user_password		= empty($_POST["user_password"])		? null : $_POST["user_password"];
	$birthday			= empty($_POST["birthday"])		? null : $_POST["birthday"];
	$id_department		= empty($_POST["id_department"])		? null : $_POST["id_department"];
	$id_position		= empty($_POST["id_position"])		? null : $_POST["id_position"];
	
	
	

	//$id_vendor=1;
	$id_type_days=1;
	$id_type_open=1;
	$id_user_created=1;
	$id_user_updated=1;
	

	if($action == "del") {
		
		foreach($_POST["delid"] as $key => $val) {
			$strSQL = ("DELETE FROM users WHERE id_users=".$val);
		//echo $strSQL;
			$DB->query($strSQL);
		}
	}	
	
	else if ($action == "add") {
		
		$strSQL		= "INSERT INTO users (id_vendor,user_type,first_name,last_name,user_password,email,birthday,date_created,date_updated,id_user_created,id_user_updated) 
				VALUES(
				\"".$id_vendor."\",
				\"".$user_type."\",
				\"".$first_name."\",
				\"".$last_name."\",
				\"".$user_password."\",
				\"".$email."\",
				\"".$birthday."\",
				now(),
				now(),		
				\"".$id_user_created."\",
				\"".$id_user_created."\"				
					)";
	//echo $strSQL;  id_vendor primary key :duplicate error 
	//exit;
		$DB->query($strSQL);	
	} 
	else if($action=="self")
	{
		$strSQL 	= "UPDATE users SET
				id_vendor				= \"".$id_vendor."\",
				user_type			= \"".$user_type."\",
				first_name			= \"".$first_name."\",
				last_name		= \"".$last_name."\",
				user_password		= md5(\"".$user_password."\"),
				email					= \"".$email."\",";
	
		$strSQL .=	"birthday			= \"".$birthday."\",
				date_updated			= now(),
				id_user_updated			= \"".$id_user_updated."\"				
				WHERE id_user=".$id_user;
		//echo $strSQL;
		//exit;
		$DB->query($strSQL);
	}
	else {
		
		$strSQL 	= "UPDATE users SET
				id_vendor				= \"".$id_vendor."\",
				user_type			= \"".$user_type."\",
				first_name			= \"".$first_name."\",
				last_name		= \"".$last_name."\",
				user_password		= md5(\"".$user_password."\"),
				email					= \"".$email."\",";
	
		$strSQL .=	"birthday			= \"".$birthday."\",
				date_updated			= now(),
				id_user_updated			= \"".$id_user_updated."\"				
				WHERE id_user=".$id_user;
		//echo $strSQL;
		//exit;
		$DB->query($strSQL);

	}
	$DB->close();
//exit;
	echo "<script>location.replace('user.php?id_user=".$id_user."&menu=3');</script>";
	//echo "<script>location.replace('bang.php?SearchField=".$SearchField."&SearchKeyword=".$SearchKeyword."&pp=".$pp."&act=".$view."&id_bangs=".$id_bangs."&submit=Submit');</script>";
?>