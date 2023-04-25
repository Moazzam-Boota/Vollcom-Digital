<?php

if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' ) || is_active_sidebar( 'footer-5' )  || is_active_sidebar( 'footer-6' ) ) {?>
        <div id="footer-widget" class="row m-0 py-3 <?php if(!is_theme_preset_active()){ echo 'has-dunkelblau-background-color'; } ?>">
            <div class="container">
                <?php if( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' )): ?>
                    <div class="row text-center text-md-left mb-3 mb-lg-5">
                        <?php if ( is_active_sidebar( 'footer-1' )) : ?>
                            <div class="col-12 col-md-3"><?php dynamic_sidebar( 'footer-1' ); ?></div>
                        <?php endif; ?>
                        <?php if ( is_active_sidebar( 'footer-2' )) : ?>
                            <div class="col-12 col-md-3"><?php dynamic_sidebar( 'footer-2' ); ?></div>
                        <?php endif; ?>
                        <?php if ( is_active_sidebar( 'footer-3' )) : ?>
                            <div class="col-12 col-md-3"><?php dynamic_sidebar( 'footer-3' ); ?></div>
                        <?php endif; ?>
                        <?php if ( is_active_sidebar( 'footer-4' )) : ?>
                            <div class="col-12 col-md-3"><?php dynamic_sidebar( 'footer-4' ); ?></div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <?php if ( is_active_sidebar( 'footer-5' )) : ?>
                <div class="d-flex justify-content-center pb-3">
                    <?php dynamic_sidebar( 'footer-5' ); ?>
                </div>
                <?php endif; ?>
            </div>
        </div>

<?php }