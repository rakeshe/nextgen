<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    {{ stylesheet_link('themes/' ~ theme ~ '/css/desktop.css?' ~ appVersion ) }}
</head>
<body>
{% if isset(data) %}
{% if not enableOffer %}
    <div id="offer-overlay"></div>
{% endif %}

{% for key, val in data %}
<div class="card-container {{ data[key][tier][0]['offer_group_seo'] }}">

    <h2>{{ key }}</h2>
    {% for card in data[key][tier] %}

        <div class="offer-card {{ card['tier']|lower }}">
            <div class="card-image">
                <div class="icon sprite-icons-{{ card['offer_group_seo'] }} {{ card['icon'] }}"></div>
                <img class="offer-card-image" src="{{ card['img_thumb'] }}" alt="{{ card['description'] }}">
            </div>
            <div class="card-text">
                <div class="tier-info">{{ tier }}</div>
                <div class="title">{{ card['title'] }}</div>
                <span class="description">{{ card['description'] }}</span>
                <div class="cta">
                    {%  if enableOffer %}
                        <a title="Redeem now" href="{{ card['uri'] }}" target="_blank">
                            <img src="http://www.tnetnoc.com/flexmanager/images/2015/07/13/redeem.png" alt="Redeem now" border="0">
                        </a>
                    {%  else %}
                        <img src="http://www.tnetnoc.com/flexmanager/images/2015/07/13/redeem.png" alt="Redeem now" border="0">
                    {%  endif %}

                </div>
            </div>
        </div>
    {% endfor %}

</div>
{% endfor %}
{% endif %}