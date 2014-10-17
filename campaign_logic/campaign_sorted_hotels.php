<?php
#==============================================================================================================================================
# Developer: Mohan
# Created Date: 17-Oct-2014
# Purpose: Logic to fetch two hotels from the particular city based on all the campaign
#==============================================================================================================================================
//uasort function
function hotelAscSort($item1,$item2){
    if ($item1['sort'] == $item2['sort']) return 0;
    return ($item1['sort'] > $item2['sort']) ? 1 : -1;
}//hotelAscSort

//sortValue function
function sortValue($arrSortValue, $sortKey){
	$retResult = array();
	foreach($arrSortValue as $key=>$content){
			$retResult[$key] = $content;
	}	
	uasort($retResult,'hotelAscSort');//all the sorted value
	$flag = 1;//setting the value
	foreach($retResult as $keyTemp=>$contentTemp){
		if($flag<3){ $retFinalResult[$keyTemp] = $contentTemp; }
		$flag++;
	}
	return $retFinalResult;
}//sortValue

//main content
$hotelDeals = file_get_contents("deals.json");//get the content from deals.json file
$arrHotelDeals = json_decode($hotelDeals,true);//decoding the json values fetchted from deals.json file
$arrCampaign = $arrHotelDeals[campaign];//shortlisting only the campaign values
//fetching all the sorted hotel details 
foreach($arrCampaign as $region){
	foreach($region as $countryKey=>$countries){
		if(($countryKey!="name")&&($countryKey!="sort")){ 
			foreach($countries as $cityKey=>$cities){
				$citiesTemp = $cities;
				$arrSortedValue = array();
				if(($cityKey!="name")&&($cityKey!="sort")){ 
					foreach ($citiesTemp as $sortKey => $value){
						if(($sortKey!="name")&&($sortKey!="sort")){
							$arrSortedValue[$sortKey] = $value;
						}//end of temporary city if condition
					}//end of temporary city foreach
					$arrSortValue[] = sortValue($arrSortedValue, $sortKey);//fetch two hotel from the current city
				}
			}//end of city foreach
		}//end of country if condition
	}//end of country foreach
}//end of region foreach
//final output
echo '----------------Final Result--------------------';
echo '<pre>';print_r($arrSortValue);echo '</pre>';
echo '----------------JSON Result--------------------';
echo '<pre>';print_r($arrCampaign);echo '</pre>';
?>