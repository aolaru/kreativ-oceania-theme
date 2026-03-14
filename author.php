<?php get_header(); ?>

<div id="blog">
    <div id="post">
        <div class="post_category">
            <?php
            $author_object = get_queried_object();
            $curauth       = ( $author_object instanceof WP_User ) ? $author_object : null;
            $author_name   = $curauth ? $curauth->display_name : get_the_author_meta( 'display_name', get_query_var( 'author' ) );
            ?>

            <h2><?php printf( esc_html__( 'About %s', 'kreativ-oceania-theme' ), esc_html( $author_name ) ); ?></h2>

            <?php if ( $curauth ) : ?>
                <dl>
                    <dt><?php esc_html_e( 'Website', 'kreativ-oceania-theme' ); ?></dt>
                    <dd>
                        <?php if ( ! empty( $curauth->user_url ) ) : ?>
                            <a href="<?php echo esc_url( $curauth->user_url ); ?>"><?php echo esc_html( $curauth->user_url ); ?></a>
                        <?php else : ?>
                            <span><?php esc_html_e( 'No website provided.', 'kreativ-oceania-theme' ); ?></span>
                        <?php endif; ?>
                    </dd>
                    <dt><?php esc_html_e( 'Profile', 'kreativ-oceania-theme' ); ?></dt>
                    <dd><?php echo esc_html( $curauth->user_description ); ?></dd>
                </dl>
            <?php endif; ?>

            <h2><?php printf( esc_html__( 'Posts written by %s', 'kreativ-oceania-theme' ), esc_html( $author_name ) ); ?></h2>

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
                <p><?php esc_html_e( 'No posts by this author.', 'kreativ-oceania-theme' ); ?></p>
            <?php endif; ?>

            <br/>

            <div id="post_nav">
                <?php if ( function_exists( 'wp_pagenavi' ) ) : ?>
                    <?php wp_pagenavi(); ?>
                <?php else : ?>
                    <div class="post_nav_previous"><?php next_posts_link( esc_html__( 'Older posts', 'kreativ-oceania-theme' ) ); ?></div>
                    <div class="post_nav_next"><?php previous_posts_link( esc_html__( 'Newer posts', 'kreativ-oceania-theme' ) ); ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
