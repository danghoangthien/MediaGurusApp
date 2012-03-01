<?
include_once("../config.php");
include_once('../htinmotion/orm/adodb5/adodb.inc.php');
include_once('../htinmotion/orm/general/general.php');
include "../htinmotion/orm/adodb5/tojson.inc.php";
$g=new general();
if($_POST['type']=='get_all')
{
	$sql = 	"SELECT * from atm_point ";//-1 trash, 0 inactive
	$category=$g->getSQLJSON($sql);
	return;
}
if($_POST['type']=='get_by_lat_lng')
{
	$sql = 	"SELECT latitude,longitude,atm_address,atm_name,(SELECT bank_name FROM bank WHERE bank_id=atm_point.bank_id ) as bank_name,
(((ACOS(SIN((".$_POST["lat"]."*PI()/180)) * SIN((latitude*PI()/180))+COS((".$_POST["lat"]."*PI()/180)) * COS((latitude*PI()/180)) * COS(((".$_POST["lng"]."- longitude)*PI()/180))))*180/PI())*60*1.1515*1.609344) AS distance 
FROM atm_point WHERE bank_id=".$_POST["bank_id"]." HAVING distance <= 3" ;

	$category=$g->getSQLJSON($sql);
	return;
}
?>