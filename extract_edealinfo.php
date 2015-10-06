<html>
<head><h2></h2></head>
<body>
<?php
include_once("simple_html_dom.php");
include_once('Results.php');
include_once('utilities.php');

/*
 * The method extract_results_edealinfo() accepts a query paramter.
 * Its main duty is to perform search for the specified query on the edealinfo.com website.
 * It extracts all the required information like, title, price, image form the HTMl
 * response from the website, build resuls objects out of these.
 * It returns an array of results objects.
 */

function extract_results_edealinfo($query) {
	
	//Build query for multiple words. Build URL for search.
	$url = "http://www.edealinfo.com/deals/search/?keyword=";
	$part2 = str_replace( ' ', '+', $query);
	$target_search_url = $url."".$part2;
	
	//Set URL and other appropriate options, utilities.php
	$target_response = file_get_contents_curl($target_search_url);

	$edealinfo_results_array = array();
	
	if (!is_null($target_response)) {
		
		//Extract title, image and price from the HTML response
		preg_match_all("/<div class='Title'>(.*?)<\\/div>/s", $target_response, $title_div);
		preg_match_all("/<span class='black10' style='color:#B71113;font-size:13px'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>(.*?)<\\/b><\\/span>/", $target_response, $prices_div);
		preg_match_all("/<div class='prod_Image'>(.*?)<\\/div>/s", $target_response, $images_div);
	
		/* Some results may not have an image, In that case use only those results that have
		 * all the three - title, price and image
		 */
		$results_str="";
		$maxResults = 10;
		$maxResults = min(count($title_div[0]), count($prices_div[0]), count($images_div[0]));
		if ($maxResults > 10) {
			$maxResults = 10;
		}
		
		for ($i = 0; $i < $maxResults; $i++) {
			$results_str .= $title_div[0][$i] . $prices_div[0][$i] . $images_div[0][$i];
		}
	
		$response_html = new simple_html_dom();
		$response_html->load($results_str);
	
		$productNameArray = array();
		$productPriceArray = array();
		$productLinkArray = array();
		$productImageArray = array();
	
		foreach($response_html->find('div[class=Title]') as $title) {
			$r1 = new simple_html_dom();
			$r1->load($title);
			$ahref = $r1->find('a');
			$a2 = $ahref[0];
			array_push($productNameArray, $a2->plaintext);
		}
	
		foreach($response_html->find('img') as $img) {
			array_push($productImageArray, $img->getAttribute('src'));
		}
	
		foreach($response_html->find('span[class=black10]') as $price) {
			array_push($productPriceArray, $price->text());
		}
		
		//Extract URL for the product.
		foreach($response_html->find('a') as $link) {
			array_push($productLinkArray, "http://www.edealinfo.com" . $link->href);
		}
		
		//Create instances of Results class using retrieved information and save these objects to an array.
		for ($i = 0; $i < $maxResults; $i++) {
			$result_obj = new Results();
			$result_obj->setProduct_name($productNameArray[$i]);
			$result_obj->setProduct_image($productImageArray[$i]);
			$result_obj->setProduct_link($productLinkArray[$i]);
			$result_obj->setProduct_price($productPriceArray[$i]);
			$result_obj->setSource_website("edealinfo.com");
			$edealinfo_results_array[] = $result_obj;
		}
	}
	//Return array of results objects.
	return $edealinfo_results_array;
}
?>
</body>
</html>