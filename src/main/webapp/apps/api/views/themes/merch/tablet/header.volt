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
<div id="header" class="subContainer visible-md visible-lg">

    <!-- desktop header -->
    <div id="dkt_header">
        <div class="row">

            <!-- header logo -->
            <div class="logo">
                <a href="/" title="Hotelclub Logo">
                    <img src="/n/themes/common/img/logo-header.png" alt="Hotelclub Logo" />
                </a>
            </div>

            <!-- header links -->
            <div class="col-md-offset-5">
                <ul class="primary">
                    {% if not empty(menuItemsTop) %}
                        {% for label,uri in menuItemsTop %}
                            <li><a rel="nofollow" class="link" href="{{ uri }}">{{ t._(label) }}</a></li>
                        {% endfor %}
                    {% endif %}
                </ul>

                <ul class="login">
                    {% if currentUser is empty %}
                        {% if not empty(menuItemsAccount) %}
                            {% for label,uri in menuItemsAccount %}
                                <li><a class="{{ label }}-link" href="{{ uri }}">{{ t._(label) }}</a></li>
                            {% endfor %}
                        {% endif %}
                    {% else %}
                        <li class="hidden-sm hidden-xs welcomeText">{{ t._('welcome') }} {{ currentUser['name'] }} </li>
                        <li class="loyaltyTier hidden-sm hidden-xs">{{ currentUser['loyaltyTier'] }} Member:</li>
                        <li class="loyaltyInfo hidden-sm hidden-xs">{{ currentUser['rewardPoints'] }} Member Rewards** ({{ currentUser['rewardPoints'] }})</li>
                        <li class="signOutLink"><a rel="nofollow" class="acc-link" href="https://www.hotelclub.com/account/logout">{{ t._('sign_out') }}</a></li>
                    {% endif %}
                </ul>
            </div>

        </div>
    </div>
    <!-- /desktop header -->

