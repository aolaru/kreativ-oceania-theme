<?php get_header(); ?>

<main id="primary" class="kreativ-content-shell" tabindex="-1">
    <?php while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class( 'kreativ-entry' ); ?>>
            <?php
            $post_tags      = get_the_tags();
            $post_author    = get_the_author();
            $can_edit_post  = current_user_can( 'edit_post', get_the_ID() );
            ?>
            <header class="kreativ-entry-header">
                <p class="kreativ-post-card-meta"><?php echo wp_kses_post( get_the_category_list( ', ' ) ); ?></p>
                <h1><?php echo esc_html( get_the_title() ); ?></h1>
                <p class="kreativ-post-card-meta">
                    <?php
                    /* translators: %s: Publication date. */
                    printf( esc_html__( 'Published on %s.', 'kreativ-core' ), esc_html( get_the_date( 'F j, Y' ) ) );
                    ?>
                </p>
            </header>

            <?php if ( has_post_thumbnail() ) : ?>
                <figure class="kreativ-entry-featured-media">
                    <?php the_post_thumbnail( 'large', array( 'class' => 'kreativ-entry-featured-image', 'loading' => 'eager', 'fetchpriority' => 'high' ) ); ?>
                </figure>
            <?php endif; ?>

            <div class="kreativ-entry-content">
                <?php the_content(); ?>
                <?php
                wp_link_pages(
                    array(
                        'before' => '<p class="page-links">' . esc_html__( 'Pages:', 'kreativ-core' ),
                        'after'  => '</p>',
                    )
                );
                ?>
            </div>

            <?php if ( $post_tags || $post_author || $can_edit_post ) : ?>
                <footer class="kreativ-entry-footer">
                <?php if ( $post_tags ) : ?>
                    <p><strong><?php esc_html_e( 'Tags:', 'kreativ-core' ); ?></strong> <?php the_tags( '', ', ', '' ); ?></p>
                <?php endif; ?>
                <?php if ( $post_author ) : ?>
                    <p>
                        <?php /* translators: %s: linked post author name. */ ?>
                        <?php printf( wp_kses_post( __( 'Written by %s.', 'kreativ-core' ) ), wp_kses_post( get_the_author_posts_link() ) ); ?>
                    </p>
                <?php endif; ?>
                <?php edit_post_link( esc_html__( 'Edit', 'kreativ-core' ), '<p>', '</p>' ); ?>
                </footer>
            <?php endif; ?>
        </article>

        <?php if ( kreativ_single_related_posts_enabled() ) : ?>
            <?php $related_query = kreativ_get_related_posts_query( get_the_ID(), 4 ); ?>
            <?php if ( $related_query->have_posts() ) : ?>
                <section class="kreativ-related-posts" aria-labelledby="related-posts-title">
                    <h2 id="related-posts-title"><?php esc_html_e( 'You might also like', 'kreativ-core' ); ?></h2>
                    <div class="kreativ-post-list">
                        <?php while ( $related_query->have_posts() ) : $related_query->the_post(); ?>
                            <?php kreativ_render_post_card(); ?>
                        <?php endwhile; ?>
                    </div>
                </section>
                <?php wp_reset_postdata(); ?>
            <?php endif; ?>
        <?php endif; ?>

        <div class="kreativ-entry-navigation">
            <?php the_post_navigation(); ?>
        </div>

        <?php if ( comments_open() || get_comments_number() ) : ?>
            <?php comments_template(); ?>
        <?php endif; ?>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
