<?php get_header(); ?>

<main id="primary" class="site-main container-fluid error-404 not-found text-center py-5">
    <div class="center">
        <h1 class="heading-h1 mb-3"><?php esc_html_e( 'Nothing found', 'kreativ-oceania-theme' ); ?></h1>
        <p><?php esc_html_e( 'The content you are looking for does not exist or may have been moved.', 'kreativ-oceania-theme' ); ?></p>
        <p><?php printf( wp_kses_post( __( 'You can use the search field below to find it, or <a href="%s"><strong>return to the home page</strong></a>.', 'kreativ-oceania-theme' ) ), esc_url( home_url( '/' ) ) ); ?></p>

        <div class="my-4">
            <?php get_search_form(); ?>
			<br/>
        </div>

        <p class="text-muted mt-4"><?php echo esc_html( kreativ_get_site_title() ); ?></p>
    </div>
    <hr class="my-5" />

    <section class="suggested-posts text-center">
        <h2 class="heading-h1 mb-4"><?php esc_html_e( 'Explore More Posts', 'kreativ-oceania-theme' ); ?></h2>
        <div class="row justify-content-center">

            <?php
            // Suggested posts (latest 8 posts)
            $suggested_args = array(
                'post_type'      => 'post',
                'posts_per_page' => 8,
                'ignore_sticky_posts' => true,
            );

            $suggested_query = new WP_Query($suggested_args);

            if ( $suggested_query->have_posts() ) :
                while ( $suggested_query->have_posts() ) : $suggested_query->the_post();
			
			?>
                <div class="col-md-3 col-sm-6 mb-4">
					
                    <div class="kreativ-font-card">
                    
						<a href="<?php echo esc_url( get_permalink() ); ?>" class="kreativ-card-title" title="<?php the_title_attribute(); ?>">
                            <strong><?php the_title(); ?></strong>
							<?php
                            echo kreativ_get_post_thumbnail_markup(
                                get_the_ID(),
                                'medium',
                                array(
                                    'class' => 'card-img-top',
                                )
                            );
                            ?>
                        
						</a>
                    
					</div>
                
			</div>
            <?php
                endwhile;
            else :
                echo '<p>' . esc_html__( 'No posts available right now.', 'kreativ-oceania-theme' ) . '</p>';
            endif;

            wp_reset_postdata();
            ?>
        </div>
    </section>

</main>

<?php get_footer(); ?>
