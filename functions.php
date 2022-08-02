<?php

// Add codestar framework
require_once get_theme_file_path() . '/codestar/codestar-framework.php';
require_once get_theme_file_path() . '/options.php';
require_once get_theme_file_path() . '/plswb-code.php';


define('IMAGES_URL', get_stylesheet_directory_uri() . '/assets/media/images/');


function mytheme_add_woocommerce_support()
{
	add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'mytheme_add_woocommerce_support');

include_once(get_stylesheet_directory() . '/inc/options.php');

// $variations = new WC_Product_Variable(3850);

// dd($variations->get_children());




// Get theme mode
function getThemeMode()
{
	$themeMode = 'light';
	if (isset($_COOKIE['theme_mode'])) $themeMode = $_COOKIE['theme_mode'];
	return $themeMode;
}

// Add CSS files to WordPress admin panel
function pidoGameAdminFiles()
{
	wp_enqueue_style('admin.bundle.min', get_template_directory_uri() . '/assets/custom/css/admin.bundle.min.css');
	wp_enqueue_style('iransansx.min', get_template_directory_uri() . '/assets/custom/css/iransansx.min.css');
}
add_action('admin_enqueue_scripts', 'pidoGameAdminFiles');

// Add CSS files to WordPress editor
function pidoGameEditorFiles()
{
	add_editor_style(get_template_directory_uri() . '/assets/custom/css/admin.bundle.min.css');
	add_editor_style(get_template_directory_uri() . '/assets/custom/css/iransansx.min.css');
	add_image_size('cart-product-plswb', 300, 150, true);
}
add_action('after_setup_theme', 'pidoGameEditorFiles');

// Add menu locations
function registerFrontEndMenus()
{
	register_nav_menus(
		array(
			'header'				=>	'فهرست سربرگ',
			'footer'				=>	'فهرست پاورقی',
			'header-user-first'		=>	'فهرست اول کاربر در سربرگ',
			'header-user-second'	=>	'فهرست دوم کاربر در سربرگ'
		)
	);
}
add_action('init', 'registerFrontEndMenus');

// Modify footer menu
function addAClassForFooter($ulClass, $args)
{
	if ($args->theme_location == 'footer') {
		return preg_replace('/<a /', '<a class="menu-link px-2"', $ulClass);
	}
	return $ulClass;
}
add_filter('wp_nav_menu', 'addAClassForFooter', PHP_INT_MAX, 2);

// Modify header user menu
function headerFirstUserMenu()
{
	$options = array(
		'echo' 				=>	false,
		'container' 		=>	false,
		'theme_location'	=>	'header-user-first',
		'fallback_cb'		=>	'fallBackMenu'
	);
	$menu = wp_nav_menu($options);
	echo preg_replace(array(
		'#^<ul[^>]*>#',
		'#</ul>$#'
	), '', $menu);
}

function headerSecondUserMenu()
{
	$options = array(
		'echo' 				=>	false,
		'container' 		=>	false,
		'theme_location'	=>	'header-user-second',
		'fallback_cb'		=>	'fallBackMenu'
	);
	$menu = wp_nav_menu($options);
	echo preg_replace(array(
		'#^<ul[^>]*>#',
		'#</ul>$#'
	), '', $menu);
}

function fallBackMenu()
{
	return;
}

function addLiClassForHeaderUser($classes, $item, $args)
{
	if ($args->theme_location == 'header-user-first' || $args->theme_location == 'header-user-second') {
		$classes[] = 'px-5';
	}
	return $classes;
}
add_filter('nav_menu_css_class', 'addLiClassForHeaderUser', 1, 3);

function addAClassForHeaderUser($ulClass, $args)
{
	if ($args->theme_location == 'header-user-first' || $args->theme_location == 'header-user-second') {
		return preg_replace('/<a /', '<a class="menu-link px-5"', $ulClass);
	}
	return $ulClass;
}
add_filter('wp_nav_menu', 'addAClassForHeaderUser', PHP_INT_MAX, 2);

// Notifications post type
function notificationsPostType()
{
	$supports = array(
		'title',
		'editor'
	);
	$labels = array(
		'name'				=>  'اعلان‌ها',
		'singular_name' 	=> 	'اعلان‌ها',
		'menu_name'			=> 	'اعلان‌ها',
		'name_admin_bar'	=> 	'اعلان‌ها',
		'add_new' 			=> 	'افزودن جدید',
		'add_new_item' 		=> 	'افزودن اعلان جدید',
		'new_item' 			=> 	'اعلان جدید',
		'edit_item' 		=> 	'ویرایش اعلان',
		'view_item' 		=> 	'نمایش اعلان',
		'all_items' 		=> 	'همهٔ اعلان‌ها',
		'search_items' 		=> 	'جستجو در اعلان‌ها',
		'not_found' 		=> 	'اعلانی یافت نشد.',
	);
	$args = array(
		'supports'				=> 	$supports,
		'labels'				=> 	$labels,
		'public' 				=>	false,
		'publicly_queryable' 	=>	true,
		'show_ui'				=>	true,
		'exclude_from_search' 	=>	true,
		'show_in_nav_menus' 	=>	false,
		'has_archive' 			=>	false,
		'rewrite'			 	=>	false
	);
	register_post_type('notifications', $args);
}
add_action('init', 'notificationsPostType');

