<?php


require_once("../include/function.php");
$DB = new myDB;
$id_events			= empty($_REQUEST["id_events"])		? null : $_REQUEST["id_events"];
//$id_events=1;
//$id_events=1;//$_REQUEST['id_events'];





?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>gogo</title>
  
    <!-- Bootstrap -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/css/demo.html5imageupload.css?v1.3" rel="stylesheet">


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
		  <form enctype="multipart/form-data" action="event_action.php" method="post" role="form">
		  <input type="hidden" name="id_events" value="<?php echo $id_events?>">
		  

		  <div class="form-group">
			<?php 
			
			if($id_events>0)
			{
				$strSQL = "SELECT * FROM events_vendors WHERE id_events=".$id_events;
				
				$DB->query($strSQL);
				while ($data = $DB->fetch_array($DB->res)){			
				
				echo '	<input type="hidden" name="action"  value="update"/>
						<input type="hidden" name="id_events"  value="'.$data['id_events'].'"/>
						<div class="form-group">
							<label class="control-label col-md-2">Date Range</label>
							<div class="col-md-8">
								<div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="yyyy-mm-dd">
									<input type="text" class="form-control" name="from_date"  value="'.$data['from_date'].'"/>
									<span class="input-group-addon">
									to </span>
									<input type="text" class="form-control" name="to_date" value="'.$data['to_date'].'"/>
								</div>
							</div>
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
					<label for="name">Video link</label>
					<input type="text" name="video_link" class="form-control" value="'.$data['video_link'].'"/>
					</div>';				
				}
			}
			else
			{
				echo '				
						<input type="hidden" name="action"  value="add"/>
						<div class="form-group">
							<label class="control-label col-md-2">Date Range</label>
							<div class="col-md-8">
								<div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="yyyy-mm-dd">
									<input type="text" class="form-control" name="from_date">
									<span class="input-group-addon">
									to </span>
									<input type="text" class="form-control" name="to_date">
								</div>
							</div>
						</div>';
				echo '<div class="col-xs-8">
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
					<label for="name">Video link</label>
					<input type="text" name="video_link" class="form-control" value=""/>
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
</html>