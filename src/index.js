import Plugin from '@swup/plugin';

export default class SwupPluginNamePlugin extends Plugin {
	name = 'Swup[PluginName]Plugin';

	constructor() {
		super();
		// this gets run when the instance is created
		// and can be used for things that don't need
		// to wait for swup instance
	}

	mount() {
		// this is executed when swup is enabled with plugin
		// you can use this.swup here to access swup instance
		// example: this.swup.on('clickLink', this.handleLinkClick)
	}

	unmount() {
		// this is executed when swup with plugin is disabled
		// you can use this.swup here to access swup instance
		// make sure to undo any changes and remove event listeners
		// example: this.swup.off('clickLink', this.handleLinkClick)
	}
}
