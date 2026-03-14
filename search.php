<?php get_header(); ?>

    <div class="container-fluid">

        <div class="text-center">

            <h2 class="heading-h2"><?php printf( esc_html__( 'No results for “%s”', 'kreativ-oceania-theme' ), esc_html( get_search_query() ) ); ?></h2>

        </div>

        <div class="row">

			<?php if (have_posts()) : while (have_posts()) : the_post();

			$post_id = $post->ID;
			
			?>
            <div class="col-md-4 col-lg-3 col-sm-6">

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

		<?php endwhile; ?>

		<?php else : ?>

        </div>

		<p class="text-center"><?php esc_html_e( 'We could not find any matching content. Try another keyword or browse recent posts from the homepage.', 'kreativ-oceania-theme' ); ?></p>

		<?php endif; ?>

    </div>

<?php get_footer();
