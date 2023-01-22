# Kirby Maintenance Mode Plugin

This plugin uses the `route:before` hook to hide the whole website from logged out visitors when `option('maintenance')` is set to `true`. It also sends a `503` code.

Kirby urls like `assets`, `api`, `media`, `panel` are will be ignored.

There are different ways to control the maintenance mode:

## Via option

```php
// site/config.php
return [
    'maintenance' => true,
    'moritzebeling.kirby-maintenance' => [
        'ignore' => [],
        'css' => false,
        'text' => 'This website is currently under maintenance and will be back online soon.',
    ]
];
```

## Via panel

Add a field `maintenance` to the `site.yml` blueprint to meet the condition `$site->maintenance()->isTrue()`.

Via `$site->maintenance_text()` you could edit the text that would welcome any logged out website visitor.

You can also use one of the prefabricated blueprint parts:

- `tabs/maintenance`
- `sections/maintenance`
- `fields/maintenance`
- `fields/maintenance_text`

## Add style

With the `moritzebeling.kirby-maintenance.css` option you could add a stylesheet, e.g.:

```css
/* /assets/css/meintenance.css */
body {
    width: 100%;
    height: 100%;
    margin: 0;
    padding: 1rem;
    display: flex;
    text-align: center;
    justify-content: center;
    align-items: center;
}
.message {
    max-width: 500px;
}
```

## 🚧 Work in progress
This plugin is work in progress and not tested accross multiple use cases. Use at own risk. Thank you for any bug reports and pull requests!

**Ideas for future development**
- [ ] Check if there is a page with the slug `maintenance`, if yes, display that page
- [ ] Allow pages to be ignored via field or blueprint option