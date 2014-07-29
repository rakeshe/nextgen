<?php
/**
 *
 * @package    campaign_data.php
 * @author     Rakesh Shrestha
 * @since      26/11/13 5:40 PM
 * @version    1.0
 */
$dataPage = [
    'meta'   => [
        'coupon_code'      => 'Hotelclub15',
        'deals_tc'         => 'Terms & Conditions:<br /><br />Save up to 50% off hotels - This offer is valid from 18 November to 01 December 2013.These offers are subject to availability and may change without notice prior to reservation confirmation. Specific offer terms and conditions are available on the website. Rates may not be available on some peak dates.<br /><br />Promo code HOTELCLUB15: Book a participating hotel by 11:59pm (CST) 15 December 2013, for stays between 18 November 2013 and 30 June 2014 via HotelClub and instantly receive 15% off your hotel booking (excluding taxes and fees). Limit one discount per hotel room and one promotion code per purchase. Applies to selected hotels only.  Discounts are not redeemable for cash for any reason. Promotion codes are non-transferrable and not for resale. HotelClub reserves the right to change the terms and conditions of this Promotion at any time without notification. Promotion code is not applicable to hotels located in New Zealand. <br /><br />CNY ¥50 Alipay cash coupon: During the promotion period ending 1 December 2013 , the first 200 customers who complete payment for their purchase on HotelClub via Alipay will be provided with a CNY 50 cash red packet (cash coupon), and  the remaining 800 eligible customers will be provided with a CNY 25 cash red packet (cash coupon). The red packet is not subject to any expenditure rules and is valid until 31 March 2013. The red packet (cash coupon) will be forfeited in the cases of transaction failure or refund when redeemed. The red packet (cash coupon) is non-transferable, not for cash withdrawal or resale. The red packet (cash coupon) will be deposited into the customer’s Alipay account within 15 working days after conclusion of the promotion. The red packet (cash coupon) cannot be used in the following situations: a customer with digital certificate has made payment in a non-digital certificate environment, the booking was paid by a third party, or the booking was submitted when the “pay with balance” function is deactivated. For any enquiries on the cash red packet, please call +86 571 95188.<br /><br />Membership upgrades: An upgrade to the Gold Membership tier will be granted only to new members of the HotelClub Membership Program who submit a membership application between 18 November 2013 and 01 December 2013. The upgrade is valid and will take effect from 14 December 2013 and is subject to the Membership Terms and Conditions. An upgrade to the Platinum Membership tier will be granted only to HotelClub Members who spend CNY ¥5,000 on [one or more] confirmed bookings completed on the HotelClub website during the period from 18 November 2013 to 01 December 2013. The upgrade is valid and will take effect from  14 December 2013 and is subject to the Membership Terms and Conditions.',
        'title'            => 'HotelClub - online hotel bookings now with Alipay',
        'meta_keyword'     => 'Great Asia Hotels Sale. Find great hotel deals with HotelClub.com',
        'meta_description' => 'Exclusive offer for Alipay members - extra 15% of hotel bookings when using Alipay & HotelClub.com',
        'show_text'          => 0,
        'show_member_widget' => 0,
    ],
    'tabs'   => [
        'NorthEast-Asia' => [
            'region'      => 'AU',
            'region_name' => 'Northeast Asia',
            'onegs' =>['202796','209446','210152','218886','218950','248885'],
            'tabs' => [
                'China'          => [
                    'region'      => 'AU',
                    'region_name' => 'China',
                    'onegs' =>['22738','18094','22738']
                ],
                'South-Korea'    => [
                    'region'      => 'AU',
                    'region_name' => 'South Korea',
                    'onegs' =>['9669','24427','301255','200255']
                ],
                'Japan'         => [
                    'region'      => 'AU',
                    'region_name' => 'Japan',
                    'onegs' =>['281116','259943','260103','317264','321097','321367']
                ],

            ],
        ],
        'Australia' => [
            'region'      => 'AU',
            'region_name' => 'Australia',
            'onegs' =>['202796','209446','210152','218886','218950','248885'],
            'tabs' => [
                'Sydney'          => [
                    'region'      => 'AU',
                    'region_name' => 'Sydney',
                    'onegs' =>['22738','18094','22738']
                ],
                'Melbourne'    => [
                    'region'      => 'AU',
                    'region_name' => 'Melourne',
                    'onegs' =>['9669','24427','301255','200255']
                ],
                'Brisbane'         => [
                    'region'      => 'AU',
                    'region_name' => 'Brisbane',
                    'onegs' =>['281116','259943','260103','317264','321097','321367']
                ],
            ],

        ],
    ],
    'banners' => [
        [
            'h1' => 'Free Nights Delight Sale',
            'h2' => 'Escape for a few nights more',
            'promo' =>'offer text',
            'url' => '/Free-Night-Sale/',
            'terms' => 'terms',
            'img' => '/img/carousel_item1.png',
            'badge'=> '//www.hotelclub.com/Marketing/campaigns/great-escapes-jan-2013/exclusive-member-rewards_EN.png'
        ],
        [
            'h1' => 'Free Nights Delight Sale',
            'h2' => 'Escape for a few nights more',
            'promo' =>'offer text',
            'url' => '/Free-Night-Sale/',
            'terms' => 'terms',
            'img' => '/img/carousel_item2.png',
            'badge'=> '//www.hotelclub.com/Marketing/campaigns/great-escapes-jan-2013/exclusive-member-rewards_EN.png'
        ],
        [
            'h1' => 'Free Nights Delight Sale',
            'h2' => 'Escape for a few nights more',
            'promo' =>'offer text',
            'url' => '/Free-Night-Sale/',
            'terms' => 'terms',
            'img' => '/img/carousel_item3.png',
            'badge'=> '//www.hotelclub.com/Marketing/campaigns/great-escapes-jan-2013/exclusive-member-rewards_EN.png'
        ],
    ]
    ];
