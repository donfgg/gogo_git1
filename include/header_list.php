<!DOCTYPE HTML>
<html>
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="keywords" content="wholesale fashion, wholesale clothes, women's wholesale apparel, wholesale tops and dresses, fashion wholesale for boutiques, clothing wholesale, clothes wholesale, high-end designers's fashion">
		<meta name="description" content="Lemon Tree provides wholesale clothing to specialty boutiques and general retailer of fashion apparel.">
		<title>Lemontreeclothing.com</title>
		
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
        
		<!-- CSS =============================================================================================================== -->
		<link rel="stylesheet" type="text/css" href="/css/style.css" />
		<link rel="stylesheet" type="text/css" href="/css/style_print.css" media="print" />
		<link rel="stylesheet" type="text/css" href="/css/cloud-zoom.css" />
		<link rel="stylesheet" type="text/css" href="/css/jqtransform.css" media="all" />
		
		<!-- Custom CSS ======================================================================================================== -->
		<link rel="stylesheet" type="text/css" href="/css/style_jy.css" />
		<link rel="stylesheet" type="text/css" href="/css/style_don.css" />
		<link rel="stylesheet" type="text/css" href="/css/style_seung.css" />
		
		<!-- jQuery js =========================================================================================================== -->
		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script type="text/javascript" src="/js/jquery-1.9.1.min.js"></script>
		 <script src="http://code.jquery.com/jquery-migrate-1.1.0.js"></script>
		
		<!--script type="text/javascript" src="/js/jquery-1.7.1.js"></script-->
        <!--script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script-->
		
		<!-- jQuery Colorbox js/CSS ============================================================================================= -->
		<script type="text/javascript" src="/js/jquery.colorbox-min.js"></script>
        <link rel="stylesheet" type="text/css" href="/css/colorbox.css"></link>
		<!-- Error!!! This is not 'js' file. It's CSS. (Seung)
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.colorbox/1.4.33/example1/colorbox.min.css"></script-->
		
		<!-- Amazon Scroller js/CSS ============================================================================================== -->
		<link rel="stylesheet" type="text/css" href="/css/amazon_scroller.css"></link>
		<script type="text/javascript" src="/js/amazon_scroller.js"></script>
        
        <!-- Bootstrap v3.3.1 js/CSS ============================================================================================== -->
        <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="/bootstrap/css/bootstrap-theme.min.css">
		<link rel="stylesheet" href="/bootstrap/css/demo.css">
		<link rel="stylesheet" href="/bootstrap/css/yamm.css">
        <script src="/bootstrap/js/bootstrap.min.js"></script>
        
		
        <!-- Amazing Slider JS -->
        <script src="/sliderengine/amazingslider.js"></script>

        <!-- Amazing Slider initiation productlist.php slider-1 -->
        <link rel="stylesheet" type="text/css" href="/sliderengine/amazingslider-1.css">
		<script src="/sliderengine/initslider-1.js"></script>
        
        <!-- Amazing Slider initiation _index.php slider-100 -->
        <link rel="stylesheet" type="text/css" href="sliderengine-index/amazingslider-100.css">
        <script src="sliderengine-index/initslider-100.js"></script>
        
		<script type="text/javascript" src="/js/jquery-ias.min.js"></script>
        
		<!-- Custom js =========================================================================================================== -->
		<script type="text/javascript" src="/js/script.js"></script>
		<script type="text/javascript" src="/js/script_don.js"></script>
        <script type="text/javascript" src="/js/script_seung.js"></script>
		<!--<script type="text/javascript" src="/js/menu.js"></script>-->
		<!-- Problometic js. (Seung)
		<script type="text/javascript" src="/js/script_jy.js"></script-->
		
		<!--[if !IE]>
		<script type="text/javascript" src="/js/sidebar_menu.js"></script>
		<![endif]-->
		<!--[if gte IE 8]>
		<script type="text/javascript" src="/js/sidebar_menu.js"></script>
		<![endif]-->
		<!--[if lte IE 7]>
		<script type="text/javascript" src="/js/sidebar_menu_ie.js"></script>
		<![endif]-->
		
		<script type="text/javascript">
			$(document).ready(function(){
				$('.ajax').colorbox({rel:'ajax'});
			});
		</script>
	</head>
	
	<?php 
		$headb          = new myDB;
		$headb->query("SELECT * FROM Background WHERE IsActive='Y' AND FromDate <= now() AND ToDate >= now() ORDER BY ToDate LIMIT 1");
        
		if($headb->rows > 0){
			$data 		= $headb->fetch_array($headb->res);
			$custombg	= " style=\"background:#{$data["BackgroundColor"]} url(/images/background/{$data["BackgroundImg"]}) 50% 0 {$data["BackgroundRepeat"]};\"";
			$bgsearch	= " style=\"background-color:#{$data["SearchboxColor"]};\"";
		}
        else{
			$custombg	= "";
			$bgsearch	= "";
		}
	?>	
    
    
	<body <?php echo $custombg?>>
	<p id="totop"><a href="#top" title="Go to top"><span></span></a></p>
        <div class="container-fluid background-color-2">
            <div class="header container">
                <div class="row">
                    <div class="col-md-4 col-xs-12">
                        <h1 class="logo">
                            <a href="<?php echo SITE_URL?>/" title="Lemontree.com" class="logo">Lemontree.com</a>
                        </h1>
                    </div>

                    <div class="col-md-8 col-xs-12">
                        <div class="col-xs-12">
                            <div class="header-menu-block">
                                <ul class="header-menu">

                                    <?php
                                        for($i=0; $i<count($headerMenu); $i++){
                                            if($headerMenu[$i][0] == "Log In"){
												
                                                if(isset($_COOKIE["userID"])){
                                                    //unset($headerMenu[$i]);
                                                    $headerMenu[$i][0] = "Log Out";
                                                    $headerMenu[$i][1] = "logout";
                                                    $headerMenu[$i][2] = "page=customer&account=logout";			
                                                }
                                            }
                                            else if($headerMenu[$i][0] == "Log Out"){
                                                if($_COOKIE["userID"] != ""){
                                                    //unset($headerMenu[$i]);
                                                    $headerMenu[$i][0] = "Log In";
                                                    $headerMenu[$i][1] = "login";
                                                    $headerMenu[$i][2] = "page=customer&account=login";				
                                                }
                                            }
                                            echo ($i<1) ? "<li class=\"first\">" : "<li>|&nbsp;&nbsp;&nbsp;&nbsp;";
                                            echo "<a href=\"";
                                            if ($headerMenu[$i][1] == "checkout"){
                                                echo str_replace("http", "https", SITE_URL);
                                            }
											else if ($headerMenu[$i][1] == "myaccount"){
                                                echo str_replace("http", "https", SITE_URL);
                                            }
                                            else{
                                                echo SITE_URL;
                                            }
                                            echo "/?".$headerMenu[$i][2] . "\" id=\"" . $headerMenu[$i][1] . "\">" . $headerMenu[$i][0];
                                            if($headerMenu[$i][0] == "My Cart"){
												
                                                if(isset($_SESSION["cart"])){
                                                    echo " (".multiDimArrSum($_SESSION['cart'])." items)";
                                                }
                                            }
                                            if($headerMenu[$i][0] == "My Wishlist"){
                                                if(isset($_COOKIE["wish"])) {
                                                    echo " (" . ($_COOKIE['wish']) . ")";
                                                }
                                            }
                                            echo "</a></li>\n";
                                        }
                                    ?>
                                </ul>
                            </div>
                            <p class="welcome-msg">
                                <?php 
								 
                                    if(isset($_COOKIE["userFirstname"])){
                                        echo "Welcome " . ((!empty($_COOKIE['VIPMember'])=="Y") ? "<img src=\"/images/ico_vip.png\" alt=\"VIP Member\" class=\"hicon\" />" : null) . $_COOKIE['userFirstname'] . "!";
                                    }
                                    else{
                                        echo "<span style='visibility: hidden;'>Welcome to our new online store!</span>";
                                    }
                                ?>
                            </p>
                            <p class="custom-msg">
                                <!--<img src="/images/we_ship_around_the_world.png" style="margin-top: 13px;" />-->
                            </p>

                            <!-- Quick Search Wrapper was here -->

                            <div class="no-display">
                                <ul class="middle_menu">
                                    <li>
                                        <a href="?page=customer&account=myorderhistory">Order Status</a>
                                    </li>
                                    <li>
                                        <a href="?info=customerservice">Customer Service</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-xs-12">
                            <div class="form-search">
                                <form id="header_search_form" action="index.php" method="get">
                                    <?php $q = empty($_GET["q"]) ? "" : $_GET["q"];?>
                                    <input type="text" id="search" name="q" value="<?php if($q) echo $q; else echo "Search product, item #...";?>" onFocus="return Focus(this.form);" onBlur="return Blur(this.form);" class="input-text" autocomplete="off"<?php echo $bgsearch?> />
                                    <button type="button" onClick="return SearchConfirm(this.form);" title="Search" class="button"></button>
                                    <!--<img src="/images/tollfreenumber.png" style="margin-top: 8px;" />-->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="container-fluid ">
            <div class="container">
                
				<div class="navbar navbar-default yamm">
				  <div class="navbar-header">
					<button type="button" data-toggle="collapse" data-target="#navbar-collapse-2" class="navbar-toggle"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
				  </div>
				 <div id="navbar-collapse-2" class="navbar-collapse collapse">
					<ul class="nav navbar-nav">	
						<li class="dropdown"><a href="<?php echo SITE_URL?>/" data-toggle="dropdown" class="dropdown-toggle" style='font-family: sans-serif;font-weight:bold'>HOME<b class="caret"></b></a>
							<ul class="dropdown-menu">
							  <li>
							   <div class="yamm-content">
								  <ul class="media-list">
									<li class="media"><a href="#" class="pull-right"><!--<img src="http://placekitten.com/64/64/" alt="64x64" class="media-object">--></a>
									  <div class="media-body">
										<h4 class="media-heading">Media heading</h4>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante.
									  </div>
									</li>
									<li class="media"><a href="#" class="pull-right"><!--<img src="http://placekitten.com/64/64/" alt="64x64" class="media-object">--></a>
									  <div class="media-body">
										<h4 class="media-heading">Media heading</h4>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque.
									  </div>
									</li>
								  </ul>
								</div>
							  </li>
							</ul>
						  </li>
						
						<?php
                            for($i=0; $i<count($topMenu); $i++){
                                echo "<li style='font-family: sans-serif;font-weight:bold'><a href=\"" . LSITE_URL . "/" . $topMenu[$i][1] . "\">" . $topMenu[$i][0] . "</a></li>";
                            }
                        ?> 
					</ul>	
				
            </div>
        </div>
	 </div>
		<script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js?lang=css"></script>
		<script>
		  $(function() {
			window.prettyPrint && prettyPrint()
			$(document).on('click', '.yamm .dropdown-menu', function(e) {
			  e.stopPropagation()
			})
		  })
		</script>
		<!-- tweet and share :)-->
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>



        <!-- Disabled old menu ============================================================================================================= -->
        <div class="container-fluid" style="display:none;">
            <div class="top-menu-wrapper-list row">
                <div class="side-banner-vertical">
                    <a href="<?php echo SITE_URL;?>/?info=shippingpolicy">Free Shipping</a>
                </div>
                <a href="<?php echo SITE_URL?>/" title="Home" class="btn-home"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a>
                <ul class="top-menu-links">
                    <?php
                        for($i=0; $i<count($topMenu); $i++){
                            echo "<li><a href=\"" . LSITE_URL . "/" . $topMenu[$i][1] . "\">" . $topMenu[$i][0] . "</a></li>\n";
                        }
                    ?>
                </ul>
            </div>
        </div>
        <!-- Disabled old menu ============================================================================================================= -->