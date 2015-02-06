{{ partial('../../../common/views/header/header') }}
    <div class="sub-content subContainer">
        <h1>Oops. The page you requested is no longer available or our promotion has expired.</h1>
        <h2>Checkout our current promotions</h2>
        {%  for campaign in data %}
            <div>

        {#<a href="/n/merch/{{ campaign['locale'] }}/{{ campaign['url'] }}">#}
        <a href="/n/merch/{{ campaign['locale'] }}/{{ campaign['url'] }}">
            <img src="{{ campaign['thumbnail'] }}" />
        </a>
        </div>
        {% endfor %}
        <br />
        <br />
    </div>
{{ partial('../../../common/views/footer/footer') }}
