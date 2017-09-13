<?php 

/* Active Redux if found */

if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname(get_template_directory()) . '/ReduxFramework/ReduxCore/framework.php' ) ) {
    require_once( dirname( get_template_directory() ) . '/ReduxFramework/ReduxCore/framework.php' );
}


?>