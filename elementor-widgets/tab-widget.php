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
		return 'Tab Widget';
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
			[
                'label' => __( 'Tab Settings', 'elementor-tab-widget' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
		);

		// <i class="fa fa-check" aria-hidden="true">

		$this->add_control(
			'tabs',
			[
				'label' => __( 'Tabs Items', 'elementor-tab-widget' ),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'tab_title' => __( 'Default Tab #1', 'elementor-tab-widget' ),
						'tab_description' => __( 'I am tab content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor' ),
					],
					[
						'tab_title' => __( 'Default Tab #2', 'elementor-tab-widget' ),
						'tab_description' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo. I am tab content. Click edit button to change this text.', 'elementor' ),
					],
				],
				'fields' => [
					[
						'name' => 'tab_title',
						'label' => __( 'Tab Title', 'elementor-tab-widget' ),
						'type' => Controls_Manager::TEXT,
						'default' => __( 'Tab Title', 'elementor-tab-widget' ),
						'placeholder' => __( 'Tab Title', 'elementor-tab-widget' ),
						'label_block' => true,
					],
					[
						'name' => 'tab_description',
						'label' => __( 'Tab Description', 'elementor-tab-widget' ),
						'type' => Controls_Manager::WYSIWYG,
						'default' => __( 'Tab Description', 'elementor-tab-widget' ),
						'placeholder' => __( 'Tab Content', 'elementor-tab-widget' ),
						'show_label' => false,
					],
					[
						'name' => 'tab_link_url',
						'label' => __( 'Button URL', 'elementor-tab-widget' ),
						'type' => Controls_Manager::URL,
						'placeholder' => __( 'https://your-link.com', 'elementor-tab-widget' ),
						'show_external' => true,
						'default' => [
							'url' => '#',
							'is_external' => true,
							'nofollow' => true,
						],
					],
					[
						'name' => 'tab_link_text',
						'label' => __( 'Button Text', 'elementor-tab-widget' ),
						'type' => Controls_Manager::TEXT,
						'default' => __( 'Button Text', 'elementor-tab-widget' ),
						'placeholder' => __( 'My Link', 'elementor-tab-widget' ),
						'label_block' => true,
					],
					[
						'name' => 'tab_image',
						'label' => __( 'Choose Image', 'elementor-tab-widget' ),
						'type' => Controls_Manager::MEDIA,
						'default' => [
							'url' => Utils::get_placeholder_image_src(),
						],
					]
				],

				'title_field' => '{{{ tab_title }}}',
			]
		);

		$this->add_control(
			'view',
			[
				'label' => __( 'View', 'elementor-tab-widget' ),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'traditional',
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
		$tabs = $this->get_settings( 'tabs' );
		$id_int = substr( $this->get_id_int(), 0, 3 );
		?>

		<div class="tab-container">
			<div class="tabs">
				<button class="tab is-selected" data-theme="digimon">
					Digimon
				</button>
				<button class="tab" data-theme="pokemon">
					Pokemon
				</button>
				<button class="tab" data-theme="tamagotchi">
					Tamagotchi
				</button>
			</div>

			<div class="tab-contents">
				<section class="tab-content is-selected" data-theme="digimon">
					<div class="tab-content__left">
						<h2>Digimon</h2>
						<p>
							Digimon, short for "Digital Monsters", is a Japanese media franchise
							encompassing virtual pet toys, anime, manga, video games, films and
							a trading card game. The franchise focuses on Digimon creatures,
							which are monsters living in a "Digital World", a parallel universe
							that originated from Earth's various communication networks.
						</p>
						<div><a href="https://en.wikipedia.org/wiki/Digimon">More about Digimon</a></div>
					</div>
					<div class="tab-content__right">
						<img src="https://images.pexels.com/photos/2312369/pexels-photo-2312369.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="digimon" />
					</div>
					<div class="clr"></div>
				</section>

				<section class="tab-content" data-theme="pokemon">
					<div>
						<h2>Pokémon</h2>
						<p>
							Pokémon also known as Pocket Monsters in Japan, is a media franchise
							managed by The Pokémon Company, a Japanese consortium between
							Nintendo, Game Freak, and Creatures. The franchise copyright is
							shared by all three companies, but Nintendo is the sole owner of the
							trademark.
						</p>
						<div><a href="https://en.wikipedia.org/wiki/Pokémon">More about Pokémon</a></div>
					<div>
					<div>
						<img src="https://images.pexels.com/photos/4974915/pexels-photo-4974915.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="digimon" />
					</div>
					<div class="clr"></div>
				</section>

				<section class="tab-content" data-theme="tamagotchi">
					<div>
						<h2>Tamagotchi</h2>
						<p>
							The Tamagotchi is a handheld digital pet, created in Japan by
							Akihiro Yokoi of Bandai. It was released by Bandai on November 23,
							1996 in Japan and May 1, 1997 in the rest of the world, quickly
							becoming one of the biggest toy fads of the 1990s and early 2000s.
							As of 2010, over 76 million Tamagotchis had been sold worldwide.
						</p>
						<div><a href="https://en.wikipedia.org/wiki/Tamagotchi">More about Tamagotchi</a></div>
					<div>
					<div>
						<img src="https://images.pexels.com/photos/4050318/pexels-photo-4050318.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="digimon" />
					</div>
					<div class="clr"></div>
				</section>
			</div>
		</div>
		<?php
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
	}

}