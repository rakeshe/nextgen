<?php
/**
 *
 * @package    parse.php
 * @author     Rakesh Shrestha
 * @since      29/10/13 3:44 PM
 * @version    1.0
 */
ini_set('display_errors',1);
//$serverName = "(local)\sqlexpress";
//
///* Connect using Windows Authentication. */
//try
//{
//    $conn = new PDO( "sqlsrv:server=$serverName ; Database=HC", "", "");
//    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
//}
//
//catch(Exception $e)
//{
//    echo 'Error!!' . PHP_EOL;
//    die( print_r( $e->getMessage() ) );
//}

/**
 * setup vars
 */
include_once('../cache/poi.php');
/*//$xml = new SimpleXMLElement("<?xml version=\"1.0\"?><SearchHotels></SearchHotels>");*/

$doc = new DOMDocument();
echo 'Trawling...' . PHP_EOL;
foreach($poi as $fileName => $url){
    $f = fopen('C:/www/nextgen/cache/' . $fileName.'.xml', "w");
    $html = file_get_contents_curl($url);
    @$doc->loadHTML($html);
    $xml = trawl($doc, $html, $url);
    fwrite($f, $xml);
    fclose($f);
    echo '   ' . $url . PHP_EOL;
}
function file_get_contents_curl($url)
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip');

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}

function trawl($doc,$html,$url){
    $xml = '<?xml version="1.0" encoding="utf8"?>';
    $previewText = null;
    $detailText= null;
    $nodes = $doc->getElementsByTagName('title');
    $title = $nodes->item(0)->nodeValue;

    // Get preview by class if not exist then grab preview/ detail pair
    $xpath = new DomXpath($doc);
    $previewText = $xpath->query('//*[@class="descpreview"]')->item(0);
    if(!($previewText)){
        $previewText = $doc->getElementById("descPreview");
        $detailText = $doc->getElementById("showBody");
    }
    $xml .= '<page>' . PHP_EOL;
    $xml .= '<url>' . $url . '</url>' . PHP_EOL;
    $xml .= '<title>' . $title . '</title>' . PHP_EOL;
    $xml .= '<meta-tags>' . PHP_EOL;
    $metas = $doc->getElementsByTagName('meta');
    for ($i = 0; $i < $metas->length; $i++) {
        $meta     = $metas->item($i);
        $metaName = $meta->getAttribute('name');
        if ($metaName == 'description' || $metaName == 'keywords') {
            $xml .= '<' . $metaName . '>' . $meta->getAttribute('content') . '</' . $metaName . '>' . PHP_EOL;
        }
    }
    $xml .= '</meta-tags>' . PHP_EOL;
    $xml .= '<item-description>' . PHP_EOL;
    $xml .= '<preview>' . str_replace('... Read more »','',$previewText->nodeValue) . '</preview>' . PHP_EOL;
    $detailTextBody = $detailText ? str_replace('« Hide','',$detailText->nodeValue) : '';
    $xml .= '<detail>' . $detailTextBody . '</detail>' . PHP_EOL;
    $xml .= '</item-description>' . PHP_EOL;
    $xml .= '</page>' . PHP_EOL;

    return $xml;

}

