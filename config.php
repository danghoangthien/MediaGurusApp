<?php
session_start();
header("Content-type: text/html; charset=utf-8");
date_default_timezone_set('Asia/saigon');
if(matchpage("_admin/")!==false  && matchpage("log.php")!==true && matchpage("/user/edit.php")!==false )
{
		if(!isset($_SESSION["user"]))
		{echo"<script>location.href='../user/log.php'</script>";}	

}
if( matchpage("log.php") )
{
	if($_GET["log"]=="out")
	{
		
		unset($_SESSION["user"]);
	}
}
if($_SERVER['SERVER_NAME'] == "localhost")
{
$HOST="localhost";
$DATABASE="admin_atm";
$USERNAME="admin_atm";
$PASS="@tm2012";
$DEBUG=false;
$admin_level="../../../";
//$DEBUG=true;
$RSS_KEY="ABQIAAAAt9ed7tLxIjLKhiUXHbE-tRT2yXp_ZAY8_ufC3CFXhHIE1NvwkxQwU3ju0R_56lQwLF3qgQpCIRA0fg";
$API_KEY="";
//$CWD ="C:\Inetpub\vhosts\sonnhadontet.com\c2life.com.vn\httpdocs\mega\" 
//echo $HOST;
}
else
{
$HOST="localhost";
$DATABASE="admin_atm";
$USERNAME="admin_atm";
$PASS="@tm2012";
$DEBUG=false;
$RSS_KEY="ABQIAAAAt9ed7tLxIjLKhiUXHbE-tRT2yXp_ZAY8_ufC3CFXhHIE1NvwkxQwU3ju0R_56lQwLF3qgQpCIRA0fg";
$API_KEY="";
$admin_level="../../";
}
?>
<?php
define('HOST',$HOST);
define('DATABASE',$DATABASE);
define('USERNAME',$USERNAME);
define('PASS',$PASS);
define('DEBUG',$DEBUG);
function matchpage($page)
{
	$curl=get_current_url();	
	if(strpos($curl,$page)!==false) return true;
	else return false;
}
function get_current_url() {
    $protocol = 'http';
    if ($_SERVER['SERVER_PORT'] == 443 || (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on')) {
        $protocol .= 's';
        $protocol_port = $_SERVER['SERVER_PORT'];
    } else {
        $protocol_port = 80;
    }
    $host = $_SERVER['HTTP_HOST'];
    $port = $_SERVER['SERVER_PORT'];
    $request = $_SERVER['PHP_SELF'];
    $query = substr($_SERVER['argv'][0], strpos($_SERVER['argv'][0], ';') + 1);
    $toret = $protocol . '://' . $host . ($port == $protocol_port ? '' : ':' . $port) . $request . (empty($query) ? '' : '?' . $query);
    return $toret;
}
function redirect($alert="",$location)
{   if($alert!="")$alert="alert('$alert');";
	echo "<script>$alert location.href='$location'</script>";
}
if( matchpage("about-us.php") || 
	matchpage("about-centre.php") || 
	matchpage("programmes.php") ||  
	matchpage("about-home-tuition.php")  ||
	matchpage("events.php") 
	)
{
	include "htinmotion/orm/adodb5/adodb.inc.php";
	include "htinmotion/orm/general/general.php";
	include "htinmotion/orm/adodb5/tojson.inc.php";
	include "htinmotion/pagination/pagingAdvance.php";
	$g=new general();
	if( matchpage("about-us.php") )		$news_id=1;
	if( matchpage("about-centre.php") )	$news_id=2;
	if( matchpage("about-home-tuition.php") )	$news_id=6;
	if( matchpage("programmes.php") )	$news_id=3;
	if( matchpage("events.php") )	{$news_id=4;}
	$banner=$g->getSQL("select banner_image from banner where news_id=".$news_id);
}
?>
