<?php
	include "../include/function.php";
	$DB = new myDB;
	$DB1 = new myDB;
	$action			= !empty($_GET["action"]);
	$loginId		= $_POST["id"];
	$loginpassword	= (!empty($_POST["pwd"]))? trim($_POST["pwd"]):null;
	$ip             = $_SERVER['SERVER_ADDR'];
	$browser        = $_SERVER['HTTP_USER_AGENT'];

	if($action=="logout")
	{
		setcookie("aduserID", "", time()-3600,"/",COOKIE_DOMAIN);
		setcookie("ip", "", time()-3600,"/",COOKIE_DOMAIN);
		echo "<script>
		window.location='./';
		</script>";
		exit;	
	}
	


	$strSQL 	= "Select count(*) AS cnt,id_user from  users where email='".$loginId."' and user_password='".$loginpassword."'";
//Print_r($strSQL);
//exit;	

	$DB->query($strSQL);
	$data = $DB->fetch_array($DB->res);
	$cnt=$data['cnt'];
	$AdminID=$data['id_user'];
//echo $AdminID;

	// i9Biz Staff login
	/*if ($loginId == "i9admin" and $loginpassword == "dkdlskdls") {
		$AdminID	= "i9BizStaff";
		$i9staff	= 1;
	}*/
	
	if ($cnt==1 ){
		/*
		$UstrSQL	= ("INSERT INTO WebsiteAdminLoginRecords (AdminID,LoginID,LoginPassword,IP_Address,BrowserInfo,DateTimeLoggedIn) VALUES(
				\"".$AdminID."\",
				\"".$loginId."\",
				\"".$loginpassword."\",
				\"".$ip."\",
				\"".$browser."\",
				now()
				)");

		$DB1->query($UstrSQL);
		*/	
		$expire	= time() + 60 * 60 * 3;
		
		//Print_r($loginId);	
		//Print_r(COOKIE_DOMAIN);
		setcookie("aduserID", $loginId, $expire,"/",COOKIE_DOMAIN);//COOKIE_DOMAIN);
		setcookie("ip", $ip, $expire,"/",COOKIE_DOMAIN);//COOKIE_DOMAIN);
		$DB->close();
		
		//Print_r($UstrSQL);
		//exit;
		
		echo "<script>
			window.location='./';
			</script>";
	} else {
		setcookie("aduserID", "", time()-3600);
		setcookie("ip", "", time()-3600);
		$DB->close();

		echo "<script>alert('Please input correct login ID or password.');
			window.location='./';
			</script>";	
	}




//echo $_COOKIE["userID"];


?>