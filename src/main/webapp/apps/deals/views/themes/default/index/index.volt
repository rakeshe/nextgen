<script>
    var cData = '{{cityData}}',
            hData = '{{hData}}',
            uInfo = '{{userInfo}}',
            MNME = '{{url}}',
            city = '{{city}}',
            when = '{{when}}',
            sort = '{{sort}}',
            apnd = '{{appendURL}}',
            noHData = '{{noHotels}}';

    var clubPromo = '{{clubPromo}}',
            pmPromo = '{{pmPromo}}',
            sBy = '{{sortBy}}',
            sTy = '{{sortType}}';

    var hPageData = '{{homePageData}}',
            hImages = '{{heroImages}}',
            t = '{{translation}}',
            crD = '{{currenciesData}}',
            lD = '{{localeData}}',
            curr = '{{curr}}',
            locale = '{{locale}}',
            currD = '{{currDoc}}',
            cName = '{{campaignName}}',
            dFormat = '{{dFormat}}',
            dFormatPl = '{{dFormatPl}}',
            docSeo = '{{docSeo}}';
</script>
<!-- Page Layout
 –––––––––––––––––––––––––––––––––––––––––––––––––– -->

<!-- Hero -->
<div class="section hero">
    <div class="container" id="header-container"> </div>

</div> <!-- End Section -->

<div class="section promotion-box">
    <div class="container">
        <div class="row">
            <div class="hero-text">
                <div class="hero-text-box">
                    <div class="five columns">
                        <img src="" class="promo-one-img" style="float:left; margin-left: -5px; padding-left:0px; padding-right:15px;"/>
                        <p class="hero-text-title promo-one-title"></p>
                        <p class="hero-text-body promo-one-body"></p>
                    </div>
                    <div class="one columns" style="text-align:center;">
                        <img src="/n/themes/deals/images/assets/plus-cross.png" class="hero-cross"/>
                    </div>
                    <div class="six columns">
                        <img src="" class="promo-two-img" style="float:left; margin-left: -5px; padding-left:0px; padding-right:15px;"/>
                        <p class="hero-text-title promo-two-title"></p>
                        <p class="hero-text-body promo-two-dody"></p>
                    </div>
                </div>
            </div>
        </div> <!-- End Row -->
        <div id="sort-row-uq"></div>
        <div class="filter" id="filter-box"></div>
    </div><!-- End Container -->
</div><!-- End Section -->

<!-- Upsell Recommendations -->
<div class="section">
    <div class="container hotel-cards-container"> </div><!-- End Container -->
</div><!-- End Section -->

<!-- Upsell Recommendations -->
{#
<div class="section upsell" id="upsel-selection">
</div>
#}
<!-- End Section -->

<!-- Destinations -->
<div class="section">
    <div class="container region-cards-container"> </div><!-- End Container -->
</div><!-- End Section -->

<div class="section footer">
    <div class="container footer-container"> </div>
</div>