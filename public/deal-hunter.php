<?php
/**
 *
 * @package    deal-hunter.php
 * @author     Rakesh Shhrestha
 * @since      9/12/13 11:22 AM
 * @version    1.0
 */

$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'deals';

$conn = mysql_connect($host, $user, '');
mysql_select_db($db); //Leave Connection Open
mysql_query("SET character_set_client=utf8", $conn);
mysql_query("SET character_set_connection=utf8", $conn);
mysql_query("SET character_set_results=utf8", $conn);
//SET character_set_connection=utf8;
//SET character_set_database=utf8;
//SET character_set_results=utf8;
//SET character_set_server=utf8;")

$criteria       = '';
$deals          = [];
$MAX_DEAL_LIMIT = 12;
// Global Criteria
$destinations = [
    'Adelaide','Amsterdam','Auckland',
    'Bali','Bangkok','Barcelona','Beijing','Berlin','Brisbane','Brussels',
    'Cairns','Canberra','Chiang Mai','Chicago',
    'Dubai','Dublin','Fiji',
    'Gold Coast','Guangzhou',
    'Hawaii','Ho Chi Minh City (Saigon)','Hobart',
    'Hong Kong',
    'Jakarta',
    'Koh Samui','Kuala Lumpur','Kyoto',
    'Langkawi','Las Vegas','London','Los Angeles',
    'Macau','Madrid','Manila','Melbourne','Miami','Milan',
    'New York',
    'Orlando','Osaka',
    'Paris','Pattaya','Penang','Perth','Phuket',
    'Rome',
    'San Francisco','Seoul','Shanghai','Singapore','Sunshine Coast','Sydney',
    'Taichung','Taipei','Tokyo',
    'Wellington'
];
//$destinations = ['Gold Coast'];
$locales = ['MS' => 'ms_MY', 'CN' => 'zh_TW', 'CS' => 'zh_CN', 'HK' => 'zh_TW', 'EN' => 'en_AU', 'DE' => 'de_DE', 'ES' => 'es_ES',
            'FR' => 'fr_FR', 'IT' => 'it_IT', 'JP' => 'ja_JP', 'KR' => 'ko_KR', 'NL' => 'nl_NL', 'PL' => 'pl_PL', 'PT' => 'pt_PT',
            'RU' => 'ru_RU', 'SV' => 'sv_SE', 'TH' => 'th_TH'];

$locales = ['EN' => 'en_AU'];
$booking_start = '2013-12-16';
$booking_end   = '2013-12-22';
//$booking_start = '';
//$booking_end   = '';
//$stay_start    = '2013-12-16';
//$stay_end      = '2014-01-16';
$stay_start   = '';
$stay_end     = '';
$oneg_include = '';
$oneg_exclude = '';

$rating_min      = 3;
$rating_max      = 5;
$dealTypeOrder = ['FN','PO'];


$filterBooking = !empty($booking_end) && !empty($booking_start) ?
    "(d.booking_start <= '{$booking_start}' and d.booking_end >= '{$booking_end}')" : '';

$filterStay = !empty($stay_start) && !empty($stay_end) ?
    "(d.stay_start <='{$stay_start}' and d.stay_end >= '{$stay_end}')" : '';

$globalFilterDeal = !empty($filterBooking) && !empty($filterStay) ? $filterBooking . ' AND ' . $filterStay : $filterBooking;
$globalFilterDeal .= empty($globalFilterDeal) && !empty($filterStay) ? $filterStay : '';

$results = [];


