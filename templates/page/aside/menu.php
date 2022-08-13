<div class="aside-menu flex-column-fluid pt-0 pb-5 py-lg-5" id="kt_aside_menu">
    <!--begin::Aside menu-->
    <div id="kt_aside_menu_wrapper" class="w-100 hover-scroll-overlay-y d-flex" data-kt-scroll="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_search, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside, #kt_aside_menu" data-kt-scroll-offset="100px">
        <div id="kt_aside_menu" class="menu menu-column menu-title-gray-600 menu-state-primary menu-state-icon-primary menu-state-bullet-primary menu-icon-gray-400 menu-arrow-gray-400 fw-bold fs-6 my-auto" data-kt-menu="true">
          
            <div data-kt-menu-trigger="click" data-kt-menu-placement="right-start" class="menu-item py-3">
              
            
            <?php
                                if (has_nav_menu('main-menu')) {
                                    echo str_replace(
                                        'menu-item-has-children',
                                        'has_dropdown',
                                        wp_nav_menu(
                                            [
                                                'theme_location' => 'main-menu',
                                                'container'         => false,
                                                'items_wrap'        => '<ul class="navbar-nav">%3$s</ul>',
                                                'depth'             => 2,
                                                'echo'              => false,
                                                'walker' => new submenu_Walker,
                                            ]
                                        )
                                    );
                                } else {
                                    echo "به این بخش یک منو اضافه کنید";
                                }
                                ?>


            
            
            
            
           
        
        </div>
    </div>
    <!--end::Aside menu-->
</div>