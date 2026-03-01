<?php get_header(); ?>

<div class="post_nav_next">
    <?php next_post_link( '%link', '&rarr;' ); ?>
</div>
<div class="post_nav_prev">
    <?php previous_post_link( '%link', '&larr;' ); ?>
</div>

<div id="post">

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<h1 class="heading-h1"><?php the_title(); ?></h1>

    <div class="post_content">
        <div class="col-lg-7 col-md-9 col-sm-12 center-margin">
            <?php the_content( 'Read the rest of this article &larr;' ); ?>
        </div>

        <?php
        $basename              = basename( get_permalink() );
        $search_creativemarket = str_replace( '-', '/', $basename );
        $search_myfonts        = str_replace( '-', ' ', $basename );

        $creative_market_url = kreativ_get_internal_url( 'creativemarket/' . $search_creativemarket );
        $myfonts_url         = kreativ_get_internal_url( 'myfonts/' . rawurlencode( $search_myfonts ) );
        $fontbundles_url     = 'https://fontbundles.net/search/' . rawurlencode( $search_myfonts ) . '/rel=tgD63I';
        $fontspring_url      = add_query_arg(
            array(
                'q'     => $search_myfonts,
                'refby' => 'kreativ',
            ),
            'https://www.fontspring.com/search'
        );
        $creative_fabrica_url = add_query_arg(
            array(
                's'         => $search_myfonts,
                'post_type' => 'product',
                'campaign'  => 'Search',
            ),
            'https://www.creativefabrica.com/ref/73113/'
        );
        ?>
        <p>
            You might find a better price for this font on
            <a rel="nofollow noopener" href="<?php echo esc_url( $creative_market_url ); ?>" target="_blank">CreativeMarket</a>,
            <a rel="nofollow noopener" href="<?php echo esc_url( $myfonts_url ); ?>" target="_blank">MyFonts</a>,
            <a rel="nofollow noopener" href="<?php echo esc_url( $fontbundles_url ); ?>" target="_blank">FontBundles</a>,
            <a rel="nofollow noopener" href="<?php echo esc_url( $fontspring_url ); ?>" target="_blank">FontSpring</a> or
            <a rel="nofollow noopener" href="<?php echo esc_url( $creative_fabrica_url ); ?>" target="_blank">CreativeFabrica</a>.
        </p>
    </div>

    <div class="post_content">
        <div class="col-lg-7 col-md-9 col-sm-12 center-margin">
            <?php if ( function_exists( 'the_ratings' ) ) : ?>
                <h2><?php the_title_attribute(); ?> font ratings</h2>
                <?php the_ratings(); ?>
                <br/>
            <?php endif; ?>

            <div class="post_tags">
                <strong>Tags:</strong> <?php the_terms( get_the_ID(), 'download_tag', '', ', ', '' ); ?>
            </div>

            <div class="post_meta">
                A font family published on <?php echo esc_html( get_the_date( 'l, F jS, Y' ) ); ?>
                <?php if ( function_exists( 'the_views' ) ) : ?>
                    that has <?php the_views(); ?>.
                <?php else : ?>
                    .
                <?php endif; ?>
                <?php edit_post_link( 'Edit', ' ', '' ); ?>

                <?php
                $u_time          = get_the_time( 'U' );
                $u_modified_time = get_the_modified_time( 'U' );
                if ( $u_modified_time >= $u_time + DAY_IN_SECONDS ) :
                    ?>
                    <p>
                        Last modified on <?php echo esc_html( get_the_modified_date( 'F jS, Y' ) ); ?>
                        at <?php echo esc_html( get_the_modified_time() ); ?>
                    </p>
                <?php endif; ?>
            </div>
        </div>
    </div>

<?php endwhile; else: ?>
    <p>Sorry, no articles matched your criteria.</p>
<?php endif; ?>

</div>

<?php get_footer(); ?>
