<!-- lang -->
<div class="col-md-offset-6">
    <ul class="nav navbar-nav navbar-right right_menu">

	{% if not empty(menuItemsRightSite) %}
		{% for label,link in menuItemsRightSite %}

		    {% if languageCode != 'en_AU' %}
                {% if label != 'ascott_specials' %}
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
	<li>&nbsp;|</li>
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

