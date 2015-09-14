/* Travel Insurance 
Author: Ravi
Filename: Main.js
Created @ 05-20-2014
Updated @ 07-04-2014
*/
/* Date-picker in search form */
var calDateFormat = 'dd/mm/yy';
var maxdate = new Date();
var closeText = "Close";
var currentText = "Today";
var checkRates = "Check Rates";
var minDate = "-86y+1d";
var maxDate = "0y";
var ageRange = "-85:+0";
$(document).ready(function () {
    /* tooltip in search form */    
    $("#help-icon").mouseover(function(event) {
        $("#help-message").fadeIn( "slow" );
    }).mouseout(function(){
        $("#help-message").fadeOut( "slow" );
    });

    /* Date-picker in search form */
    $( "#ddlAdult" ).change(function() {
        $('#divDobL2, #divDobL3, #divDobL4, #divDobL5').hide();
        for(var i=1; i<=$('#ddlAdult').val(); i++) {
            $('#divDobL'+i).show();
        }
    });
    
/* Responsive calendar in datepicker form */
function findBootstrapEnvironment() {
var envs = ['xs', 'sm', 'md', 'lg'];

$el = $('<div>');
$el.appendTo($('body'));

for (var i = envs.length - 1; i >= 0; i--) {
  var env = envs[i];
  $el.addClass('hidden-'+env);
  if ($el.is(':hidden')) {
  $el.remove();
  return env
  }
  };
  }
  var month =2;
  if (findBootstrapEnvironment() == 'xs'){
  var month =1;
  }
  else {
  var month =2;
  }
  $('#dStartDate').datepicker({
  inline: true,
  dateFormat: 'dd/mm/yy',
  maxDate: '+364D',
  minDate: 0,
  numberOfMonths: month,
  showCurrentAtPos: 0,
  closeText: closeText,
  currentText: currentText,
  showButtonPanel: true,
  firstDay: 0,
  dayNamesMin: [ "S", "M", "T", "W", "T", "F", "S" ],
  onSelect: function(dateText, inst){ 
  $('#dEndDate').datepicker("option", "minDate", $('#dStartDate').val()); 		    		   
  
  var m_startDate = new Date();
  var m_endDate  = new Date();
  m_startDate = $('#dStartDate').datepicker( "getDate" );
  m_endDate =  $('#dEndDate').datepicker( "getDate" );
  
  if ((m_startDate !== null) && (m_endDate === null)) {
  // alert(m_endDate);
  m_startDate.setDate(m_startDate.getDate() + 5);                    
  $('#dEndDate').datepicker( "setDate", m_startDate );
  }
  
  }
  });
  
  $('#dEndDate').datepicker({
  inline: true,
  dateFormat: 'dd/mm/yy',
  maxDate: '+364D',
  minDate: 0,
  numberOfMonths: month,
  showCurrentAtPos: 0,
  closeText: closeText,
  currentText: currentText,		
  showButtonPanel: true,
  dayNamesMin: [ "S", "M", "T", "W", "T", "F", "S" ],
  onSelect: function(dateText, inst){ $('#dStartDate').datepicker("option", "maxDate", $('#dEndDate').val()); }
  });
  
  $( document ).on("focus","input[id*='Adob']", function () {			
  $(this).datepicker({
  dateFormat: 'dd/mm/yy',        
  changeMonth: true,
  changeYear: true,
  numberOfMonths: 1,
  yearRange: ageRange,
  minDate: minDate,
  maxDate: "-18Y",
  closeText: closeText,
  currentText: currentText,
  showButtonPanel: true,
  dayNamesMin: [ "S", "M", "T", "W", "T", "F", "S" ],
  onSelect: function (selected) {
  $(this).datepicker("option", "mindate", selected)           
  }
  });
  });
  });
  /* End of Date-picker in search form */
  /* Validating search form */
  hiddenElements = $(':hidden');
  visibleElements = $(':visible');
  function validate_textbox(){
  var isValid = true;
  $('input[name*="AdobOne"]').each(function() {
  var attr_id=$(this).attr("id");
  var parent_id='#'+$(this).closest("div").attr("id");
  
  if($(parent_id).css('display') == 'block'){
  if ($.trim($(this).val()) == '') {
  isValid = false;
  $(this).css({
  "border": "1px solid red",
  "background": "#d0262f"
  });				
  }else { 
  isValid = true;
  $(this).css({
  "border": "",
  "background": ""
  });
  }
  }});
  return isValid;
  }
  function validate_searchform(){
  var flag = false;
  var errFlag = false;
  if(validate_textbox() == false){
  $( ".error_dob" ).html("<p class='error_date_msg'>Select date of birth</p>");
  $( ".checkBoxDestinations" ).css("outline","0px solid none");				
  flag = true;
  } else {
  $( ".error_dob" ).empty();
  }
  if (!$("input[name*='DES']").is(":checked")){		
  $( ".destination_search" ).html("<p class='error_msg'>Select destination(s)</p>");
  $( ".checkBoxDestinations" ).addClass("errorFocusChk");
  flag = true;
  }else {
  $( ".destination_search" ).empty();
  $(".checkBoxDestinations").removeClass('errorFocusChk');
  }
  if ($.trim($('input[name="dStartDate"]').val()) == ''){
  $( ".checkBoxDestinations" ).css("outline","0px solid none");		
  $( ".startdate" ).html("<p class='error_msg'>Select date</p>");		
  $("input[name='dStartDate']").addClass('errorFocus');
  flag = true;
  errFlag = true;
  } else {
  $( ".startdate" ).empty();
  $("input[name='dStartDate']").removeClass('errorFocus');
  }
  if ($.trim($('input[name="dEndDate"]').val()) == ''){
  $( ".checkBoxDestinations" ).css("outline","0px solid none");		
  $( ".startdate" ).html("<p class='error_msg'>Select date</p>");		
  $("input[name='dEndDate']").addClass('errorFocus');
  flag = true;
  } else {
  if (errFlag == false)
  $( ".startdate" ).empty();
  $("input[name='dEndDate']").removeClass('errorFocus');
  }	
  if (flag == false)
  return true;
  return false;
  }


