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
  /* End of Validating search form */