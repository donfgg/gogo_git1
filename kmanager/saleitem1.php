<?php


require_once("../include/function.php");

require_once("head.php");
require_once("header.php");
require_once("sidebar.php");


$DB = new myDB;
$DBi = new myDB;
$DBu = new myDB;
$DBd = new myDB;

$icontact_id			= empty($_REQUEST["icontact_id"])		? null : $_REQUEST["icontact_id"];
$ucontact_id			= empty($_REQUEST["contact_id"])		? null : $_REQUEST["contact_id"];
$delchk			= empty($_REQUEST["del"])		? null : $_REQUEST["del"];



if($delchk==1)
{
	$strSQLd = "UPDATE contacts SET img= ''	WHERE contact_id=".$icontact_id;					
//print_r($strSQLd);	
						
	$DBd->query($strSQLd);
}

$error					= false;

$absolutedir			= dirname(__FILE__);
$dir					= '/tmp/';
$serverdir				= $absolutedir.$dir;


$filename				= array();

foreach($_FILES as $name => $value) {
	
	if(!empty($_POST[$name.'_values']))
	{
		$json					= json_decode($_POST[$name.'_values']);




$json->name= str_replace("/modules/tmp/","",$json->name);


		$tmp					= explode(',',$json->data);

		$imgdata 				= base64_decode($tmp[1]);
		
		$extension				= strtolower(end(explode('.',$json->name)));
		$fname					= substr($json->name,0,-(strlen($extension) + 1)).'.'.substr(sha1(time()),0,6).'.'.$extension;
		
		$rfname					= substr($json->name,0,-(strlen($extension) + 1)).'.'.$extension;
			
		
		$handle					= fopen($serverdir.$fname,'w');
		fwrite($handle, $imgdata);
		fclose($handle);

		

		$strSQLi = "UPDATE contacts SET img= \"".$fname."\"	   WHERE contact_id=".$json->alt ;					
						
			$DBi->query($strSQLi);

		
		$filename[]				= $fname;
		$rfilename[]				= $rfname;
		
		
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


		$strSQLu = "UPDATE contacts SET name= '".$name."',category= '".$category."',price= ".$price.",qty= ".$qty.",unit= '".$unit."',description= '".$description."'
								WHERE contact_id=".$ucontact_id;					
								
				//print_r($strSQLu);
					$DBu->query($strSQLu);
	}


?>



	
	<link rel="stylesheet" type="text/css" href="/css/style_seung.css" />

    <!-- Bootstrap -->
   <!--<link href="assets/css/bootstrap.css" rel="stylesheet">-->
    <link href="assets/css/listdemo.html5imageupload.css?v1.3" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  
    
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
	<link rel="stylesheet" href="/smanager/js/jquery-ui.css">
	<script src="/smanager/js/jquery-ui.js"></script>
	<script type='text/javascript' src='js/jquery.hoverIntent.minified.js'></script>
	
	<style>
	  #sortable { list-style-type: none; margin: 0; padding: 0;  }/*width: 800px;*/
	  #sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em;color:black;font-weight: 100;  }/*width: 130px;height: 230px;float: left;font-size: 1.4em;*/
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
							location.reload();
				  }
			});
			
		  }
	});	

});
						
</script>


	<div class="container">
	  <div class="row">
	    <div class="col-xs-12">
			<table class="col-xs-12">	
			<tr>	
		   <td>image</td><td>category</td><td>name_e</td><td>name_k</td><td>name_s</td><td>name_c</td><td>unit</td><td>qty</td><td>price</td><td>description</td><td>action</td><td>action</td>
		   <tr>	
			</table>
		
		  <div class="form-group">
			<?php 
			
			$strSQL = "SELECT * FROM contacts ORDER BY SortNo ";
			$i=1;
			$DB->query($strSQL);

			echo "<table>
			<tr><td>";
			echo '<form enctype="multipart/form-data" action="saleitem.php" method="post" role="form" id="form2" name="forms2">';
			echo '<div >';	
			echo "<ul id=\"sortable\">";
			while ($data = $DB->fetch_array($DB->res)){			
					

				
				echo "<li  id=\"i_". $data["contact_id"] ."\" class=\"ui-state-default col-xs-12\" style=\"padding-left: 0.5em;overflow: hidden;\"><span class=\"ui-icon ui-icon-arrowthick-2-n-s\"></span>";
				echo "<input type=\"hidden\" name=\"hcontactid[]\" id=\"hcontactid\" value=\"" . $data["contact_id"] . "\"/>";
				echo '<table>';	
				if($i%2==1)
				echo '<tr style="background-color:#eeeeee;">';				
				else
				echo '<tr style="background-color:#ffffff;">';		


				if($data['img']==""){
				echo '<td><div  class="dropzone smalltext smalltools"  data-ajax="false"  data-width="200"  data-height="200" data-url="canvas.php" data-originalsize="false" data-ghost="false"   data-originalsave="false"     style="width: 100px; height:100px;padding: 10px;border: 1px solid #DDD;  margin: 10px;">
				  <input type="file" name="thumb'.$data['contact_id'].'"  alt="'.$data['contact_id'].'" value="'.$data['contact_id'].'"/>			   
				</div></td>';
				}
				else
				{
				
				echo '<td><a class="ajax" href="edit_item.php?contact_id='.$data['contact_id'].'">
				<img  src="/modules/tmp/'. $data['img'].'" style="width: 100px; height:100px;"></a></td>';//  src="data:image;base64,'.$data['Rimg'].'"

				}
				


				echo '<td class="col-xs-1">
						'.$data['category'].'
					</td>	';
				echo '<td class="col-xs-1">
						'.$data['name'].'
					</td>	';
				echo '<td class="col-xs-1">
						'.$data['name'].'
					</td>	';
				echo '<td class="col-xs-1">
						'.$data['name'].'
					</td>	';
				echo '<td class="col-xs-1">
						'.$data['name'].'
					</td>	';

				echo '<td class="col-xs-1">
						'.$data['unit'].'
					</td>';
				echo '<td class="col-xs-1">
						'.$data['qty'].'
					</td>';
				echo '<td class="col-xs-1">
						'.$data['price'].'
					</td>';
				echo '<td class="col-xs-3">
						'.$data['description'].'
					</td>';
				echo '<td class="col-xs-3">
						<a class="ajax" href="edit_item.php?contact_id='.$data['contact_id'].'" >Edit</a>
					</td>';
				echo '<td class="col-xs-3">
						<a  href="index.php?icontact_id='.$data['contact_id'].'&del=1" >Del</a>
					</td>';
				echo '</tr></table></li>';
				$i++;
					
			}
			
			echo '</ul></div>';		
		  ?>
		  </div>
		  <div style="height:300px;"><span >&nbsp;</span></div>
		  <div><button type="submit" class="btn btn-default">Submit</button></div>		  
		  </form>
		  </td></tr></table>
	    </div>	  
	</div>
	
	
	

    
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!--<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>-->
    
    <script src="assets/js/html5imageupload.js?v1.4.3"></script>

	<!-- jQuery Colorbox js/CSS ============================================================================================= -->
		<script type="text/javascript" src="/js/jquery.colorbox-min.js"></script>
        <link rel="stylesheet" type="text/css" media="screen" href="/css/jquery.colorbox.css">
	
	<script type="text/javascript">
			$(document).ready(function(){
				$('.ajax').colorbox({rel:'ajax'});
			});
	</script>

    
    <script>
    
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
    
  </body>
</html>