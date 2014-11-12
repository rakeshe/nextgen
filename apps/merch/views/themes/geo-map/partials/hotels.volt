<script type="text/javascript">
var deals = JSON.parse('{{ hotelDetailsJson }}'),
camp = '{{ campaignData }}',
trans = {'mem_extras':'{{t._("mem_extras")}}', 'mem_inactive_line1':'{{t._("mem_inactive_line1")}}',  'mem_inactive_line2':'{{t._("mem_inactive_line2")}}', 'Save':'{{t._("Save")}}', 'book':'{{t._("book")}}'},
lang = '{{languageCode}}',
campName = '{{ campaignName }}',
hotelsD = '{{ hotels | json_encode}}';
</script>
{% if city is not defined %}
{% set city = false %}
{% endif %}
{% if country is defined and country != "" %}
{% endif%}
<!-- START VIEW PARTIAL: hotel/item list -->
<!-- Hotel List -->
<div class="clearfix">
	<div id="hotel_card_block">
		<div id="hotel_card_search">
			<div class="world_best_deals">World best deals</div>
			<div class="hotel_all_search"><img src="/themes/common/img/search.jpeg" width="15"/>Search all HotelClub<b class="caret"></b></div>
		</div>
		<div class="display-cards"></div>		
	</div>		
</div>
<div class="search_footer">
	<div class="search_footer_head">
		<span class="search_not_found">Not found what you're looking for?</span>
		<span class="search_plus"><img src="/themes/common/img/plus.png"/></span>
	</div>
	<input type="text" value="Search all HotelClub" name="search_input_footer" class="search_input_footer"/>
	<div class="search_hotel_near">
		<img src="/themes/common/img/marker.png"/> Nearby tonight <b>></b>
	</div>
</div><br/>