// Time init
function timeAgoFunction()
{
	return (get_the_time('U') >= strtotime('-1 week')) ? sprintf(esc_html__('%s پیش'), human_time_diff(get_the_time('U'), current_time('timestamp'))) : get_the_date();
}
add_filter('the_time', 'timeAgoFunction');

// Get header menu array
function headerMenuArray()
{
	$menuName = 'header';
	if (($locations = get_nav_menu_locations()) && isset($locations[$menuName])) {
		$menu = wp_get_nav_menu_object($locations[$menuName]);
		$menuItems = wp_get_nav_menu_items($menu->term_id);
		$realMenu = array();
		$secondStepIds = array();
		foreach ((array) $menuItems as $menuItem) {
			$menuItemArray = (array) $menuItem;
			$menuItemArray['children'] = array();
			if ($menuItemArray['menu_item_parent'] == 0) {
				$realMenu[$menuItemArray['ID']] = $menuItemArray;
			} else {
				if (array_key_exists($menuItemArray['menu_item_parent'], $realMenu)) {
					$realMenu[$menuItemArray['menu_item_parent']]['children'][$menuItemArray['ID']] = $menuItemArray;
					$secondStepIds[$menuItemArray['menu_item_parent'] . '#' . $menuItemArray['ID']] = $menuItemArray['ID'];
				} elseif (in_array($menuItemArray['menu_item_parent'], $secondStepIds)) {
					$key = array_search($menuItemArray['menu_item_parent'], $secondStepIds);
					$explode = explode('#', $key);
					$parent = $explode[0];
					$realMenu[$parent]['children'][$menuItemArray['menu_item_parent']]['children'][$menuItemArray['ID']] = $menuItemArray;
				}
			}
		}
	}
	return $realMenu;
}

// Deactivate out of stock variations
function productVariationIsActive($active, $variation)
{
	if (!$variation->is_in_stock()) return false;
	return $active;
}
add_filter('woocommerce_variation_is_active', 'productVariationIsActive', 10, 2);

// Get related posts function
function getRelatedPosts($postId, $relatedCount, $args = array())
{
	$args = wp_parse_args((array) $args, array(
		'orderby'	=>	'rand',
		'return'	=>	'query'
	));
	$relatedArgs = array(
		'post_type'      	=>	get_post_type($postId),
		'posts_per_page'	=>	$relatedCount,
		'post_status'   	=>	'publish',
		'post__not_in'   	=>	array($postId),
		'orderby'        	=>	$args['orderby'],
		'tax_query'      	=>	array()
	);
	$post = get_post($postId);
	$taxonomies = get_object_taxonomies($post, 'names');
	foreach ($taxonomies as $taxonomy) {
		$terms = get_the_terms($postId, $taxonomy);
		if (empty($terms)) {
			continue;
		}
		$termList = wp_list_pluck($terms, 'slug');
		$relatedArgs['tax_query'][] = array(
			'taxonomy'	=>	$taxonomy,
			'field'		=>	'slug',
			'terms'    	=>	$termList
		);
	}
	if (count($relatedArgs['tax_query']) > 1) {
		$relatedArgs['tax_query']['relation'] = 'OR';
	}
	if ($args['return'] == 'query') {
		return new WP_Query($relatedArgs);
	} else {
		return $relatedArgs;
	}
}

// Register widgets locations
function widgetsInit()
{
	register_sidebar(array(
		'name'          => 'سایدبار تک نوشته',
		'id'            => 'blog-sidebar'
	));
}
add_action('widgets_init', 'widgetsInit');

// Creating search blog widget
class blogSearchWidget extends WP_Widget
{
	function __construct()
	{
		parent::__construct('blog_search_widget', 'پیدو گیم: جستجو در وبلاگ');
	}

	public function widget($args, $instance)
	{
		$title = apply_filters('widget_title', $instance['title']);
		$placeholder = $instance['placeholder'];
		echo $args['before_widget'];
		echo '<div class="mb-16">';
		if (!empty($title)) echo $args['before_title'] . '<h4 class="mb-7">' . $title . '</h4>' . $args['after_title'];
		echo '<div class="position-relative"><span class="svg-icon svg-icon-3 svg-icon-gray-500 position-absolute top-50 translate-middle ms-6"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" /><path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" /></svg></span><input type="text" class="form-control form-control-solid ps-10" name="search" placeholder="' . $placeholder . '"></div>';
		echo '</div>';
		echo $args['after_widget'];
	}

	public function form($instance)
	{
		if (isset($instance['title'])) {
			$title = $instance['title'];
		} else {
			$title = 'جستجو در وبلاگ پیدو گیم';
		}
		if (isset($instance['placeholder'])) {
			$placeholder = $instance['placeholder'];
		} else {
			$placeholder = 'جستجو';
		}
?>
		<p>
			<label for="<?php echo $this->get_field_id('title') ?>">عنوان:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('title') ?>" name="<?php echo $this->get_field_name('title') ?>" type="text" value="<?php echo esc_attr($title) ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('placeholder') ?>">متن نگه دارنده:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('placeholder') ?>" name="<?php echo $this->get_field_name('placeholder') ?>" type="text" value="<?php echo esc_attr($placeholder) ?>" />
		</p>
		<?php }

