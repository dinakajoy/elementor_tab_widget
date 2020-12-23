<?php
/**
 * Elementor Tab Widget.
 *
 * Elementor widget that inserts a customized tab content into the page.
 *
 * @since 1.0.0
 */

namespace Elementor_Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Tab_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'tab-widget';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Tab Widget', 'elementor-tab-widget' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'fa fa-folder';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the tab-widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return array( 'basic' );
	}

	/**
	 * Register tab-widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		$this->start_controls_section(
			'section_tabs',
			array(
				'label' => __( 'Tab Settings', 'elementor-tab-widget' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'tabs',
			array(
				'label'       => __( 'Tabs Items', 'elementor-tab-widget' ),
				'type'        => Controls_Manager::REPEATER,
				'default'     => array(
					array(
						'tab_title'       => __( 'My margins are shrinking', 'elementor-tab-widget' ),
						'tab_description' => __( 'A lot of factors contribute to margin compression - some beyond your dealership\'s control. But you can fight back by tackling inefficiencies that make matters worse.', 'elementor' ),
						'tab_link_text'	=> __( 'Show me where i could be loosing money', 'elementor-tab-widget' )
					),
					array(
						'tab_title'       => __( 'I\'m uncertain about compliances', 'elementor-tab-widget' ),
						'tab_description' => __( 'Compliance slip ups can be costly to your dealerships bottom line and reputation. But it\'s tough to keep up with ever-changing regulations.', 'elementor' ),
						'tab_link_text'		=> __( 'Help me stay compliant', 'elementor-tab-widget' )
					),
				),
				'fields'      => array(
					array(
						'name'        => 'tab_title',
						'label'       => __( 'Tab Title', 'elementor-tab-widget' ),
						'type'        => Controls_Manager::TEXT,
						'default'     => __( 'Tab Title', 'elementor-tab-widget' ),
						'placeholder' => __( 'Tab Title', 'elementor-tab-widget' ),
						'label_block' => true,
					),
					array(
						'name'        => 'tab_description',
						'label'       => __( 'Tab Description', 'elementor-tab-widget' ),
						'type'        => Controls_Manager::WYSIWYG,
						'default'     => __( 'Tab Description', 'elementor-tab-widget' ),
						'placeholder' => __( 'Tab Content', 'elementor-tab-widget' ),
						'show_label'  => false,
					),
					array(
						'name'          => 'tab_link_url',
						'label'         => __( 'Button URL', 'elementor-tab-widget' ),
						'type'          => Controls_Manager::URL,
						'placeholder'   => __( 'https://your-link.com', 'elementor-tab-widget' ),
						'show_external' => true,
						'default'       => array(
							'url'         => '#',
							'is_external' => true,
							'nofollow'    => true,
						),
					),
					array(
						'name'        => 'tab_link_text',
						'label'       => __( 'Button Text', 'elementor-tab-widget' ),
						'type'        => Controls_Manager::TEXT,
						'default'     => __( 'Button Text', 'elementor-tab-widget' ),
						'placeholder' => __( 'My Link', 'elementor-tab-widget' ),
						'label_block' => true,
					),
					array(
						'name'    => 'tab_image',
						'label'   => __( 'Choose Image', 'elementor-tab-widget' ),
						'type'    => Controls_Manager::MEDIA,
						'default' => array(
							'url' => Utils::get_placeholder_image_src(),
						),
					),
				),

				'title_field' => '{{{ tab_title }}}',
			)
		);

		$this->end_controls_section();

		$this->style_tab();
	}

	/**
	 * Widget Style Customization.
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function style_tab() {

		/**
		 * Tab Section Style Settings
		 */
		$this->start_controls_section(
			'tab_section_style',
			[
				'label' => __( 'Tab Section', 'elementor-tab-widget' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		// Margin
		$this->add_responsive_control(
			'tab_margin',
			[
				'label' => __( 'Margin', 'elementor-tab-widget' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom' => 0,
					'left' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .tabs-section' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Padding
		$this->add_responsive_control(
			'tab_padding',
			[
				'label' => __( 'Padding', 'elementor-tab-widgetn' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom' => 0,
					'left' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .tabs-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Border Type
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'tab_border',
				'label' => __( 'Border', 'elementor-tab-widget' ),
				'selector' => '{{WRAPPER}} .tabs-section',
			]
		);

		 // Box Shadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'tab_box_shadow',
				'label' => __( 'Box Shadow', 'elementor-tab-widget' ),
				'selector' => '{{WRAPPER}} .tabs-section',
			]
		);

		// Width
		$this->add_control(
			'tab_width',
			[
				'label' => __( 'Width', 'elementor-tab-widget' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'description' => 'Default: 100%',
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .tabs-section' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Background Color
		$this->add_control(
			'tab_backgorund_color',
			[
				'label' => __( 'Background Color', 'elementor-tab-widget' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'transparent',
				'selectors' => [
					'{{WRAPPER}} .tabs-section ' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		/**
		 * Tab Title Style Settings
		 */
		$this->start_controls_section(
			'tab_title_style',
			[
				'label' => __( 'Tab Title', 'elementor-tab-widget' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		// Title Typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'tab_title_typography',
				'label' => __( 'Typography', 'elementor-tab-widget' ),
				'selector' => '{{WRAPPER}} .tab-title',
			]
		);

		// Padding
		$this->add_responsive_control(
			'tab_title_padding',
			[
				'label' => __( 'Padding', 'elementor-tab-widgetn' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => 7,
					'right' => 0,
					'bottom' => 7,
					'left' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .tab-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Border Type
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'tab_title_border',
				'label' => __( 'Border', 'elementor-tab-widget' ),
				'selector' => '{{WRAPPER}} .tab-title',
			]
		);

		// Box Shadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'tab_title_box_shadow',
				'label' => __( 'Box Shadow', 'elementor-tab-widget' ),
				'selector' => '{{WRAPPER}} .tab-title',
			]
		);

		// Text Color
		$this->add_control(
			'tab_title_text_color',
			[
				'label' => __( 'Text Color', 'elementor-tab-widget' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#333333',
				'selectors' => [
					'{{WRAPPER}} .tab-title' => 'color: {{VALUE}}',
				],
			]
		);

		// Background Color
		$this->add_control(
			'tab_title_backgorund_color',
			[
				'label' => __( 'Background Color', 'elementor-tab-widget' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tab-title' => 'background-color: {{VALUE}}',
				],
			]
		);

		// Active Tab Text Color
		$this->add_control(
			'active_tab_title_text_color',
			[
				'label' => __( 'Active Tab Text Color', 'elementor-tab-widget' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#00599a',
				'selectors' => [
					'{{WRAPPER}} .tab-title.is-selected' => 'color: {{VALUE}}',
				],
			]
		);

		// Active Tab Background Color
		$this->add_control(
			'active_tab_title_backgorund_color',
			[
				'label' => __( 'Active Tab Background Color', 'elementor-tab-widget' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#e0e0e0',
				'selectors' => [
					'{{WRAPPER}} .tab-title.is-selected' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		/**
		 * Tab Content Section Style Settings
		 */
		$this->start_controls_section(
			'tab_content_section_style',
			[
				'label' => __( 'Tab Content Section', 'elementor-tab-widget' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		// Margin
		$this->add_responsive_control(
			'tab_content_margin',
			[
				'label' => __( 'Margin', 'elementor-tab-widget' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom' => 0,
					'left' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .content-section' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Padding
		$this->add_responsive_control(
			'tab_content_padding',
			[
				'label' => __( 'Padding', 'elementor-tab-widgetn' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom' => 0,
					'left' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .content-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Border Type
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'tab_content_border',
				'label' => __( 'Border', 'elementor-tab-widget' ),
				'selector' => '{{WRAPPER}} .content-section',
			]
		);

		 // Box Shadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'tab_content_box_shadow',
				'label' => __( 'Box Shadow', 'elementor-tab-widget' ),
				'selector' => '{{WRAPPER}} .content-section',
			]
		);

		// Width
		$this->add_control(
			'tab_content_width',
			[
				'label' => __( 'Width', 'elementor-tab-widget' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'description' => 'Default: 100%',
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .content-section' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Background Color
		$this->add_control(
			'tab_content_backgorund_color',
			[
				'label' => __( 'Background Color', 'elementor-tab-widget' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'transparent',
				'selectors' => [
					'{{WRAPPER}} .content-section ' => 'background-color: {{VALUE}}',
				],
			]
		);

		/**
		 * Tab Content Style Settings
		 */

		$this->add_control(
			'tab_desc_style',
			[
				'label' => __( 'Tab Content Description', 'elementor-tab-widget' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		// Description Typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'tab_desc_typography',
				'label' => __( 'Typography', 'elementor-tab-widget' ),
				'selector' => '{{WRAPPER}} .tab-desc',
			]
		);

		// Text Color
		$this->add_control(
			'tab_desc_text_color',
			[
				'label' => __( 'Text Color', 'elementor-tab-widget' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#333333',
				'selectors' => [
					'{{WRAPPER}} .tab-desc' => 'color: {{VALUE}}',
				],
			]
		);

		// Background Color
		$this->add_control(
			'tab_desc_backgorund_color',
			[
				'label' => __( 'Background Color', 'elementor-tab-widget' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tab-desc' => 'background-color: {{VALUE}}',
				],
			]
		);

		/**
		 * Tab Button Style Settings
		 */
		$this->add_control(
			'tab_btn_style',
			[
				'label' => __( 'Tab Content Button', 'elementor-tab-widget' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		// Background Color
		$this->add_control(
			'tab_btn_bg_color',
			[
				'label' => __( 'Background Color', 'elementor-tab-widget' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#00599a',
				'selectors' => [
					'{{WRAPPER}} .tab-btn a' => 'background-color: {{VALUE}}',
				],
			]
		);

		// Text Color
		$this->add_control(
			'tab_btn_text_color',
			[
				'label' => __( 'Text Color', 'elementor-tab-widget' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .tab-btn a' => 'color: {{VALUE}}',
				],
			]
		);

		// Background Color On Hover
		$this->add_control(
			'tab_button_hover_bg_color',
			[
				'label' => __( 'Background Color', 'elementor-tab-widget' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#00599a',
				'selectors' => [
					'{{WRAPPER}} .tab-btn a:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		// Text Color On Hover
		$this->add_control(
			'tab_btn_hover_text_color',
			[
 				'label' => __( 'Text Color', 'elementor-tab-widget' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .tab-btn a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		/**
		 * Tab Image Style Settings
		 */
		$this->add_control(
			'tab_img_style',
			[
				'label' => __( 'Tab Content Image', 'elementor-tab-widget' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		// Width
		$this->add_responsive_control(
			'image_width',
			[
				'label' => __( 'Width', 'elementor-tab-widget' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'description' => 'Desfault: 100%',
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .tab-img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Height
		$this->add_responsive_control(
			'image_height',
			[
				'label' => __( 'Height', 'elementor-tab-widget' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'description' => 'Desfault: 230px',
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 230,
				],
				'selectors' => [
					'{{WRAPPER}} .tab-img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Margin
		$this->add_responsive_control(
			'image_margin',
			[
				'label' => __( 'Margin', 'elementor-tab-widget' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom' => 0,
					'left' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .tab-img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Padding
		$this->add_responsive_control(
			'image_padding',
			[
				'label' => __( 'Padding', 'elementor-tab-widget' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom' => 0,
					'left' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .tab-img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Border Type
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'label' => __( 'Border', 'elementor-tab-widget' ),
				'selector' => '{{WRAPPER}} .tab-img',
			]
		);

		// Border Radius
		$this->add_responsive_control(
			'image_border_radius',
			[
				'label' => __( 'Border Radius', 'elementor-tab-widget' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom' => 0,
					'left' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .tab-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		// Box Shadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'image_box_shadow',
				'label' => __( 'Box Shadow', 'elementor-tab-widget' ),
				'selector' => '{{WRAPPER}} .tab-img',
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render tab widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( $settings['tabs'] ) {
			?>

			<section class="tab-container st-container" role="tablist">
				<div class="tabs tabs-section">
					<h4>WHAT ARE YOUR DEALERSHIP'S BIGGEST CHALLENGES</h4>
					<?php
					foreach ( $settings['tabs'] as $index => $item ) {

						// For inline editing.
						$tab_title_setting_key = $this->get_repeater_setting_key( 'tab_title', 'tabs', $index );
						$this->add_inline_editing_attributes( $tab_title_setting_key, 'none' );

						?>

						<button class="tab tab-title <?php echo ( 0 === $index ) ? 'is-selected' : ''; ?>" data-theme="<?php echo esc_attr( $index ); ?>" <?php echo esc_attr( $this->get_render_attribute_string( $tab_title_setting_key ) ); ?>>
							<?php echo esc_html( $item['tab_title'] ); ?>
						</button>
						<?php

					}
					?>
				</div>

				<div class="tab-contents content-section">
					<?php
					foreach ( $settings['tabs'] as $index => $item ) {

						// Button.
						$button_target   = $item['tab_link_url']['is_external'] ? ' target="_blank"' : '';
						$button_nofollow = $item['tab_link_url']['nofollow'] ? ' rel="nofollow"' : '';

						// For inline editing.

						$tab_description_setting_key = $this->get_repeater_setting_key( 'tab_description', 'tabs', $index );
						$this->add_render_attribute(
							$tab_description_setting_key,
							[
								'class' => [ 'tab-desc' ],
							]
						);
						$this->add_inline_editing_attributes( $tab_description_setting_key, 'advanced' );

						$tab_btn_text_setting_key = $this->get_repeater_setting_key( 'tab_link_text', 'tabs', $index );
						$this->add_inline_editing_attributes( $tab_btn_text_setting_key, 'none' );

						?>
						<section class="tab-content <?php echo ( 0 === $index ) ? 'is-selected' : ''; ?>" data-theme="<?php echo esc_attr( $index ); ?>">
							<div class="tab-content__left">
								<div <?php echo esc_attr( $this->get_render_attribute_string( $tab_description_setting_key ) ); ?>><?php echo esc_html( $item['tab_description'] ); ?></div>
								<div class="tab-btn">
									<a href="<?php echo esc_url( $item['tab_link_url']['url'] ); ?>" <?php echo esc_attr( $button_target ); ?> <?php echo esc_attr( $button_nofollow ); ?> alt="<?php echo esc_attr( $item['tab_link_text'] ); ?>" >
										<span <?php echo esc_attr( $this->get_render_attribute_string( $tab_btn_text_setting_key ) ); ?>><?php echo esc_html( $item['tab_link_text'] ); ?></span>
									</a>
								</div>
							</div>
							<div class="tab-content__right img-wrapper">
								<img class="tab-img" src="<?php echo esc_url( $item['tab_image']['url']); ?>" alt="<?php echo esc_attr( $item['tab_title'] ); ?>" />
							</div>
						</section>
					<?php } ?>
				</div>
			</section>

			<section class="tabs-mobile st-container" role="tablist">
				<?php
				foreach ( $settings['tabs'] as $index => $item ) {

					// Button.
					$button_target   = $item['tab_link_url']['is_external'] ? ' target="_blank"' : '';
					$button_nofollow = $item['tab_link_url']['nofollow'] ? ' rel="nofollow"' : '';

					// For inline editing.
					$tab_title_setting_key = $this->get_repeater_setting_key( 'tab_title', 'tabs', $index );
					$this->add_inline_editing_attributes( $tab_title_setting_key, 'none' );

					$tab_description_setting_key = $this->get_repeater_setting_key( 'tab_description', 'tabs', $index );
					$this->add_render_attribute(
						$tab_description_setting_key,
						[
							'class' => [ 'tab-desc' ],
						]
					);
					$this->add_inline_editing_attributes( $tab_description_setting_key, 'advanced' );

					$tab_btn_text_setting_key = $this->get_repeater_setting_key( 'tab_link_text', 'tabs', $index );
					$this->add_inline_editing_attributes( $tab_btn_text_setting_key, 'none' );
					?>
					<div class="tab-mobile content-section">

						<input type="checkbox" id="<?php echo esc_html( $index ); ?>" <?php echo ( 0 === $index ) ? esc_attr( 'checked' ) : ''; ?> />
						<label class="tab-label-mobile tab-title" for="<?php echo esc_html( $index ); ?>">
							<span <?php echo esc_attr( $this->get_render_attribute_string( $tab_title_setting_key ) ); ?>><?php echo esc_html( $item['tab_title'] ); ?></span>
						</label>

						<div class="tab-content-mobile content-section">
							<div class="tab-img-mobile img-wrapper">
								<img class="tab-img" src="<?php echo esc_url( $item['tab_image']['url']); ?>" alt="<?php echo esc_attr( $item['tab_title'] ); ?>" />
							</div>
							<div <?php echo esc_attr( $this->get_render_attribute_string( $tab_description_setting_key ) ); ?>>
								<?php echo esc_html( $item['tab_description'] ); ?>
							</div>
							<div class="tab-btn">
								<a href="<?php echo esc_url( $item['tab_link_url']['url'] ); ?>" <?php echo esc_attr( $button_target ); ?> <?php echo esc_attr( $button_nofollow ); ?> alt="<?php echo esc_attr( $item['tab_link_text'] ); ?>" >
									<span <?php echo esc_attr( $this->get_render_attribute_string( $tab_btn_text_setting_key ) ); ?>><?php echo esc_html( $item['tab_link_text'] ); ?></span>
								</a>
							</div>
						</div>
					</div>
				<?php } ?>
			</section>

			<?php
		}
	}

	/**
	 * Render tab widget output on the editor.
	 *
	 * Written in JavaScript.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _content_template() {
		?>
		<#
		if ( settings.tabs ) {
			#>
			<section class="tab-container st-container" role="tablist">
				<div class="tabs tabs-section">
					<#
					_.each( settings.tabs, function( item, index ) {
						<!-- For inline editing.. -->
						var tabTitleKey = view.getRepeaterSettingKey( 'tab_title', 'tabs', index );
						view.addInlineEditingAttributes( tabTitleKey, 'none' );

						#>
						<# if ( index === 0 ) { #>
						<button class="tab is-selected tab-section" data-theme="{{ index }}">
						<# } else { #>
						<button class="tab tab-title" data-theme="{{ index }}" {{{ view.getRenderAttributeString( tabTitleKey ) }}}>
						<# } #>
							{{{ item.tab_title }}}
						</button>
					<# } ); #>
				</div>

				<div class="tab-contents content-section">
					<#
					_.each( settings.tabs, function( item, index ) {

						<!-- Button. -->
						var link_target = item.tab_link_url.is_external ? ' target="_blank"' : '';
						var link_nofollow = item.tab_link_url.nofollow ? ' rel="nofollow"' : '';

						<!-- For inline editing.. -->
						var tabDescriptionKey = view.getRepeaterSettingKey( 'tab_description', 'tabs', index );
						view.addRenderAttribute(
							tabDescriptionKey,
							{
								'class': [  'tab-desc' ],
							}
						);
						view.addInlineEditingAttributes( tabDescriptionKey, 'advanced' );

						var tabBtnTextKey = view.getRepeaterSettingKey( 'tab_link_text', 'tabs', index );
						view.addInlineEditingAttributes( tabBtnTextKey, 'none' );

						#>
						<# if ( index === 0 ) { #>
						<section class="tab-content is-selected" data-theme="{{ index }}">
						<# } else { #>
						<section class="tab-content" data-theme="{{ index }}">
						<# } #>
							<div class="tab-content__left">
								<div {{{ view.getRenderAttributeString( tabDescriptionKey ) }}}> {{{ item.tab_description }}} </div>
								<div class="tab-btn">
									<a href="{{ item.tab_link_url.url }}" {{ link_target }} {{ link_nofollow }}>
										<span {{{ view.getRenderAttributeString( tabBtnTextKey ) }}}> {{{ item.tab_link_text }}} </span>
									</a>
								</div>
							</div>
							<div class="tab-content__right img-wrapper">
								<img src="{{ item.tab_image.url }}" alt="{{ item.tab_title }}" class="tab-img" />
							</div>
						</section>
					<# } ); #>
				</div>
			</section>

			<section class="tabs-mobile st-container" role="tablist">
				<#
				_.each( settings.tabs, function( item, index ) {

					<!-- Button. -->
					var link_target = item.tab_link_url.is_external ? ' target="_blank"' : '';
					var link_nofollow = item.tab_link_url.nofollow ? ' rel="nofollow"' : '';

					<!-- For inline editing.. -->
					var tabTitleKey = view.getRepeaterSettingKey( 'tab_title', 'tabs', index );
					view.addInlineEditingAttributes( tabTitleKey, 'none' );

					var tabDescriptionKey = view.getRepeaterSettingKey( 'tab_description', 'tabs', index );
					view.addRenderAttribute(
						tabDescriptionKey,
						{
							'class': [  'tab-desc' ],
						}
					);
					view.addInlineEditingAttributes( tabDescriptionKey, 'advanced' );

					var tabBtnTextKey = view.getRepeaterSettingKey( 'tab_link_text', 'tabs', index );
					view.addInlineEditingAttributes( tabBtnTextKey, 'none' );

					#>
					<div class="tab-mobile content-section">
						<# if ( index === 0 ) { #>
						<input type="checkbox" checked id="{{ index }}" />
						<# } else { #>
						<input type="checkbox" id="{{ index }}" />
						<# } #>
						<label class="tab-label-mobile tab-title" for="{{ index }}">
							<span {{{ view.getRenderAttributeString( tabTitleKey ) }}}> {{{ item.tab_title }}} </span>
						</label>

						<div class="tab-content-mobile">
							<div class="tab-img-mobile img-wrapper">
								<img src="{{ item.tab_image.url }}" alt="{{ item.tab_title }}" class="tab-img" />
							</div>
							<div {{{ view.getRenderAttributeString( tabDescriptionKey ) }}}> {{{ item.tab_description }}} </div>
							<div class="tab-btn">
								<a href="{{ item.tab_link_url.url }}" {{ link_target }} {{ link_nofollow }}>
									<span {{{ view.getRenderAttributeString( tabBtnTextKey ) }}}> {{{ item.tab_link_text }}} </span>
								</a>
							</div>
						</div>
					</div>
				<# } ); #>
			</section>

		<# } #>
		<?php
	}

}
