	<?php


	require_once("../include/function.php");
	include("head.php");
	include("header.php");
	include("sidebar.php");


	$DB = new myDB;
	$DB1 = new myDB;
	$DBa = new myDB;
	$DBi = new myDB;
	$DBu = new myDB;
	$DBd = new myDB;
	$DBx = new myDB;
	$DBy = new myDB;
	$DBm = new myDB;
	

	
	$view			= empty($_REQUEST["view"])		? 0 : $_REQUEST["view"];

	$uploadchk			= empty($_REQUEST["uploadchk"])		? 0 : $_REQUEST["uploadchk"];

	$action			= empty($_REQUEST["action"])		? null : $_REQUEST["action"];
	$icontact_id			= empty($_REQUEST["icontact_id"])		? null : $_REQUEST["icontact_id"];
	$ucontact_id			= empty($_REQUEST["contact_id"])		? null : $_REQUEST["contact_id"];
	$mcontact_id			= empty($_REQUEST["mcontact_id"])		? null : $_REQUEST["mcontact_id"];
	$delchk			= empty($_REQUEST["del"])		? null : $_REQUEST["del"];

	$from_date			= empty($_POST["from_date"])		? null : $_POST["from_date"];
	$from_time			= empty($_POST["from_time"])		? null : $_POST["from_time"];
	$to_date			= empty($_POST["to_date"])		? null : $_POST["to_date"];
	$to_time			= empty($_POST["to_time"])		? null : $_POST["to_time"];

	$sfrom_date			= empty($_POST["sfrom_date"])		? null : $_POST["sfrom_date"];
	$sto_date			= empty($_POST["sto_date"])		? null : $_POST["sto_date"];

	
	$id_vendor=2;
	$id_location=2;

	$id_user_created=1;
	$id_user_updated=1;
	$macontact_id="";
	
	if($action=="step1")
	{
		if($mcontact_id>0)
		{
			$strSQLy		= "UPDATE 1contact_master SET
						from_date				= \"".$from_date."\",
						to_date				= \"".$to_date."\",
						from_time				= \"".$from_time."\",
						to_time				= \"".$to_time."\",
						sfrom_date				= \"".$sfrom_date."\",
						sto_date				= \"".$sto_date."\",
						date_updated			= now(),
						id_user_updated			= \"".$id_user_updated."\"				
						WHERE contact_id=".$mcontact_id;
						$DBy->query($strSQLy);
		}
		else if($from_date!="")
		{
			$strSQLx		= "INSERT INTO 1contact_master (id_vendor,id_location,from_date,to_date,from_time,to_time,sfrom_date,sto_date,date_created,date_updated,id_user_created,id_user_updated)  VALUES(
						\"".$id_vendor."\",
						\"".$id_location."\",
						\"".$from_date."\",
						\"".$to_date."\",
						\"".$from_time."\",
						\"".$to_time."\",
						\"".$sfrom_date."\",
						\"".$sto_date."\",
						now(),
						now(),		
						\"".$id_user_created."\",
						\"".$id_user_created."\"
						)";
						$DBx->query($strSQLx);


						
						$strSQLa = " Select contact_id from 1contact_master Order BY contact_id DESC Limit 0,1";
						$DBa->query($strSQLa);

						while ($dataa = $DBa->fetch_array($DBa->res)){
							$mcontact_id=$dataa['contact_id'];
						}	

					
		}

		if (!empty($_FILES['csv']['size']) > 0) { 

				//get the csv file 
				$file = $_FILES[csv][tmp_name]; 
				$handle = fopen($file,"r"); 
				 
				//loop through the csv file and insert into database 
				do { 
					if ($data[0]) { 
						mysql_query("INSERT INTO 1contacts (category, name, unit,qty,price,description,mcontact_id) VALUES 
							( 							
								'".addslashes($data[0])."', 
								'".addslashes($data[1])."', 
								'".addslashes($data[2])."', 
								'".addslashes($data[3])."', 
								'".addslashes($data[4])."',					
								'".addslashes($data[5])."',
								'".$mcontact_id."'
							) 
						"); 
					} 
				} while ($data = fgetcsv($handle,1000,",","'")); 	// 

				//redirect 
				//header('Location: import.php?success=1'); die;
		} 

	}

	else if(($action =="view") or ($action =="step2"))
	{
		$strSQLm = "SELECT * FROM 1contact_master WHERE contact_id=".$mcontact_id;
		
		//echo $strSQLm;
		
		$DBm->query($strSQLm);
		while ($datam = $DBm->fetch_array($DBm->res)){
				$from_date=$datam['from_date'];
				$to_date=$datam['to_date'];
				$from_time=$datam['from_time'];
				$to_time=$datam['to_time'];
				$sfrom_date=$datam['sfrom_date'];
				$sto_date=$datam['sto_date'];

		}
	}



	if($delchk==1)
	{
		$strSQLd = "DELETE FROM 1contacts WHERE contact_id=".$icontact_id;
		
		//$strSQLd = "UPDATE contacts SET img= ''	WHERE contact_id=".$icontact_id;					
	//print_r($strSQLd);	
							
		$DBd->query($strSQLd);
	}


	if($action == "del") {
		
		foreach($_POST["delid"] as $key => $val) {
			$strSQL = ("DELETE FROM 1contact_master WHERE contact_id=".$val);
		//echo $strSQL;
			$DB->query($strSQL);

			$strSQL1 = ("DELETE FROM 1contacts WHERE mcontact_id=".$val);
		//echo $strSQL;
			$DB1->query($strSQL1);
		}
	}

	/*file save
	$error					= false;
	$absolutedir			= dirname(__FILE__);
	$dir					= '/tmp/';
	$serverdir				= $absolutedir.$dir;
	*/
	$filename				= array();

	foreach($_FILES as $name => $value) {
		
		if(!empty($_POST[$name.'_values']))
		{
			$json					= json_decode($_POST[$name.'_values']);
			$json->name= str_replace("/kmanager/tmp/","",$json->name);
			$tmp					= explode(',',$json->data);
			
			//db save			
			$extension				= strtolower(end(explode('.',$json->name)));
			$fname					= substr($json->name,0,-(strlen($extension) + 1)).'.'.substr(sha1(time()),0,6).'.'.$extension;
			
			
			
			//file save
			/*
			$imgdata 				= base64_decode($tmp[1]);
			
			$extension				= strtolower(end(explode('.',$json->name)));
			$fname					= substr($json->name,0,-(strlen($extension) + 1)).'.'.substr(sha1(time()),0,6).'.'.$extension;
			
			$rfname					= substr($json->name,0,-(strlen($extension) + 1)).'.'.$extension;
				
			
			$handle					= fopen($serverdir.$fname,'w');
			fwrite($handle, $imgdata);
			fclose($handle);
			$rfilename[]				= $rfname;

			*/

			

			$strSQLi = "UPDATE 1contacts SET img= \"".$fname."\"	, rimg= \"".$tmp[1]."\"  WHERE contact_id=".$json->alt ;					
							
			$DBi->query($strSQLi);		
			$filename[]				= $fname;
			
		}
	}

	if($ucontact_id>0)
	{
		$name			= empty($_REQUEST["name_e"])		? null : $_REQUEST["name_e"];
		$category			= empty($_REQUEST["category"])		? null : $_REQUEST["category"];
		$price			= empty($_REQUEST["price"])		? null : $_REQUEST["price"];
		$qty			= empty($_REQUEST["qty"])		? null : $_REQUEST["qty"];
		$unit			= empty($_REQUEST["unit"])		? null : $_REQUEST["unit"];
		$description			= empty($_REQUEST["description"])		? null : $_REQUEST["description"];

		$strSQLu = "UPDATE 1contacts SET name= '".$name."',category= '".$category."',price= ".$price.",qty= ".$qty.",unit= '".$unit."',description= '".$description."'
								WHERE contact_id=".$ucontact_id;					
								
				//print_r($strSQLu);
					$DBu->query($strSQLu);
	}


	/* server processing
	foreach($_POST["my_multi_select1"] as $key => $val) {
			$strSQLx		= "INSERT INTO contact_master (id_vendor,id_location,from_date,to_date,from_time,to_time,sfrom_date,sto_date,date_created,date_updated,id_user_created,id_user_updated)  VALUES(
						\"".$id_vendor."\",
						\"".$id_location."\",
						\"".$from_date."\",
						\"".$to_date."\",
						\"".$from_time."\",
						\"".$to_time."\",
						\"".$sfrom_date."\",
						\"".$sto_date."\",
						now(),
						now(),		
						\"".$id_user_created."\",
						\"".$id_user_created."\"
						)";
						$DBx->query($strSQLx);
		
			$DB->query($strSQL);
	*/

	?>		
		

	<link rel="stylesheet" type="text/css" href="/css/style_seung.css" />

    <!-- Bootstrap -->
   <!--<link href="assets/css/bootstrap.css" rel="stylesheet">-->
    <link href="../../assets/css/listdemo.html5imageupload.css?v1.3" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  
    
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
	
	<!--<link rel="stylesheet" href="/smanager/js/jquery-ui.css">
	<script src="/smanager/js/jquery-ui.js"></script>ksh-->
	
	<!--<script type='text/javascript' src='js/jquery.hoverIntent.minified.js'></script>-->
	
	<style>
	  #sortable { list-style-type: none; margin: 0; padding: 0;  }/*width: 800px;*/
	  #sortable li { margin: 0 0px 0px 0px;  padding-left: 1.5em;color:black;font-weight: 100;  }/*padding: 0.4em; width: 130px;height: 230px;float: left;font-size: 1.4em;*/
	  #sortable li span { position: absolute; margin-left: -1.3em; }

	  


	  </style>
  
  <script>
  $(function() {
    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();

	
  });
  </script>
			
