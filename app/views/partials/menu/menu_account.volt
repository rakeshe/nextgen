{% if currentUser is empty %}
    {% for label,uri in menuItemsAccount %}
        <li><a class="link" href="{{ uri }}">{{ t._(label) }}</a></li>
    {% endfor %}
{% else %}
    <li class="welcomeText">{{ t._('welcome') }} {{ currentUser['name'] }} </li>
    <li class="loyaltyTier">{{ currentUser['loyaltyTier'] }} Member:</li>
    <li class="loyaltyInfo">{{ currentUser['rewardPoints'] }} Member Rewards** ({{ currentUser['rewardPoints'] }})</li>
    <li class="signOutLink"><a rel="nofollow" class="link" href="https://www.hotelclub.com/account/logout">{{ t._('sign_out') }}</a></li>

{% endif %}