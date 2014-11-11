{{ partial('../../../common/views/header/header') }}
<style>
	.saveBookInfo{ background:none !important; padding:0 !important; }
	#banner { padding:0 !important;box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.1) !important; margin-bottom:20px; }
	#banner_image { margin:0; }
	#banner_val { position:relative; margin-bottom:-30px; z-index:999;float:right;text-align:right;margin-right:10px; }
	#menu_new { margin: 0; padding: 0; }
	#menu_new li { display: block; float: left; margin: 0; width: 20%; background-color: #E21E28; padding: 10px;border-right:1px solid #FFFFFF; text-align:center; }
	#menu_new li:last-child { border-right:0px; } 
	#menu_new li a { color:#FFFFFF; text-decoration:none; font-size:12pt; }
	#hotel_card_block { width=90%; height:auto; }
	#hotel_card_search { display:block; }
	.world_best_deals { float:left; width:470px; padding:15px 10px;font-size:11pt;font-weight:bold; }
	.hotel_all_search { float:left; text-align:right; width:470px; padding:15px 5px;font-size:11pt;font-weight:bold; }
	.map-back { color:#FFF !important; }
	.map-reset { color:#FFF !important; }s
	.hotel_main_block { background-color:#FFF; }
	#hotel_image { float:left; }
	#hotel_content { float:left; width:180px; margin:5px; }
	.hotel_card_heading { color:#FFF;font-size:14pt;  }
	.hotel_name { color:#E21E28; font-weight:bold; font-size:12pt; }
	.hotel_city { color:#303030; font-size:10pt;font-weight:bold; }
	.hotel_review { float:right; }
	.hotel_cards {float:left;width:460px; border:4px solid #000; margin:3px 0px 15px 10px; }
	.hotel_cards_heading { padding:5px; }
	.font_red { font-size:8pt !important; }
	#footer_new { box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.1) !important; margin-bottom:20px; }
	.search_footer { border:4px solid #EEEEEE; margin:10px; padding:20px; }
	.search_not_found { font-size:11pt;font-weight:bold; }
	.search_footer_head { margin:10px 10px 10px 0; }
	.search_input_footer { background: white; border: 1px double #DDD;border-radius: 5px; box-shadow: 0 0 5px #333; color: #666; outline: none; height:25px; width: 100%;} 
	.search_plus { float:right; }
	.search_hotel_near{ padding:10px 10px 10px 0; font-size:10pt; color:#666; }	
</style>
<!-- START VIEW PARTIAL: banner.phtml -->
<div id="banner" class="subContainer">

    {{ partial(theme ~ '/partials/map') }}
        
    {{ partial(theme ~ '/partials/menu') }}
    
    {{ partial(theme ~ '/partials/hotels') }}

</div>

{{ partial('../../../common/views/footer/footer') }}