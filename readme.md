[comment]: CLI-remove-start

# Plugin template

This repo is used as a template for swup plugins. Steps to publish your own swup plugin:

1. Make a copy of this repo.
2. Update the name in _package.json_. Please, follow format `swup-[plugin name]-plugin`.
3. Update the description, repository url and author in _package.json_.
4. Write your plugin in `src/index.js`. Plugin must be in a form of class, must extend `@swup/plugin` and should have a property name defined (`package.json` name in a form PascalCase - _swup-name-plugin_ -> _SwupNamePlugin_).
5. Update this documentation. Below is a documentation template where the _SwupNamePlugin_ needs to be replaced with your plugin name from packages.json in PascalCase.
6. Use `npm run build` to compile a standalone version of your plugin (_dist_ folder) and `npm run compile` to transpile npm version of your plugin (_lib_ folder). Both commands are run before publishing automatically.
7. Publish your plugin to npm with `npm publish` command. This assumes you have npm account and are logged in with your computers CLI.

## Tips

- Checkout existing plugins before creating one.
- Swup instance is automatically assigned to the plugin instance and can be accessed under `this.swup` in `mount`/`unmount` methods.
- If you feel like this should be an official swup plugin (under npm `@swup` organization) and the world could use a thing like this, contact me at gmarcuk@gmail.com.

---

[comment]: CLI-remove-end

# Swup [Plugin Name] Plugin

## Instalation

This plugin can be installed with npm

```bash
npm install swup-[plugin-name]-plugin
```

and included with import

```javascript
import Swup[PluginName]Plugin from 'swup-[plugin-name]-plugin';
```

or included from the dist folder

```html
<script src="./dist/SwupNamePlugin.js"></script>
```

## Usage

To run this plugin, include an instance in the swup options.

```javascript
const swup = new Swup({
  plugins: [new SwupNamePlugin()]
});
```
