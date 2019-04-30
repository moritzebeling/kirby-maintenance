import Plugin from '@swup/plugin';

export default class PluginName extends Plugin {
    constructor(){
        super();
        // this gets run when instance is created
        // and can be used for things that don't need
        // to wait for swup instance
    }


    mount() {
        // this is executed when swup is enabled with plugin
        // you can use this.swup here to access swup instance
        // example: this.swup.on('clickLink', event => console.log(event))
    }

    unmount() {
        // this is executed when swup with plugin is disabled
        // you can use this.swup here to access swup instance
    }
}