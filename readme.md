# Swup Plugin Template

## Instructions

1. Clone this repository.
2. Update the package name in `package.json`. Make sure to follow the format `swup-[plugin name]-plugin`.
3. Update the description, repository url and author in `package.json`.
4. Add functionality to your plugin in `src/index.js`. It must be a class extending `@swup/plugin`. Make sure to update the class name as well as the `name` property in PascalCase:
`swup-name-plugin` → `SwupNamePlugin`
5. Update this readme and document the features of your plugin. Make sure to replace each `SwupNamePlugin` placeholder with the actual name of your plugin in PascalCase.
6. Run `npm run build` to build a transpiled dist version of the plugin. The build command is run before publishing to npm automatically.
7. Publish your plugin to npm using `npm publish`. This assumes you have an npm account and are logged in via their CLI.

## Tips

- Check out existing plugins before creating a new one.
- The swup instance is automatically assigned to the plugin instance and can be accessed at `this.swup` in the `mount`/`unmount` methods.
- If you think your new plugin has broad appeal and should live in the `@swup` org as an official plugin, get in touch at gmarcuk@gmail.com.

---

# SwupHighlightCurrentPagePlugin

This is a plugin for [swup](https://swup.js.org/) – the complete, flexible, extensible, and easy-to-use page transition library for your server-side rendered website.

Swup plugin for highlighting links to the current page.

## Installation

Install the plugin from npm and import it into your bundle.

```bash
npm install swup-highlight-current-page-plugin
```

```js
import SwupHighlightCurrentPagePlugin from 'swup-highlight-current-page-plugin';
```

Or include the minified production file from a CDN:

```html
<script src="https://unpkg.com/swup-highlight-current-page-plugin@latest"></script>
```

## Usage

To run this plugin, include an instance in the swup options.

```javascript
const swup = new Swup({
  plugins: [new SwupHighlightCurrentPagePlugin()]
});
```