	public function update($new_instance, $old_instance)
	{
		$instance = array();
		$instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
		$instance['placeholder'] = (!empty($new_instance['placeholder'])) ? strip_tags($new_instance['placeholder']) : '';
		return $instance;
	}
}

// Creating blog categories widget
class blogCategoriesWidget extends WP_Widget
{
	function __construct()
	{
		parent::__construct('blog_categories_widget', 'پیدو گیم: نمایش دسته بندی های وبلاگ');
	}

	public function widget($args, $instance)
	{
		$title = apply_filters('widget_title', $instance['title']);
		$number = $instance['number'];
		$count = $instance['count'];
		echo $args['before_widget'];
		$categories = get_categories(array(
			'orderby'	=>	'count',
			'order'   	=>	'DESC',
			'number'	=>	$number
		));
		echo '<div class="mb-16">';
		if (!empty($title)) echo $args['before_title'] . '<h4 class="mb-7">' . $title . '</h4>' . $args['after_title'];
		foreach ($categories as $category) : ?>
			<div class="d-flex flex-stack fw-bold fs-5 text-muted mb-4">
				<a href="<?php echo get_category_link($category->term_id) ?>" class="text-muted text-hover-primary pe-2"><?php echo $category->name ?></a>
				<?php if (!$count) : ?>
					<div class="m-0 ss02"><?php echo $category->category_count ?></div>
				<?php endif ?>
			</div>
		<?php endforeach;
		echo '</div>';
		echo $args['after_widget'];
	}

	public function form($instance)
	{
		if (isset($instance['title'])) {
			$title = $instance['title'];
		} else {
			$title = 'دسته بندی ها';
		}
		if (isset($instance['number'])) {
			$number = $instance['number'];
		} else {
			$number = 5;
		}
		if (isset($instance['count'])) {
			$count = $instance['count'];
		} else {
			$count = false;
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title') ?>">عنوان:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('title') ?>" name="<?php echo $this->get_field_name('title') ?>" type="text" value="<?php echo esc_attr($title) ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('number') ?>">تعداد برای نمایش:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('number') ?>" name="<?php echo $this->get_field_name('number') ?>" type="number" value="<?php echo esc_attr($number) ?>" />
		</p>
		<p>
			<input type="checkbox" class="widefat" id="<?php echo $this->get_field_id('count') ?>" name="<?php echo $this->get_field_name('count') ?>" <?php checked($count, 'on') ?>>
			<label for="<?php echo $this->get_field_id('count') ?>">مخفی سازی تعداد نوشته ها</label>
		</p>
		<?php }

	public function update($new_instance, $old_instance)
	{
		$instance = array();
		$instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
		$instance['number'] = (!empty($new_instance['number'])) ? strip_tags($new_instance['number']) : '';
		$instance['count'] = $new_instance['count'];
		return $instance;
	}
}

// Creating blog last posts widget
class blogLastPostsWidget extends WP_Widget
{
	function __construct()
	{
		parent::__construct('blog_last_posts_widget', 'پیدو گیم: نمایش نوشته های اخیر وبلاگ');
	}

	public function widget($args, $instance)
	{
		$title = apply_filters('widget_title', $instance['title']);
		$number = $instance['number'];
		echo $args['before_widget'];
		echo '<div class="mb-16">';
		if (!empty($title)) echo $args['before_title'] . '<h4 class="mb-7">' . $title . '</h4>' . $args['after_title'];
		$recentPosts = wp_get_recent_posts(array(
			'numberposts'	=>	$number,
			'post_status'	=>	'publish'
		));
		foreach ($recentPosts as $post) : ?>
			<div class="d-flex align-items-center mb-7">
				<a href="<?php echo get_permalink($post['ID']) ?>">
					<div class="symbol symbol-60px symbol-2by3 me-4">
						<div class="symbol-label" style="background-image: url('<?php echo get_the_post_thumbnail_url($post['ID']) ?>')"></div>
					</div>
				</a>
				<div class="m-0">
					<a href="<?php echo get_permalink($post['ID']) ?>" class="text-dark fw-bolder text-hover-primary fs-6"><?php echo $post['post_title'] ?></a>
					<span class="text-gray-600 fw-bold d-block pt-1 fs-7 ss02">در <?php echo get_the_time('d M Y', $post['ID']); ?></span>
				</div>
			</div>
		<?php endforeach;
		echo '</div>';
		echo $args['after_widget'];
	}

