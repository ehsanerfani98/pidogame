<?php
class Products extends \Elementor\Widget_Base
{

	public $category_ids = [];

	public function get_name()
	{
		return 'SliderThumbnail';
	}

	public function get_title()
	{
		return esc_html__('محصولات', 'elementor-addon');
	}

	public function get_icon()
	{
		return 'eicon-thumbnails-down';
	}

	public function get_categories()
	{
		return ['plussweb-category'];
	}

	public function get_keywords()
	{
		return ['محصولات'];
	}

	protected function register_controls()
	{

		$categories = get_terms(
			array(
				'taxonomy' => 'product_cat',
				'hide_empty' => false,
				// 'parent' => 0,
			)
		);

		$category['all'] = 'همه دسته بندی ها';

		foreach ($categories as $item) {
			$category[$item->term_id] = $item->name;
			$this->category_ids[] = $item->term_id;
		}


		$args = array(
			'post_type'        => 'product',
			'posts_per_page'   => -1,
			"post_status" => "publish"
		);
		$query = new WP_Query($args);
		if ($query->have_posts()) {
			while ($query->have_posts()) {
				$query->the_post();
				$product_ids[get_the_ID()] = get_the_title();
			}
			wp_reset_postdata();
		}


		// Content Tab Start


		$this->start_controls_section(
			'section_category',
			[
				'label' => esc_html__('تنظیمات محصول', 'elementor-addon'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'category',
			[
				'label' => esc_html__('انتخاب دسته', 'elementor-addon'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => array_key_first($category),
				'options' => $category,
			]
		);

		$this->add_control(
			'count',
			[
				'label' => esc_html__('تعداد محصولات', 'elementor-addon'),
				'type' => \Elementor\Controls_Manager::NUMBER,
			]
		);

		$this->add_control(
			'card_style',
			[
				'label' => esc_html__('استایل محصول', 'elementor-addon'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'original',
				'options' => [
					'original' => 'استایل اصلی',
					'festival' => 'استایل جشنواره'
				],
			]
		);

		$this->add_control(
			'status_product',
			[
				'label' => esc_html__('نوع محصول', 'elementor-addon'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => 'جدیدترین ها',
					'total_sales' => 'پر فروش ترین ها',
					'_wc_average_rating' => 'محبوب ترین ها',
					'_sale_price' => 'محصولات تخفیف خورده'
				],
			]
		);

		$this->add_control(
			'orderby',
			[
				'label' => esc_html__('ترتیب نمایش', 'elementor-addon'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'ASC',
				'options' => [
					'ASC' => 'صعودی',
					'DESC' => 'نزولی'
				],
			]
		);

		$this->add_control(
			'status_slider',
			[
				'label' => 'غیر فعال کردن اسلایدر',
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => 'روشن',
				'label_off' => 'خاموش',
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'display_auto',
			[
				'label' => 'نمایش خودکار',
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => 'روشن',
				'label_off' => 'خاموش',
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'display_column',
			[
				'label' => 'نمایش تک ستون',
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => 'روشن',
				'label_off' => 'خاموش',
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'count_column',
			[
				'label' => 'تعداد ستون',
				'type' => \Elementor\Controls_Manager::NUMBER,
			]
		);

		$this->add_control(
			'status_product_ids',
			[
				'label' => 'نمایش بر اساس شناسه محصول',
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => 'روشن',
				'label_off' => 'خاموش',
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'product_ids',
			[
				'label' => esc_html__('انتخاب محصول', 'plugin-name'),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => $product_ids,
				'default' => [],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_rule_product',
			[
				'label' => esc_html__('قوانین کارت محصول', 'elementor-addon'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'rule_price',
			[
				'label' => 'نمایش قیمت',
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => 'خاموش',
				'label_off' => 'روشن',
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'rule_title_fa',
			[
				'label' => 'نمایش عنوان فارسی',
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => 'خاموش',
				'label_off' => 'روشن',
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'rule_title_en',
			[
				'label' => 'نمایش عنوان لاتین',
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => 'خاموش',
				'label_off' => 'روشن',
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'rule_button',
			[
				'label' => 'نمایش دکمه خرید',
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => 'خاموش',
				'label_off' => 'روشن',
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'rule_percent',
			[
				'label' => 'نمایش درصد تخفیف',
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => 'خاموش',
				'label_off' => 'روشن',
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'rule_timer_off',
			[
				'label' => 'نمایش تایمر تخفیف',
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => 'خاموش',
				'label_off' => 'روشن',
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->end_controls_section();


		// Content Tab End


		// Style Tab Start

		$this->start_controls_section(
			'section_title_style',
			[
				'label' => esc_html__('رنگبندی کارت محصول', 'elementor-addon'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'cart_color',
			[
				'label' => esc_html__('رنگ کارت', 'elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hello-world' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'cart_button_color',
			[
				'label' => esc_html__('رنگ دکمه', 'elementor-addon'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hello-world' => 'color: {{VALUE}};',
				],
			]
		);



		$this->end_controls_section();

		// Style Tab End

	}

	protected function render()
	{
		$category_ids = $this->category_ids;

		$settings = $this->get_settings_for_display();

		$wid = rand(0000000000, 9999999999);
		$term_id = $settings['category'];
		$count = $settings['count'];
		$cart_color = $settings['cart_color'];
		$cart_button_color = $settings['cart_button_color'];
		$card_style = $settings['card_style'];
		$orderby = $settings['orderby'];
		$product_ids = implode(',', $settings['product_ids']);
		$status_product_ids = $settings['status_product_ids'];
		$display_column = $settings['display_column'];
		$count_column = $settings['count_column'];
		$display_auto = $settings['display_auto'];
		$status_slider = $settings['status_slider'];
		$status_product = $settings['status_product'];


		//parameter rule
		$rule_price = $settings['rule_price'];
		$rule_title_fa = $settings['rule_title_fa'];
		$rule_title_en = $settings['rule_title_en'];
		$rule_button = $settings['rule_button'];
		$rule_percent = $settings['rule_percent'];
		$rule_timer_off = $settings['rule_timer_off'];

		include PLSWB_THEME_PATH . '/inc/widgets-elementor/view-widgets/Products_view.php';
	}
}
