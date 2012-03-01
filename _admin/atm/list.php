<? include_once "../../config.php"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<? include "../../theme/whitelabelTheme/template/head.html"; ?> 
<style type="text/css">
#paging ul li{
display:inline;
padding:5px;
color:#0099cc;
cursor:pointer;
}
li{
	list-style:none;
}
table tr.parent{
	background:#EFEFEF;
}
table tr.parent td
{
	font-weight:700;
	
}
table td{
	vertical-align:middle;
}
</style>
<script id="atm_list_template" type="text/x-jquery-tmpl">
	<tr> 
		<td>${row.atm_id} </td>
		<td>${row.bank_name} </td>
		<td>${row.atm_name} </td>
		<td>${row.atm_address} </td> 
		<td><a  class='btn i_pencil icon yellow small' href='edit.php?id=${row.atm_id}'>Edit</a></td>
		<td><a  action="ajax_trash" row_id='${row.atm_id}'  class='btn i_trashcan icon red small' href='#t' >Delete</a></td>
	</tr>
</script>

    	

<script type="text/javascript">
	$.ajaxSetup({
			dataType:"json",
			type:"POST"
	});
    $.fn.ready(function(){

		$(".datatable tbody").pagebind({
			template:"#atm_list_template",
			navigation	: "",
			url:"../../htinmotion/orm/atm/core.php?type=get_all",
			onBindPage:function(){dataTable()}
		});
	});
	
	$("a[action='ajax_trash']").live('click',function(){
		var atm_id=$(this).attr("row_id");
		//<a href="#t" class="btn i_pencil icon green small" id="ajax_trash_confirm" action="ajax_detail">Yes</a>
		jQuery.facebox('<h5 style="text-align:center">Are you sure to remove this ATM Point out of your list </h5><h3 style="text-align:center"><a href="#t" class="btn i_pencil icon green small" id="ajax_trash_confirm" >Yes</a> <a href="#t" class="btn i_pencil icon green small" id="ajax_trash_cancel" >No</a>');
		$("#ajax_trash_confirm").click(function(){
			$.ajax({
				dataType:"xml",
				data	:{atm_id:atm_id},
				url		:"../../htinmotion/orm/atm/core.php?type=delete_atm",
				success	:function(xml){
					jQuery.facebox("<h3>"+$(xml).find("status").text()+"</h3>");
					setTimeout(function(){
						location.reload();
					},2500)
				}
			})
		});
		$("#ajax_trash_cancel").click(function(){
			 jQuery(document).trigger('close.facebox') ;
		});
		
	});
	$("a[action='ajax_detail']").live('click',function(){
		//popup layout...
	});	
	function dataTable(){
		
				$("body").find(".datatable").dataTable();				
	}
</script>
<body>
	<div id="pageoptions">
	<? include "../../theme/whitelabelTheme/template/pageoptions.html"; ?> 
    	<!--#include file="file:///C|/AppServ/www/Theme/template/pageoptions.html" --> 
    </div>
	<header>
    <? include "../../theme/whitelabelTheme/template/header.html"; ?> 
		<!--#include file="file:///C|/AppServ/www/Theme/template/header.html" --> 
	</header>
    <nav>
	 <? include "../../theme/whitelabelTheme/template/nav.html"; ?> 
	</nav>			
	<section id="content">
		<div class="g12">
			<div class="alert info">Page List</div>
			
			<table class="datatable">
				<thead>
					<tr>
                    	<th>ATM ID &nbsp;&nbsp;</th>
                        <th>Bank</th>
						<th>ATM Name &nbsp;&nbsp;</th>
						<th>ATM Address </th>
						<th colspan="2">Manage</th>
					</tr>
				</thead>
				<tbody>
                
                </tbody>
				<tfoot>
					<tr>
                    	<th>ATM ID &nbsp;&nbsp;</th>
                        <th>Bank</th>
						<th>ATM Name &nbsp;&nbsp;</th>
						<th>ATM Address &nbsp;&nbsp;&nbsp;&nbsp;</th>
						<th colspan="2">Manage</th>
					</tr>
				</tfoot>
			</table>
		</div>
	</section>
<footer>Developed by MediaGurus Team </footer>
</body>
</html>
