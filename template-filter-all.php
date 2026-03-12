<?php
/*
Template Name: Editorial Home
*/
get_header();

$featured_categories = kreativ_get_featured_categories( 6 );
$hero_description    = kreativ_get_site_description();
?>
<div class="kreativ-hero container">
    <p class="kreativ-hero-subtitle"><?php echo esc_html( $hero_description ); ?></p>
</div>

<?php if ( ! empty( $featured_categories ) ) : ?>
    <?php foreach ( $featured_categories as $category ) : ?>
        <div class="container kreativ-section kreativ-section-<?php echo esc_attr( $category->slug ); ?>">

            <div class="kreativ-section-header">
                <h2 class="kreativ-section-title">
                    <?php echo kreativ_render_icon( $category->slug ); ?>
                    <?php echo esc_html( $category->name ); ?>
                </h2>
                <a href="<?php echo esc_url( get_category_link( $category ) ); ?>" class="kf-view-all"><?php esc_html_e( 'View all', 'kreativ' ); ?> &rsaquo;</a>
            </div>

            <div class="row">
                <?php
                $query = new WP_Query(
                    array(
                        'posts_per_page'         => 8,
                        'post_status'            => 'publish',
                        'ignore_sticky_posts'    => true,
                        'no_found_rows'          => true,
                        'update_post_term_cache' => false,
                        'update_post_meta_cache' => false,
                        'cat'                    => (int) $category->term_id,
                    )
                );

                if ( $query->have_posts() ) :
                    while ( $query->have_posts() ) :
                        $query->the_post();

                        $is_new = function_exists( 'kf_is_new_post' ) ? kf_is_new_post( get_the_ID() ) : false;
                        ?>
                        <div class="col-md-3 col-sm-6 kreativ-card-animate">
                            <div class="kreativ-font-card">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="kreativ-card-media">

                                        <span class="kf-badge kf-badge-<?php echo esc_attr( $category->slug ); ?>">
                                            <?php echo esc_html( $category->name ); ?>
                                        </span>

                                        <?php if ( $is_new ) : ?>
                                            <span class="kf-badge-new"><?php esc_html_e( 'New', 'kreativ' ); ?></span>
                                        <?php endif; ?>

                                        <?php
                                        echo kreativ_get_post_thumbnail_markup(
                                            get_the_ID(),
                                            'medium',
                                            array(
                                                'class' => 'card-img-top',
                                            )
                                        );
                                        ?>
                                    </div>
                                    <h3><?php the_title(); ?></h3>
                                </a>
                            </div>
                        </div>
                    <?php
                    endwhile;
                endif;
                wp_reset_postdata();
                ?>
            </div>
        </div>
    <?php endforeach; ?>
<?php else : ?>
    <div class="container kreativ-section">
        <div class="kreativ-section-header">
            <h2 class="kreativ-section-title"><?php esc_html_e( 'Latest Posts', 'kreativ' ); ?></h2>
        </div>
        <div class="row">
            <?php
            $latest_posts = new WP_Query(
                array(
                    'posts_per_page'         => 8,
                    'post_status'            => 'publish',
                    'ignore_sticky_posts'    => true,
                    'no_found_rows'          => true,
                    'update_post_term_cache' => false,
                    'update_post_meta_cache' => false,
                )
            );

            if ( $latest_posts->have_posts() ) :
                while ( $latest_posts->have_posts() ) :
                    $latest_posts->the_post();
                    ?>
                    <div class="col-md-3 col-sm-6 kreativ-card-animate">
                        <div class="kreativ-font-card">
                            <a href="<?php the_permalink(); ?>">
                                <div class="kreativ-card-media">
                                    <?php
                                    echo kreativ_get_post_thumbnail_markup(
                                        get_the_ID(),
                                        'medium',
                                        array(
                                            'class' => 'card-img-top',
                                        )
                                    );
                                    ?>
                                </div>
                                <h3><?php the_title(); ?></h3>
                            </a>
                        </div>
                    </div>
                    <?php
                endwhile;
            endif;
            wp_reset_postdata();
            ?>
        </div>
    </div>
<?php endif; ?>

<?php get_footer(); ?>
