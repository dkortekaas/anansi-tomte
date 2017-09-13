<?php

if ( ! function_exists ( 'wl_top_navigation' ) ) :
function wl_top_navigation() {
global $pvc_Options;
   
    

    if ( function_exists('icl_object_id') ) :
        do_action('icl_language_selector');
    else :

        $html = '';
        if (isset($pvc_Options['login_button_pos']) && $pvc_Options['login_button_pos'] == 'toplinks') {

            if (is_user_logged_in()) {
                $logout_link = '';
            if ( class_exists( 'WooCommerce' ) ) {
                    $logout_link = wp_logout_url( get_permalink( woocommerce_get_page_id( 'myaccount' ) ) );
                } else {
                    $logout_link = wp_logout_url( get_home_url() );
                }            $html .= '<li class="menu-item"><a href="' . esc_url($logout_link) . '">' . esc_html__('Logout', 'pvc') . '</a></li>';
            } else {
                $login_link = $register_link = '';
                if ( class_exists( 'WooCommerce' ) ) {
                    $login_link = wc_get_page_permalink( 'myaccount' );
                    if (get_option('woocommerce_enable_myaccount_registration') === 'yes') {
                        $register_link = wc_get_page_permalink( 'myaccount' );
                    }
                } else {
                    $login_link = wp_login_url( get_home_url() );
                    $active_signup = get_site_option( 'registration', 'none' );
                    $active_signup = apply_filters( 'wpmu_active_signup', $active_signup );
                    if ($active_signup != 'none')
                        $register_link = wp_registration_url( get_home_url() );
                }
                $html .= '<li class="menu-item"><a href="' . esc_url($login_link) . '"> ' . esc_html__('Login', 'pvc') . '</a></li>';
                if ($register_link) {
                    $html .= '<li class="menu-item"><a href="' . esc_url($register_link) . '">' . esc_html__('Register', 'pvc') . '</a></li>';
                }
            }
        }
        if(isset($pvc_Options['show_menu_arrow']) && $pvc_Options['show_menu_arrow'])
    {
        $mcls=' show-arrow';
    }
    else
    {
        $mcls='';
    }
        ob_start();
        if ( has_nav_menu( 'toplinks' ) ) :
        
            wp_nav_menu(array(
                'theme_location' => 'toplinks',
                'container' => '',
                'menu_class' => 'top-links1 mega-menu1' .$mcls,
                'before' => '',
                'after' => '',          
                'link_before' => '',
                'link_after' => '',
                'fallback_cb' => false,
                'walker' => new MagikPvc_top_navwalker
            ));
        endif;

        $output = str_replace('&nbsp;', '', ob_get_clean());

        if ($output && $html) { 
            $output = preg_replace('/<\/ul>$/', $html . '</ul>', $output, 1);
        }

        return $output;
    endif;
}
endif;

if ( ! function_exists ( 'magikPvc_mobile_top_navigation' ) ) {

function magikPvc_mobile_top_navigation() {
global $pvc_Options;
   
    $html = '';

    if (isset($pvc_Options['login_button_pos']) && $pvc_Options['login_button_pos'] == 'toplinks') {

        if (is_user_logged_in()) {
            $logout_link = '';
          if ( class_exists( 'WooCommerce' ) ) {
                $logout_link = wp_logout_url( get_permalink( woocommerce_get_page_id( 'myaccount' ) ) );
            } else {
                $logout_link = wp_logout_url( get_home_url() );
            }            $html .= '<li class="menu-item"><a href="' . esc_url($logout_link) . '">' . esc_html__('Logout', 'pvc') . '</a></li>';
        } else {
            $login_link = $register_link = '';
            if ( class_exists( 'WooCommerce' ) ) {
                $login_link = wc_get_page_permalink( 'myaccount' );
                if (get_option('woocommerce_enable_myaccount_registration') === 'yes') {
                    $register_link = wc_get_page_permalink( 'myaccount' );
                }
            } else {
                $login_link = wp_login_url( get_home_url() );
                $active_signup = get_site_option( 'registration', 'none' );
                 $active_signup = apply_filters( 'wpmu_active_signup', $active_signup );
                if ($active_signup != 'none')
                    $register_link = wp_registration_url( get_home_url() );
            }
            $html .= '<li class="menu-item"><a href="' . esc_url($login_link) . '">' . esc_html__('Login', 'pvc') . '</a></li>';
            if ($register_link) {
                $html .= '<li class="menu-item"><a href="' . esc_url($register_link) . '">' . esc_html__('Register', 'pvc') . '</a></li>';
            }
        }
    }
   if(isset($pvc_Options['show_menu_arrow']) && $pvc_Options['show_menu_arrow'])
   {
    $mcls=' show-arrow';
   }
   else
   {
    $mcls='';
   }
    ob_start();
    if ( has_nav_menu( 'toplinks' ) ) :
        wp_nav_menu(array(
            'theme_location' => 'toplinks',
            'container' => '',
            'menu_class' => 'top-links1 accordion-menu' . $mcls,
            'before' => '',
            'after' => '',
            'link_before' => '',
            'link_after' => '',
            'fallback_cb' => false,
            'walker' => new MagikPvc_mobile_navwalker
        ));
    endif;

    $output = str_replace('&nbsp;', '', ob_get_clean());

    if ($output && $html) {
        $output = preg_replace('/<\/ul>$/', $html . '</ul>', $output, 1);
    }

    return $output;
}
}


