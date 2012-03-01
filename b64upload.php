<?php 

if ($_REQUEST['image']) {
	
	// convert the image data from base64
	$imgData = base64_decode($_REQUEST['image']);
	
	// set the image paths
	$file =  md5(date('Ymdgisu')) . '.jpg';
	$url = 'C:\\Inetpub\\vhosts\\sonnhadontet.com\\mediagurus.vn\\httpdocs\\android\\uploads\\' . $file; 
	
	// delete the image if it already exists
	if (file_exists($file)) { unlink($file); }
	
	// write the imgData to the file
	$fp = fopen($url, 'w');
	fwrite($fp, $imgData);
	fclose($fp);
	echo $file;
	return;
}

?>