<!-- lang -->
<div class="col-md-offset-6">
    <ul class="nav navbar-nav navbar-right right_menu">
        <li class="dropdown">
            <a href="http://www.revresda.com/event.ng/Type=click&FlightID=236487&AdID=458542&TargetID=53988&ASeg=&AMod=&Segments=65,406,4979,7949,8303,11672,12591,39489,47055,50404,60715,61817,64040,74252,80088,85776,85777&Targets=53988&Values=81,90,100,31103,32876,33112,33119,33156,33234,34172,34641,34959,34960,35048,35272,35582,35643,35657,35682,35771,35793,36063,36105,36112,36138,68032,68088,68179,68180,68236,68270,68318,68322,68325,68326,68359,68363,68367,68375,96191,102874,102875,103013,103016,103078,103455,108536,113294&RawValues=NGUSERID%2Ca32a420-11187-519196470-1&WebLogicSession=&Params.User.UserID=a32a420-11187-519196470-1&Redirect=http%3A%2F%2Fwww.hotelclub.com%2Fhotels%2Fascott-offer"
                class="link">Ascott Specials</a>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">English <b class="caret"></b></a>
            <ul class="dropdown-menu">
                {% for language_code,label in menuItemsLanguageOptions %}
                    <li lang="{{ language_code }}" class="">
                        <a href="/{{ language_code }}/test-campaing/" class="link">{{ label }}</a>
                    </li>
                {% endfor %}
            </ul>
        </li>
    </ul>
</div>
{#{{ todo: add js for pjax switcher }}#}