	public function form($instance)
	{
		if (isset($instance['title'])) {
			$title = $instance['title'];
		} else {
			$title = 'نوشته های اخیر';
		}
		if (isset($instance['number'])) {
			$number = $instance['number'];
		} else {
			$number = 4;
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title') ?>">عنوان:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('title') ?>" name="<?php echo $this->get_field_name('title') ?>" type="text" value="<?php echo esc_attr($title) ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('number') ?>">تعداد برای نمایش:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('number') ?>" name="<?php echo $this->get_field_name('number') ?>" type="number" value="<?php echo esc_attr($number) ?>" />
		</p>
		<?php }

	public function update($new_instance, $old_instance)
	{
		$instance = array();
		$instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
		$instance['number'] = (!empty($new_instance['number'])) ? strip_tags($new_instance['number']) : '';
		return $instance;
	}
}

// Creating last products widget
class lastProductsWidget extends WP_Widget
{
	function __construct()
	{
		parent::__construct('last_products_widget', 'پیدو گیم: نمایش آخرین محصولات');
	}

	public function widget($args, $instance)
	{
		$title = apply_filters('widget_title', $instance['title']);
		$number = $instance['number'];
		echo $args['before_widget'];
		echo '<div class="mb-16">';
		if (!empty($title)) echo $args['before_title'] . '<h4 class="mb-7">' . $title . '</h4>' . $args['after_title'];
		$myArgs = array(
			'post_type'      	=>	'product',
			'posts_per_page'	=>	$number,
			'post_status'		=>	'publish'
		);
		$products = new WP_Query($myArgs);
		while ($products->have_posts()) : $products->the_post();
			global $product;
			$rating = $product->get_average_rating() * 2;
			switch (true) {
				case $rating == 0:
					$rating = 'بدون امتیاز';
					$badgeColor = 'dark';
					break;

				case $rating < 4:
					$rating .= '<i class="far fa-star text-primary ms-1 fs-9"></i>';
					$badgeColor = 'primary';
					break;

				case $rating < 7:
					$rating .= '<i class="far fa-star text-warning ms-1 fs-9"></i>';
					$badgeColor = 'warning';
					break;

				case $rating <= 10:
					$rating .= '<i class="far fa-star text-success ms-1 fs-9"></i>';
					$badgeColor = 'success';
					break;
			} ?>
			<div class="d-flex align-items-center mb-7">
				<a href="<?php the_permalink() ?>">
					<div class="symbol symbol-60px symbol-2by3 me-4">
						<div class="symbol-label" style="background-image: url('<?php echo get_the_post_thumbnail_url() ?>')"></div>
					</div>
				</a>
				<div class="m-0">
					<a href="<?php the_permalink() ?>" class="text-dark fw-bolder text-hover-primary fs-6"><?php the_title() ?></a>
					<span class="badge badge-light-<?php echo $badgeColor ?> ss02"><?php echo $rating ?></span>
					<span class="text-gray-600 fw-bold d-block pt-1 fs-7 ss02"><?php echo $product->get_price_html() ?></span>
				</div>
			</div>
		<?php endwhile;
		echo '</div>';
		echo $args['after_widget'];
	}

	public function form($instance)
	{
		if (isset($instance['title'])) {
			$title = $instance['title'];
		} else {
			$title = 'آخرین محصولات';
		}
		if (isset($instance['number'])) {
			$number = $instance['number'];
		} else {
			$number = 4;
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title') ?>">عنوان:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('title') ?>" name="<?php echo $this->get_field_name('title') ?>" type="text" value="<?php echo esc_attr($title) ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('number') ?>">تعداد برای نمایش:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('number') ?>" name="<?php echo $this->get_field_name('number') ?>" type="number" value="<?php echo esc_attr($number) ?>" />
		</p>
		<?php }

	public function update($new_instance, $old_instance)
	{
		$instance = array();
		$instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
		$instance['number'] = (!empty($new_instance['number'])) ? strip_tags($new_instance['number']) : '';
		return $instance;
	}
}

// Creating selling products widget
class sellingProductsWidget extends WP_Widget
{
	function __construct()
	{
		parent::__construct('selling_products_widget', 'پیدو گیم: نمایش پر فروش ترین محصولات');
	}

	public function widget($args, $instance)
	{
		$title = apply_filters('widget_title', $instance['title']);
		$number = $instance['number'];
		echo $args['before_widget'];
		echo '<div class="mb-16">';
		if (!empty($title)) echo $args['before_title'] . '<h4 class="mb-7">' . $title . '</h4>' . $args['after_title'];
		$myArgs = array(
			'post_type'      	=>	'product',
			'posts_per_page'	=>	$number,
			'meta_key' 			=>	'total_sales',
			'orderby'			=>	'meta_value_num',
			'post_status'		=>	'publish'
		);
		$products = new WP_Query($myArgs);
		while ($products->have_posts()) : $products->the_post();
			global $product;
			$rating = $product->get_average_rating() * 2;
			switch (true) {
				case $rating == 0:
					$rating = 'بدون امتیاز';
					$badgeColor = 'dark';
					break;

				case $rating < 4:
					$rating .= '<i class="far fa-star text-primary ms-1 fs-9"></i>';
					$badgeColor = 'primary';
					break;

				case $rating < 7:
					$rating .= '<i class="far fa-star text-warning ms-1 fs-9"></i>';
					$badgeColor = 'warning';
					break;

				case $rating <= 10:
					$rating .= '<i class="far fa-star text-success ms-1 fs-9"></i>';
					$badgeColor = 'success';
					break;
			} ?>
			<div class="d-flex align-items-center mb-7">
				<a href="<?php the_permalink() ?>">
					<div class="symbol symbol-60px symbol-2by3 me-4">
						<div class="symbol-label" style="background-image: url('<?php echo get_the_post_thumbnail_url() ?>')"></div>
					</div>
				</a>
				<div class="m-0">
					<a href="<?php the_permalink() ?>" class="text-dark fw-bolder text-hover-primary fs-6"><?php the_title() ?></a>
					<span class="badge badge-light-<?php echo $badgeColor ?> ss02"><?php echo $rating ?></span>
					<span class="text-gray-600 fw-bold d-block pt-1 fs-7 ss02"><?php echo $product->get_price_html() ?></span>
				</div>
			</div>
		<?php endwhile;
		echo '</div>';
		echo $args['after_widget'];
	}

