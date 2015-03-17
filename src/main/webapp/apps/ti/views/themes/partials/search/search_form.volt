<div class="row">
  <div class="col-xs-12 col-md-8 col-lg-8 al">
		<div class="main-search-box">		  
		  <div class="row">
			<div class="col-xs-11 col-sm-8 col-md-7 col-lg-7">
			  <h4 class="hidden-xs">
				<strong>{{t._('Search_for_Travel_Insurance')}}</strong>
			  </h4>
			  <h5 class="visible-xs">
				<strong>{{t._('Search_for_Travel_Insurance')}}</strong>
			  </h5>				
		  </div>
		  <div class="row-padding visible-xs clearfix"></div>
		  <div class="col-xs-11 col-sm-4 col-md-5 col-lg-5">
			  <div id="divnav" class="breadCrumb">
				<div class="breadCrumbText">
				  <ul class="row">
					<li class="col-xs-6 col-sm-6 col-md-0 col-lg-0">
					  <a class="breadCrumbQuoteLabel" href="#">
						{{t._('quote')}}
					  </a>
					</li>
					<li class="col-xs-7 col-sm-7 col-md-0 col-lg-0">
					  <a class="breadCrumbDetailsLabel" href="#">
						{{t._('details')}}
					  </a>
					</li>
					<li class="col-xs-7 col-sm-7 col-md-0 col-lg-0">
					  <a class="breadCrumbPurchaseLabel" href="#">
						{{t._('purchase')}}
					  </a>
					</li>
					<li class="col-xs-7 col-sm-7 col-md-0 col-lg-0">
					  <a class="breadCrumbConfirmLabel" href="#">
						{{t._('confirm')}}
					  </a>
					</li>
				  </ul>
				</div>
				<!-- progress round and tick buttons -->
				<div class="divImgQuote" id="divImgQuote">
				  <div class="col-xs-0 block-icon1">
					<span>
					</span>
				  </div>
				  <div class="col-xs-0 block-icon2">
					<span>
					</span>
				  </div>
				  <div class="col-xs-0 block-icon3">
					<span>
					</span>
				  </div>
				  <div class="col-xs-0 block-icon4">
					<span>
					</span>
				  </div>
				</div>
			  </div>
			</div>
		  
		  <div id="src-elmt">			
			{{ form('class': 'form-search','id' : 'form-search','name' : 'find-hotel') }}
			<div class="row row-padding text-right">
			  <div class="col-xs-6 col-sm-3 col-md-3 Search_head1">
				<strong>
				  {{t._('select_travellers')}}
				</strong>
			  </div>
			</div>
			<div class="row row-padding text-right">
			  <div class="col-xs-6 col-sm-3 col-md-3 search_content1">
				{{t._('country_of_residence')}}
			  </div>
			  <div class="col-xs-2 col-sm-2 col-md-2">
				{{form.render('ddlcountry')}}
			  </div>
			</div>
			<div class="row row-padding text-right">
			  <div class="col-xs-6 col-sm-3  col-md-3 col-lg-3 search_content1">
				{{t._('adult')}}
			  </div>
			 <div class="col-xs-1 col-sm-1 col-md-1">
				{{form.render('ddlAdult')}}
			  </div>
			  <div class="clearfix row-padding visible-xs">
			  </div>
			  <div class="col-xs-6 col-sm-3 col-md-2 dependents">
				{{t._('child')}}
			  </div>
			  <div class="col-xs-1 col-sm-1  col-md-1">
				{{form.render('ddlChild')}}
			  </div>
			   <div class="col-xs-4 col-sm-1  col-md-1">
			  <div class="help-icon hidden-xs col-md-1" id="help-icon"></div>
              <div class="help-message hidden-xs" id="help-message" style="display: none;"></div>
			  </div>
			  <div class="clearfix visible-xs"></div>
			</div>
			<div class="row row-padding date_search text-right">
				  <div class="col-xs-6 col-sm-3 col-md-3 col-11p search_content1">
					{{t._('dob')}}
					<div style="clear:both;">&nbsp;</div>
				  </div>
				  <div class="col-dob">
					  <div id="divDobL1" class="dob_search">
						{{form.render('Adob1')}}
					</div>						
					{#	<div class="dob_td"></div> #}
						<div id="divDobL2" class="dob_search" style="display:none">
							{{form.render('Adob2')}}
						</div>
						<div id="divDobL3" class="dob_search" style="display:none">
							{{form.render('Adob3')}}
						</div>
						<div id="divDobL4" class="dob_search" style="display:none">
							{{form.render('Adob4')}}
						</div>
						<div id="divDobL5" class="dob_search" style="display:none">
							{{form.render('Adob5')}}
						</div>
					</div>
					<p class="error_dob col-xs-10 col-sm-4 col-md-5 col-lg-5"></p>
				<div style="clear:both;">&nbsp;</div>
				</div>
			 <div class="clearfix visible-xs"></div>
			<div class="row row-padding">
			  <div class="col-xs-7 col-sm-4 col-md-5 col-lg-5 search_head2">
				<strong>
				  {{t._('select_your_destinations')}}
				</strong>
				 </div>
				  <div class="col-xs-5 col-sm-5 col-md-6 col-lg-5 destination_search" id="destination_search">
			  </div>
			
			</div>
			<div class="row row-padding dest-res">
			</div>
			
			<div class="row row-padding">
			  <div class="col-xs-5 col-sm-3 col-md-3 search_head3">
				<strong>
				  {{t._('specify_dates')}}
				</strong>
			  </div>
			  <div class="startdate col-xs-4 col-sm-3 col-md-3" >
					<strong>
					</strong>
				  </div>
			  </div>
			  <div class="row-padding">
			   <div class="col-xs-11 col-sm-12 col-md-12 search_content3">
				<div class="date_form">
				  <div style="float:left; margin-top: 5px;" class="col-11p">
					{{t._('start_date')}} <div style="clear:both;">&nbsp;</div>
				  </div>
				  <div class="dStartDate_data">
					{{form.render('dStartDate')}}
				  </div>
				  <div style="clear:both;">&nbsp;</div>
				</div>
				 
				<div class="clearfix row-padding visible-xs">
				</div>
				<div class="date_form_2 ">
				  <div style="float:left; margin-top: 5px;" class="col-11p">
					{{t._('end_date')}} <div style="clear:both;">&nbsp;</div>
				  </div>
				  
				  <div class="dEndDate_data">
					{{form.render('dEndDate')}}
				  </div>
				  
				  <div style="clear:both;">&nbsp;</div>
				  </div>
				</div>
				</div>
			
				<div class="clearfix"></div>
				
				<div class="col-xs-11 col-sm-5 col-md-6 col-lg-5 promocode_form">
				  <div style="float:left; margin-top: 5px;" class="col-11p">
					{{t._('promocode')}} <div style="clear:both;">&nbsp;</div>
				  </div>
				
				  <div class="couponCode_form">
					{{form.render('couponCode')}}
				  </div>
				  <div class="clearfix visible-xs">
				  </div>
				  <div style="clear:both;">&nbsp;</div>
				  <div style="float:left;display:none" class="coupon_Code" >
					<strong>
					</strong>
				  </div>
				</div>
			<div class="row row-padding">
			  <div class="col-xs-11 col-sm-11 col-md-11 search_btn" >
				<button type="submit" id="getPrice" title="Get Quotes" class="btn btn-default col-md-offset-8">
				  {{t._('get_quote')}}
				</button>
			  </div>
			</div>
		  </div>		  
		  <div id="mod-scrch" class="row row-padding">
			<div class="col-xs-12 col-sm-11 col-md-11 text-right" id="ch-yr-sch">
			  <a href="#" id="sw-s-bx"><strong>{{t._('change_search')}}</strong></a>
			</div>
			<div class="clearfix"></div>
			<div class="col-xs-12 col-sm-10 col-md-12 col-lg-11 row-fluid" id="search-result-summary">
			</div>
		  </div>
		  </div>
		</form>
	  </div>
  <!-- /Travel Insurance -->
 <div id='loading'>
     <div class="row row-padding">
      <div> <img src="/n/themes/common/img/loading.gif" /> Working ...</div>
	  <div style="font-size:10px">Please wait as we work on your request</div>
    </div>
  </div>

{#<div id='loading'>#}
    {#<div class="contener_general">#}
        {##}
        {#<div class="contener_mixte"><div class="ballcolor ball_1">&nbsp;</div></div> <div class="contener_mixte"><div class="ballcolor ball_2">&nbsp;</div></div> <div class="contener_mixte"><div class="ballcolor ball_3">&nbsp;</div></div> <div class="contener_mixte"><div class="ballcolor ball_4">&nbsp;</div></div> </div>#}
{#</div>#}

  <div id="display-frame">
  </div>
  <div id="search-result-box">
    <div class="row inc-policy">
      {{t._('insurance_policy_prices')}}
    </div>
		<div class="table-responsive" id="insurance-policy-prices">
		  <table class="table table-bordered">
			<thead>
			  <tr>
				<th class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				  {{t._('policy_type')}}
				</th>
				<th class="text-center col-xs-3 col-sm-3 col-md-3 col-lg-3">
				  {{t._('comprehensive')}}
				</th>
				<th class="text-center col-xs-3 col-sm-3 col-md-3 col-lg-3">
				  {{t._('essentials')}}
				</th>
			  </tr>
			</thead>
			<tbody id="sngl_jury">
			</tbody>
		  </table>
		</div>
		<div class="row inc-policy">
		  {{t._('compare')}}
		</div>
		<div class="table-responsive">
		  <table class="table table-bordered">
			<thead>
			  <tr>
				<th class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				  {{t._('features')}}
				</th>
				<th class="text-center col-xs-3 col-sm-3 col-md-3 col-lg-3">
				  {{t._('view_details')}}
				</th>
				<th class="text-center col-xs-3 col-sm-3 col-md-3 col-lg-3">
				  {{t._('view_details')}}
				</th>
			  </tr>
			</thead>
			<tbody id="hfeatures">
			</tbody>
		  </table>
		</div>
    <div style="margin-top: -18px;" class="table-responsive">
	<table class="table table-bordered">
	<thead id="Insurance_clone"><tr><th class="col-xs-6 col-sm-6 col-md-6 col-lg-6"></th>
				<th class="text-center col-xs-3 col-sm-3 col-md-3 col-lg-3"></th>
				<th class="text-center col-xs-3 col-sm-3 col-md-3 col-lg-3"></th>
			  </tr>
			</thead>
			<tbody  id="insurance-policy-prices-2">
	</tbody>
	</table>
	
    </div>
	<div class="sub-limits-apply">
  <p>*Sub-limits apply - refer to the product disclosure statement for details </p>
   <p>^There is no cover under these Policy Sections while travelling in Australia</p>
  </div>
  </div>
</div>

<div class="col-md-3 col-lg-4 hidden-xs col-sm-12">
  <div id="divRight1" class="advert-inside-page">
    <!--class="advtext"-->
    <!-- 300 X 300 ad placeholder -->
    <div class="advert-inside-page-top">
      <script src="http://www.revresda.com/js.ng/CookieName=PRO2&site=HCL&channel=insurance&Section=main&adsize=300x250&pos=top&platform=austin&secure=false&language=en_AU&subdomain=HCL" language="javascript">
      </script>
    </div>
    
    <div class="advert-inside-page-mid">
      <script src="http://www.revresda.com/js.ng/CookieName=PRO2&site=HCL&channel=insurance&Section=main&adsize=300x250&pos=bottom&platform=austin&secure=false&language=en_AU&subdomain=HCL"  language="javascript">
      </script>
    </div>

  </div>
</div>
</div>

<script>
var data = {destination : '{{ destination }}', trans : {update_quote : '{{t._('update_quote')}}', promocode : '{{t._("promocode")}}', single_journey : '{{t._("single_journey")}}', buy_now : '{{t._("buy_now")}}' } };
</script>



