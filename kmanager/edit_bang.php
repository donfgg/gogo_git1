<?php


require_once("../include/function.php");
$DB = new myDB;
$id_bangs			= empty($_REQUEST["id_bangs"])		? null : $_REQUEST["id_bangs"];
//$id_events=1;
//$id_events=1;//$_REQUEST['id_events'];
?>
<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.4
Version: 3.9.0
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>gogmarket</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/clockface/css/clockface.css"/>
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css"/>
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"/>
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="../../assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link id="style_color" href="../../assets/admin/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
</head>





    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    
	<div class="container">
	  <div class="row">
	    <div class="col-xs-12">
		  <form enctype="multipart/form-data" action="bang_action.php" method="post" role="form">
		  <input type="hidden" name="id_bangs" value="<?php echo $id_bangs?>">
		  

		  <div class="form-group">
			<?php 
			
			if($id_bangs>0)
			{
				$strSQL = "SELECT * FROM bangs_vendors WHERE id_bangs=".$id_bangs;
				
				$DB->query($strSQL);
				while ($data = $DB->fetch_array($DB->res)){			
				
				echo '				
						<input type="hidden" name="action"  value="add"/>
						<div class="form-group">
							<label class="control-label col-md-1">Date</label>
							<div class="col-md-3">
								<div class="input-group input-medium date date-picker"  data-date-format="yyyy-mm-dd" data-date-viewmode="years">
									<input type="text" name="from_date" class="form-control" value="'.$data['from_date'].'">
									<span class="input-group-btn">
									<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
									</span>
								</div>
								
							</div>
						</div>';

				echo '<div class="form-group">
							<label class="control-label col-md-1">From</label>
							
							<div class="col-md-3">
								<div class="input-group">
									<input type="text" name="from_time" value="'.$data['from_time'].'" class="form-control timepicker timepicker-24">
									<!--<span class="input-group-btn">
									<button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
									</span>-->
								</div>
							</div>

						</div> ';

				echo '<div class="form-group">
							<label class="control-label col-md-1">To</label>
							
							<div class="col-md-3">
								<div class="input-group">
									<input type="text" name="to_time" value="'.$data['to_time'].'" class="form-control timepicker timepicker-24">
									<!--<span class="input-group-btn">
									<button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
									</span>-->
								</div>
							</div>

						</div> ';
		
				
				echo '<div class="col-xs-4">
					<label for="name">Count</label>
					<input type="text" name="count" class="form-control" value="'.$data['count'].'"/>
					</div>';
				
				echo '<div class="col-xs-8">
					<label for="name">Title</label>
					<input type="text" name="title" class="form-control" value="'.$data['title'].'"/>
					</div>';
				echo '<div class="col-xs-12">
					<label for="name">Description</label>
					<input type="text" name="description" class="form-control" value="'.$data['description'].'"/>
					</div>';
				echo '<div class="col-xs-3">
					<label for="name">image</label>
					<input type="file" name="image" class="form-control" value=""/>
					</div>';
				echo '<div class="col-xs-8">
					
					<img src="data:image/jpg;base64,'.$data['image'].'" style="width:600px; height:150px; padding: 10px;"/>
					</div>';
				echo '<div class="col-xs-6">
					<label for="name">Image link</label>
					<input type="text" name="detail_link" class="form-control" value="'.$data['detail_link'].'"/>
					</div>';
				echo '<div class="col-xs-6">
					<label for="name">Barcode</label>
					<input type="text" name="barcode" class="form-control" value="'.$data['barcode'].'"/>
					</div>';
				echo '<div class="col-xs-1">
					<label for="name">Gender</label>
					<select name="gender">
					<option value="">Select</option>
					<option value="M" '; 
					if ($data["gender"]=="M") 
						echo 'selected';
					echo '>Male</option>
					<option value="F" ';
					if ($data["gender"]=="F")
					echo 'selected';
					echo '>Female</option>
					</select>
					
					</div>';
				echo '<div class="col-xs-1">
					<label for="name">Age from</label>
					<input type="text" name="age_from" class="form-control" value="'.$data['age_from'].'"/>
					</div>';			
			   echo '<div class="col-xs-1">
					<label for="name">Age to</label>
					<input type="text" name="age_to" class="form-control" value="'.$data['age_to'].'"/>
					</div>';
				echo '<div class="col-xs-12">
					<label for="name">Emoticon</label>
					<label><input type="radio" name="emoticon" id="emoticon1" value="1"';
				if ($data["emoticon"]=="1") 
						echo 'checked';
				echo'> Option 1</label>
					
					<label><input type="radio" name="emoticon" id="emoticon2" value="2"'; 
				if ($data["emoticon"]=="2") 
						echo 'checked';
				echo'> Option 2</label>

					
					</div>';


				}
			}
			else
			{
				echo '				
						<input type="hidden" name="action"  value="add"/>
						<div class="form-group">
							<label class="control-label col-md-1">Date</label>
							<div class="col-md-3">
								<div class="input-group input-medium date date-picker"  data-date-format="yyyy-mm-dd" data-date-viewmode="years">
									<input type="text" name="from_date" class="form-control" >
									<span class="input-group-btn">
									<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
									</span>
								</div>
								
							</div>
						</div>';

				echo '<div class="form-group">
							<label class="control-label col-md-1">From</label>
							
							<div class="col-md-3">
								<div class="input-group">
									<input type="text" name="from_time" class="form-control timepicker timepicker-24">
									<!--<span class="input-group-btn">
									<button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
									</span>-->
								</div>
							</div>
							
							
							<!--<div class="col-md-3">
								<input type="text" name="from_time" value="11:30 PM" data-format="hh:mm A" class="form-control clockface_1"/>
							</div>-->
						</div> ';
				echo '<div class="form-group">
							<label class="control-label col-md-1">To</label>
							
							<div class="col-md-3">
								<div class="input-group">
									<input type="text" name="to_time" class="form-control timepicker timepicker-24">
									<!--<span class="input-group-btn">
									<button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
									</span>-->
								</div>
							</div>
							
							
							
							<!--<div class="col-md-3">
								<input type="text" name="to_time" value="2:30 PM" data-format="hh:mm A" class="form-control clockface_1"/>
							</div>-->
						</div> ';
		



				echo '<div class="col-xs-4">
					<label for="name">Count</label>
					<input type="text" name="count" class="form-control" value=""/>
					</div>';


				echo '<div class="col-xs-12">
					<label for="name">Title</label>
					<input type="text" name="title" class="form-control" value=""/>
					</div>';
				echo '<div class="col-xs-12">
					<label for="name">Description</label>
					<input type="text" name="description" class="form-control" value=""/>
					</div>';
				echo '<div class="col-xs-6">
					<label for="name">image</label>
					<input type="file" name="image" class="form-control" value=""/>
					</div>';
				
				echo '<div class="col-xs-6">
					<label for="name">Image link</label>
					<input type="text" name="detail_link" class="form-control" value=""/>
					</div>';
				echo '<div class="col-xs-6">
					<label for="name">Barcode</label>
					<input type="text" name="barcode" class="form-control" value=""/>
					</div>';
				echo '<div class="col-xs-1">
					<label for="name">Gender</label>
					<select name="gender">
					<option value="">Select</option>
					<option value="M" >Male</option>
					<option value="F" >Female</option>
					</select>
					</div>';
				echo '<div class="col-xs-1">
					<label for="name">Age from</label>
					<input type="text" name="age_from" class="form-control" value=""/>
					</div>';			
			   echo '<div class="col-xs-1">
					<label for="name">Age to</label>
					<input type="text" name="age_to" class="form-control" value=""/>
					</div>';
				echo '<div class="col-xs-12">
					<label for="name">Emoticon</label>
					<label><input type="radio" name="emoticon" id="emoticon1" value="1" > Option 1</label>
					<label><input type="radio" name="emoticon" id="emoticon2" value="2" > Option 2</label>
					</div>';
			}
					
		  ?>
		  </div>
		  <div style="height:420px;"><span >&nbsp;</span></div>
		  <div><button type="submit" class="btn btn-default" style="margin-left:15px;">Save</button></div>		  
		  </form>
	    </div>	  
	</div>
	
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="../../assets/global/plugins/respond.min.js"></script>
<script src="../../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="../../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="../../assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="../../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/clockface/js/clockface.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="../../assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="../../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="../../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="../../assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="../../assets/admin/pages/scripts/components-pickers.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
        jQuery(document).ready(function() {       
           // initiate layout and plugins
           Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init(); // init quick sidebar
Demo.init(); // init demo features
           ComponentsPickers.init();
        });   
    </script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>