	public function form($instance)
	{
		if (isset($instance['title'])) {
			$title = $instance['title'];
		} else {
			$title = 'پر فروش ترین محصولات';
		}
		if (isset($instance['number'])) {
			$number = $instance['number'];
		} else {
			$number = 4;
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title') ?>">عنوان:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('title') ?>" name="<?php echo $this->get_field_name('title') ?>" type="text" value="<?php echo esc_attr($title) ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('number') ?>">تعداد برای نمایش:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('number') ?>" name="<?php echo $this->get_field_name('number') ?>" type="number" value="<?php echo esc_attr($number) ?>" />
		</p>
	<?php }

	public function update($new_instance, $old_instance)
	{
		$instance = array();
		$instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
		$instance['number'] = (!empty($new_instance['number'])) ? strip_tags($new_instance['number']) : '';
		return $instance;
	}
}

// Load custom widgets
function loadWidgets()
{
	register_widget('blogSearchWidget');
	register_widget('blogCategoriesWidget');
	register_widget('blogLastPostsWidget');
	register_widget('lastProductsWidget');
	register_widget('sellingProductsWidget');
}
add_action('widgets_init', 'loadWidgets');

// Filter content images
function replaceImages($content)
{
	$post = new DOMDocument();
	libxml_use_internal_errors(true);
	$post->loadHTML('<?xml encoding="utf-8" ?>' . $content);
	libxml_clear_errors();
	$imgs = $post->getElementsByTagName('img');
	foreach ($imgs as $img) {
		if ($img->parentNode->hasAttribute('data-src')) continue;
		$aClass = $img->parentNode->getAttribute('class');
		$img->parentNode->setAttribute('class', $aClass . ' d-block overlay');
		$img->parentNode->setAttribute('data-fslightbox', 'lightbox-basic');
	};
	return $post->saveHTML();
}

add_filter('the_content', 'replaceImages');

// Add filter checkbox
function getAttributeFilter($attributeName, $i)
{
	global $post;
	$postId = isset($_POST['post_id']) ? absint($_POST['post_id']) : $post->ID;
	$attributeName = strtolower(sanitize_title($attributeName));
	$val = get_post_meta($postId, 'attribute_' . $attributeName . '_filter_' . $i, true);
	return !empty($val) ? $val : false;
}

function addProductAttributeFilter($attribute, $i = 0)
{
	$value = getAttributeFilter($attribute->get_name(), $i); ?>
	<tr>
		<td>
			<label>
				<input type="hidden" name="attribute_filter[<?php echo esc_attr($i); ?>]" value="0" />
				<input type="checkbox" class="checkbox" <?php checked($value, true); ?> name="attribute_filter[<?php echo esc_attr($i); ?>]" value="1" />
				نمایش در فیلترها
			</label>
		</td>
	</tr>
	<?php
}
add_action('woocommerce_after_product_attribute_settings', 'addProductAttributeFilter', 10, 2);

function ajaxWoocommerceSaveAttributes()
{
	check_ajax_referer('save-attributes', 'security');
	parse_str($_POST['data'], $data);
	$postId = absint($_POST['post_id']);
	if (array_key_exists('attribute_filter', $data) && is_array($data['attribute_filter'])) {
		foreach ($data['attribute_filter'] as $i => $val) {
			$attrName = sanitize_title($data['attribute_names'][$i]);
			$attrName = strtolower($attrName);
			update_post_meta($postId, 'attribute_' . $attrName . '_filter_' . absint($i), wc_string_to_bool($val));
		}
	}
}
add_action('wp_ajax_woocommerce_save_attributes', 'ajaxWoocommerceSaveAttributes', 0);


function dd($dd)
{
	wp_die(var_dump($dd));
}

add_action('woocommerce_add_to_cart', function () {
	add_action('myalarm', function () {

	?>
		<div class="alert alert-dismissible bg-info d-flex flex-column flex-sm-row w-100 p-5 mb-10">
			<!--begin::Icon-->
			<!--begin::Svg Icon | path: icons/duotune/general/gen007.svg-->
			<span class="svg-icon svg-icon-2hx svg-icon-light me-4 mb-5 mb-sm-0">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
					<path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="black"></path>
					<path d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z" fill="black"></path>
				</svg>
			</span>
			<!--end::Svg Icon-->
			<!--end::Icon-->
			<!--begin::Content-->
			<div class="d-flex flex-column text-light pe-0 pe-sm-10">
				<h4 class="mb-2 text-light">تبریک</h4>
				<span>محصول شما با موفقیت به سبد خرید اضافه شد.</span>
			</div>
			<a href="<?= home_url('cart/') ?>" class="btn btn-light-info m-2">مشاهده سبد خرید</a>

			<!--end::Content-->
			<!--begin::Close-->
			<button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
				<!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
				<span class="svg-icon svg-icon-2x svg-icon-light">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
						<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black"></rect>
						<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black"></rect>
					</svg>
				</span>
				<!--end::Svg Icon-->
			</button>
			<!--end::Close-->
		</div>
<?php
	});
});


add_filter('wc_add_to_cart_message_html', '__return_false');




// add_filter('woocommerce_checkout_fields', 'addBootstrapToCheckoutFields' );
//  function addBootstrapToCheckoutFields($fields) {
//     foreach ($fields as &$fieldset) {
//         foreach ($fieldset as &$field) {
//             $field['input_class'][] = 'form-control form-control-solid';
//         }
//     }
//     return $fields;
// }


add_filter('woocommerce_form_field_args', 'wc_form_field_args', 10, 3);

function wc_form_field_args($args, $key, $value = null)
{



	switch ($args['type']) {

		case "select":  /* Targets all select input type elements, except the country and state select input types */
			$args['class'][] = 'form-group'; // Add a class to the field's html element wrapper - woocommerce input types (fields) are often wrapped within a <p></p> tag  
			$args['input_class'] = array('form-select', 'form-select-solid'); // Add a class to the form input itself
			//$args['custom_attributes']['data-plugin'] = 'select2';
			$args['label_class'] = array('control-label');
			$args['custom_attributes'] = array('data-control' => 'select2', 'data-allow-clear' => 'true', 'aria-hidden' => 'true',);
			break;

		case 'country': /* By default WooCommerce will populate a select with the country names - $args defined for this specific input type targets only the country select element */
			$args['class'][] = 'form-group single-country';
			$args['input_class'] = array('form-select', 'form-select-solid'); // Add a class to the form input itself
			$args['label_class'] = array('control-label');
			$args['custom_attributes'] = array('data-control' => 'select2', 'data-allow-clear' => 'true', 'aria-hidden' => 'true',);
			break;

		case "state": /* By default WooCommerce will populate a select with state names - $args defined for this specific input type targets only the country select element */
			$args['class'][] = 'form-group'; // Add class to the field's html element wrapper 
			$args['input_class'] = array('form-select', 'form-select-solid'); // Add a class to the form input itself
			//$args['custom_attributes']['data-plugin'] = 'select2';
			$args['label_class'] = array('control-label');
			$args['custom_attributes'] = array('data-control' => 'select2', 'data-allow-clear' => 'true', 'aria-hidden' => 'true',);
			break;


		case "password":
		case "text":
		case "email":
		case "tel":
		case "number":
			$args['class'][] = 'form-group';
			//$args['input_class'][] = 'form-control input-lg'; // will return an array of classes, the same as bellow
			$args['input_class'] = array('form-control', 'form-control-solid');
			$args['label_class'] = array('control-label');
			break;

		case 'textarea':
			$args['input_class'] = array('form-control', 'form-control-solid');
			$args['label_class'] = array('control-label');
			break;

		case 'checkbox':
			break;

		case 'radio':
			break;

		default:
			$args['class'][] = 'form-group';
			$args['input_class'] = array('form-control', 'form-control-solid');
			$args['label_class'] = array('control-label');
			break;
	}

	return $args;
}


remove_action('woocommerce_cart_is_empty', 'wc_empty_cart_message', 10);
add_action('woocommerce_cart_is_empty', 'custom_empty_cart_message', 10);

function custom_empty_cart_message()
{
	$html  = '<div class="woocommerce-info alert alert-dismissible bg-light-primary border border-primary border-dashed d-flex flex-column flex-sm-row w-100 p-5 mb-10"><div class="d-flex flex-column pe-0 pe-sm-10" style="margin-right: 3rem">';
	$html .= wp_kses_post(apply_filters('wc_empty_cart_message', __('Your cart is currently empty.', 'woocommerce')));
	echo $html . '</div></div>';
}




//نمایش دیتا در سبد خرید
function add_cf_after_cart_item_name($name_html, $cart_item, $cart_item_key)
{
	if (!isset($cart_item['meta_data_cart'])) {
		return $name_html;
	}
	if (!empty($cart_item['meta_data_cart'])) {
		foreach ($cart_item['meta_data_cart'] as $item) {
			if (isset($item['status'])) {
				$val = number_format($item['value']) . ' تومان ';
			} else {
				$val = $item['value'];
			}
			$name_html .= 		"<br>" . $item['title'] . ' : ' .  $val;
		}
	}
	return $name_html;
}
add_filter('woocommerce_cart_item_name', 'add_cf_after_cart_item_name', 10, 3);


//اضافه کردن دیتا به سبد خرید
// function kia_add_cart_item_data($cart_item, $product_id)
// {
// 	$cart_item['meta_data_cart'] = [
// 		'name' => 'دستگاه',
// 		'device' => 'پلی استیشن'
// 	];
// 	return $cart_item;
// }
// add_filter('woocommerce_add_cart_item_data', 'kia_add_cart_item_data', 10, 2);


// ذخیره دیتا بعد از پرداخت
add_action('woocommerce_checkout_create_order_line_item', 'save_cart_item_custom_meta_as_order_item_meta', 10, 4);
function save_cart_item_custom_meta_as_order_item_meta($cart_item, $cart_item_key, $values, $order)
{
	if (!isset($values['meta_data_cart'])) {
		return;
	}
	if (!empty($values['meta_data_cart'])) {
		foreach ($values['meta_data_cart'] as $item) {
			if (isset($item['status'])) {
				$val = number_format($item['value']) . ' تومان ';
			} else {
				$val = $item['value'];
			}
			$cart_item->update_meta_data($item['title'], $val);
		}
	}
}



function ti_custom_javascript()
{
	wp_enqueue_script('plswb-js', get_template_directory_uri() . '/assets/js/plswb-js.js', '', '', true);
}
add_action('wp_enqueue_scripts', 'ti_custom_javascript',);


add_action('wp_ajax_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');
add_action('wp_ajax_nopriv_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');

function woocommerce_ajax_add_to_cart()
{

	$product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
	$quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
	$variation_id = absint($_POST['variation_id']);
	// This is where you extra meta-data goes in
	$cart_item_data = $_POST['meta'];
	// $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
	$product_status = get_post_status($product_id);

	// wp_send_json( [
	// 	'data' => $product_id
	// ] );

	// Remember to add $cart_item_data to WC->cart->add_to_cart
	if (WC()->cart->add_to_cart($product_id, $quantity, $variation_id, array(), $cart_item_data) && 'publish' === $product_status) {

		do_action('woocommerce_ajax_added_to_cart', $product_id);

		if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
			wc_add_to_cart_message(array($product_id => $quantity), true);
		}

		WC_AJAX::get_refreshed_fragments();
	} else {

		$data = array(
			'error' => true,
			'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id)
		);

		echo wp_send_json($data);
	}