var SearchBox = {
        'init': function() {
            return data.destination;
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
            return $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: '/n/travel-insurance',
                    async: false,
                    data: $('form[name="find-hotel"]').serialize()
                }
            );
        }
        ,
        'getResultSummary': function() {
            var html = '';
            var txtChild = $('#ddlChild').val() > 1 ? ' dependents' : ' dependent';
            txtChild = $('#ddlChild').val() < 1 ? '' : ' and ' + $('#ddlChild').val() + txtChild;
            var txtAdult = $('#ddlAdult').val() > 1 ? ' adults' : ' adult';
            html += '<h4>Results for ' + $('#ddlAdult').val() + txtAdult + txtChild + ' for travel on ' + $('#dStartDate').val() + ' to ' + $('#dEndDate').val() + ' from '+ $( "#ddlcountry option:selected" ).text() +' to:</h4>';
            $('.checkBoxDestinations:checked').each(function() {
                    html += '<div class="row regions leftpadding row-padding">-&nbsp;&nbsp;&nbsp;<p class="region_left">' + $(this).closest('div').next().text() + '</p></div>';
                }
            );
            var cp = $('#couponCode').val().trim();
            if (cp != '')
                html += '<div class="row col-xs-8 row-fluid row-padding"><strong>' + data.trans.buy_now + ':</strong>&nbsp;&nbsp;'+cp+'</div>';
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
            html += '<div id="iframe-container">';
            html += '<iframe name="purchase_iframe" id="purchase_iframe"  width="100%" height="100%" frameborder="0"></iframe>';
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
            $('#getPrice').text(data.trans.update_quote);
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
                    row += ' <tr><td style=" padding-top: 5%;text-align: left;">' + data.trans.single_journey + '</td><td><div class="rowNP"><span class="priceLabel">from</span><span class="buyprice">$' + planA + '</span></div><div class="rowNP"><button type="submit" data-plan="A" title="Get Quotes" class="buy-plan btn btn-default">' + data.trans.buy_now + '</button></div></td><td><div class="rowNP"><span class="priceLabel">from</span><span class="buyprice">$' + planB + '</span></div><div class="rowNP"><button type="submit" data-plan="B" title="Get Quotes" class="buy-plan btn btn-default">' + data.trans.buy_now + '</button></div></td></tr>';
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
            });
        }
    });
}
());
  /* End of Validating search form */