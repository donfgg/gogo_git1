<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
<?php 

$menu	= empty($_GET["menu"])?"":$_GET["menu"];

?>


<!-- BEGIN CONTAINER -->
<div class="page-container">
	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
		<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
		<div class="page-sidebar navbar-collapse collapse">
			<ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
				<!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
				<li class="sidebar-toggler-wrapper">
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler">
					</div>
					<!-- END SIDEBAR TOGGLER BUTTON -->
				</li>
				<!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
				<li class="sidebar-search-wrapper">
					<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
					<!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
					<!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
					<form class="sidebar-search " action="extra_search.html" method="POST">
						<a href="javascript:;" class="remove">
						<i class="icon-close"></i>
						</a>
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Search...">
							<span class="input-group-btn">
							<a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
							</span>
						</div>
					</form>
					<!-- END RESPONSIVE QUICK SEARCH FORM -->
				</li>
				<li class="start <?php if(($menu=="") or ($menu==0 )) echo "active open"?>" >
					<a href="index.php">
					<i class="icon-home"></i>
					<span class="title">Dashboard</span>
					<span class="arrow "></span>
					</a>
					
				</li>
				
				<li class="<?php if($menu==1) echo "active open"?>">
					<a href="javascript:;">
					<i class="icon-basket"></i>
					<span class="title">Items</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="saleitem.php?menu=1">
							<i class="icon-home"></i>
							Sales </a>
						</li>
						<li>
							<a href="salecoupon.php?menu=1">
							<i class="icon-basket"></i>
							Coupon</a>
						</li>						
					</ul>
				</li>
				<li class="<?php if($menu==2) echo "active open"?>">
					<a href="javascript:;">
					<i class="icon-rocket"></i>
					<span class="title">Promotion</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="bang.php?menu=2">
							Bang Coupon</a>
						</li>
						<li>
							<a href="event.php?menu=2">
							Event</a>
						</li>
						<li>
							<a href="notice.php?menu=2">
							Notification</a>
						</li>
						
					</ul>
				</li>
				<li class="<?php if($menu==3) echo "active open"?>">
					<a href="javascript:;">
					<i class="icon-diamond"></i>
					<span class="title">Setting</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="user.php?menu=3">
							User</a>
						</li>
						<li>
							<a href="market.php?menu=3">
							Market</a>
						</li>
						<li>
							<a href="ui_confirmations.html">
							Sales</a>
						</li>
						
					</ul>
				</li>
				<li class="<?php if($menu==4) echo "active open"?>">
					<a href="javascript:;">
					<i class="icon-puzzle"></i>
					<span class="title">Billing</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="components_pickers.html">
							Statement</a>
						</li>
						<li>
							<a href="components_context_menu.html">
							Invoice</a>
						</li>
						
					</ul>
				</li>

				<li class="<?php if($menu==5) echo "active open"?>">
					<a href="javascript:;">
					<i class="icon-puzzle"></i>
					<span class="title">Report</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="components_pickers.html">
							Promotion</a>
						</li>
						<li>
							<a href="components_context_menu.html">
							Sales</a>
						</li>
						
					</ul>
				</li>
			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
	</div>
	<!-- END SIDEBAR -->

<!------------------------------------------------------------------------------------------------------------------------------------------------------------>
