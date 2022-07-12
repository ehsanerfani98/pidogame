<?php

// Add codestar framework
require_once get_theme_file_path() . '/codestar/codestar-framework.php';
require_once get_theme_file_path() . '/options.php';


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
					$rating .= '<i class="far fa-star text-danger ms-1 fs-9"></i>';
					$badgeColor = 'danger';
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
					$rating .= '<i class="far fa-star text-danger ms-1 fs-9"></i>';
					$badgeColor = 'danger';
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
			<a href="<?= home_url( 'cart/' ) ?>" class="btn btn-info m-2">مشاهده سبد خرید</a>

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