if ( ! function_exists ( 'wl_main_menu' ) ) {
function wl_main_menu() {
    global $pvc_Options, $woocommerce;
   
    $html = '';
    $products = '';

    //if (isset($pvc_Options['login_button_pos']) && $pvc_Options['login_button_pos'] == 'main_menu') :

        if (is_user_logged_in()) :
            if (ICL_LANGUAGE_CODE=='nl') :
 	            $html .= '<li class="menu-item visible-xs"><a href="'. get_permalink( get_option('woocommerce_myaccount_page_id') ) .'" title="'. __('My Account','anansi-tomte') .'">'. __('My Account','anansi-tomte') .'</a></li>';
                if ($woocommerce->cart->cart_contents_count > 0) :
                    $products = '('. $woocommerce->cart->cart_contents_count .')';
                endif;
                $html .= '<li class="menu-item visible-xs"><a href="'. esc_url(WC()->cart->get_cart_url()) .'" title="'. __('Cart','anansi-tomte') .'">'. __('Cart','anansi-tomte') . $products . '</a></li>';
            endif;
           
            //$html .= '<li class="menu-item "><a href="' . esc_url($logout_link) . '"><span>' . esc_html__('My account', 'woocommerce') . '</span></a></li>';
            //$html .= '<li class="menu-item "><a href="' . esc_url($logout_link) . '"><span>' . esc_html__('Shopping Cart', 'woocommerce') . '</span></a></li>';
        else :
            if (ICL_LANGUAGE_CODE=='nl') :
                $login_link = $register_link = '';
                if (class_exists( 'WooCommerce' ) ) :
                    $login_link = wc_get_page_permalink( 'myaccount' );
                    if (get_option('woocommerce_enable_myaccount_registration') === 'yes') :
                        $register_link = wc_get_page_permalink( 'myaccount' );
                    endif;
                else :
                    $login_link = wp_login_url( get_home_url() );
                    $active_signup = get_site_option( 'registration', 'none' );
                    $active_signup = apply_filters( 'wpmu_active_signup', $active_signup );
         
                    if ($active_signup != 'none') :
                        $register_link = wp_registration_url( get_home_url() );
                    endif;
                endif;
                $html .= '<li class="menu-item visible-xs"><a href="' . esc_url($login_link) . '"><span>' . esc_html__('My Account', 'pvc') . '</span></a></li>';
           endif;
            // if ($register_link) :
            //     $html .= '<li class="menu-item visible-xs"><a href="' . esc_url($register_link) . '"><span>' . esc_html__('Register', 'pvc') . '</span></a></li>';
            // endif;          
        endif;
    //endif;
    if(isset($pvc_Options['show_menu_arrow']) && $pvc_Options['show_menu_arrow']) :
        $mcls=' show-arrow';
    else :
        $mcls='';
    endif;
    ob_start();
    
    if ( has_nav_menu('main_menu') ) :     
        $args = array(
        'container' => '',
        'menu_class' => 'sf-menu sf-arrows local-scroll' . $mcls,
            'before' => '',
            'after' => '',
            'link_before' => '',
            'link_after' => '',
            'fallback_cb' => false,
            'walker' => new MagikPvc_top_navwalker
        );
       
        $args['theme_location'] = 'main_menu';
        
        wp_nav_menu($args);
    endif;

    if ( has_nav_menu('main_menu') ) :     
        $args = array(
        'container' => '',
        'menu_class' => 'mobile-menu' . $mcls,
            'before' => '',
            'after' => '',
            'link_before' => '',
            'link_after' => '',
            'fallback_cb' => false,
            'walker' => new MagikPvc_top_navwalker
        );
       
        $args['theme_location'] = 'main_menu';
        
        wp_nav_menu($args);
    endif;

    $output = str_replace('&nbsp;', '', ob_get_clean());

    if ($output && $html) {

        $output = preg_replace('/<\/ul>$/', $html . '</ul>', $output, 1);
    }

    return $output;
}
}