<script type="text/javascript">
$(document).ready(function(){
	$( "#sortable" ).sortable({
		  update: function( event, ui ) {
		var frmDatas	= $("#form2").serializeArray();
		  frmDatas.push({name:"mode", value:"itemsort"});
		
			/*$.each(frmDatas, function(i, field){
            alert(field.value);

			});*/
		   $("#ajax_load").css('display','block');
		   $.ajax({
						async:false, type:"post", dataType:"json", url:"/lib/ajaxtools.php",
						data: frmDatas,
						success: function(d) {
							//location.reload();
				  }
			});
			
		  }
	});	

});
						
</script>







<input type="hidden" id="viewcheck" name="viewcheck" value="<?php echo $view?>">
<input type="hidden" id="uploadchk" name="uploadchk" value="<?php echo $uploadchk?>">
<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Modal title</h4>
						</div>
						<div class="modal-body">
							 Widget settings form goes here
						</div>
						<div class="modal-footer">
							<button type="button" class="btn blue">Save changes</button>
							<button type="button" class="btn default" data-dismiss="modal">Close</button>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->

			
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Coupons <small>Sale Coupons</small>
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="index.html">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">Coupons</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">Sale Coupon</a>
					</li>
				</ul>				
			</div>
			<!-- END PAGE HEADER-->
			
			
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">


	<div id="addarea" style="display:none;">			


				<div class="portlet box grey-cascade">						
						
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gift"></i>Step 1-Sale date Setup
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								<!--<a href="javascript:;" class="reload">
								</a>-->
								
							</div>
						</div>
						<div class="portlet-body form" id="addnew" style="display:block;">
							<form enctype="multipart/form-data" action="salecoupon.php" method="post"  role="form" class="form-horizontal form-row-seperated">
								<input type="hidden" name="action" value="step1">
								<input type="hidden" name="menu" value="1">
								<div class="form-body">
																	
									<h6 class="page-title" style="margin-left: 10px;margin-bottom: 0px;font-size: 18px;font-weight: 600;">
									Sale Show Period <small></small>
									</h6>
									<div class="form-group">
										<label class="control-label col-md-1">From Date</label>
										<div class="col-md-2">
											<div class="input-group input-medium date date-picker"  data-date-format="yyyy-mm-dd" data-date-viewmode="years">
												<input type="text" id="from_date" name="from_date" class="form-control" value="<?php echo $from_date?>">
												<span class="input-group-btn">
												<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
												</span>
											</div>											
										</div>
										<label class="control-label col-md-1">From Time</label>										
										<div class="col-md-1">
											<div class="input-group">
												<input type="text"  name="from_time"  value="<?php echo $from_time?>" class="form-control timepicker timepicker-24">												
											</div>
										</div>

										<label class="control-label col-md-1">To Date</label>
										<div class="col-md-2">
											<div class="input-group input-medium date date-picker"  data-date-format="yyyy-mm-dd" data-date-viewmode="years">
												<input type="text" id="to_date" name="to_date" class="form-control" value="<?php echo $to_date?>">
												<span class="input-group-btn">
												<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
												</span>
											</div>											
										</div>
										<label class="control-label col-md-1">To Time</label>
										
										<div class="col-md-1">
											<div class="input-group">
												<input type="text" name="to_time" class="form-control timepicker timepicker-24" value="<?php echo $to_time?>">
												
											</div>
										</div>
									</div>

									<h6 class="page-title col-md-1" style="margin-left: 10px;margin-bottom: 0px;font-size: 18px;font-weight: 600;">
									Sale Period <small></small>
									</h6>
									<div class="form-group">
										<label class="control-label col-md-1">From Date</label>
										<div class="col-md-3">
											<div class="input-group input-medium date date-picker"  data-date-format="yyyy-mm-dd" data-date-viewmode="years">
												<input type="text"  id="sfrom_date" name="sfrom_date" class="form-control" value="<?php echo $sfrom_date?>">
												<span class="input-group-btn">
												<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
												</span>
											</div>											
										</div>
										
										<label class="control-label col-md-1">To Date</label>
										<div class="col-md-3">
											<div class="input-group input-medium date date-picker"  data-date-format="yyyy-mm-dd" data-date-viewmode="years">
												<input type="text" id="sto_date" name="sto_date" class="form-control" value="<?php echo $sto_date?>">
												<span class="input-group-btn">
												<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
												</span>
											</div>											
										</div>
									</div>

									<div id="uploadarea" >
										<h6 class="page-title col-md-2" style="margin-left: 10px;margin-bottom: 0px;font-size: 18px;font-weight: 600;">
										Upload CSV <small></small>
										</h6>
										<div class="form-group">
											<div class="col-md-6">
												<input name="csv" type="file" id="csv" style="float: left;  margin-top: 20px;"/>											
											</div>	
										</div>
									</div>




									

									
									

								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">
											
											<button type="submit" class="btn green"><i class="fa fa-check"></i> Contiune</button>
											<button type="button" class="btn default" onclick="addcancel()">Cancel</button>
										</div>
									</div>
								</div>
							</form>								
						</div>
					</div>
				</div>

			

				



			<div class="portlet box red-sunglo" >						
						
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gift"></i>Step 2-Image Input 
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								
								
							</div>
						</div>
			</div>

			

							<div class="form-group" style="display:block">

									<div class="btn-group">
											<a href="edit_coupon.php" class="ajax"><span class="btn green">Add New coupon</span> </a>
										</div>
									<div class="btn-group">
									<?php $xcategory			= empty($_REQUEST["xcategory"])		? null : $_REQUEST["xcategory"]; ?>
											
											
												<label class="control-label col-md-3">Category</label>
												<div class="col-md-7">
													<select id="xcategory" onchange="change_catagory()" class="form-control select2me" data-placeholder="Select...">
														<option value="">Select</option>
														<option value="seafood"<?php if ($xcategory=='seafood') echo " selected"?>>Sea Food</option>
														<option value="deil"<?php if ($xcategory=='deil') echo " selected"?>>Deil</option>
													</select>													
												</div>
											
											
											
											
											
									</div>


								<!--<p><a href="edit_item.php" class="ajax"><span class="btn green">Add New</span> </a></p>-->
									<table class="table table-striped table-bordered table-hover " style="  margin-bottom: 4px;">	
									<tr>	
								   <td class="col-xs-1" style="text-align: center;">image</td><td class="col-xs-1" style="text-align: center;">category</td><td class="col-xs-1" style="text-align: center;" style="text-align: center;">name_e</td><td class="col-xs-1" style="text-align: center;">name_k</td><td class="col-xs-1" style="text-align: center;">name_s</td><td class="col-xs-1" style="text-align: center;">name_c</td><td class="col-xs-1" style="text-align: center;">unit</td><td class="col-xs-1" style="text-align: center;">qty</td><td class="col-xs-1" style="text-align: center;">price</td><td class="col-xs-5" style="text-align: center;">description</td><td class="col-xs-1"  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td class="col-xs-1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								   <tr>	
									</table>
								
								<?php 
								
								

								

								
								$strSQL = "SELECT * FROM 1contacts WHERE 1 ";
								
								if($mcontact_id!="")
								$strSQL .= " and  mcontact_id=".$mcontact_id;
								else
								$strSQL .= " and  mcontact_id=0";	
								
								if($xcategory!="")
								$strSQL .= " and  category='".$xcategory."'";

								$strSQL .= " ORDER BY SortNo ";

							//print_r($strSQL);		
								
								$i=1;
								$DB->query($strSQL);

								echo "<table>
								<tr><td>";
								echo '<form enctype="multipart/form-data" action="salecoupon.php" method="post" role="form" id="form2" name="forms2">';
								echo '<input type="hidden" name="action" value="step2">';
								echo '<input type="hidden" name="menu" value="1">';
								echo '<input type="hidden" name="view" value="1">';
								echo '<input type="hidden" name="uploadchk" value="1">';

								echo '<div >';	
								echo "<ul id=\"sortable\">";
								while ($data = $DB->fetch_array($DB->res)){			
										

									
									echo "<li  id=\"i_". $data["contact_id"] ."\" class=\"ui-state-default col-xs-12\" style=\"padding-left: 0.5em;overflow: hidden;\"><span class=\"ui-icon ui-icon-arrowthick-2-n-s\"></span>";
									echo "<input type=\"hidden\" name=\"hcontactid[]\" id=\"hcontactid\" value=\"" . $data["contact_id"] . "\"/>";
									echo '<table class="table-striped  table-hover" style="border-bottom: 1px solid #ddd;">';	
									/*if($i%2==1)
									echo '<tr style="background-color:#eeeeee;">';				
									else
									echo '<tr style="background-color:#ffffff;">';		
									*/
									echo '<tr style="cursor: move;">';	
										
									if($data['img']==""){
									echo '<td><div  class="dropzone smalltext smalltools"  data-ajax="false"  data-width="200"  data-height="200" data-url="canvas.php" data-originalsize="false" data-ghost="false"   data-originalsave="false"     style="width: 100px; height:100px;padding: 10px;border: 1px solid #DDD;  margin: 10px;">
									  <input type="file" name="thumb'.$data['contact_id'].'"  alt="'.$data['contact_id'].'" value="'.$data['contact_id'].'"/>			   
									</div></td>';
									}
									else
									{
									
									echo '<td><a class="ajax" href="edit_coupon.php?contact_id='.$data['contact_id'].'&mcontact_id='.$data['mcontact_id'].'">';
									//echo '<img  src="/kmanager/tmp/'. $data['img'].'" style="width: 100px; height:100px;"></a></td>';
									echo '<img  src="data:image;base64,'.$data['rimg'].'"  style="width: 100px; height:100px;"></a></td>';
									}
									


									echo '<td class="col-xs-1" style="  text-align: center;">
											'.$data['category'].'
										</td>	';
									echo '<td class="col-xs-1" style="  text-align: center;">
											'.$data['name'].'
										</td>	';
									echo '<td class="col-xs-1" style="  text-align: center;">
											'.$data['name'].'
										</td>	';
									echo '<td class="col-xs-1" style="  text-align: center;">
											'.$data['name'].'
										</td>	';
									echo '<td class="col-xs-1" style="  text-align: center;">
											'.$data['name'].'
										</td>	';

									echo '<td class="col-xs-1" style="  text-align: right;">
											'.$data['unit'].'
										</td>';
									echo '<td class="col-xs-1" style="  text-align: right;">
											'.$data['qty'].'
										</td>';
									echo '<td class="col-xs-1" style="  text-align: right;">
											'.$data['price'].'
										</td>';
									echo '<td class="col-xs-5" style="  text-align: center;">
											'.$data['description'].'
										</td>';
									echo '<td class="col-xs-1">
											<a class="ajax btn green" href="edit_coupon.php?contact_id='.$data['contact_id'].'&mcontact_id='.$data['mcontact_id'].'&menu=1" >Edit</a>
										</td>';
									echo '<td class="col-xs-1">
											<a  href="salecoupon.php?icontact_id='.$data['contact_id'].'&del=1&menu=1&view=1&uploadchk=1" class="btn green">Del</a>
										</td>';
									echo '</tr></table></li>';
									$i++;
										
								}
								
								echo '</ul></div>';		
							  ?>
							  </div>
							  
							  <div><button type="submit" class="btn green">Submit</button></div>		  
							  </form>
							  </td></tr></table>
							</div>	  
					


