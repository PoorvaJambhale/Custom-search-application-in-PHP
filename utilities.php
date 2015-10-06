<html>
<head>
<title> * * * Grab a deal! * * * </title>
<style>
body {
	background-color:#BFFFFF;
	font-family:"Arial";
	}
box-shadow: 10px 10px #888, -10px -10px #f4f4f4, 0px 0px 5px 5px #cc6600;

.box h3{
	text-align:center;
	position:relative;
	top:80px;
}
.box {
	width:70%;
	height:120px;
	background:#FFF;
	margin:40px auto;
}


/*==================================================
 * Effect 1
 * ===============================================*/
.effect1{
	-webkit-box-shadow: 0 10px 6px -6px #777;
	   -moz-box-shadow: 0 10px 6px -6px #777;
	        box-shadow: 0 10px 6px -6px #777;
}
</style>
</head>
<body>
<?php
function file_get_contents_curl($url){
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	
	$data = curl_exec($ch);
	curl_close($ch);

	return $data;
}
function print_array($results_array) {

	
	foreach($results_array as $result) {
		
		print("<div class=\"box effect1\">");
		print("<table>");
		
		print("<tr>");
		print("<td rowspan=\"3\" align=\"left\">");
		print("<img height='93' width='122' src='". $result->getProduct_image() ."'>");
		print("</td>");
		
		print("<td>");
		print("<a href=\"".$result->getProduct_link()."\">".$result->getProduct_name()."</a>");
		print("</td>");
		print("</tr>");
		
		print("<tr>");
		print("<td>");
		print("Price: ".$result->getProduct_price());
		print("</td>");
		print("</tr>");
		
		print("<tr>");
		print("<td>");
		print("Source: ".$result->getSource_website());
		print("</td>");
		print("</tr>");
		
		print("</table>");
		print("</div>");
	}
	
}

?>
</body>
</html>