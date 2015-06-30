<script id="sort-template" type="text/x-handlebars-template">
<div class="row sort-row">
    <div class="three columns" id="filter-btn">
        <ul class="breadcrumbs bc-space">
            <li><a href="/n/sale/deals/">Home</a></li>
            >
            <li id="breadcrumb-city">{{ city }}</li>
        </ul>
    </div>
    <div class="nine columns">
        <ul class="sort-control sr-space">
            <li class="sort-list sort-list-label">
                Sort by:
            </li>
            <li class="sort-list">
                <a class="sort-button sort-box-price" data-sort="price" title="Price">Price</a>
            </li>
            <li class="sort-list">
                <a class="sort-button sort-box-name" data-sort="name" title="Name">Name</a>
            </li>
            <li class="sort-list">
                <a class="sort-button sort-box-rating" data-sort="rating" title="Rating">Rating</a>
            </li>
            <li class="sort-list">
                <strong><a class="sort-button sort-box-picks" data-sort="ourPicks" title="Our picks">Our picks</a>
                <span class="sort-indicator-image"></span> <!-- &or; --></strong>
            </li>
        </ul>
    </div>
</div>
</script>