	wp_die();
}

add_action('woocommerce_before_calculate_totals', 'set_cutom_cart_item_price', 20, 1);
function set_cutom_cart_item_price($cart)
{



	if (is_admin() && !defined('DOING_AJAX'))
		return;

	if (did_action('woocommerce_before_calculate_totals') >= 2)
		return;

	$cart_content = $cart->get_cart();



	foreach ($cart_content as $cart_item) {

		if (!isset($cart_item['meta_data_cart'])) {
			return;
		}
		foreach ($cart_item['meta_data_cart'] as $value) {
			if (isset($value['status'])) {
				$total_price[] = $value['value'];
			}
		}

		$base_price = $cart_item['data']->get_price();
		if (isset($total_price) && !empty($total_price)) {
			$new_total_price = array_sum($total_price) + (int)$base_price;
		} else {
			$new_total_price = $base_price;
		}
		$cart_item['data']->set_price($new_total_price);
		unset($total_price);
	}
}


add_filter('woocommerce_get_price_html', 'custom_price_format', 10, 2);
add_filter('woocommerce_variable_price_html', 'custom_price_format', 10, 2);
function custom_price_format($price, $product)
{

	// 1. Variable products
	if ($product->is_type('variable')) {

		// Searching for the default variation
		$default_attributes = $product->get_default_attributes();
		// Loop through available variations
		foreach ($product->get_available_variations() as $variation) {
			$found = true; // Initializing
			// Loop through variation attributes
			foreach ($variation['attributes'] as $key => $value) {
				$taxonomy = str_replace('attribute_', '', $key);
				// Searching for a matching variation as default
				if (isset($default_attributes[$taxonomy]) && $default_attributes[$taxonomy] != $value) {
					$found = false;
					break;
				}
			}
			// When it's found we set it and we stop the main loop
			if ($found) {
				$default_variaton = $variation;
				break;
			} // If not we continue
			else {
				continue;
			}
		}
		// Get the default variation prices or if not set the variable product min prices
		// $regular_price = isset($default_variaton) ? $default_variaton['display_price']: $product->get_variation_regular_price( 'min', true );
		// $sale_price = isset($default_variaton) ? $default_variaton['display_regular_price']: $product->get_variation_sale_price( 'min', true );
		$regular_price = $product->get_variation_regular_price('min', true);
		$sale_price = $product->get_variation_sale_price('max', true);
	}
	// 2. Other products types
	else {
		$regular_price = $product->get_regular_price();
		$sale_price    = $product->get_sale_price();
	}

	// Formatting the price
	if ($regular_price !== $sale_price && $product->is_on_sale()) {



		// Percentage calculation and text
		$percentage = round(($regular_price - $sale_price) / $regular_price * 100) . '%';
		$percentage_txt = __(' Save', 'woocommerce') . ' ' . $percentage;

		// $price = '<del class="badge badge-danger">' . wc_price($regular_price) . '</del> <ins>' . wc_price($sale_price) . $percentage_txt . '</ins>';
		$price = '<div class=" fs-5 px-4 py-2"><del>' . wc_price($regular_price) . ' </del>  </div><div class="badge badge-success fs-5 px-4 py-2">' . wc_price($sale_price) . '</div>';
	} else {
		if ($sale_price == 0) {
			if ($regular_price == 0) {
				$price = '<div class=" fs-5 px-4 py-2">' . 'رایگان' . '</div>';
				return $price;
			}

			$price = '<div class=" fs-5 px-4 py-2">' . wc_price($regular_price) . '</div>';
			return $price;
		}
		$price = '<div class=" fs-5 px-4 py-2">' . wc_price($regular_price) . '</div><div class=" fs-5 px-4 py-2">' . wc_price($sale_price) . '</div>';
	}
	return $price;
}



function fx_check($pid, $vid)
{

	$arg = array(
		'post_type' => 'extra_fields_plswb',
		'post_status' => 'publish',
		'posts_per_page' => -1,
	);

	$fields_plswb = new WP_Query($arg);
	if ($fields_plswb->have_posts()) {
		while ($fields_plswb->have_posts()) {
			$fields_plswb->the_post();
			$display_rules = get_post_meta(get_the_ID(), "all_products_show_rules", true);
			$extra_fields = get_post_meta(get_the_ID(), "plswb_fields", true);

			if (is_null($vid)) {
				$variation_ids[] = $pid;
			} else {
				foreach ($display_rules as $product_id) {
					$variations = new WC_Product_Variable($product_id);
					foreach ($variations->get_children() as  $v_id) {
						$variation_ids[] = $v_id;
					}
				}
			}

			$variation_ids = array_unique($variation_ids);
			if (is_null($vid)) {
				$vid = $pid;
			}

			foreach ($extra_fields as $item) {
				if ($item['disable_org_show_products_rules']) {
					foreach ($item['inside_show_products_rules'] as $show_product_id) {
						$variation_id = $show_product_id;
						$product = wc_get_product($variation_id);
						if ($product->is_type('variation')) {
							$show_inside_rule_products_ids[] = $variation_id;
						} else {
							$variations = new WC_Product_Variable($variation_id);
							foreach ($variations->get_children() as  $vn_id) {
								$show_inside_rule_products_ids[] = $vn_id;
							}
							$show_inside_rule_products_ids[] = $vid;
						}
						foreach ($show_inside_rule_products_ids as $variation_id) {
							if ($variation_id == $vid && in_array($pid, $display_rules)) {
								$new_extra_fields[] = $item;
							}
						}
						$show_inside_rule_products_ids = [];
					}

					foreach ($new_extra_fields as $item) {
						if (count($item['not_show_products_rules']) > 0) {

							foreach ($item['not_show_products_rules'] as $not_show_product_id) {
								$not_variation_id = $not_show_product_id;
								$variation_unset_ids = $variation_ids;
	
								$product = wc_get_product($not_variation_id);
								if ($product->is_type('variation')) {
									$pos = array_search($not_variation_id, $variation_ids);
									if ($pos !== false) {
										unset($variation_unset_ids[$pos]);
									}
								} else {
									$variations = new WC_Product_Variable($not_variation_id);
									
									foreach ($variations->get_children() as  $vn_id) {
										$pos = array_search($vn_id, $variation_ids);
										if ($pos !== false) {
											unset($variation_unset_ids[$pos]);
										}
									}
									
									$pos = array_search($vid, $variation_ids);
									if ($pos !== false) {
										unset($variation_unset_ids[$pos]);
									}
	
								}
							}
	
							foreach ($variation_unset_ids as $variation_id) {
								if ($variation_id == $vid && in_array($pid, $display_rules)) {
									$new_extra_fields[] = $item;
								}
							}
						} else {
							foreach ($variation_ids as $variation_id) {
								if ($variation_id == $vid && in_array($pid, $display_rules)) {
									$new_extra_fields[] = $item;
								}
							}
						}
					}


				} else {
					if (count($item['not_show_products_rules']) > 0) {

						foreach ($item['not_show_products_rules'] as $not_show_product_id) {
							$not_variation_id = $not_show_product_id;
							$variation_unset_ids = $variation_ids;

							$product = wc_get_product($not_variation_id);
							if ($product->is_type('variation')) {
								$pos = array_search($not_variation_id, $variation_ids);
								if ($pos !== false) {
									unset($variation_unset_ids[$pos]);
								}
							} else {
								$variations = new WC_Product_Variable($not_variation_id);
								
								foreach ($variations->get_children() as  $vn_id) {
									$pos = array_search($vn_id, $variation_ids);
									if ($pos !== false) {
										unset($variation_unset_ids[$pos]);
									}
								}

								$pos = array_search($vid, $variation_ids);
								if ($pos !== false) {
									unset($variation_unset_ids[$pos]);
								}


							}
						}

						foreach ($variation_unset_ids as $variation_id) {
							if ($variation_id == $vid && in_array($pid, $display_rules)) {
								$new_extra_fields[] = $item;
							}
						}
					} else {
						foreach ($variation_ids as $variation_id) {
							if ($variation_id == $vid && in_array($pid, $display_rules)) {
								$new_extra_fields[] = $item;
							}
						}
					}
				}
			}
		}
		wp_reset_postdata();
	}

	return $new_extra_fields;
}
