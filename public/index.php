<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Hotel Club - Great Holidays</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.5">
	<!-- include bootstrap -->
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="css/hc_great_holidays.min.css" rel="stylesheet" media="screen">
</head>
<body>
	<div class="container">
		<!-- header -->
		<div id="header" class="subContainer">
			<div class="row">
				
				<!-- header logo -->
				<div class="col-md-5 logo">
					<a href="index.html" title="Hotelclub Logo">
						<img src="http://www.tnetnoc.com/static/28.64.9/image/pos/hcl/en-au/logo-header.png" alt="Hotelclub Logo" />
					</a>
				</div>
				
				<!-- header links -->
				<div class="col-md-offset-5">
					<ul class="primary">
						<li><a rel="nofollow" class="link" href="https://www.hotelclub.com/trips/current">My Bookings</a></li>
						<li><a rel="nofollow" class="link" href="https://www.hotelclub.com/account/myclub">My Club</a></li>
						<li><a rel="nofollow" class="link" href="https://www.hotelclub.com/account/myprofile">My Account</a></li>
						<li><a rel="nofollow" class="link" href="https://www.hotelclub.com/trips/writeReview">Write a review</a> </li>
						<li class="last"><a rel="nofollow" class="link" href="http://faq.hotelclub.com">Customer Service</a></li>
					</ul>				
							
					<ul class="login">
						<li class="welcomeText">Welcome sanand </li>
						<li class="loyaltyTier">Silver Member:</li>
						<li class="loyaltyInfo">0.00 Member Rewards** (Rs.0.00)</li>
						<li class="signOutLink"><a rel="nofollow" class="link" href="https://www.hotelclub.com/account/logout">Sign out</a></li>
					</ul>
				</div>
			
			</div>
		</div>
		
		<!-- headMenu -->
		<div id="headMenu" class="subContainer">
			<div class="row">
				<!-- main menu -->
				<div class="col-md-6">
					<ul class="left_menu">
						<li>Home</li>
						<li>Life Style Club</li>
					</ul>
				</div>
				
				<!-- lang -->
				<div class="col-md-offset-6">
					<ul class="nav navbar-nav navbar-right right_menu">
						<li class="dropdown">
							<a href="index.php" class="dropdown-toggle" data-toggle="dropdown"  data-target="#">English <b class="caret"></b></a>
							<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
								<li><a href="#fr" data-toggle="tab">French</a></li>
								<li><a href="#ch" data-toggle="tab">Chinese</a></li>
								<li><a href="#ge" data-toggle="tab">German</a></li>
								<li><a href="#sp" data-toggle="tab">Spanish</a></li>
							</ul>
						</li>
					</ul>
				<!-- Remove This Later Just Displays the Tab works-->
					<div class="tab-content">
						<div class=" tab-pane active" id="en">
						English 
						</div>
						<div class=" tab-pane " id="fr">
						French 
						</div>
						<div class=" tab-pane " id="ch">
						Chinese 
						</div>
						<div class=" tab-pane " id="ge">
						German 
						</div>
						<div class=" tab-pane " id="sp">
						Spanish 
						</div>
					</div>
				<!-- Remove This Later Just Displays the Tab works-->
				</div>
			</div>
		</div>
		<!-- banner -->
		<div id="banner" >	
		
				<div class="row">
					<div id="searchBot" class="col-md">
						<!-- search -->
						<form class="form-inline datepicker" method="get" name="searchBot role="form">
							<div class=" where">
								<h2>Find a hotel deal</h2>
								<p>Where</p>
								<input type="text"  class="form-control input-md" placeholder="Location.." id="locationText">
							</div>	
							<div class="form-group col-md">
								<p>Check-in</p>
								<input type="text" class="check-input form-control input-sm "  placeholder="Check in">
							</div>
							<div class="form-group col-md">
								<p>Check-out</p>
								<input type="text" class="check-input form-control input-sm "  placeholder="Check out">
							</div>								
							<div class="controls">
							<div class="errorMessage">&nbsp;</div>	
								<input type="button" class="btn btn-default col-md-offset-8" onclick="doSearch(this.form)" value="Search" name="search">
							</div>
							<div class=" promo-code">                        
								<p>I have a promotion code</p>
								<input type="text"  name="couponCode" id="couponCode" class="form-control input-md" placeholder="Location.." id="locationText">
							</div>                        
						</form>					
					</div>
				</div>
				<div id="regionTabs">
					<!-- Tabs -->
					<div class="tabbable deal-tabs" id="deal-tabs">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#tab1" data-toggle="tab"  >South East Asia</a></li>
							<li><a href="#tab2" data-toggle="tab"  >North Asia</a></li>
							<li><a href="#tab3" data-toggle="tab"  >Australia</a></li>
							<li><a href="#tab4" data-toggle="tab"  >Europe &amp; US</a></li>
						</ul>   
					</div>				
				</div>		
				<img src="img/HC_201301014_Major_Holiday_958_EN.jpg" id="" class="img-responsive" width="958" height="390" alt="Responsive image"/>	
		</div>
		
		<!-- hotelList -->
		<div class="clearfix"></div>
		<div class="red-line"></div>
		<div id="hotelList" class="subContainer">
			<div class="row">
			<div class="tab-content">
				<div class=" tab-pane active" id="tab1">
					<!--Forloop Starts--> 
		<?php for($i=0;$i<=6;$i++){ ?>
			<div class="hotelDeal col-md-6" style="cursor: default;">
			<?php //if ($i % 2) { echo "0"; } else { echo "2"; }  ?>
				<div class="image_section" id="image_section">
					<a>
						<div >
						<img src="http://www.hotelclub.com/ad-unit/promodeals/images/mp_v1_1149971.jpg" class="img-responsive" id="image_hotel" alt="Responsive image" width="180" height="120" />
						<div class="hotel-image-text">
								<div class="hotel-location">Bangkok</div>
								<div class="star4">
								<img src="http://www.hotelclub.com/ad-unit/images/ce-hotelstar-brand.png" class="img-responsive ce-star" id="image_hotel" alt="Responsive image" width="148" height="12" />
								</div>
							</div>
						</div>        
					</a>					
				</div>
				<div class="middle-offer-section">
					<div class="hotelInfo">
						<h3>
						<!-- HOTEL NAME -->
							<a>
							<div class="purple-color" title="Mode Sathorn Hotel">Mode Sathorn Hotel</div>                
							</a>        
						</h3>
						<div class="campaign-promo-offer">Save 50%</div>
						<input type="hidden" value="Save 50%" id="hotel_inc1_1149971">
						<div class="members-extras-block">                
							<!-- The Big Red Plus Sign -->
							<img class="members-extras-logo img-responsive" alt="Member Rewards" src="//www.hotelclub.com/Ad-unit/images/member-rewards_20x20.png" >  
							<div class="font_red member-extras-text">Member Extras</div>
						</div>
						<div class="sign-in-member-offer offer-for-existing-members font_red">Save 55%</div>
						<div class="sign-out-member-offer" style="display: none;">  
							<span>
								<!-- Show_JoinHotelClub_Popup()-->
								<p>Freebies Included</p>
								<p>Find out more &gt;&gt;</p>
							</span>
						</div>
					</div>
				</div>

				<div class="saveBookInfo">
						Save<br> <span class="percentage">50%</span>
						<div class="clear"></div>
						<div class="btn button">
						<a>Book</a>
						</div><br>
						<p class="inclusions">Travel: Now - 31/12/2013</p>
				</div>
						<div class="clear"></div>
			</div>
		<?php } ?>
		<!--Forloop Ends--> 
				</div>				
				
				<div class=" tab-pane" id="tab2">
				<!--Forloop Starts--> 
				<?php for($i=0;$i<=6;$i++){ ?>
					<div class="hotelDeal col-md-6" style="cursor: default;">
					<?php //if ($i % 2) { echo "0"; } else { echo "2"; }  ?>
						<div class="image_section" id="image_section">
							<a>
							<div>
								<img src="http://www.hotelclub.com/ad-unit/promodeals/images/mp_v1_307928.jpg" class="img-responsive" id="image_hotel" alt="Responsive image" width="180" height="120"/>
								<!--<img src="http://www.hotelclub.com/ad-unit/promodeals/images/mp_v1_1149971.jpg" class="hotelimg" />-->
									<div class="hotel-image-text">
										<div class="hotel-location">Austalia</div>
										<div class="star4">
								<img src="http://www.hotelclub.com/ad-unit/images/ce-hotelstar-brand.png" class="img-responsive ce-star" id="image_hotel" alt="Responsive image" width="148" height="12" />
								</div>
									</div>
								</div>        
							</a>
						</div>
						<div class="middle-offer-section">
							<div class="hotelInfo">
								<h3>
								<!-- HOTEL NAME -->
									<a>
									<div class="purple-color" title="Mode Sathorn Hotel">Landmark Hotel </div>                
									</a>        
								</h3>
								<div class="campaign-promo-offer">Save 50%</div>
								<input type="hidden" value="Save 50%" id="hotel_inc1_1149971">
								<div class="members-extras-block">                
									<!-- The Big Red Plus Sign -->
									<img class="members-extras-logo img-responsive" alt="Member Rewards" src="//www.hotelclub.com/Ad-unit/images/member-rewards_20x20.png">  
									<div class="font_red member-extras-text">Member Extras</div>
								</div>
								<div class="sign-in-member-offer offer-for-existing-members font_red">Save 55%</div>
								<div class="sign-out-member-offer" style="display: none;">  
									<span>
										<!-- Show_JoinHotelClub_Popup()-->
										<p>Freebies Included</p>
										<p>Find out more &gt;&gt;</p>
									</span>
								</div>
							</div>
						</div>

						<div class="saveBookInfo">
								Save<br> <span class="percentage">50%</span>
								<div class="clear"></div>
								<div class="btn button">
								<a>Book</a>
								</div><br>
								<p class="inclusions">Travel: Now - 31/12/2013</p>								
						</div>
								<div class="clear"></div>
					</div>
				<?php } ?>
				<!--Forloop Ends--> 
				</div>

				<div class=" tab-pane" id="tab3">
					<!--Forloop Starts--> 
		<?php for($i=0;$i<=6;$i++){ ?>
			<div class="hotelDeal col-md-6" style="cursor: default;">
			<?php //if ($i % 2) { echo "0"; } else { echo "2"; }  ?>
				<div class="image_section" id="image_section">
					<a>
						<div>
						<img src="http://www.hotelclub.com/ad-unit/promodeals/images/mp_v1_316563.jpg" class="img-responsive"  alt="Responsive image" id="image_hotel" width="180" height="120"/>					
							<div class="hotel-image-text">
								<div class="hotel-location">UK</div>
								<div class="star4">
								<img src="http://www.hotelclub.com/ad-unit/images/ce-hotelstar-brand.png" class="img-responsive ce-star" id="image_hotel" alt="Responsive image" width="148" height="12" />
								</div>
							</div>
						</div>        
					</a>
				</div>
				<div class="middle-offer-section">
					<div class="hotelInfo">
						<h3>
						<!-- HOTEL NAME -->
							<a>
							<div class="purple-color" title="Mode Sathorn Hotel">Jupiters Hotel and ...</div>                
							</a>        
						</h3>
						<div class="campaign-promo-offer">Save 50%</div>
						<input type="hidden" value="Save 50%" id="hotel_inc1_1149971">
						<div class="members-extras-block">                
							<!-- The Big Red Plus Sign -->
							<img class="members-extras-logo img-responsive" alt="Member Rewards" src="//www.hotelclub.com/Ad-unit/images/member-rewards_20x20.png">  
							<div class="font_red member-extras-text">Member Extras</div>
						</div>
						<div class="sign-in-member-offer offer-for-existing-members font_red">Save 55%</div>
						<div class="sign-out-member-offer" style="display: none;">  
							<span>
								<!-- Show_JoinHotelClub_Popup()-->
								<p>Freebies Included</p>
								<p>Find out more &gt;&gt;</p>
							</span>
						</div>
					</div>
				</div>

				<div class="saveBookInfo">
						Save<br> <span class="percentage">50%</span>
						<div class="clear"></div>
						<div class="btn button">
						<a >Book</a>
						</div><br>
						<p class="inclusions">Travel: Now - 31/12/2013</p>						
				</div>
						<div class="clear"></div>
			</div>
		<?php } ?>
		<!--Forloop Ends--> 
				</div>
				<div class="tab-pane" id="tab4">
					<!--Forloop Starts--> 
		<?php for($i=0;$i<=6;$i++){ ?>
			<div class="hotelDeal col-md-6" style="cursor: default;">
			<?php //if ($i % 2) { echo "0"; } else { echo "2"; }  ?>
				<div class="image_section" id="image_section">
					<a>
						<div>
						<img src="http://www.hotelclub.com/ad-unit/promodeals/images/mp_v1_23106.jpg" class="img-responsive" id="image_hotel" alt="Responsive image" width="180" height="120"/>	
						<!--<img src="http://www.hotelclub.com/ad-unit/promodeals/images/mp_v1_1149971.jpg" class="hotelimg" />-->
							<div class="hotel-image-text">
								<div class="hotel-location">Bangkok</div>
								<div class="star4">
								<img src="http://www.hotelclub.com/ad-unit/images/ce-hotelstar-brand.png" class="img-responsive ce-star" id="image_hotel" alt="Responsive image" width="148" height="12" />
								</div>
							</div>
						</div>        
					</a>
				</div>
				<div class="middle-offer-section">
					<div class="hotelInfo">
						<h3>
						<!-- HOTEL NAME -->
							<a href="javascript:void(0);">
							<div class="purple-color" title="Mode Sathorn Hotel">Villa Alessandra</div>                
							</a>        
						</h3>
						<div class="campaign-promo-offer">Save 50%</div>
						<input type="hidden" value="Save 50%" id="hotel_inc1_1149971">
						<div class="members-extras-block">                
							<!-- The Big Red Plus Sign -->
							<img class="members-extras-logo img-responsive" alt="Member Rewards" src="//www.hotelclub.com/Ad-unit/images/member-rewards_20x20.png">  
							<div class="font_red member-extras-text">Member Extras</div>
						</div>
						<div class="sign-in-member-offer offer-for-existing-members font_red">Save 55%</div>
						<div class="sign-out-member-offer" style="display: none;">  
							<span>
								<!-- Show_JoinHotelClub_Popup()-->
								<p>Freebies Included</p>
								<p>Find out more &gt;&gt;</p>
							</span>
						</div>
					</div>
				</div>

				<div class="saveBookInfo">
						Save<br> <span class="percentage">50%</span>
						<div class="clear"></div>
						<div class="btn button">
						<a>Book</a>
						</div><br>
						<p class="inclusions">Travel: Now - 31/12/2013</p>
				</div>
						<div class="clear"></div>
			</div>
		<?php } ?>
		<!--Forloop Ends--> 
				</div>
				</div>
			</div>
		</div>
					
		<!-- footMenu -->
		<div id="footMenu" class="subContainer">
			<div class="row">
				<div class="col-md-12">
				<ul class="footerLinks">
					<li class="first"><a href="http://www.hotelclub.com/trips/current">My Bookings</a> </li>
					<li><a href="https://www.hotelclub.com/account/myclub">My Club</a> </li>
					<li><a href="http://www.hotelclub.com/account/myprofile">My Account</a></li>
					<li><a href="http://www.hotelclub.com/info/page?id=AboutUs">About Us</a> </li>
					<li><a href="http://careers.orbitz.com/">Careers</a> </li>
					<li><a href="http://www.hotelclub.com/info/page?id=PrivacyPolicy">Privacy Policy</a> </li>
					<li><a href="https://faq.hotelclub.com/">Contact Us</a> </li>
					<li><a href="http://www.hotelclub.com/info/page?id=TermsAndConditions">Terms of Use</a> </li>
					<li><a target="_blank" href="http://www.hotelclub.com/info/win?id=lowPriceGuaranteeTerms&amp;locale=en_AU">Best Price Guarantee</a> </li>
					<li><a href="#">Mobile</a> </li>
					<li><a href="http://www.hotelclub.com/travel-shop/">HotelClub TravelShop</a></li>
					<li><a href="http://cartrawler.com/hotelclub/">Car Hire</a></li>
					<li><a href="http://partner.isango.com/hotelclub">Tours &amp; Attractions</a></li>
					<li><a href="http://www.hotelclub.com/TravelAgent.asp">Travel Agents</a> </li>
					<li><a href="#">Contact Us</a> </li>
					<li class="last"><a href="http://corp.orbitz.com/advertise/hotelclub"> Advertise with Us</a> </li>
				</ul>
				</div>
			</div>
		</div>
		
		<!-- footer -->
		<div id="footer" class="subContainer">
			<div id="foot_img"><a href="http://www.bbbonline.org/cks.asp?id=108022784642"><img width="26" height="40" alt="Better Business Bureau" src="https://www.tnetnoc.com/siteImages/HCRG.en_AU/logos/bbb-1.png"></a></div>
			<p></p><p>HotelClub is a registered trademark of HotelClub Pty Ltd.<br>HotelClub  is owned and operated by HotelClub Pty Ltd., an affiliate of HotelClub Limited, part of Orbitz Worldwide Inc<br></p><br><p>**1 Member Reward = 1 USD, converted to your currency today. See full <a title="Membership Terms and Conditions" href="http://www.hotelclub.com/info/win?id=MembershipTerms&amp;locale=en_AU" onclick="javascript: return popups(this);">Membership Terms and Conditions</a> for details.</p><p></p>
		</div>
	</div>
	
	<!-- include external js -->
	<script src="http://code.jquery.com/jquery.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
