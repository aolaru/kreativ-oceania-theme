		<footer class="kreativ-footer">
            <?php if ( has_nav_menu( 'footer' ) ) : ?>
                <nav class="kreativ-footer-links" aria-label="<?php esc_attr_e( 'Footer menu', 'kreativ-oceania-theme' ); ?>">
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'footer',
                            'container'      => false,
                            'menu_class'     => 'kreativ-footer-links-menu',
                            'fallback_cb'    => false,
                            'depth'          => 1,
                        )
                    );
                    ?>
                </nav>
            <?php endif; ?>

			<p class="kreativ-footer-meta">
                &copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php echo esc_html( kreativ_get_site_title() ); ?>
                <?php
                $footer_text = trim( (string) get_theme_mod( 'kreativ_footer_text', '' ) );
                if ( '' !== $footer_text ) :
                    ?>
                    &middot; <?php echo esc_html( $footer_text ); ?>
                <?php endif; ?>
			</p>
		</footer>
        <?php wp_footer(); ?>
    </section>
</body>
</html>
