# Kirby Maintenance Mode Plugin

This plugin uses the `route:before` hook to hide the whole website from logged out visitors when `option('maintenance')` is set to `true`.

Kirby urls like `assets`, `api`, `media`, `panel` are will be ignored.

## Settings

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

## 🚧 Work in progress
This plugin is work in progress and not tested accross multiple use cases. Use at own risk. Thank you for any bug reports and pull requests!

**To do**
- [ ] check if there is a page with the slug "maintenance", if yes, display that page
- [ ] allow toggling of maintenance mode via panel system option
- [ ] allow pages to be ignored via field or blueprint option
- [ ] publish as composer package and add to plugins repo on getkirby.com