<?php
/*
* About page using Flexible Content
*/

 get_header(); ?>

<section class="hero-about">
    <div class="hero-text">
        <h3><?php the_field( 'hero_text' ); ?></h3>
    </div>
</section>

<div class="site-content">
    <section class="about-intro">
        <?php the_field( 'service_description' ); ?>
    </section>

    <?php if ( have_rows( 'icon_text_blocks' ) ): ?>
        <?php while ( have_rows( 'icon_text_blocks' ) ) : the_row(); ?>
        <div class="all-services">
            <?php if ( get_row_layout() == 'icon-left_text-right' ) { ?>
              <div class="service-section">
                <figure class="service-image alignleft">
                    <?php $icon_left = get_sub_field( 'icon_left' ); 
                if ( $icon_left ) { 
                    echo wp_get_attachment_image( $icon_left, 'full' ); 
                }?>
                </figure>
                <div class="service-description">
                    <?php the_sub_field( 'text_right' ); ?>
                </div>
            </div><!-- .service-section -->
            <?php }
            if ( get_row_layout() == 'text-left_icon-right' ) { ?>
            <div class="service-section">
                <div class="service-description">
                    <?php the_sub_field( 'text_left' ); ?>
                </div> 
                <figure class="service-image alignright">
                <?php $icon_right = get_sub_field( 'icon_right' ); 
                    if ( $icon_right ) { 
                        echo wp_get_attachment_image( $icon_right, 'full' ); 
                    } ?>
                </figure>
                </div><!-- .service-section -->
            </div><!-- .all-services -->
            <?php }
            if ( get_row_layout() == 'contact_us_section' ) { ?>
            <section class="about-contact">
			    <div class="contact-description">
                     <h4><?php 
                the_sub_field( 'contact_us_information' ); ?></h4>
                </div>
                <div class="contact-button">
                	<a class="button" style="background: none repeat scroll 0 0 <?php the_sub_field( 'button_color' ); ?>;" href="<?php echo esc_url( home_url() ); ?>/contact"><?php the_sub_field( 'button' ); ?></a>
                </div>
            </section>
            <?php } ?>
        <?php endwhile; endif; ?>
     </div><!-- .service-section -->
</div><!-- .site-content -->
<?php get_footer(); ?>