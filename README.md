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

## 🚧 Work in progress
This plugin is work in progress and not tested accross multiple use cases. Use at own risk. Thank you for any bug reports and pull requests!

**To do**
- [ ] check if there is a page with the slug `maintenance`, if yes, display that page
- [ ] allow pages to be ignored via field or blueprint option
- [ ] publish as composer package and add to plugins repo on getkirby.com