<?php
	include "../include/function.php";
	$DB = new myDB;
	
	$id_bangs			= empty($_REQUEST["id_bangs"])		? null : $_REQUEST["id_bangs"];
	$action			= empty($_POST["action"])		? null : $_POST["action"];
	//$delid			= empty($_POST["delid"])		? null : $_POST["delid"];
	$id_vendor			= empty($_POST["id_vendor"])		? null : $_POST["id_vendor"];
	$id_type_list			= empty($_POST["id_type_list"])		? null : $_POST["id_type_list"];
	$title			= empty($_POST["title"])		? null : $_POST["title"];
	$from_date			= empty($_POST["from_date"])		? null : $_POST["from_date"];
	$from_time			= empty($_POST["from_time"])		? null : $_POST["from_time"];
	$to_time			= empty($_POST["to_time"])		? null : $_POST["to_time"];
	$count			= empty($_POST["count"])		? null : $_POST["count"];

	$emoticon			= empty($_POST["emoticon"])		? null : $_POST["emoticon"];
	$description			= empty($_POST["description"])		? null : $_POST["description"];
	$detail_link			= empty($_POST["detail_link"])		? null : $_POST["detail_link"];
	$barcode			= empty($_POST["barcode"])		? null : $_POST["barcode"];
	$id_user_created			= empty($_POST["id_user_created"])		? null : $_POST["id_user_created"];
	$id_user_updated			= empty($_POST["id_user_updated"])		? null : $_POST["id_user_updated"];
	
	$age_from			= empty($_POST["age_from"])		? null : $_POST["age_from"];
	$age_to			= empty($_POST["age_to"])		? null : $_POST["age_to"];
	$gender			= empty($_POST["gender"])		? null : $_POST["gender"];	

	$image="";

	$id_vendor=1;
	$id_user_created=1;
	$id_user_updated=1;
	$id_type_list=2;

	$filetemp			= empty($_FILES['image']['tmp_name'])		? 0 : $_FILES['image']['tmp_name'];
	
	 if($filetemp!=0)
	 {
			if(getimagesize($_FILES['image']['tmp_name'])==TRUE)
			{
			
				$image=addslashes($_FILES['image']['tmp_name']);


				$name=addslashes($_FILES['image']['name']);
				$image=file_get_contents($image);

	//print_r($image);

				$image=base64_encode($image);
				//saveimage($name,$image);
				
			}
	 }	
	
	if($action == "del") {
		
		foreach($_POST["delid"] as $key => $val) {
			$strSQL = ("DELETE FROM bangs_vendors WHERE id_bangs=".$val);
		//echo $strSQL;
			$DB->query($strSQL);
		}
	}
	 else if ($id_bangs == "") {
		$strSQL		= "INSERT INTO bangs_vendors (id_vendor,id_type_list,title,from_date,from_time,to_time,description,";
		if($image!="")
		$strSQL		.="image,";

		$strSQL		.="detail_link,barcode,date_created,date_updated,id_user_created,id_user_updated,gender,age_from,age_to,emoticon,count) VALUES(
				\"".$id_vendor."\",
				\"".$id_type_list."\",
				\"".$title."\",
				\"".$from_date."\",
				\"".$from_time."\",
				\"".$to_time."\",
				\"".$description."\",";
		if($image!="")
		$strSQL		.=		"\"".$image."\",";
		
		$strSQL		.=		"\"".$detail_link."\",
				\"".$barcode."\",
				now(),
				now(),		
				\"".$id_user_created."\",
				\"".$id_user_created."\",
				\"".$gender."\",
				\"".$age_from."\",
				\"".$age_to."\",
				\"".$emoticon."\",
				\"".$count."\"
					)";
	//echo $strSQL;
	//exit;
		$DB->query($strSQL);	
	} else if ($id_bangs >0) {
		
		
		$strSQL 	= "UPDATE bangs_vendors SET
				id_type_list				= \"".$id_type_list."\",
				title			= \"".$title."\",
				from_date			= \"".$from_date."\",
				from_time		= \"".$from_time."\",
				to_time		= \"".$to_time."\",
				description					= \"".$description."\",";
				
		if($image!="")
		$strSQL .=	"image			= \"".$image."\",";
				
		$strSQL .=	"detail_link			= \"".$detail_link."\",
				barcode			= \"".$barcode."\",
				date_updated			= now(),
				id_user_updated			= \"".$id_user_updated."\",
				count		= \"".$count."\",
				gender		= \"".$gender."\",
				age_from		= \"".$age_from."\",
				age_to		= \"".$age_to."\",
				emoticon		= \"".$emoticon."\"
				WHERE id_bangs=".$id_bangs;
		//echo $strSQL;
		//exit;
		$DB->query($strSQL);
	}
	$DB->close();
//exit;
	echo "<script>location.replace('bang.php?id_bangs=".$id_bangs."&menu=2');</script>";
	//echo "<script>location.replace('bang.php?SearchField=".$SearchField."&SearchKeyword=".$SearchKeyword."&pp=".$pp."&act=".$view."&id_bangs=".$id_bangs."&submit=Submit');</script>";
?>