<?php
if (has_nav_menu('footer')) {
    wp_nav_menu(
        array(
            'theme_location'    =>  'footer',
            'container'         =>  'ul',
            'menu_class'        =>  'menu menu-gray-700 menu-hover-primary fw-bold order-1'
        )
    );
}
