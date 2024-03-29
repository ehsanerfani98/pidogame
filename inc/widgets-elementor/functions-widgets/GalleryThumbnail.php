<?php
class GalleryThumbnail extends \Elementor\Widget_Base
{

	public function get_name()
	{
		return 'GalleryThumbnail';
	}

	public function get_title()
	{
		return esc_html__('گالری', 'elementor-addon');
	}

	public function get_icon()
	{
		return 'eicon-gallery-justified';
	}

	public function get_categories()
	{
		return ['plussweb-category'];
	}

	public function get_keywords()
	{
		return ['گالری پیدوگیم', 'گالری'];
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
		

		$this->end_controls_section();

		// Content Tab End


		// Style Tab Start

		// $this->start_controls_section(
		// 	'section_title_style',
		// 	[
		// 		'label' => esc_html__('Title', 'elementor-addon'),
		// 		'tab' => \Elementor\Controls_Manager::TAB_STYLE,
		// 	]
		// );

		// $this->add_control(
		// 	'title_color',
		// 	[
		// 		'label' => esc_html__('Text Color', 'elementor-addon'),
		// 		'type' => \Elementor\Controls_Manager::COLOR,
		// 		'selectors' => [
		// 			'{{WRAPPER}} .hello-world' => 'color: {{VALUE}};',
		// 		],
		// 	]
		// );

		// $this->end_controls_section();

		// Style Tab End

	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
?>
			<?= do_shortcode('[gallery-thumbnail term_id="' . $settings['category'] . '"]') ?>
<?php
	}
}
