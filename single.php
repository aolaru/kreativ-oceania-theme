<?php get_header(); ?>

<!-- Post Navigation Arrows -->
<div class="post_nav_next">
    <?php previous_post_link( '%link', '&rarr;' ); ?>
</div>

<div class="post_nav_prev">
    <?php next_post_link( '%link', '&larr;' ); ?>
</div>

<main id="post" class="container-fluid my-5">

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <h1 class="heading-h1 mb-4"><?php the_title(); ?></h1>

    <!-- Breadcrumb -->
    <div class="col-lg-7 col-md-9 col-sm-12 center-margin">
        <p class="breadcrumb" style="font-size: 0.7em; text-align: left;">
            <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php esc_attr_e( 'Home', 'kreativ-oceania-theme' ); ?>"><?php esc_html_e( 'Home', 'kreativ-oceania-theme' ); ?></a> ›
            <?php the_category(' › '); ?>
        </p>
    </div>

    <!-- Main Post Content -->
    <div class="post_content mb-5">
        <div class="col-lg-7 col-md-9 col-sm-12 center-margin">
            <?php the_content(); ?>
        </div>
    </div>

    <?php if ( kreativ_single_related_posts_enabled() ) : ?>
        <!-- Suggested Posts -->
        <section class="related-posts mt-5">
            <div class="col-lg-10 col-md-11 col-sm-12 center-margin text-center">
                <h2 class="heading-h2 mb-4"><?php esc_html_e( 'You Might Also Like', 'kreativ-oceania-theme' ); ?></h2>
                <div class="row justify-content-center">
                    <?php
                    $related_query = kreativ_get_related_posts_query( get_the_ID(), 4 );

                    if ( $related_query->have_posts() ) :
                        while ( $related_query->have_posts() ) :
                            $related_query->the_post();

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
                        wp_reset_postdata();
                    else :
                        ?>
                        <p><?php esc_html_e( 'No related posts found.', 'kreativ-oceania-theme' ); ?></p>
                        <?php
                    endif;
                    ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- Meta + Tags -->
    <div class="post_content">
        <div class="col-lg-7 col-md-9 col-sm-12 center-margin">

            <?php if ( get_the_tags() ) : ?>
                <div class="post_tags mb-3">
                    <strong>Tags:</strong> <?php the_tags('', ', ', ''); ?>
                </div>
            <?php endif; ?>

            <div class="post_meta text-muted mb-4">
                <?php
                printf(
                    esc_html__( 'Published on %1$s in %2$s by %3$s.', 'kreativ-oceania-theme' ),
                    esc_html( get_the_date( 'F j, Y' ) ),
                    wp_strip_all_tags( get_the_category_list( ', ' ) ),
                    esc_html( get_the_author() )
                );
                ?>
                <?php edit_post_link('Edit', ' | ', ''); ?>
            </div>
        </div>
    </div>

<?php endwhile; else: ?>

    <div class="text-center py-5">
        <h2><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'kreativ-oceania-theme' ); ?></h2>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary mt-3"><?php esc_html_e( 'Back to Home', 'kreativ-oceania-theme' ); ?></a>
    </div>

<?php endif; ?>

</main>

<?php get_footer(); ?>
