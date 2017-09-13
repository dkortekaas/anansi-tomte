<?php
/**
 * Show Feature blocks
 *
 * @package WordPress
 * @subpackage logiqShop
 */

if ( ! function_exists( 'weblogiqpress_show_features' ) ) :
function weblogiqpress_show_features() {
    $showfeatures = get_option('wlc_features');
    if (trim($showfeatures) != "" & ($showfeatures == "both" || $showfeatures == "bottom")) :

            $title1 = get_option('wlc_feature_title_1');
		    $content1 = get_option('wlc_feature_text_1');
		    $icon1 = get_option('wlc_feature_icon_1');
            $link1 = get_option('wlc_feature_link_1');

            $title2 = get_option('wlc_feature_title_2');
		    $content2 = get_option('wlc_feature_text_2');
		    $icon2 = get_option('wlc_feature_icon_2');
            $link2 = get_option('wlc_feature_link_2');

            $title3 = get_option('wlc_feature_title_3');
		    $content3 = get_option('wlc_feature_text_3');
		    $icon3 = get_option('wlc_feature_icon_3');
            $link3 = get_option('wlc_feature_link_3');

            $title4 = get_option('wlc_feature_title_4');
		    $content4 = get_option('wlc_feature_text_4');
		    $icon4 = get_option('wlc_feature_icon_4');
            $link4 = get_option('wlc_feature_link_4');
	    ?>

        <?php if($title1 && $title2 && $title3 && $title4) : ?>

        <div class="our-features-box hidden-xs">
            <div class="container">
                <div class="features-block">
                    <div class="col-md-3 col-xs-12 col-sm-6">
                        <?php if( $link1 ): ?>
                        <a href="<?php echo $link1; ?>" title="<?php echo $title1; ?>">
                        <?php endif; ?>
                            <div class="feature-box first">
                                <span class="<?php echo $icon1; ?>"></span>
                                <h3><?php echo $title1; ?></h3>
                                <div class="content">
                                    <?php echo $content1; ?>
                                </div>
                            </div>
                        <?php if( $link1 ): ?>
                        </a>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-3 col-xs-12 col-sm-6">
                        <?php if( $link2 ): ?>
                        <a href="<?php echo $link2; ?>" title="<?php echo $title2; ?>">
                        <?php endif; ?>
                            <div class="feature-box">
                                <span class="<?php echo $icon2; ?>"></span>
                                <h3><?php echo $title2; ?></h3>
                                <div class="content">
                                    <?php echo $content2; ?>
                                </div>
                            </div>
                        <?php if( $link2 ): ?>
                        </a>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-3 col-xs-12 col-sm-6">
                        <?php if( $link3 ): ?>
                        <a href="<?php echo $link3; ?>" title="<?php echo $title3; ?>">
                        <?php endif; ?>
                            <div class="feature-box">
                                <span class="<?php echo $icon3; ?>"></span>
                                <h3><?php echo $title3; ?></h3>
                                <div class="content">
                                    <?php echo $content3; ?>
                                </div>
                            </div>
                        <?php if( $link3 ): ?>
                        </a>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-3 col-xs-12 col-sm-6">
                        <?php if( $link4 ): ?>
                        <a href="<?php echo $link4; ?>" title="<?php echo $title4; ?>">
                        <?php endif; ?>
                            <div class="feature-box last">
                                <span class="<?php echo $icon4; ?>"></span>
                                <h3><?php echo $title4; ?></h3>
                                <div class="content">
                                    <?php echo $content4; ?>
                                </div>
                            </div>
                        <?php if( $link4 ): ?>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endif;
    endif;
}
endif;