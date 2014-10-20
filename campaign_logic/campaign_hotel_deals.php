<?php
#==============================================================================================================================================
# Developer: Mohan
# Created Date: 17-Oct-2014
# Purpose: Logic to fetch two hotels from the particular city based on all the campaign
#==============================================================================================================================================
class campaignHotelDeals{
	public function fetchCampaignVal($arrCampaign){
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
							$arrSortValue[] = $this->sortValue($arrSortedValue);//fetch two hotel from the current city
						}
					}//end of city foreach
				}//end of country if condition
			}//end of country foreach
		}//end of region foreach
		return $arrSortValue;
	}

	public function sortValue($arrSortValue){
		$retResult = array();
		foreach($arrSortValue as $key=>$content){
				$retResult[$key] = $content;
		}	
		uasort($retResult,array($this, 'hotelAscSort'));//all the sorted value
		$flag = 1;//setting the value
		foreach($retResult as $keyTemp=>$contentTemp){
			if($flag<3){ $retFinalResult[$keyTemp] = $contentTemp; }
			$flag++;
		}
		return $retFinalResult;
	}

	//uasort function
	public function hotelAscSort($item1,$item2){
		if ($item1['sort'] == $item2['sort']) return 0;
		return ($item1['sort'] > $item2['sort']) ? 1 : -1;
	}//hotelAscSort
}//end of regionHotelDeals class

//main content
$hotelDeals = file_get_contents("edited_deals.json");//get the content from deals.json file
$arrHotelDeals = json_decode($hotelDeals,true);//decoding the json values fetchted from deals.json file
$arrCampaign = $arrHotelDeals[campaign];//short listing only the campaign values
$objRegHotelDeal = new campaignHotelDeals();//creating a new object
$arrSortValue = $objRegHotelDeal->fetchCampaignVal($arrCampaign);//creating a new object

//final output
echo '<table border="1" cellpadding="3" cellspacig="3" width="100%"><tr>';
echo '<td valign="top" width="50%"><center>----------------Sorted Campaign Result--------------------</center>';
echo '<pre>';print_r($arrSortValue);echo '</pre></td>';
echo '<td valign="top" width="50%"><center>----------------RAW JSON Result--------------------</center>';
echo '<pre>';print_r($arrCampaign);echo '</pre></td>';
echo '</tr></table>';
?>