{% for region, tab in pageData['tabs'] %}

    <li class="dropdown-submenu level1">
        <a tabindex="-1"
           href="/{{ languageCode }}/{{ campaignName }}/{{ region }}">{{ tab['region_name'] }}</a>
        {% if not(tab['tabs'] is empty) %}
            <ul class="dropdown-menu level2">
                {% for regionSub, tabSub in tab['tabs'] %}
                    <li>
                        <a tabindex="-1"
                           href="/{{ languageCode }}/{{ campaignName }}/{{ region }}/{{ regionSub }}">{{ tabSub['region_name'] }}</a>
                    </li>
                    <li class="divider"></li>

                {% endfor %}
            </ul>
        {% endif %}
    </li>
{% endfor %}
