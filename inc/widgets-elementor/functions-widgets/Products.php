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


		// Content Tab Start
		$this->start_controls_section(
			'section_category',
			[
				'label' => esc_html__('دسته بندی', 'elementor-addon'),
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
		// $this->add_control(
		// 	'is_background',
		// 	[
		// 		'label' => esc_html__('پس زمینه اصلی', 'elementor-addon'),
		// 		'type' => \Elementor\Controls_Manager::SELECT,
		// 		'default' => array_key_first($category),
		// 		'options' => [
		// 			'true' => 'فعال',
		// 			'false' => 'غیر فعال'
		// 		],
		// 	]
		// );

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
?>
			<?= do_shortcode('[plswb-products term_id="' . $settings['category'] . '" count="' . $settings['count'] . '" cart_color="' . $settings['cart_color'] . '" cart_button_color="' . $settings['cart_button_color'] . '"]') ?>
<?php
	}
}
