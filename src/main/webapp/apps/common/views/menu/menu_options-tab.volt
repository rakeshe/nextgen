<!-- lang -->
{% if not empty (menuItemsLanguageOptions) %}        
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> {{ menuItemsLanguageOptions[languageCode] }} <b class="caret"></b></a>
    <ul class="dropdown-menu">
        {% for language_code,label in menuItemsLanguageOptions %}
        <li lang="{{ language_code }}" class="">
            <a href="/n/set-language/{{ language_code }}" class="link">{{ label }}</a>
        </li>
        {% endfor %}
    </ul>
</li>
{% endif %}

