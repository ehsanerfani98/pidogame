<?php
class Products extends \Elementor\Widget_Base
{

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

		foreach ($categories as $item) {
			$category[$item->term_id] = $item->name;
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
				'type' => \Elementor\Controls_Manager::TEXT,
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

		/**************/

		$this->start_controls_section(
			'section_start_card',
			[
				'label' => esc_html__('تنظیمات کارت ویژه', 'elementor-addon'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'status_card',
			[
				'label' => 'نمایش کارت',
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => 'روشن',
				'label_off' => 'خاموش',
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'icon_card',
			[
				'label' => esc_html__('آیکن کارت', 'elementor-addon'),
				'type' => \Elementor\Controls_Manager::ICONS,
			]
		);

		$this->add_control(
			'title_card',
			[
				'label' => esc_html__('متن مشاهده همه', 'elementor-addon'),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		
		$this->add_control(
			'title_card',
			[
				'label' => esc_html__('لینک مشاهده همه', 'elementor-addon'),
				'type' => \Elementor\Controls_Manager::URL,
			]
		);

		$this->add_control(
			'content_card',
			[
				'label' => esc_html__('متن کارت', 'elementor-addon'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
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

		// $this->end_controls_section();

		// Style Tab End

	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();

		$product_ids = implode(',', $settings['product_ids']);
?>
			<?= do_shortcode('[plswb-products term_id="' . $settings['category'] . '" count="' . $settings['count'] . '" cart_color="' . $settings['cart_color'] . '" cart_button_color="' . $settings['cart_button_color'] . '" card_style="' . $settings['card_style'] . '" orderby="' . $settings['orderby'] . '" status_product_ids="' . $settings['status_product_ids'] . '" product_ids="' . $product_ids . '"]') ?>
<?php
	}
}
