$(document).ready(function(){
	var closeText = "Close";
	var currentText = "Today";
	var checkRates = "Check Rates";	
	$('#checkin').datepicker({
		inline: true,
		dateFormat: 'dd/mm/yy',
		maxDate: '+364D',
		minDate: 0,
		numberOfMonths: 2,
		showCurrentAtPos: 0,
		closeText: closeText,
		currentText: currentText,
		showButtonPanel: true,
		firstDay: 0,
		dayNamesMin: [ "S", "M", "T", "W", "T", "F", "S" ],
		onSelect: function(dateText, inst){ $('#checkout').datepicker("option", "minDate", $('#checkin').val()); }
	});
	$('#checkout').datepicker({
		inline: true,
		dateFormat: 'dd/mm/yy',
		maxDate: '+364D',
		minDate: 0,
		numberOfMonths: 2,
		showCurrentAtPos: 0,
		closeText: closeText,
		currentText: currentText,
		showButtonPanel: true,
		onSelect: function(dateText, inst){ $('#checkin').datepicker("option", "maxDate", $('#checkout').val()); }
	});

});