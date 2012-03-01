<?
function pagingJSON($page,$query_pag_data,$per_page=15,$cache=false)
{
	$g=new general();
	$cur_page = $page;
	$page -= 1;
	$previous_btn = true;
	$next_btn = true;
	$first_btn = true;
	$last_btn = true;
	$start = $page * $per_page;
	$query_pag_data.=" LIMIT $start, $per_page";
	if($cache==true)
	{
		$result_pag_data =$g->getCacheSQLAdvance(7200,$query_pag_data,0);
	}
	if($cache==false)
	{
		$result_pag_data =$g->getSQLAdvance($query_pag_data,0);
	}
	//print_r($result_pag_data);return;
	header('Cache-Control: no-cache, must-revalidate');
	header('Content-type: application/json');
	echo rs2json($result_pag_data);
	return;
}
function smartPagingNavi($page,$count_sql,$per_page=15,$cache=false){
	$g=new general();
	
	$cur_page = $page;
	$page -= 1;
	$previous_btn = true;
	$next_btn = true;
	$first_btn = true;
	$last_btn = true;
	$start = $page * $per_page;	
/* --------------------------------------------- */
	$query_pag_num = $count_sql;
	if ($cache==true)
	{	$row=$g->getCacheSQL(7200,$query_pag_num,0);}
	if ($cache==false)
	{	$row=$g->getSQL($query_pag_num,0);}
	$count = $row[0]['count'];
	$no_of_paginations = ceil($count / $per_page);

/* ---------------Calculating the starting and endign values for the loop----------------------------------- */
if ($cur_page >= 7) {
    $start_loop = $cur_page - 3;
    if ($no_of_paginations > $cur_page + 3)
        $end_loop = $cur_page + 3;
    else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
        $start_loop = $no_of_paginations - 6;
        $end_loop = $no_of_paginations;
    } else {
        $end_loop = $no_of_paginations;//chua hieu
    }
} else {
    $start_loop = 1;
    if ($no_of_paginations > 7)
        $end_loop = 7;
    else
        $end_loop = $no_of_paginations;
}
/* ----------------------------------------------------------------------------------------------------------- */
$msg .= "<div class='pagination'><ul>";

// FOR ENABLING THE FIRST BUTTON
if ($first_btn && $cur_page > 1) {
    $msg .= "<li p='1' class='active'>&nbsp;&nbsp;first&nbsp;&nbsp;|</li>";
} else if ($first_btn) {
    $msg .= "<li p='1' class='inactive'>&nbsp;&nbsp;first&nbsp;&nbsp;|</li>";
}

// FOR ENABLING THE PREVIOUS BUTTON
if ($previous_btn && $cur_page > 1) {
    $pre = $cur_page - 1;
    $msg .= "<li p='$pre' class='active'>&nbsp;&nbsp;prev&nbsp;&nbsp;|</li>";
} else if ($previous_btn) {
    $msg .= "<li class='inactive'>&nbsp;&nbsp;prev&nbsp;&nbsp;|</li>";
}
for ($i = $start_loop; $i <= $end_loop; $i++) {

    if ($cur_page == $i)
        $msg .= "<li p='$i' class='active current'>&nbsp;&nbsp;{$i}&nbsp;&nbsp;</li>";
    else
        $msg .= "<li p='$i' class='active'>&nbsp;&nbsp;{$i}&nbsp;&nbsp;</li>";
}

// TO ENABLE THE NEXT BUTTON
if ($next_btn && $cur_page < $no_of_paginations) {
    $nex = $cur_page + 1;
    $msg .= "<li p='$nex' class='active'>|&nbsp;&nbsp;next&nbsp;&nbsp;</li>";
} else if ($next_btn) {
    $msg .= "<li class='inactive'>|&nbsp;&nbsp;next&nbsp;&nbsp;</li>";
}

// TO ENABLE THE END BUTTON
if ($last_btn && $cur_page < $no_of_paginations) {
    $msg .= "<li p='$no_of_paginations' class='active'>|&nbsp;&nbsp;last&nbsp;&nbsp;</li>";
} else if ($last_btn) {
    $msg .= "<li p='$no_of_paginations' class='inactive'>|&nbsp;&nbsp;last&nbsp;&nbsp;</li>";
}
//$goto = "<input type='text' class='goto' size='1' style='margin-top:-1px;margin-left:60px;'/><input type='button' id='go_btn' class='go_button' value='Go'/>";
//$total_string = "<span class='total' a='$no_of_paginations'>Page <b>" . $cur_page . "</b> of <b>$no_of_paginations</b></span>";
//$msg = $msg . "</ul>" . $goto . $total_string . "</div>";  // Content for pagination
echo $msg;
}
?>