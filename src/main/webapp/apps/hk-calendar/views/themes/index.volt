{% set theme = 'themes/hk-calendar/' %}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <title>Experience Hong Kong | The Unmissable Events | HotelClub</title>
    <meta name="description" content="From a Bruce Lee exhibition to the birthday of Confucius, discover Hong Kong's unmissable events with this interactive calendar.">
    <link rel="canonical" href="http://www.hotelclub.com/hong-kong-interactive">
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="article">
    <meta property="og:title" content="Experience Hong Kong | The Unmissable Events">
    <meta property="og:description" content="From a Bruce Lee exhibition to the birthday of Confucius, discover Hong Kong's unmissable events with this interactive calendar.">
    <meta property="og:url" content="http://www.hotelclub.com/n/hong-kong-interactive">
    <meta property="og:site_name" content="Hotelclub.com">
    <meta property="og:image" content="http://www.hotelclub.com/n/hong-kong-interactive/img/month/aug1new.jpg">
    <meta property="article:published_time" content="2015-01-31">
    <meta property="article:author" content="https://www.facebook.com/HotelClub">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@hotelclub">
    <meta name="twitter:domain" content="Hotelclub.com">
    <link rel="publisher" href="https://plus.google.com/+hotelclub">
    {{ get_title() }}
    {{ stylesheet_link("http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css",false) }}
    {{ stylesheet_link(theme ~ 'css/main.css?' ~ appVersion ) }}
    {{ stylesheet_link(theme ~ 'css/slick.css?' ~ appVersion ) }}
    <link rel="shortcut icon" href="/favicon.ico" />
    {{ javascript_include("http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js", false) }}
    {{ javascript_include(theme ~ 'js/libs/modernizr.min.js?' ~ appVersion ) }}
    {{ javascript_include("https://maps.googleapis.com/maps/api/js?v=3.exp",false) }}
</head>
<body>
<div id="wrapper">
    <header id="header">
        <img id="logo" src="{{ theme }}img/new_logo.png" width="60" height="70" alt="Hotel Club logo">
        <div class="menu-button">
            <img src="{{ theme }}img/manuburger2.png" width="23" height="15" alt="Menu button">
        </div>
    </header>
    <section class="main one">
        <div class="title">
            <h1><span>Experience</span><br>Hong Kong</h1>
            <h3>The Unmissable Events</h3>
            <div class="socialbar-title"></div>
        </div>

        <div class="arrow">
            <img src="{{ theme }}img/arrow2.png" height="44" width="44" alt="Go down">
        </div>
    </section>
    <section class="back month one">
        <nav id="menu">
            <ul>
                <li class="active"><a href="#month/january/2015">Jan / 15</a></li>
                <li><a href="#month/february/2015">Feb / 15</a></li>
                <li><a href="#month/march/2015">Mar / 15</a></li>
                <li><a href="#month/april/2015">Apr / 15</a></li>
                <li><a href="#month/may/2015">May / 15</a></li>
                <li><a href="#month/june/2015">Jun / 15</a></li>
                <li><a href="#month/july/2015">Jul / 15</a></li>
                <li><a href="#month/august/2015">Aug / 15</a></li>
                <li><a href="#month/september/2015">Sep / 15</a></li>
                <li><a href="#month/october/2015">Oct / 15</a></li>
                <li><a href="#month/november/2015">Nov / 15</a></li>
                <li><a href="#month/december/2015">Dec / 15</a></li>
            </ul>
        </nav>
        <div class="month-container">
            <article class="month-info">

            </article>
        </div>
        <div class="arrow arrow-white">
            <img src="{{ theme }}img/arrow-white2.png" height="16" width="27" alt="Go down">
        </div>
        <div class="events">
            <div class="container group">

            </div>

        </div>
        <div id="outbox"></div>
        <div id="lightbox">
				<span class="close">
					<img src="{{ theme }}img/close.png" height="20" width="19" alt="">
				</span>
            <article class="detail">

            </article>
        </div>
    </section>

</div>



<script id="tplMonth" type="text/template">
    <div>
        <h2><%= name %>
            <% if (typeof(prev) != "undefined") { %>
            <a href="#month/<%= prev %>" class="month-arrow left"></a>
            <% } %>
            <% if (typeof(next) != "undefined") { %>
            <a href="#month/<%= next %>" class="month-arrow right"></a>
            <% } %>
        </h2>
    </div>
    <div class="weather group">
        <div class="icon">
            <img src="{{ theme }}img/<%= weather.icon %>.png" height="35" width="36" alt="<%= weather.icon %>">
        </div>
        <div class="info">
            <div class="degree"><%= weather.temp %>&deg;<sup>C</sup></div>
            <div class="more"><p>Average temperature</p></div>
        </div>
    </div>
    <div class="tip">
        <h5>Helpful tip:</h5>
        <p><%= tip %></p>
    </div>
</script>

<script id="tplEvent" type="text/template">
    <div class="item" data-event="<%= id%>">
        <a href="#<%= history %>/event/<%= id%>">
            <img src="{{ theme }}<%= photos[0].min %>" alt="">
        </a>
        <h6><%= name +'<br/><span>'+date+'</span>'%></h6>
    </div>
</script>


<script id="tplEventDetails" type="text/template">
    <div class="event-text">
        <div class="date"><%= date %></div>
        <h3><%= name %></h3>
        <p class="price"><%= price %></p>
        <span class="line"></span>
        <p class="text"><%= text %></p>
        <br>
        <p class="link"><a target="_blank" href="<%= link %>"><%= link %></a></p>
    </div>
    <div id="gmap" class="event-map">

    </div>
    <div id="event-gallery" class="group">
        <% if (typeof(photos) != "undefined") { %>
        <% _.map(photos, function(num){ %>
        <div class="event-gallery-item" data-big="<%= num.full %>">
            <img src="{{ theme }}<%= num.min %>">
        </div>
        <%})%>
        <% }%>
    </div>
</script>


{{ javascript_include(theme ~ 'js/libs/modernizr.min.js?' ~ appVersion ) }}
{{ javascript_include(theme ~ 'js/libs/jquery.js?' ~ appVersion ) }}
{{ javascript_include(theme ~ 'js/libs/slick.min.js?' ~ appVersion ) }}
{{ javascript_include(theme ~ 'js/libs/underscore.js?' ~ appVersion ) }}
{{ javascript_include(theme ~ 'js/libs/backbone.js?' ~ appVersion ) }}
{{ javascript_include(theme ~ 'js/libs/sh_j.js?' ~ appVersion ) }}
{{ javascript_include(theme ~ 'js/data/eventData.js?' ~ appVersion ) }}
{{ javascript_include(theme ~ 'js/models/models.js?' ~ appVersion ) }}
{{ javascript_include(theme ~ 'js/views/month.js?' ~ appVersion ) }}
{{ javascript_include(theme ~ 'js/views/header.js?' ~ appVersion ) }}
{{ javascript_include(theme ~ 'js/views/event.js?' ~ appVersion ) }}
{{ javascript_include(theme ~ 'js/views/eventItem.js?' ~ appVersion ) }}
{{ javascript_include(theme ~ 'js/collections/monthcollection.js?' ~ appVersion ) }}
{{ javascript_include(theme ~ 'js/routes/route.js?' ~ appVersion ) }}
{{ javascript_include(theme ~ 'js/app.js?' ~ appVersion ) }}
</body>
</html>