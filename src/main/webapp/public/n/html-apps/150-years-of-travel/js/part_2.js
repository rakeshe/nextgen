$(".city").on("mouseover touchstart", function(){
	var $t= $(this);
	var text = $t.attr("alt");
	var t = $t.position();
	var tip = $t.data("tip_div")
	if(!tip){
		tip=$("<div>");
		tip.css({
			position: "absolute",
			top: t.top + 50,
			left: t.left + 50,
			"z-index": 1000,
			padding: "10px",
			width: "auto",
			background: "white",
			color: "black",
			"font-size":"16px"
		});
		$t.data("tip_div", tip)
	}
	tip.text(text);
	$(".map_wrap").append(tip);
});

$(".city").on("mouseout touchend", function(){
	if($(this).data("tip_div"))$(this).data("tip_div").remove();
})