// prep output files for each locales
foreach (array_keys($locales) as $locale) {
    $file        = "deals_result_{$locale}.csv";
    $fp[$locale] = fopen($file, 'w');
//    fputs($fp[$locale], $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));
    fwrite($fp[$locale], "\xEF\xBB\xBF");
    $printHeader[$locale] = true;
}
echo "Fetching deals for \n";
foreach ($destinations as $city) {
    echo $city . "\n";
    $lap = microtime(1);
//    echo $city . "\n";
    $globalFilterHotel = "
        SELECT
        h.id_hotel
        FROM hotel h
        INNER JOIN city ct ON ct.id_city=h.fk_city
        WHERE h.oneg_id > 0
        AND ct.name like  '" . $city . "%'
        AND h.rating between {$rating_min} AND {$rating_max}
        ";

// Get Free nights
    $sql = "select
            case when count(*) > 1 then
            substr(group_concat(id_deal order by fn desc), 1,instr(group_concat(id_deal order by fn desc),',')-1)
            else d.id_deal end as id_deal
            ,d.oneg_id
            ,max(d.fn) as max_fn
            from deal d
            inner join deal_type dt on dt.id_deal_type=d.fk_deal_type
            where
            dt.deal_code='FN' and d.fn > 0
            AND d.fk_hotel in ($globalFilterHotel)";
    $sql .= !empty($globalFilterDeal) ? " AND " . $globalFilterDeal : '';
    $sql .= ' GROUP BY d.fk_hotel ORDER BY max_fn desc';
    $rs = mysql_query($sql, $conn);
    if ($rs) {
        while ($d = mysql_fetch_assoc($rs)) {
            if (empty($results[$d['oneg_id']])) {
                $results[$d['oneg_id']] = $d['id_deal'];
            }
        }
    }

// Get Perent Off discount
    $sql = "select
            case when count(*) > 1 then
            substr(group_concat(id_deal order by percent_off desc), 1,instr(group_concat(id_deal order by percent_off desc),',')-1)
            else d.id_deal end as id_deal
            ,d.oneg_id, max(d.percent_off) as max_percent
            from deal d
            inner join deal_type dt on dt.id_deal_type=d.fk_deal_type
            where dt.deal_code='PO' and d.percent_off >= 25
            AND d.fk_hotel in ($globalFilterHotel)";
    $sql .= !empty($globalFilterDeal) ? " AND " . $globalFilterDeal : '';
    $sql .= ' GROUP BY d.fk_hotel order by max_percent desc';
    $rs = mysql_query($sql, $conn);
    if ($rs) {
        while ($d = mysql_fetch_assoc($rs)) {
            if (empty($results[$d['oneg_id']])) {
                $results[$d['oneg_id']] = $d['id_deal'];
            }
        }
    }

    /*// DISCOUNT DOLLAR OFF
        $sql = "select
                case when count(*) > 1 then
                substr(group_concat(id_deal order by dollar_off desc), 1,instr(group_concat(id_deal order by dollar_off desc),',')-1)
                else d.id_deal end as id_deal
                ,d.oneg_id, max(d.dollar_off) as max_dollar
                from deal d
                inner join deal_type dt on dt.id_deal_type=d.fk_deal_type
                where dt.deal_code='DO' and d.dollar_off >= 25
                AND d.fk_hotel in ($globalFilterHotel)";
        $sql .= !empty($globalFilterDeal) ? " AND " . $globalFilterDeal : '';
        $sql .= ' GROUP BY d.fk_hotel order by max_dollar desc';
        $rs = mysql_query($sql, $conn);
        if ($rs) {
            while ($d = mysql_fetch_assoc($rs)) {
                $results[] = $d['id_deal'];
            }
        }*/


//  MOO
    $sql = "select max(d.id_deal) as id_deal, d.oneg_id
            from deal d
            inner join channel c on c.id_channel = d.fk_channel
            where c.name='Email/Clp'
            AND d.fk_hotel in ($globalFilterHotel)";
    $sql .= !empty($globalFilterDeal) ? " AND " . $globalFilterDeal : '';
    $sql .= ' GROUP BY d.fk_hotel';
    $rs = mysql_query($sql, $conn);
    if ($rs) {
        while ($d = mysql_fetch_assoc($rs)) {
            if (empty($results[$d['oneg_id']])) {
                $results[$d['oneg_id']] = $d['id_deal'];
            }
        }
    }

//  Exclusive
    $sql = "select max(d.id_deal) as id_deal, d.oneg_id
            from deal d
            where d.exclusive =1
            AND d.fk_hotel in ($globalFilterHotel)";
    $sql .= !empty($globalFilterDeal) ? " AND " . $globalFilterDeal : '';
    $sql .= ' GROUP BY d.fk_hotel';
    $rs = mysql_query($sql, $conn);
    if ($rs) {
        while ($d = mysql_fetch_assoc($rs)) {
            if (empty($results[$d['oneg_id']])) {
                $results[$d['oneg_id']] = $d['id_deal'];
            }
        }
    }

    $deals = !empty($results) ? array_slice(array_unique($results), 0, $MAX_DEAL_LIMIT) : null;
    // Get the deals
    if (!empty($deals)) {
        foreach ($locales as $locale => $language) {


            $sql = "
            select
            r.name as region_name
            ,case when cl.name is not null then cl.name else c.name end as country_name
            ,case when ctl.name is not null then ctl.name else ct.name end as city_name
            ,case when hl.name is not null then hl.name else h.name end as hotel_name
            ,h.rating
            ,d.*
            from deal d
            inner join hotel h on h.id_hotel=d.fk_hotel
            left join hotel_lang hl on hl.fk_hotel=h.id_hotel and hl.language_code='{$locale}'
            inner join city ct on ct.id_city = h.fk_city
            left join city_lang ctl on ctl.fk_city=ct.id_city and ctl.language_code='{$locale}'
            inner join country c on c.id_country=ct.fk_country
            left join country_lang cl on cl.fk_country=c.id_country  and cl.language_code='{$locale}'
            inner join region r on r.id_region=c.fk_region
            inner join deal_type dt on dt.id_deal_type=d.fk_deal_type
            where d.id_deal in("
                . implode(',', $deals)
                . ")";
            $rs  = mysql_query($sql, $conn);
            if ($rs) {
                $printTitle = true;
                while ($d = mysql_fetch_assoc($rs)) {
                    if ($printHeader[$locale]) {
                        fputcsv($fp[$locale], array_keys($d));
//                    fputcsv($fp, array_keys($d));
                        $printHeader[$locale] = false;
                    }
                    fputcsv($fp[$locale], $d);
//                fputcsv($fp, $d);

                }
            }
        }

    }

    unset($deals, $rs, $results, $sql);

}

foreach (array_keys($locales) as $locale) {
    fclose($fp[$locale]);
//    fclose($fp);
}
