{% if theme is not defined %}
    {% set theme = 'geo-map' %}
{% endif %}
{% if appVersion is not defined %}
    {% set appVersion = '1.12.0' %}
{% endif %}
{% if fontCSS is not defined %}
    {% set fontCSS = 'normal-font' %}
{% endif %}

{{ stylesheet_link('vendor/bootstrap3.0/css/bootstrap.min.css?' ~ appVersion ) }}
{{ stylesheet_link('themes/common/font/font_museo.css?' ~ appVersion ) }}
{{ stylesheet_link('themes/common/font/font_serifa.css?' ~ appVersion ) }}
{{ stylesheet_link('themes/' ~ theme ~ '/css/desktop.css?' ~ appVersion ) }}
{{ stylesheet_link('themes/' ~ theme ~ '/css/'~ fontCSS ~'.css?' ~ appVersion ) }}
{{ stylesheet_link("//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/blitzer/jquery-ui.min.css", false) }}
<div class="container">

    <div class="copyright">
        <a href="https://www.bbb.org/chicago/business-reviews/travel-agencies-and-bureaus/hotelclub-in-chicago-il-88262367" style="float: left; margin-right: 10px;"><img
                    alt="Better Business Bureau" height="49" src="https://www.hotelclub.com/Marketing/cbbb-badge-horz.png"
                    width="149"></a>

        <p style="float: left">HotelClub is a registered trademark of HotelClub Pty Ltd.<br>
            HotelClub is owned and operated by HotelClub Pty Ltd., an affiliate of HotelClub Limited, part of Orbitz
            Worldwide Inc</p>

        <p style="float: left"><span class="caveat">**</span>1 Member Reward = 1 USD, converted to AUD today. See full <a class="link"
                                                                                                                          rel="nofollow popup"
                                                                                                                          href="/info/win?id=MembershipTerms">Membership
                Terms and Conditions</a> for details.</p>
    </div>



</div>


{{ javascript_include("//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js", false) }}
{{ javascript_include("//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js", false) }}
{{ javascript_include('vendor/bootstrap3.0/js/bootstrap.min.js?' ~ appVersion ) }}
{{ javascript_include('themes/' ~ theme ~ '/js/common.js?' ~ appVersion ) }}
{{ javascript_include('vendor/lazy-load/jquery.lazyload.js?' ~ appVersion ) }}
{{ javascript_include('themes/common/js/jquery.cookie.js?' ~ appVersion ) }}
{{ javascript_include('themes/common/js/respond.src.js?' ~ appVersion ) }}