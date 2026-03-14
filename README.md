# Kreativ Oceania Theme

A lightweight, responsive WordPress theme for editorial sites, blogs, and content-driven websites.

This repository contains the current private production version of the theme, including recent cleanup for stronger accessibility, responsive image handling, and more general-purpose branding so it can be used beyond the original KREATIV site.

## Highlights

- Sectioned homepage templates for category-driven publishing
- Responsive post thumbnails using native WordPress image markup
- Custom logo support
- Dark mode toggle
- Footer menu support
- Theme option for built-in related posts
- Theme options for homepage featured categories, footer text, and schema social links
- Refreshed favicon, app icon, and social image assets

## Theme Scope

The theme is now suitable for:

- Editorial websites
- Content-driven blogs
- Magazine-style category archives
- Private or client WordPress themes
- WordPress.com custom theme uploads on plugin-enabled plans

The repository has been cleaned up to remove older marketplace-specific templates and bundled proprietary font assets so the package is closer to WordPress.org submission expectations.

## Requirements

- WordPress 6.x recommended
- PHP 8.0+ recommended

## Installation

### Self-hosted WordPress

1. Copy the theme folder into `wp-content/themes/`.
2. Activate `Kreativ Oceania Theme` from `Appearance > Themes`.
3. Assign menus in `Appearance > Menus`.
4. Optionally set a custom logo in `Appearance > Customize > Site Identity`.

### WordPress.com

1. Create a zip of the theme folder.
2. Upload it from `Appearance > Themes > Install Theme` on a plugin-enabled WordPress.com plan.
3. Activate the theme and configure logo, menus, and homepage content.

## Recommended Setup

For the best result:

1. Create a primary menu.
2. Create a footer menu.
3. Add a site title, tagline, and logo.
4. Publish posts across several categories.
5. Set a static front page using either `Editorial Home` or `Sectioned Home` if you want the category grid homepage.

## Customizer Options

The theme currently exposes these options:

- `Show theme related posts on single posts`
- `Featured category slugs`
- `Footer text`
- `Organization social profile URLs`

If `Featured category slugs` is left empty, the homepage templates automatically use the most active categories.

## Repository Notes

- Main stylesheet and theme header: [style.css](style.css)
- Main theme logic: [functions.php](functions.php)
- Main sectioned homepage template: [template-filter-all.php](template-filter-all.php)

## Recent Cleanup

Recent work in this repository included:

- removal of old dead assets and code paths
- cleanup of built-in related posts behavior
- refreshed screenshot and icon set
- accessibility improvements including skip links and visible focus states
- responsive image performance improvements
- generalization of branding and homepage logic for broader reuse

## Development

Useful local checks:

```bash
php -l functions.php
php -l header.php
php -l footer.php
```

For broader validation, lint any edited PHP templates before packaging a release zip.

## License

GPL-2.0-or-later. See [license.txt](license.txt).
