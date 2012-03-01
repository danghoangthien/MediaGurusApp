<?
include "../../../config.php";
include "../adodb5/adodb.inc.php";
include "../general/general.php";
include "../adodb5/tojson.inc.php";
include "../../pagination/pagingAdvance.php";
$g=new general();
if($_GET['type']=='get_all')
{
	//$sql = 	" SELECT atm_point.*,(select bank_name from bank where bank_id=atm_point.bank_id) as bank_name from atm_point order by atm_id desc ";//-1 trash, 0 inactive
	//$category=$g->getSQLJSON($sql);
	//return;
	if($_POST['type']=='page')
	{
		$query_pag_data = "SELECT atm_point.*,(select bank_name from bank where bank_id=atm_point.bank_id) as bank_name from atm_point order by atm_id desc";
		pagingJSON($_POST["page"],$query_pag_data,10000,false);
		return;
	}
	if($_POST['type']=="no_of_page")
	{
		$count_sql="select count(atm_id) as count from atm_point ";
		smartPagingNavi($_POST["cur_page"],$count_sql,7,true);
		return;
	}
}
if($_GET['type']=='get_atm_by_atm_id')
{
	$sql = 	"SELECT * from atm_point "
			." where  atm_id=".$_POST['atm_id'];
	$category=$g->getSQLJSON($sql);
	return;
}
if($_GET['type']=='add_atm')
{
	header('Content-type: text/xml');
	echo "<?xml version='1.0' encoding='UTF-8'?>";	
	$validate=validate();
	if($validate!="1") return;
	$g=new general();
	$_POST["atm_add_dt"]=date("Y-m-d H:i:s");
	$msg=$g->executeInsert("atm_point",$_POST,"");
	if(is_numeric($msg))
	{
		$msg= "Add atm Success";
	}
	echo "<status><![CDATA[$msg]]></status>";
	return;
}
if($_GET['type']=='edit_atm')
{
	header('Content-type: text/xml');
	echo "<?xml version='1.0' encoding='UTF-8'?>";	
	$validate=validate();
	if($validate!="1") return;
	$g=new general();
	$msg=$g->executeUpdate("atm_point",$_POST," where atm_id=".$_POST["atm_id"]);
	if($msg==true)
	{
		$msg="Edit ATM Success";
	}
	echo "<status><![CDATA[$msg]]></status>";
	return;
}
function validate(){
	if(!isset($_POST["atm_name"]) || $_POST["atm_name"]=="")
	{
		$msg="Please Input: <strong>ATM name</strong>";
		echo "<status><![CDATA[$msg]]></status>";
		return;
	}
	if(!isset($_POST["atm_address"]) || $_POST["atm_address"]=="")
	{
		$msg="Please Input: <strong>ATM Address</strong>";
		echo "<status><![CDATA[$msg]]></status>";
		return;
	}
	if(!isset($_POST["latitude"]) || $_POST["latitude"]=="")
	{
		$msg="Please Input: <strong>ATM latitude</strong>";
		echo "<status><![CDATA[$msg]]></status>";
		return;
	}
	if(!isset($_POST["longitude"]) || $_POST["longitude"]=="")
	{
		$msg="Please Input: <strong>ATM longitude</strong>";
		echo "<status><![CDATA[$msg]]></status>";
		return;
	}
	return "1";
}
?>