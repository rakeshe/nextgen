<!-- lang -->
<div class="col-md-offset-6">
    <ul class="nav navbar-nav navbar-right right_menu">
	
	{% if not empty(menuItemsRightSite) %}
		{% for label,link in menuItemsRightSite %}
                    <li class="dropdown">
                        <a href="{{ link }}" class="link">{{ t._(label) }}</a>
                    </li>
         {% endfor %}
	{% endif %}        
	{% if not empty(menuItemsLanguageOptions) %}        
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> {{ menuItemsLanguageOptions[languageCode] }} <b class="caret"></b></a>
            <ul class="dropdown-menu">
                {% for language_code,label in menuItemsLanguageOptions %}
                    <li lang="{{ language_code }}" class="">
                        <a href="/set-language/{{ language_code }}" class="link">{{ label }}</a>
                    </li>
                {% endfor %}
            </ul>
        </li>
	{% endif %}	
	<li>&nbsp;|</li>
	{% if not empty(currencies) %}
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> {{ currencyCode }} <b class="caret"></b></a>
            <ul class="dropdown-menu">
                {% for CatName, currencyPkg in currencies %}
                <div>{{ t._(CatName) }}</div>
                	{% for currency_code,labelName in currencyPkg %}
	                    <li lang="{{ language_code }}" class="">
	                        <a href="/set-currency/{{ currency_code }}" class="link">{{ t._(labelName) }}</a>
	                    </li>
	                {% endfor %}
                {% endfor %}
            </ul>
        </li>
	{% endif %}	
    </ul>
</div>

