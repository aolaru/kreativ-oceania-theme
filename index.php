<?php get_header(); ?>

<div id="blog">
    <div id="post">
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <div class="post_archive">
                    <?php if ( is_sticky() ) : ?>
                        <div class="post_featured"><?php esc_html_e( 'Featured', 'kreativ-oceania-theme' ); ?></div>
                    <?php endif; ?>

                    <h1>
                        <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h1>

                    <div class="post_meta">
                        <?php
                        printf(
                            esc_html__( 'Published on %1$s in %2$s.', 'kreativ-oceania-theme' ),
                            esc_html( get_the_date( 'l, F jS, Y' ) ),
                            wp_strip_all_tags( get_the_category_list( ', ' ) )
                        );
                        ?>
                    </div>

                    <div class="post_content">
                        <?php the_content( esc_html__( 'Read the rest of this article »', 'kreativ-oceania-theme' ) ); ?>
                    </div>

                    <?php
                    wp_link_pages(
                        array(
                            'before'         => '<p><strong>' . esc_html__( 'Pages:', 'kreativ-oceania-theme' ) . '</strong> ',
                            'after'          => '</p>',
                            'next_or_number' => 'number',
                        )
                    );
                    ?>
                </div>
            <?php endwhile; ?>
        <?php else : ?>
            <div class="post_archive">
                <h2><?php esc_html_e( 'Post not found', 'kreativ-oceania-theme' ); ?></h2>
                <p><?php esc_html_e( 'The post you are looking for does not exist or has been moved. Please use the search form to find what you are looking for.', 'kreativ-oceania-theme' ); ?></p>
            </div>
        <?php endif; ?>

        <div id="post_nav">
            <div class="post_nav_previous"><?php next_posts_link( esc_html__( 'Older posts', 'kreativ-oceania-theme' ) ); ?></div>
            <div class="post_nav_next"><?php previous_posts_link( esc_html__( 'Newer posts', 'kreativ-oceania-theme' ) ); ?></div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