<div id="brancharea" > 						
							<div class="portlet box yellow" style="margin-top:50px;">						
							
								<div class="portlet-title">
									<div class="caption">
										<i class="fa fa-gift"></i>Step 3-Select Branch 
									</div>
									<div class="tools">
										<a href="javascript:;" class="collapse">
										</a>
										
										
									</div>
								</div>


								<div class="portlet-body form" id="addnew" style="display:block;">
									<form enctype="multipart/form-data" action="notice_action.php" method="post" role="form" class="form-horizontal form-row-seperated">
									<input type="hidden" name="menu" value="1">
										<div class="form-body">
											<div class="form-group">
												<label class="control-label col-md-1">Branch</label>
												<div class="col-md-9">
													<select multiple="multiple" class="multi-select" id="my_multi_select1" name="my_multi_select1[]">
														<option value="1">Fulloton</option>
														<option value="2">BuanaPark</option>
														<option value="3">Sandiego</option>
														<option value="4">Torrance</option>
														<option value="5">Los angeles</option>												
													</select>
												</div>
											</div>
										</div>	
										<div class="form-actions">
											<div class="row">
												<div class="col-md-offset-3 col-md-9">
													<button type="submit" class="btn green"><i class="fa fa-check"></i> Contiune</button>
													<button type="button" class="btn default" onclick="addcancel()">Cancel</button>
												</div>
											</div>
										</div>
									</form>								
								</div>
							</div>
					</div>



					</div>





							<div class="portlet box purple" >
						
								<div class="portlet-title">
									<div class="caption">
										<i class="fa fa-gift"></i>Sale List
									</div>
									<div class="tools">
										<a href="javascript:;" class="collapse">
										</a>
										
										
									</div>
								</div>
								
								<div class="portlet-body form" id="addnew2" >
								
								<div class="col-md-1">
										<div class="btn-group">
											<button  class="btn green" onclick="addbtn()">
											Bulk Add New <i class="fa fa-plus"></i></a>
											</button>
										</div>
									</div>
								<div class="col-md-1">
										<div class="btn-group">
											<button  class="btn green" onclick="singleadd()">
											Single Add New <i class="fa fa-plus"></i></a>
											</button>
										</div>
									</div>	


								<form enctype="multipart/form-data" action="salecoupon.php" method="post" role="form">	
									<div class="col-md-10">
									<div class="btn-group">
										<button id="sample_editable_1_new" class="btn green" onclick="return delcoupon(this.form)" style="margin-left: 10px;">
										Delete <i class="fa fa-trash-o"></i></a>
										</button>
										<input type="hidden" name="action"  value="del"/>
									</div>
									</div>
									
									<table class="table table-striped table-bordered table-hover" id="sample_3">
									<thead>
									<tr>
										<th class="table-checkbox">
											<input type="checkbox"  class="group-checkable" data-set="#sample_3 .checkboxes"/>
										</th>
										
										<th>
											 From Date
										</th>
										<th>
											 To Date
										</th>
										<th>
											 Show From Date
										</th>
										<th>
											 Show To Date
										</th>
										<th>
											 Market
										</th>
										<th >
											 Location
										</th>
										<th>
											 Edit
										</th>
										
									</tr>
									</thead>
									<tbody>	
									<?php
									$strSQL = "SELECT * FROM 1contact_master";
									$DB->query($strSQL);
									while ($data = $DB->fetch_array($DB->res)){
									
										echo '<tr class="odd gradeX">
											<td>
												<input type="checkbox" class="checkboxes" name="delid[]" value="'.$data['contact_id'].'"/>
											</td>
											<td>
												 '.$data['from_date'].'
											</td>
											<td>
												'. $data['to_date'].'
											</td>
											<td>
												 '.$data['sfrom_date'].'
											</td>
											<td>
												'. $data['sto_date'].'
											</td>											
											
											<td >
												 '. $data['id_vendor'].'
											</td>
											<td>
												 '. $data['id_location'].'
											</td>
											
											<td>
												<a href="salecoupon.php?mcontact_id='.$data['contact_id'].'&action=view&menu=1&view=1&uploadchk=1" >
												<span class="btn green">Edit<i class="fa fa-pencil" style="margin-left: 10px;"></i></span></a>
												<!--<button id="sample_editable_1_new" class="btn green">
														Edit <i class="fa fa-plus"></i></a>
														</button>-->
											</td>
																		
										</tr>';
										} ?>
										</tbody>
									</table>
									</form>
								</div>
								
							</div>		





				</div>
			</div>
			<!-- END PAGE CONTENT-->
		</div>
	</div>
	<!-- END CONTENT -->
	
