<form action="/" method="get">
    <input type="text" name="s" id="search" placeholder="<?php _e('Search...', 'anansi-tomte'); ?>" class="form-control" value="<?php the_search_query(); ?>" />
    <button class="search-btn"><i class="fa fa-search" aria-hidden="true"></i></button>
</form>