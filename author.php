<?php get_header(); ?>

<div id="blog">

	<div id="post">
	
		<div class="post_category">

		<!-- This sets the $curauth variable -->

    <?php
    $author_object = get_queried_object();
    $curauth = ( $author_object instanceof WP_User ) ? $author_object : null;
    ?>

    <h2>About <?php echo esc_html( get_the_author_meta( 'display_name', get_query_var( 'author' ) ) ); ?></h2>
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

    <h2>Articles written by <?php the_author(); ?></h2>

    <ul>
	
	<!-- The Loop -->

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	
        <li>
            <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>">
            <?php the_title(); ?></a>,
            <?php the_time('d M Y'); ?> in <?php the_category('&');?>
        </li>

    <?php endwhile; else: ?>

        <p><?php echo 'No posts by this author.'; ?></p>

    <?php endif; ?>
    <br/>
    </ul>

	<!-- End Loop -->

		<div id="post_nav">
		
			<?php if (function_exists( 'wp_pagenavi' )) : wp_pagenavi();
				  
				  else : ?>
					
					<div class="post_nav_previous"><?php next_posts_link(' &larr; Older articles ') ?></div>
		
					<div class="post_nav_next"><?php previous_posts_link(' Newer articles &rarr; ') ?></div>
					
			<?php endif; ?>
			
		</div>		
	
		</div>
	
	</div>

</div>

<?php get_footer(); ?>