$dataHotels = [
    '9669' => [
        'name'             => 'Pensione Hotel Perth by 8Hotels',
        'location'         => 'Hong Kong',
        'stars'            => '4',
        'img'              => ['315715.jpg', '315715.jpg', '315715.jpg'],
        'href'             => 'http://www.hotelclub.com/psi?type=hotel&locale=en_AU&adults=2&id=315715',
        'country'          => 'AU',
        'city'             => 'Perth',
        'promo_offer'      => 'Stay 2 & Save 20%',
        'member_offer'     => '',
        'conditions'       => 'Travel: Now - 31/12/2014',
        'discount_percent' => 20,
        'promocode'        => 'PO',
        'promoamount'      => '40',
    ],
    '24427' => [
        'location'         => 'Hong Kong',
        'promo_offer'      => 'Stay 2 & Save 20%',
        'member_offer'     => '',
        'conditions'       => 'Travel: Now - 31/12/2014',
        'discount_percent' => 20,
        'name'             => 'Millennium Hotel Paris Opera',
        'stars'            => '4',
        'img'              => ['315715.jpg', '315715.jpg', '315715.jpg'],
        'href'             => 'http://www.hotelclub.com/psi?type=hotel&locale=en_AU&adults=2&id=315715',
        'country'          => 'FR',
        'city'             => 'Paris',
        'promocode'        => 'PO',
        'promoamount'      => '25',
    ],
    '301255' => [
        'location'         => 'Hong Kong',
        'promo_offer'      => 'Stay 2 & Save 20%',
        'member_offer'     => '',
        'conditions'       => 'Travel: Now - 31/12/2014',
        'discount_percent' => 20,
        'name'             => 'The H Hotel',
        'stars'            => '5',
        'img'              => ['315715.jpg', '315715.jpg', '315715.jpg'],
        'href'             => 'http://www.hotelclub.com/psi?type=hotel&locale=en_AU&adults=2&id=315715',
        'country'          => 'AE',
        'city'             => 'Dubai',
        'promocode'        => 'PO',
        'promoamount'      => '25',
    ]
];
$dataBanners = [
    'Free-Nights-Sale' => [
        [
            'h1' => 'Free Nights Delight Sale',
            'h2' => 'Escape for a few nights more',
            'promo' =>'offer text',
            'url' => '/Free-Night-Sale/',
            'terms' => 'terms',
            'img' => '/img/carousel_item1.png',
            'badge'=> '//www.hotelclub.com/Marketing/campaigns/great-escapes-jan-2013/exclusive-member-rewards_EN.png'
        ],
        [
            'h1' => 'Free Nights Delight Sale',
            'h2' => 'Escape for a few nights more',
            'promo' =>'offer text',
            'url' => '/Free-Night-Sale/',
            'terms' => 'terms',
            'img' => '/img/carousel_item2.png',
            'badge'=> '//www.hotelclub.com/Marketing/campaigns/great-escapes-jan-2013/exclusive-member-rewards_EN.png'
        ],
        [
            'h1' => 'Free Nights Delight Sale',
            'h2' => 'Escape for a few nights more',
            'promo' =>'offer text',
            'url' => '/Free-Night-Sale/',
            'terms' => 'terms',
            'img' => '/img/carousel_item3.png',
            'badge'=> '//www.hotelclub.com/Marketing/campaigns/great-escapes-jan-2013/exclusive-member-rewards_EN.png'
        ],
    ],
    'Northeast-Asia' => [
        [
            'h1' => 'Free Nights Delight Sale',
            'h2' => 'Escape for a few nights more',
            'promo' =>'offer text',
            'url' => '/Free-Night-Sale/',
            'terms' => 'terms',
            'img' => '/img/carousel_item1.png',
            'badge'=> '//www.hotelclub.com/Marketing/campaigns/great-escapes-jan-2013/exclusive-member-rewards_EN.png'
        ],
        [
            'h1' => 'Free Nights Delight Sale',
            'h2' => 'Escape for a few nights more',
            'promo' =>'offer text',
            'url' => '/Free-Night-Sale/',
            'terms' => 'terms',
            'img' => '/img/carousel_item2.png',
            'badge'=> '//www.hotelclub.com/Marketing/campaigns/great-escapes-jan-2013/exclusive-member-rewards_EN.png'
        ],
        [
            'h1' => 'Free Nights Delight Sale',
            'h2' => 'Escape for a few nights more',
            'promo' =>'offer text',
            'url' => '/Free-Night-Sale/',
            'terms' => 'terms',
            'img' => '/img/carousel_item3.png',
            'badge'=> '//www.hotelclub.com/Marketing/campaigns/great-escapes-jan-2013/exclusive-member-rewards_EN.png'
        ],
    ],
    'Australia' => [
        [
            'h1' => 'Free Nights Delight Sale',
            'h2' => 'Escape for a few nights more',
            'promo' =>'offer text',
            'url' => '/Free-Night-Sale/',
            'terms' => 'terms',
            'img' => '/img/carousel_item1.png',
            'badge'=> '//www.hotelclub.com/Marketing/campaigns/great-escapes-jan-2013/exclusive-member-rewards_EN.png'
        ],
        [
            'h1' => 'Free Nights Delight Sale',
            'h2' => 'Escape for a few nights more',
            'promo' =>'offer text',
            'url' => '/Free-Night-Sale/',
            'terms' => 'terms',
            'img' => '/img/carousel_item2.png',
            'badge'=> '//www.hotelclub.com/Marketing/campaigns/great-escapes-jan-2013/exclusive-member-rewards_EN.png'
        ],
        [
            'h1' => 'Free Nights Delight Sale',
            'h2' => 'Escape for a few nights more',
            'promo' =>'offer text',
            'url' => '/Free-Night-Sale/',
            'terms' => 'terms',
            'img' => '/img/carousel_item3.png',
            'badge'=> '//www.hotelclub.com/Marketing/campaigns/great-escapes-jan-2013/exclusive-member-rewards_EN.png'
        ],
    ],
    'China' => [
        [
            'h1' => 'Free Nights Delight Sale',
            'h2' => 'Escape for a few nights more',
            'promo' =>'offer text',
            'url' => '/Free-Night-Sale/',
            'terms' => 'terms',
            'img' => '/img/carousel_item1.png',
            'badge'=> '//www.hotelclub.com/Marketing/campaigns/great-escapes-jan-2013/exclusive-member-rewards_EN.png'
        ],
        [
            'h1' => 'Free Nights Delight Sale',
            'h2' => 'Escape for a few nights more',
            'promo' =>'offer text',
            'url' => '/Free-Night-Sale/',
            'terms' => 'terms',
            'img' => '/img/carousel_item2.png',
            'badge'=> '//www.hotelclub.com/Marketing/campaigns/great-escapes-jan-2013/exclusive-member-rewards_EN.png'
        ],
        [
            'h1' => 'Free Nights Delight Sale',
            'h2' => 'Escape for a few nights more',
            'promo' =>'offer text',
            'url' => '/Free-Night-Sale/',
            'terms' => 'terms',
            'img' => '/img/carousel_item3.png',
            'badge'=> '//www.hotelclub.com/Marketing/campaigns/great-escapes-jan-2013/exclusive-member-rewards_EN.png'
        ],
    ],
    'South-Korea' => [
        [
            'h1' => 'Free Nights Delight Sale',
            'h2' => 'Escape for a few nights more',
            'promo' =>'offer text',
            'url' => '/Free-Night-Sale/',
            'terms' => 'terms',
            'img' => '/img/carousel_item1.png',
            'badge'=> '//www.hotelclub.com/Marketing/campaigns/great-escapes-jan-2013/exclusive-member-rewards_EN.png'
        ],
        [
            'h1' => 'Free Nights Delight Sale',
            'h2' => 'Escape for a few nights more',
            'promo' =>'offer text',
            'url' => '/Free-Night-Sale/',
            'terms' => 'terms',
            'img' => '/img/carousel_item2.png',
            'badge'=> '//www.hotelclub.com/Marketing/campaigns/great-escapes-jan-2013/exclusive-member-rewards_EN.png'
        ],
        [
            'h1' => 'Free Nights Delight Sale',
            'h2' => 'Escape for a few nights more',
            'promo' =>'offer text',
            'url' => '/Free-Night-Sale/',
            'terms' => 'terms',
            'img' => '/img/carousel_item3.png',
            'badge'=> '//www.hotelclub.com/Marketing/campaigns/great-escapes-jan-2013/exclusive-member-rewards_EN.png'
        ],
    ],
    'Taiwan' => [
        [
            'h1' => 'Free Nights Delight Sale',
            'h2' => 'Escape for a few nights more',
            'promo' =>'offer text',
            'url' => '/Free-Night-Sale/',
            'terms' => 'terms',
            'img' => '/img/carousel_item1.png',
            'badge'=> '//www.hotelclub.com/Marketing/campaigns/great-escapes-jan-2013/exclusive-member-rewards_EN.png'
        ],
        [
            'h1' => 'Free Nights Delight Sale',
            'h2' => 'Escape for a few nights more',
            'promo' =>'offer text',
            'url' => '/Free-Night-Sale/',
            'terms' => 'terms',
            'img' => '/img/carousel_item2.png',
            'badge'=> '//www.hotelclub.com/Marketing/campaigns/great-escapes-jan-2013/exclusive-member-rewards_EN.png'
        ],
        [
            'h1' => 'Free Nights Delight Sale',
            'h2' => 'Escape for a few nights more',
            'promo' =>'offer text',
            'url' => '/Free-Night-Sale/',
            'terms' => 'terms',
            'img' => '/img/carousel_item3.png',
            'badge'=> '//www.hotelclub.com/Marketing/campaigns/great-escapes-jan-2013/exclusive-member-rewards_EN.png'
        ],
    ],
    'Sydney' => [
        [
            'h1' => 'Free Nights Delight Sale',
            'h2' => 'Escape for a few nights more',
            'promo' =>'offer text',
            'url' => '/Free-Night-Sale/',
            'terms' => 'terms',
            'img' => '/img/carousel_item1.png',
            'badge'=> '//www.hotelclub.com/Marketing/campaigns/great-escapes-jan-2013/exclusive-member-rewards_EN.png'
        ],
        [
            'h1' => 'Free Nights Delight Sale',
            'h2' => 'Escape for a few nights more',
            'promo' =>'offer text',
            'url' => '/Free-Night-Sale/',
            'terms' => 'terms',
            'img' => '/img/carousel_item2.png',
            'badge'=> '//www.hotelclub.com/Marketing/campaigns/great-escapes-jan-2013/exclusive-member-rewards_EN.png'
        ],
        [
            'h1' => 'Free Nights Delight Sale',
            'h2' => 'Escape for a few nights more',
            'promo' =>'offer text',
            'url' => '/Free-Night-Sale/',
            'terms' => 'terms',
            'img' => '/img/carousel_item3.png',
            'badge'=> '//www.hotelclub.com/Marketing/campaigns/great-escapes-jan-2013/exclusive-member-rewards_EN.png'
        ],
    ],
    'Melbourne' => [
        [
            'h1' => 'Free Nights Delight Sale',
            'h2' => 'Escape for a few nights more',
            'promo' =>'offer text',
            'url' => '/Free-Night-Sale/',
            'terms' => 'terms',
            'img' => '/img/carousel_item1.png',
            'badge'=> '//www.hotelclub.com/Marketing/campaigns/great-escapes-jan-2013/exclusive-member-rewards_EN.png'
        ],
        [
            'h1' => 'Free Nights Delight Sale',
            'h2' => 'Escape for a few nights more',
            'promo' =>'offer text',
            'url' => '/Free-Night-Sale/',
            'terms' => 'terms',
            'img' => '/img/carousel_item2.png',
            'badge'=> '//www.hotelclub.com/Marketing/campaigns/great-escapes-jan-2013/exclusive-member-rewards_EN.png'
        ],
        [
            'h1' => 'Free Nights Delight Sale',
            'h2' => 'Escape for a few nights more',
            'promo' =>'offer text',
            'url' => '/Free-Night-Sale/',
            'terms' => 'terms',
            'img' => '/img/carousel_item3.png',
            'badge'=> '//www.hotelclub.com/Marketing/campaigns/great-escapes-jan-2013/exclusive-member-rewards_EN.png'
        ],
    ],
    'Brisbane' => [
        [
            'h1' => 'Free Nights Delight Sale',
            'h2' => 'Escape for a few nights more',
            'promo' =>'offer text',
            'url' => '/Free-Night-Sale/',
            'terms' => 'terms',
            'img' => '/img/carousel_item1.png',
            'badge'=> '//www.hotelclub.com/Marketing/campaigns/great-escapes-jan-2013/exclusive-member-rewards_EN.png'
        ],
        [
            'h1' => 'Free Nights Delight Sale',
            'h2' => 'Escape for a few nights more',
            'promo' =>'offer text',
            'url' => '/Free-Night-Sale/',
            'terms' => 'terms',
            'img' => '/img/carousel_item2.png',
            'badge'=> '//www.hotelclub.com/Marketing/campaigns/great-escapes-jan-2013/exclusive-member-rewards_EN.png'
        ],
        [
            'h1' => 'Free Nights Delight Sale',
            'h2' => 'Escape for a few nights more',
            'promo' =>'offer text',
            'url' => '/Free-Night-Sale/',
            'terms' => 'terms',
            'img' => '/img/carousel_item3.png',
            'badge'=> '//www.hotelclub.com/Marketing/campaigns/great-escapes-jan-2013/exclusive-member-rewards_EN.png'
        ],
    ],
];