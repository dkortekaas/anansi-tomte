<div id="nav-panel" class="">
    <?php
        // show top navigation and mobile menu
        //$MagikPvc = new MagikPvc();
        echo wl_mobile_search();
        echo '<div class="menu-wrap">';
        echo wl_mobile_menu().'</div>';
        echo '<div class="menu-wrap">'.magikPvc_mobile_top_navigation().'</div>';
    ?>
</div>