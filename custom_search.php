<?php
include_once("extract_walmart.php");
include_once("extract_amazon.php");
include_once("extract_edealinfo.php");
include_once("utilities.php");

	//Get the query from the user.
	$query = $_POST["query"];
	
	//Perform search for user specified query on each of the three websites by calling below methods - 
	$walmart_results = extract_results_walmart($query);
	$amazon_results = extract_results_amazon($query);
	$edealinfo_results = extract_results_edealinfo($query);
	
	//Combine the results from the three websites.
	$all_results = array($walmart_results, $amazon_results, $edealinfo_results);
	 
	//Rank the results according to predetermined ranking policy.
	$ranked_results = rank_results($all_results);
	print ("<h2 align=\"center\"> * * * Grab a deal! * * * </h2>");
	print("<h4 align=\"center\">Searching for \"" . $query . "\" on amazon.com, walmart.com, and edealinfo.com!</h4>");
	print("<p style=\"text-align:center;\"><a href=\"AIIP_home.php\">Home</a></p>");
	
	//Display the results.
	print_array($ranked_results);
	
	/*	Rank the results according to ranking policy -
	 *	Rating scheme used: Listed the top item from each of the three websites first and then second and so on.
	 */
	function rank_results($results_array) {		
		
		$ranked_results = array();
		$count = count($results_array);
		
		for ($i = 0; $i < 10; $i++) {
			for ($j = 0; $j < $count; $j++) {
				if (isset($results_array[$j][$i])) { // Added this condition so that if a website returned less than 10 results then do not error out.
					$ranked_results[] = $results_array[$j][$i];	
				}
			}
		}
		
		return $ranked_results;
	}
?>