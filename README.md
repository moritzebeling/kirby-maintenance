# Kirby Maintenance Mode Plugin

This plugin uses the `route:before` hook to hide the whole website from logged out visitors when `option('maintenance')` is not set to `true`.

All (sub-) routes `maintenance`, `assets`, `api`, `media`, `panel` are will be ignored.

## Settings

```php
// /site/config.php
return [
    'maintenance' => true,
    'moritzebeling.kirby-maintenance' => [
        'ignore' => [],
        'text' => 'This website is currently under maintenance and will be back online soon.',
    ]
];
```

## Todo
- [ ] check if there is a page with the slug "maintenance", if yes, display the page
- [ ] allow toggling of maintenance mode via panel system option
- [ ] allow pages to be ignored via field

## 🚧 Work in progress
This plugin is work in progress and not tested accross multiple use cases. Use at own risk. Thank you for any bug reports and pull requests!