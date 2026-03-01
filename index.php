<?php get_header(); ?>

<div id="blog">
    <div id="post">
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <div class="post_archive">
                    <?php if ( is_sticky() ) : ?>
                        <div class="post_featured">FEATURED</div>
                    <?php endif; ?>

                    <h1>
                        <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h1>

                    <div class="post_meta">
                        Published on <?php echo esc_html( get_the_date( 'l, F jS, Y' ) ); ?> in <?php the_category( ', ' ); ?>.
                    </div>

                    <div class="post_content">
                        <?php the_content( 'Read the rest of this article &raquo;' ); ?>
                    </div>

                    <?php
                    wp_link_pages(
                        array(
                            'before'         => '<p><strong>Pages:</strong> ',
                            'after'          => '</p>',
                            'next_or_number' => 'number',
                        )
                    );
                    ?>
                </div>
            <?php endwhile; ?>
        <?php else : ?>
            <div class="post_archive">
                <h2>Article not found</h2>
                <p>Ooops! The article you are looking for does not exist or has been moved. Please use the search form to find what you are looking for. Thank you!</p>
            </div>
        <?php endif; ?>

        <div id="post_nav">
            <div class="post_nav_previous"><?php next_posts_link( ' &larr; Older articles ' ); ?></div>
            <div class="post_nav_next"><?php previous_posts_link( ' Newer articles &rarr; ' ); ?></div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
