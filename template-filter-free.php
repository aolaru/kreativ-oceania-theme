<?php
/*
Template Name: Filter Free
*/
?>
<?php get_header(); ?>

<div class="container-fluid">

	<h1 style="text-align:center;">Discover new FREE fonts every week</h1>

	<div style="text-align:center;">A constantly growing collection of hand-picked free fonts for designers with commercial use licenses.</div>

	<div class="row">

		<?php // WP_Query arguments

        $args = array (

            'tax_query' => array(

                'relation' => 'OR',

                array (
                        'taxonomy' => 'download_category',
                        'field' => 'name',
                        'terms' => array('Free'),
                     ),

             ),

            'pagination'        => true,

            'posts_per_page'    => '100',
        );

        // The Query
        $query = new WP_Query( $args );

        // The Loop
        if ( $query->have_posts() ) {

            while ( $query->have_posts() ) {

                $query->the_post();

                $post_id = $post->ID;

                ?>

		<?php $image_medium = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'medium' ); ?>

		<div class="col-md-4 col-lg-3 col-sm-6">
			<div class="kreativ-font-card">
				<a href="<?php the_permalink() ?>" class="kreativ-card-title" title="<?php the_title_attribute(); ?>">
					<strong><?php the_title(); ?></strong>
					<img class="card-img-top"
						src="<?php echo esc_url( get_template_directory_uri() . '/img/loading.gif' ); ?>"
						data-original="<?php echo esc_url( $image_medium[0] ?? kreativ_get_fallback_image_url() ); ?>"
						alt="<?php the_title_attribute(); ?>"
						loading="lazy" />
				</a>
				<a href="<?php echo esc_url( kreativ_get_checkout_url( $post_id ) ); ?>" title="<?php echo esc_attr( sprintf( 'Download %s font', get_the_title() ) ); ?>" class="card">
					<span class="btn btn-primary">Download free font</span>
				</a>
			</div>
			</div>
			<?php
            }
        } else {
            echo '<h2>Sorry, no fonts found!</h2>';
        }
        wp_reset_postdata();
        ?>
		</div>
	</div>
</section>

<?php get_footer();
