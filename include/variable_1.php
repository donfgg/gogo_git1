<?php 
/**********************************************
*		@author : 		    Michael
*		@detail :			Common variables
*		@copyright :		2012
**********************************************/

/*--------------- Database Configuration ---------------*/
$DBConf["DB_TYPE"]	= "MySQL";
$DBConf["HOST"]     = "localhost";//"54.84.27.97";  //"192.168.1.76";
$DBConf["DB_NAME"]  = "gogomarket";
$DBConf["USER"]     = "root";//"sshopadmin";
$DBConf["PWD"]      = "gogo123";//"Tkzjtiqusa";
/*--------------- Database Configuration --------------- */

/*** Paging Information ***/

define("PAGEBLOCK", 10);
$LIMIT          = 15;

/*** Header Menu ***/
$headerMenu[]	= array("My Account", "myaccount", "page=customer&account=myaccount");
$headerMenu[]	= array("Weekly ADS", "weekly", "");
$headerMenu[]	= array("Market Event", "event", "info=marketevent");
$headerMenu[]	= array("Log In", "login", "page=customer&account=login");
//$headerMenu[]	= array("Shop List", "mycart", "page=mycart");
//$headerMenu[]	= array("Checkout", "checkout", "page=checkout");
//$headerMenu[]	= array("My Coupon", "mywishlist", "info=mywishlist");
//$headerMenu[]	= array("My Wishlist", "mywishlist", "info=mywishlist");
//$headerMenu[]	= array("My Wishlist", "mywishlist", "info=mywishlist");

/*** Top Corner Menu ***/
//$topMenu[]      = array("Home","","");
$topMenu[]      = array("Weekly ADS","","");
$topMenu[]      = array("Buiness Opportunity","","");
$topMenu[]      = array("About us","","");
$topMenu[]      = array("Contact us","","");

/*$topMenu[]      = array("EDITOR'S PICK","?c1=10","");
$topMenu[]      = array("SPECIAL SALE","?c1=11","");
*/

/*** Sub Menu List ***/
//$subMenu[]		= array("Main Events", "", "");
//$subMenu[]		= array("Africa Cup of Nations", "", "");
//$subMenu[]		= array("SHOP BY:", "", "shopby", 1); ksh
/*$subMenu[]		= array("Shop by Brand", "brand=More...", "brand");
$subMenu[]		= array("Shop by Club", "club=More...", "club");
$subMenu[]		= array("Shop by Country", "country=More...", "country");
$subMenu[]		= array("Shop by Player", "player=More...", "player");
$subMenu[]		= array("Shop by League", "league=More...", "league");*/
$subMenu[]		= array("Shop by Category", "", "category");
/*$subMenu[]		= array("ACCESSORIES", "c1=24", "");
$subMenu[]		= array("Apparel", "shopby=apparel", "apparel", 1);
$subMenu[]		= array("BOOKS", "c1=3", "");
$subMenu[]		= array("DVDS", "c1=5", "");
$subMenu[]		= array("Equipment", "c1=6", "equipment", 1);
$subMenu[]		= array("FLAGS/Banners", "c1=26", "");
$subMenu[]		= array("Infant/Toddlers", "c1=20&c2=231", "");
$subMenu[]		= array("POSTERS", "c1=11", "");
$subMenu[]		= array("PATCHES", "c1=33", "");
$subMenu[]		= array("REFEREE", "c1=48", "");
$subMenu[]		= array("SHINGUARDS", "c1=14", "");
$subMenu[]		= array("Footware", "c1=7", "");
$subMenu[]		= array("Goalkeeping", "c1=8", "");
$subMenu[]		= array("team", "c1=17&c2=109", "");
$subMenu[]		= array("Holiday Center", "c1=49", "");*/

/*$shopby[]		= array("Brand", "brand=More...");
$shopby[]		= array("Club", "club=More...");
$shopby[]		= array("Country", "country=More...");
$shopby[]		= array("Player", "player=More...");
$shopby[]		= array("League", "league=More...");
ksh*/
//$apparel[]		= array("CAPS/BEANIES","c1=4");
$apparel[]		= array("Compression Gear and more","c1=10&c2=104");
$apparel[]		= array("Fleece / Tops / Hoodies","c1=42");
$apparel[]		= array("Jackets","c1=35");
$apparel[]		= array("Pants","c1=19&c2=106");
$apparel[]		= array("&frac34; Pants","c1=15&c2=112");
$apparel[]		= array("Shorts","c1=15");
$apparel[]		= array("Socks","c1=16");
$apparel[]		= array("Scarves","c1=13");
$apparel[]		= array("Training Tops","c1=36&c2=184");
//$apparel[]		= array("Training Jerseys","");
$apparel[]		= array("T-shirts","c1=18");
$apparel[]		= array("Warm-Ups","c1=19");


$equipment[]	= array("Field","c1=6&c2=43");
$equipment[]	= array("Training","c1=6&c2=44");

$country		= array("Argentina",
					"Australia",
					"Brazil",
					"Cameroon",
					"Denmark",
					"England",
					"France",
					"Germany",
					"Greece",
					"Holland",
					"Italy",
					"Ivory Coast",
					"Japan",
					"Mexico",
					"Portugal",
					"South Africa",
					"South Korea",
					"Spain",
					"USA",
					"More...");
$club			= array("AC Milan",
					"Arsenal",
					"Barcelona",
					"Bayern Munichn",
					"Celtic",
					"Chelsea",
					"Chicago Fie",
					"Chivas USA",
					"Chivas de Guadalajara",
					"Club America",
					"DC United",
					"InterMilan",
					"Juventus",
					"Liverpool",
					"Los Angeles Galaxy",
					"Manchester United",
					"New Castle",
					"Pumas",
					"Real Madrid",
					"More...");
$brand			= array("Adidas",
					"Atletica",
					"Diadora",
					"Duke",
					"Joma",
					"Kappa",
					"Lotto",
					"Mikasa",
					"Mitre",
					"Mueller",
					"Nike",
					"Puma",
					"Reebok",
					"Umbro",
					"Voit",
					"More...");



/*** Administration Section ***/





/*** Company Information ***/
define("SITE_COMPANY", "gogomarket");
define("SITE_ADDRESS1", "1295 N Tustin Ave ");
define("SITE_ADDRESS2", "");
define("SITE_CITY", "Anaheim");
define("SITE_STATE", "CA");
define("SITE_ZIPCODE", "92807");
define("SITE_COUNTRY", "");
define("SITE_PHONE", "213-747-3410");
define("SITE_FAX", "213-747-3411");
define("SITE_EMAIL", "info@gogomarket.net");
//define("SITE_URL", "http://sshop.i9biz.com");
//define("COOKIE_DOMAIN", "sshop.i9biz.com");
define("SITE_URL", "http://52.10.37.199");
define("LSITE_URL", "http://52.10.37.199");
define("COOKIE_DOMAIN", "52.10.37.199");
	
	
define("PRODUCT_IMAGE_PATH", "/Images_Products/");
define("IMAGE_PATH", "");
define("SITE_TITLE", "");
define("SITE_MAIL", "");
define("INVOICE_LINES", 20);
	
/*** Administration ***/
define("ADMIN_LEVEL", 9);
define("ADMINID", "");
define("ADMINPW", "");

/*** Login Timeout ***/
define("LOGIN_TIMEOUT", 3600);		// in seconds

/*** THRESHOLE ***/
define("BESTPRICE", 1000);
define("DISCOUNT_LIMIT", 1500);
define("DISCOUNT_RATIO", 0.05);
define("FREESHIPPING", 2000);
?>