if ( ! function_exists ( 'wl_mobile_menu' ) ) {
function wl_mobile_menu() {
    global $pvc_Options;

    $html = '';
    if (isset($pvc_Options['login_button_pos']) && $pvc_Options['login_button_pos'] == 'main_menu') {
        if (is_user_logged_in()) {
            $logout_link = '';
            if ( class_exists( 'WooCommerce' ) ) {
              $logout_link = wp_logout_url( get_permalink( woocommerce_get_page_id( 'myaccount' ) ) );
            } else {
                $logout_link = wp_logout_url( get_home_url() );
            }
            $html .= '<li class="menu-item"><a href="' . esc_url($logout_link) . '">' . esc_html__('Logout', 'pvc') . '</a></li>';
        } else {
            $login_link = $register_link = '';
            if ( class_exists( 'WooCommerce' ) ) {
                $login_link = wc_get_page_permalink( 'myaccount' );
                if (get_option('woocommerce_enable_myaccount_registration') === 'yes') {
                    $register_link = wc_get_page_permalink( 'myaccount' );
                }
            } else {
                $login_link = wp_login_url( get_home_url() );
                $active_signup = get_site_option( 'registration', 'none' );
                $active_signup = apply_filters( 'wpmu_active_signup', $active_signup );
                if ($active_signup != 'none')
                    $register_link = wp_registration_url( get_home_url() );
            }
            $html .= '<li class="menu-item"><a href="' . esc_url($login_link) . '">' . esc_html__('Login', 'pvc') . '</a></li>';
            if ($register_link ) {
                $html .= '<li class="menu-item"><a href="' . esc_url($register_link) . '">' . esc_html__('Register', 'pvc') . '</a></li>';
            }
        }
    }

   
    ob_start();
    if ( has_nav_menu( 'main_menu' ) ) :
      
        $args = array(
            'container' => '',
            'menu_class' => 'mobile-menu accordion-menu',
            'before' => '',
            'after' => '',
            'link_before' => '',
            'link_after' => '',
            'fallback_cb' => false,
            'walker' => new MagikPvc_mobile_navwalker
        );
      
            $args['theme_location'] = 'main_menu';
        
        wp_nav_menu($args);
    endif;

    $output = str_replace('&nbsp;', '', ob_get_clean());


    if ($output && $html) {
        $output = preg_replace('/<\/ul>$/', $html . '</ul>', $output, 1);
    }

    return $output;
}
}




if ( ! function_exists ( 'magikPvc_home_mobile_menu' ) ) {
function magikPvc_home_mobile_menu() {
    global $pvc_Options;

    $html = '';
    if (isset($pvc_Options['login_button_pos']) && $pvc_Options['login_button_pos'] == 'main_menu') {
        if (is_user_logged_in()) {
            $logout_link = '';
            if ( class_exists( 'WooCommerce' ) ) {
              $logout_link = wp_logout_url( get_permalink( woocommerce_get_page_id( 'myaccount' ) ) );
            } else {
                $logout_link = wp_logout_url( get_home_url() );
            }
            $html .= '<li class="menu-item"><a href="' . esc_url($logout_link) . '">' .esc_html__('Logout', 'pvc') . '</a></li>';
        } else {
            $login_link = $register_link = '';
            if ( class_exists( 'WooCommerce' ) ) {
                $login_link = wc_get_page_permalink( 'myaccount' );
                if (get_option('woocommerce_enable_myaccount_registration') === 'yes') {
                    $register_link = wc_get_page_permalink( 'myaccount' );
                }
            } else {
                $login_link = wp_login_url( get_home_url() );
                $active_signup = get_site_option( 'registration', 'none' );
                $active_signup = apply_filters( 'wpmu_active_signup', $active_signup );
                if ($active_signup != 'none')
                    $register_link = wp_registration_url( get_home_url() );
            }
            $html .= '<li class="menu-item"><a href="' . esc_url($login_link) . '">' .esc_html__('Login', 'pvc') . '</a></li>';
            if ($register_link ) {
                $html .= '<li class="menu-item"><a href="' . esc_url($register_link) . '">' .esc_html__('Register', 'pvc') . '</a></li>';
            }
        }
    }

   
    ob_start();
    if ( has_nav_menu( 'main_menu' ) ) :
      
        $args = array(
            'container' => '',
            'menu_class' => 'mega-menu nav',
            'before' => '',
            'after' => '',
            'link_before' => '',
            'link_after' => '',
            'fallback_cb' => false,
            'walker' => new MagikPvc_home_mobile_navwalker
        );
      
            $args['theme_location'] = 'main_menu';
        
        wp_nav_menu($args);
    endif;

    $output = str_replace('&nbsp;', '', ob_get_clean());


    if ($output && $html) {
        $output = preg_replace('/<\/ul>$/', $html . '</ul>', $output, 1);
    }

    return $output;
}

}
?>