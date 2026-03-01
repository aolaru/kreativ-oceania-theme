<?php get_header(); ?>

<div id="blog">
    <div id="post">
        <div class="post_category">
            <?php
            $author_object = get_queried_object();
            $curauth       = ( $author_object instanceof WP_User ) ? $author_object : null;
            $author_name   = $curauth ? $curauth->display_name : get_the_author_meta( 'display_name', get_query_var( 'author' ) );
            ?>

            <h2>About <?php echo esc_html( $author_name ); ?></h2>

            <?php if ( $curauth ) : ?>
                <dl>
                    <dt>Website</dt>
                    <dd>
                        <?php if ( ! empty( $curauth->user_url ) ) : ?>
                            <a href="<?php echo esc_url( $curauth->user_url ); ?>"><?php echo esc_html( $curauth->user_url ); ?></a>
                        <?php else : ?>
                            <span>No website provided.</span>
                        <?php endif; ?>
                    </dd>
                    <dt>Profile</dt>
                    <dd><?php echo esc_html( $curauth->user_description ); ?></dd>
                </dl>
            <?php endif; ?>

            <h2>Articles written by <?php echo esc_html( $author_name ); ?></h2>

            <?php if ( have_posts() ) : ?>
                <ul>
                    <?php while ( have_posts() ) : the_post(); ?>
                        <li>
                            <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                <?php the_title(); ?>
                            </a>,
                            <?php echo esc_html( get_the_date( 'd M Y' ) ); ?> in <?php the_category( '&' ); ?>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php else : ?>
                <p>No posts by this author.</p>
            <?php endif; ?>

            <br/>

            <div id="post_nav">
                <?php if ( function_exists( 'wp_pagenavi' ) ) : ?>
                    <?php wp_pagenavi(); ?>
                <?php else : ?>
                    <div class="post_nav_previous"><?php next_posts_link( ' &larr; Older articles ' ); ?></div>
                    <div class="post_nav_next"><?php previous_posts_link( ' Newer articles &rarr; ' ); ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
