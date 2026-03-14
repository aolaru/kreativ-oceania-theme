<?php
/*
Template Name: Glossary
*/
?>
<?php get_header(); ?>

<div id="page">

	<h1><?php the_title(); ?></h1>

	<div class="page_column">
		<h2><?php esc_html_e( 'Articles in alphabetic order', 'kreativ-oceania-theme' ); ?></h2>
		<ul class="page_column_list">
			<?php wp_get_archives('type=alpha'); ?> 
		</ul>
	</div>

	<div class="page_column">
		<h2><?php esc_html_e( 'Articles by category', 'kreativ-oceania-theme' ); ?></h2>
		<ul class="page_column_list">
			<?php wp_list_categories('show_count=1&title_li=');?>
		</ul>
		
		<h2><?php esc_html_e( 'Articles by month', 'kreativ-oceania-theme' ); ?></h2>
		<ul class="page_column_list">
			<?php wp_get_archives('type=monthly'); ?>
		</ul>
	</div>

	<div class="page_column">
		<h2><?php esc_html_e( 'Articles by tags', 'kreativ-oceania-theme' ); ?></h2>
			<?php wp_tag_cloud('smallest=8&largest=22&number=10000'); ?>
	</div>

</div>

<?php get_footer();
