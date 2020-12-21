/**
 * Plugin scripts.
 *
 * @package Elementor_Tab_Widget
 */

import '../sass/tab.scss';

class WidgetHandlerClass extends elementorModules.frontend.handlers.Base {

	getDefaultSettings() {
		return {
			selectors: {
				tabContainer: '.tab-container',
				tabs: '.tab',
				tabContents: '.tab-content',
			},
		};
	}

	getDefaultElements() {
		const selectors = this.getSettings('selectors');
		return {
			$tabContainer: this.$element.find(selectors.tabContainer),
			$tabs: this.$element.find(selectors.tabs),
			$tabContents: this.$element.find(selectors.tabContents),
		};
	}

	bindEvents() {
		this.elements.$tabs.each(function () {
			$(this).click(function () {
				alert('I worked');
			})
		})
	}
}

jQuery(window).on('load', () => {
	const addHandler = ($element) => {
		elementorFrontend.elementsHandler.addHandler(WidgetHandlerClass, {
			$element,
		});
	};
	// Add our handler to the my-elementor Widget (this is the slug we get from get_name() in PHP)
	elementorFrontend.hooks.addAction('frontend/element_ready/elementor-tab-widget-script.default', addHandler);
});
