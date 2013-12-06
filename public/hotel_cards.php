<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Hotel Club - Great Holidays - Header</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- include bootstrap -->
	<link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="css/main.css" rel="stylesheet" media="screen">
</head>
<body>
	<div class="container">
		
		<?php for($i=0; $i<5; $i++){ ?>
		<!-- START VIEW PARTIAL: hotel_card.html -->
		<div class="hotel_card">
			<!-- hcard - header -->
			<div class="hcard_head">
				<div class="hcard_title">Langham Hotel Langham Hotel Langham Hotel</div>
				<div class="clear">&nbsp;</div>
			</div>
			
			<!-- hcard - offer -->
			<div class="hcard_offer">Sparen Sie<br><span class="offer_per">40<sup>%</sup></span></div>
			<div class="clear">&nbsp;</div>
			
			<!-- hcard - body -->
			<div class="hcard_body">
				<div class="hcard_image">
					<img src="img/hcard_image.jpg" alt="Hotel Image" /><br/>
					<div class="hcard_city">Kuala Lampur</div>
				</div>
				<div class="hcard_text">
					<p><img src="img/star_image.png" alt="Star" /></p>
					<div class="hcard_content">
						<ul>
							<li>Book in advance & Save 30%</li>
							<li>Free Breakfast</li>
							<li>Free WiFi</li>
						</ul>
					</div>
					<div class="mem_extras">
						<p>Member Extras</p>
						<ul class="mem_extras_text1">
							<li>Stay 3 & Pay only 2</li>
							<li>15% Food & Spa discount</li>
							<li>Free Late Check-out</li>
						</ul>
						<div class="mem_extras_text2">
							<a href="#">Freebies included<br/>Find out more &raquo;</a>
						</div>
					</div>
					<div class="hcard_date">Travel: Now - 31/03/2014</div>
					<div class="hcard_book"><button class="hc_button">Book</button></div>
				</div>
				<div class="clear">&nbsp;</div>
			</div>
		</div>
		<?php } ?>
		<!-- END VIEW PARTIAL: hotel_card.phtml -->
		<div class="clear">&nbsp;</div>
	</div>
	
	<!-- include external js -->
	<script src="http://code.jquery.com/jquery.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<!-- /include external js -->
</body>
</html>