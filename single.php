<?php get_header(); ?>

<main id="primary" class="kreativ-content-shell" tabindex="-1">
    <?php while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class( 'kreativ-entry' ); ?>>
            <header class="kreativ-entry-header">
                <p class="kreativ-post-card-meta"><?php echo wp_kses_post( get_the_category_list( ', ' ) ); ?></p>
                <h1><?php echo esc_html( get_the_title() ); ?></h1>
                <p class="kreativ-post-card-meta">
                    <?php printf( esc_html__( 'Published on %s.', 'kreativ-core' ), esc_html( get_the_date( 'F j, Y' ) ) ); ?>
                </p>
            </header>

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

            <footer class="kreativ-entry-footer">
                <?php if ( get_the_tags() ) : ?>
                    <p><strong><?php esc_html_e( 'Tags:', 'kreativ-core' ); ?></strong> <?php the_tags( '', ', ', '' ); ?></p>
                <?php endif; ?>
                <p>
                    <?php /* translators: %s: linked post author name. */ ?>
                    <?php printf( wp_kses_post( __( 'Written by %s.', 'kreativ-core' ) ), wp_kses_post( get_the_author_posts_link() ) ); ?>
                    <?php edit_post_link( esc_html__( 'Edit', 'kreativ-core' ), ' ', '' ); ?>
                </p>
            </footer>
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

        <nav class="kreativ-entry-navigation" aria-label="<?php esc_attr_e( 'Post navigation', 'kreativ-core' ); ?>">
            <?php the_post_navigation(); ?>
        </nav>

        <?php if ( comments_open() || get_comments_number() ) : ?>
            <?php comments_template(); ?>
        <?php endif; ?>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