</div>
<div id="mbl_header" class="hidden-md hidden-lg">

    {#@todo - convert to volt#}
    <!-- mobile header -->
    <div id="mbl_menu">
        <div class="dropdown multi_languages">
            <a class="dropdown-toggle head_menu_pad" id="mbl_menu_logo" data-toggle="dropdown" href="#">
                <img src="/n/themes/common/img/mobile_menu.png" class="img-responsive" />
                <span class="offscreen">Main Menu</span></a>
            <ul class="dropdown-menu main_left_menu" role="menu" aria-labelledby="dLabel">
                <li><a href="http://www.hotelclub.com" alt="Home">Home</a></li>
                <li class="horiz_border"><a href="http://www.hotelclub.com/hotels/club-benefits" alt="Club Benefits" class="no_horiz_border">Club Benefits</a></li>
                <li>
                    <a href="https://faq.hotelclub.com/" alt="Customer Service"><table width="100%"><tr>
                                <td width="20%"><div class="customer_menu_icon">&nbsp;</div></td>
                                <td>Customer Service</td>
                            </tr></table></a>

                </li>
                <!-- lang -->
                {% if not empty (menuItemsLanguageOptions) %}
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" id="open_languages" data-toggle="dropdown">{{ menuItemsLanguageOptions[languageCode] }}<b class="caret"></b></a>
                        <ul class="dropdown-menu" id="lang_style">
                            {% for language_code,label in menuItemsLanguageOptions %}
                                <li lang="{{ language_code }}" class="">
                                    <a href="/n/set-language/{{ language_code }}" class="link">{{ label }}</a>
                                </li>
                            {% endfor %}
                        </ul>
                    </li>
                {% endif %}
            </ul>
        </div>
    </div>

    <div id="mbl_logo">
        <a href="index.html" title="Hotelclub Logo" class="head_menu_pad" id="mbl_main_logo">
            <img src="/n/themes/common/img/logo-tablet.png"  class="img-responsive" alt="Hotelclub Logo" />
        </a>
    </div>

    <div id="mbl_brief_member">
        <!--<div id="tab_briefcase" class="visible-sm">
            <a href="#" title="Hotelclub" class="head_menu_pad" id="mbl_brief_logo"><span>&nbsp;</span></a>
        </div>-->

        <div id="mbl_member">
            <div class="dropdown pull-right">
                {# <a class="visible-sm dropdown-toggle head_menu_pad" data-toggle="dropdown" href="#" id="tbl_member_logo">
                  <span >Welcome</span>
                 </a> #}
                <a class=" dropdown-toggle head_menu_pad" data-toggle="dropdown" href="#" id="mbl_member_logo"> <span class="visible-sm visible-xs	" > <img src="/n/themes/common/img/mobile_member.png" class="img-responsive" alt="member Logo" />   </span>
                </a>
                <ul class="dropdown-menu main_right_menu" role="menu" aria-labelledby="dLabel2">
                    {% if not empty(menuItemsTop) %}
                        {% for label,uri in menuItemsTop %}
                            <li><a rel="nofollow" class="link" href="{{ uri }}">{{ t._(label) }}</a></li>
                        {% endfor %}
                    {% endif %}
                    {% if currentUser is empty %}
                        {% if not empty(menuItemsAccount) %}
                            {% for label,uri in menuItemsAccount %}
                                <li><a class="{{ label }}-link" href="{{ uri }}">{{ t._(label) }}</a></li>
                            {% endfor %}
                        {% endif %}
                    {% else %}
                        <li class="hidden-sm hidden-xs welcomeText">{{ t._('welcome') }} {{ currentUser['name'] }} </li>
                        <li class="loyaltyTier hidden-sm hidden-xs">{{ currentUser['loyaltyTier'] }} Member:</li>
                        <li class="loyaltyInfo hidden-sm hidden-xs">{{ currentUser['rewardPoints'] }} Member Rewards** ({{ currentUser['rewardPoints'] }})</li>
                        <li class="signOutLink"><a rel="nofollow" class="acc-link" href="https://www.hotelclub.com/account/logout">{{ t._('sign_out') }}</a></li>
                    {% endif %}
                </ul>
            </div>
        </div>
    </div>

    <div class="clear">&nbsp;</div>
    <!-- /mobile header -->


</div>
<!-- headMenu -->
<div id="headMenu" class="subContainer visible-md visible-lg">
    <div class="row">
        <!-- main menu -->
        <div class="col-md-6">
            <ul id="header_menu_hc" class="left_menu">
                {% if not empty(menuItemsSite) %}

                    {% if languageCode == 'en_AU' %}

                        {% for label,uri in menuItemsSite %}
                            <li><a class="link" href="{{ uri }}">{{ t._(label) }}</a></li>
                        {% endfor %}
                    {%else%}

                        {% for label,uri in menuItemsSite %}
                            {% if label != 'menu_travel_insurance' %}
                                <li><a class="link" href="{{ uri }}">{{ t._(label) }}</a></li>
                            {%endif%}
                        {% endfor %}

                    {%endif%}

                {% endif %}
            </ul>
        </div>
        <!-- lang -->
        <div class="col-md-offset-2 pull-left">
            <ul class="nav navbar-nav navbar-right right_menu right_menu_link">
                {% if not empty(menuItemsRightSite) %}
                    {% for label,link in menuItemsRightSite %}

                        {% if languageCode != 'en_AU' %}
                            {% if label != 'USA' %}
                                <li class="dropdown">
                                    <a href="{{ link }}" class="link">{{ t._(label) }}</a>
                                </li>
                            {% endif %}
                        {% else %}
                            <li class="dropdown">
                                <a href="{{ link }}" class="link">{{ t._(label) }}</a>
                            </li>
                        {% endif %}
                    {% endfor %}
                {% endif %}
            </ul>
        </div>
        <div class="col-md-offset-2">
            <ul class="nav navbar-nav navbar-right right_menu">

                {% if not empty(menuItemsLanguageOptions) %}
                    <li class="dropdown">
                        <a href="#" id="" class="dropdown-toggle" data-toggle="dropdown"> {{ menuItemsLanguageOptions[languageCode | trim] }} <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            {% for language_code,label in menuItemsLanguageOptions %}
                                <li lang="{{ language_code }}" class="">
                                    <a href="/n/set-language/{{ language_code }}" class="link">{{ label }}</a>
                                </li>
                            {% endfor %}
                        </ul>
                    </li>
                {% endif %}
                <li><div class="right_menu_divider"></div> </li>
                {% if not empty(currencies) %}
                    <li class="dropdown">
                        <ul class="dropdown-menu currencySelector selector multiColumn">
                            {% for groupIndex, currencyGroup in currencyList %}
                                <li class="column column3">
                                    {% for CatName, currencyPkg in currencyGroup %}
                                        <div class="section {% if not loop.first %}top {% endif %}"><h5>{{ t._(CatName) }}</h5></div>
                                        {% for currency_code,labelName in currencyPkg %}
                                            <ul>
                                                <li data-component="currencySelectorItem">
                                                    <a class="link currencyItem" data-currency="{{ currency_code }}">{{ t._(labelName) }}</a>
                                                </li>
                                            </ul>
                                        {% endfor %}
                                    {% endfor %}
                                </li>
                            {% endfor %}

                        </ul>
                        <a href="#" id="currency-selector-menu" class="dropdown-toggle" data-toggle="dropdown"> {{ currencyCode }} <b class="caret"></b></a>
                    </li>
                {% endif %}
            </ul>
        </div>

    </div>
</div>
<!-- /headMenu -->


</div>


{{ javascript_include("//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js", false) }}
{{ javascript_include("//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js", false) }}
{{ javascript_include('vendor/bootstrap3.0/js/bootstrap.min.js?' ~ appVersion ) }}
{{ javascript_include('themes/' ~ theme ~ '/js/common.js?' ~ appVersion ) }}
{{ javascript_include('vendor/lazy-load/jquery.lazyload.js?' ~ appVersion ) }}
{{ javascript_include('themes/common/js/jquery.cookie.js?' ~ appVersion ) }}
{{ javascript_include('themes/common/js/respond.src.js?' ~ appVersion ) }}