</div>
<!-- END CONTAINER -->
<?php
include("footer.php");
?>

<script src="../../assets/js/html5imageupload.js?v1.4.3"></script>

	<!-- jQuery Colorbox js/CSS ============================================================================================= -->
		<script type="text/javascript" src="/js/jquery.colorbox-min.js"></script>
        <link rel="stylesheet" type="text/css" media="screen" href="/css/jquery.colorbox.css">
	
	<script type="text/javascript">
			$(document).ready(function(){
				$('.ajax').colorbox();


				//alert($('#viewcheck').val());

				if($('#viewcheck').val()>0)
					$('#addarea').css('display','block');

				if($('#uploadchk').val()>0)
				{		
					$('#uploadarea').css('display','none');
					$('#brancharea').css('display','none');
				}
				
			});
	</script>



    
    <script>
	
	function delcoupon(frm){
		
			if (confirm("Do you want to delete event?")) {
				frm.submit();
			}
			return false;

		}

	function addbtn(){
		$('#addarea').css('display','block');
		$('#uploadarea').css('display','block');
		$('#brancharea').css('display','block');

		$('#from_date').val('');
		$('#to_date').val('');
		$('#sfrom_date').val('');
		$('#sto_date').val('');
	}	

	function change_catagory(){
	//alert('xxxx');
	var xcategory=$('#xcategory').val();
	location ='salecoupon.php?menu=1&xcategory='+xcategory;
	}
    
    $('#retrievingfilename').html5imageupload({
    	onAfterProcessImage: function() {
    		$('#filename').val($(this.element).data('name'));
    	},
    	onAfterCancel: function() {
    		$('#filename').val('');
    	}
    	
    });

	$('#form1').html5imageupload({
    	onAfterProcessImage: function() {
    		$('#filename1').val($(this.element).data('name'));
    	},
    	onAfterCancel: function() {
    		$('#filename1').val('');
    	}
    	
    });
    
    $('#save').html5imageupload({
    	onSave: function(data) {
    		console.log(data);
    	},
    	
    });
    
    $('.dropzone').html5imageupload();
    
    $( "#myModal" ).on('shown.bs.modal', function(){
    	$('#modaldialog').html5imageupload();
    });
    

    
    </script>
    