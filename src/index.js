import Plugin from '@swup/plugin';

export default class SwupHighlightCurrentPagePlugin extends Plugin {
	name = 'SwupHighlightCurrentPagePlugin';

	constructor() {
		super();
		/**
		 * Exectuted each time an instance of this plugin is created.
		 * Can be used for things that don't rely on access to the swup instance.
		 */
	}

	mount() {
		/**
		 * Executed when swup is initialized with this plugin.
		 * You can use this.swup here to access the swup instance.
		 *
		 * example: this.swup.on('clickLink', this.handleLinkClick)
		 */
	}

	unmount() {
		/**
		 * Executed when a swup instance with this plugin is disabled.
		 * You can use this.swup here to access the swup instance.
		 * Make sure to undo any changes your plugin might have applied to the
		 * swup instance and remove event listeners here.
		 *
		 * example: this.swup.off('clickLink', this.handleLinkClick)
		 */
	}
}
