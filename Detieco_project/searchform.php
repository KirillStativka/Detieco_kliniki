<?php $sq = get_search_query() ? get_search_query() : __( 'Поиск по сайту&hellip;', 'base' ); ?>
<form method="get" class="search-form" action="<?php echo home_url(); ?>" >
	<input type="text" class="search-input" name="s" placeholder="<?php echo $sq; ?>" value="<?php echo get_search_query(); ?>" />
	<input type="submit" value="" class="search-submit" />
</form>