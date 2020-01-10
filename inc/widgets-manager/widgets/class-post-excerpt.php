<?php
/**
 * Elementor Classes.
 *
 * @package header-footer-elementor
 */

namespace HFE\WidgetsManager\Widgets;

use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Plugin;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;   // Exit if accessed directly.
}

/**
 * HFE Post Excerpt widget
 *
 * HFE widget for Post Excerpt.
 *
 * @since x.x.x
 */
class Post_Excerpt extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since x.x.x
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'post-excerpt';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since x.x.x
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Post Excerpt', 'header-footer-elementor' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since x.x.x
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'fas fa-search';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since x.x.x
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'hfe-widgets' ];
	}

	/**
	 * Register Post Excerpt controls.
	 *
	 * @since x.x.x
	 * @access protected
	 */
	protected function _register_controls() {
		$this->register_content_post_excerpt_controls();	
		$this->register_styling_post_excerpt_controls();
	}

	/**
	 * Register Post Excerpt General Controls.
	 *
	 * @since x.x.x
	 * @access protected
	 */
	protected function register_content_post_excerpt_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Excerpt', 'header-footer-elementor' ),
			]
		);

		$this->add_control(
			'custom_excerpt',
			array(
				'label'        => __( 'Custom Excerpt', 'uael' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'uael' ),
				'label_off'    => __( 'Hide', 'uael' ),
				'return_value' => 'yes',
				'default'      => 'no',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Register Post Excerpt Styling Controls.
	 *
	 * @since x.x.x
	 * @access protected
	 */
	protected function register_styling_post_excerpt_controls() {

		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Style', 'header-footer-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_color',
			[
				'label'     => __( 'Text Color', 'header-footer-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .hfe-post-excerpt-content' => 'color: {{VALUE}};',
				],
				'scheme'    => [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'scheme' =>Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .hfe-post-excerpt-content',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Post Excerpt output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since x.x.x
	 * @access protected
	 */
	protected function render() {

		$this->add_render_attribute( 'post-excerpt-content', 'class', 'hfe-post-excerpt-content' );

		$title_html = sprintf( '<%1$s %2$s>%3$s</%1$s>', 'div', $this->get_render_attribute_string( 'post-excerpt-content' ), get_the_excerpt() );

		echo $title_html;
	}
}