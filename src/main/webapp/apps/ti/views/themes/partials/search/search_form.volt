<div class="row">
  <div class="col-xs-12 col-md-8 col-lg-7 al">
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
			<div class="row row-padding">
			  <div class="col-xs-6 col-sm-3 col-md-3 Search_head1">
				<strong>
				  {{t._('select_travellers')}}
				</strong>
			  </div>
			</div>
			<div class="row row-padding">
			  <div class="col-xs-6 col-sm-3 col-md-3 search_content1">
				{{t._('country_of_residence')}}
			  </div>
			  <div class="col-xs-2 col-sm-2 col-md-2">
				{{form.render('ddlcountry')}}
			  </div>
			</div>
			<div class="row row-padding">
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
			<div class="row row-padding date_search">
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
			  <div class="col-xs-7 col-sm-4 col-md-5 col-lg-4 search_head2">
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
				  <div style="float:left" class="col-11p">
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
				  <div style="float:left" class="col-11p">
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
				  <div style="float:left" class="col-11p">
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
      <div> <img src="img/loading.gif" /> Working...</div>
	  <div style="font-size:10px">Please wait as we work on your request</div>
    </div>
  </div>
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
  
  var SearchBox = {
    'init': function() {
      return '{{ destination }}';
    }
    ,
    'startLoadin': function() {
      $('#loading').show();
	 $('.container').css('opacity', '0.8')
      // show loading
    }
    ,
    'stopLoading': function() {
      $('#loading').hide();
	$('.container').css('opacity', '')
      // hide loading
    }
    ,
    'getArray': function() {
      return $.parseJSON(this.init());
    }
    ,
    'getDataByKey': function(key) {
      return this.getArray()[key];
    }
    ,
    'displayData': function(key) {
      var opt = '';
      $.each(this.getDataByKey(key), function(index, value) {
        opt += '<div class="col-xs-11 col-sm-11 col-md-11 col-lg-11 row-padding">';
        opt += '<div style="float:left"><input class="checkBoxDestinations" type="checkbox" name="DES[]"  value="' + value['ref'] + '"';
        if (value['isChecked'] == true)
          opt += 'checked="checked"';
        opt += '/></div>';
        opt += '';
        opt += '&nbsp;&nbsp;&nbsp;<div class="dest_left">' + value['Destination'] + '</div></div>';
      }
            );
      $('.dest-res').html(opt);
    }
    ,
    'responseCache': {
    }
    ,
    'getPriceDetails': function() {
      this.startLoadin();
      console.log('testing');
      return $.ajax({
        type: 'POST',
        dataType: 'json',
        url: '/travel-insurance',
        async: false,
        data: $('form[name="find-hotel"]').serialize()
      }
                   );
    }
    ,
    'getResultSummary': function() {
      var html = '';
      html += '<h4>Results for ' + $('#ddlAdult').val() + ' adults for travel on ' + $('#dStartDate').val() + ' to ' + $('#dEndDate').val() + ' from '+ $( "#ddlcountry option:selected" ).text() +' to:</h4>';
      $('.checkBoxDestinations:checked').each(function() {
	html += '<div class="row regions leftpadding row-padding">-&nbsp;&nbsp;&nbsp;<p class="region_left">' + $(this).closest('div').next().text() + '</p></div>';
      }
                                             );
      var cp = $('#couponCode').val().trim();
      if (cp != '')
        html += '<div class="row col-xs-8 row-fluid row-padding"><strong>{{t._("promocode")}}:</strong>&nbsp;&nbsp;'+cp+'</div>';
      return html;
    }
  }
      ;
	   /* Submitting Buynow in search Form  */
  (function() {
    $(document).on('click', '.buy-plan', function() {
	$(".main-search-box").hide();
      SearchBox.startLoadin();
      
      var plan = $(this).data('plan') === 'A' ? SearchBox.responseCache['planDetails'][0] : SearchBox.responseCache['planDetails'][1],
          benefits = SearchBox.responseCache['inputData'];
      var html = '';
      html = '<form id="frmBuyPolicy" name="frmBuyPolicy" target="purchase_iframe" method="POST" action="' + benefits['azPurchasingGW'] + '">';
      html += '<input type="hidden" name="productID" value="' + plan['productVariant']['productCode'] + '">';
      html += '<input type="hidden" name="productLabel" value="' + plan['label'] + '">';
      html += '<input type="hidden" name="productPrice" value="' + plan['premiumProduct'] + '">';
      if (benefits['couponCode'] !== '')
        html += '<input type="hidden" name="promotionCode" value="' + benefits['couponCode'] + '">';
      html += '<input type="hidden" name="destinationCode" value="' + benefits['destinationCode'] + '">';
      html += '<input type="hidden" name="departureDate" value="' + benefits['departureDate'].replace(/[\/]/g, "-") + '">';
      html += '<input type="hidden" name="returnDate" value="' + benefits['returnDate'].replace(/[\/]/g, "-") + '">';
      html += '<input type="hidden" name="numberOfDependent" value="' + benefits['numberOfDependent'] + '">';
      html += '<input type="hidden" name="numberOfChildren" value="' + benefits['numberOfChildren'] + '">';
      html += '<input type="hidden" name="numberOfAdult" value="' + benefits['numberOfAdult'] + '">';
      html += '<input type="hidden" name="numberOfSenior" value="' + benefits['numberOfSenior'] + '">';
      html += '<input type="hidden" name="numberOfSenior1" value="' + benefits['numberOfSenior1'] + '">';
      html += '<input type="hidden" name="numberOfSenior2" value="' + benefits['numberOfSenior2'] + '">';
      html += '<input type="hidden" name="numberOfSenior3" value="' + benefits['numberOfSenior3'] + '">';
      html += '</form>';
      html += '<div class="row-fluid">';
      html += '<iframe name="purchase_iframe" id="purchase_iframe" class="well well-small span10" style="height: 1000px; width:100%;" name="purchase_iframe"></iframe>';
      html += '</div>';
      $('#search-result-box').hide();
      $('#display-frame').html(html);
      $('form[name="frmBuyPolicy"]').submit();
      $('#purchase_iframe').on('load', function() {
        SearchBox.stopLoading();
        $('#display-frame').show();
      }
                              );
    }
                  );
    
    $('#mod-scrch').hide();
    var deValue = $('#ddlcountry').attr("selected", true).val();
    SearchBox.displayData(deValue);
    $(document).on('change', '#ddlcountry', function() {
      SearchBox.displayData($(this).val());
    }
                  );
    $(document).on('click', '#sw-s-bx', function(e) {
      e.preventDefault();
      $('#src-elmt').show();
      $('#ch-yr-sch').hide();
      $('#getPrice').text("{{t._('update_quote')}}");
    }
                  );
    /* Submitting Search Form  */
    $(document).on('click', '#getPrice', function(e) {
      e.preventDefault();
      $('#display-frame').html('').hide();
      if (validate_searchform()!= true){
      return false;
      }
      else {
        $(".error_msg").empty();
	  $( ".checkBoxDestinations" ).css("outline","");
	  $( "#dStartDate" ).css("border","");
	  $( "#dEndDate" ).css("border","");
		SearchBox.getPriceDetails().done(function(result) {
          SearchBox.stopLoading();
          $('.alert-danger').remove();
          if (typeof result['error'] !== 'undefined') {
            if ($.isArray(result['error'])) {
              $.each(result['error'], function(index, val) {
                $('<div class="alert alert-danger">' + val + '</div>').prependTo('.al');
              }
                    );
            }
            else {
              $('<div class="alert alert-danger">' + result['error'] + '</div>').prependTo('.al');
            }
            $("html, body").animate({
              scrollTop:0}
                                    , '500', 'swing');
            $('#search-result-box').hide();
          }
          else {
            SearchBox.responseCache['inputData'] = result['inputData'];
            // local caching
            SearchBox.responseCache['planDetails'] = result['productsAvailable'];
            // local caching
            
            $('#search-result-box').hide();
            // hide search box
            $('#search-result-summary').html(SearchBox.getResultSummary());
			$('#sw-s-bx').show();
            // display summary ie:destination
            $('#search-result-box').show();
            // show search box result
            var planA = result['productsAvailable']['0']['premiumProduct'],
                planB = result['productsAvailable']['1']['premiumProduct'];
            var row = '';
            row += ' <tr><td style=" padding-top: 5%;text-align: left;">{{t._("single_journey")}}</td><td><div class="rowNP"><span class="priceLabel">from</span><span class="buyprice">' + planA + '</span></div><div class="rowNP"><button type="submit" data-plan="A" title="Get Quotes" class="buy-plan btn btn-default">{{t._("buy_now")}}</button></div></td><td><div class="rowNP"><span class="priceLabel">from</span><span class="buyprice">' + planB + '</span></div><div class="rowNP"><button type="submit" data-plan="B" title="Get Quotes" class="buy-plan btn btn-default">{{t._("buy_now")}}</button></div></td></tr>';
            $('#sngl_jury').html(row);
            var ht = '';
            $.each(result['json_benefits'], function(index, val) {
              ht += '<tr><td class="text-left">' + index + '</td>' + '<td class="text-center">' + val['A'][0] + '</td>' + '<td class="text-center">' + val['B'][0] + '</td></tr>';
            }
			  
                  );
				 // ht +='<tr>' + $('#insurance-policy-prices-2').html($('#sngl_jury').clone()) +'</tr>';
            //insurance-policy-prices
            $('#insurance-policy-prices-2').html($('#sngl_jury').children().clone());
            $('#hfeatures').html(ht);
            $('#src-elmt').hide();
            //search form
            $('#mod-scrch,#ch-yr-sch').show();
            //change your search
          }
        }
                                        );
      }
    }
                  );
  }
   ());
</script>



