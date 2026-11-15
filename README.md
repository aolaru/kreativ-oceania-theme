# Kreativ Core

A lightweight, responsive WordPress theme for editorial sites, blogs, and content-driven websites.

This repository contains the current private production version of the theme, including recent cleanup for stronger accessibility, responsive image handling, and more general-purpose branding so it can be used beyond the original KREATIV site.

## Highlights

- Sectioned homepage templates for category-driven publishing
- Responsive post thumbnails using native WordPress image markup
- Custom logo support
- Dark mode toggle
- Footer menu support
- Theme option for built-in related posts
- Theme options for homepage featured categories, archive presentation, footer text, and accent color
- Six Gutenberg patterns for editorial storytelling, case studies, quotes, and newsletter calls to action
- Journal, Studio, and Portfolio design variations
- Supports WordPress Site Icons configured in `Appearance > Customize > Site Identity`

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
2. Activate `Kreativ Core` from `Appearance > Themes`.
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
- `Blog archive heading`
- `Blog archive introduction`
- `Accent color`
- `Archive spacing`
- `Design variation`

If `Featured category slugs` is left empty, the homepage templates automatically use the most active categories.

## Patterns

Open the block inserter and choose the `Kreativ` category to add an editorial introduction, feature story, project case study, pull quote, newsletter invitation, or general callout. The patterns use core blocks only, so they can be edited without a companion plugin.

## Repository Notes

- Main stylesheet and theme header: [style.css](style.css)
- Main theme logic: [functions.php](functions.php)
- Main sectioned homepage template: [template-filter-all.php](template-filter-all.php)

## Recent Cleanup

Recent work in this repository included:

- removal of old dead assets and code paths
- cleanup of built-in related posts behavior
- refreshed screenshot and logo fallback asset
- accessibility improvements including skip links and visible focus states
- responsive image performance improvements
- generalization of branding and homepage logic for broader reuse
- removal of the legacy framework stylesheet in favor of a small theme-owned layout layer
- matching block-editor typography, colors, and content widths
- a native Gutenberg pattern library and curated design variations

## Development

Run these local release checks before creating a package:

```bash
find . -type f -name '*.php' -not -path './vendor/*' -print0 | xargs -0 -n1 php -l
find js -type f -name '*.js' -print0 | xargs -0 -n1 node --check
rg -U '\r$' --glob '*.php' --glob '*.css' --glob '*.js' --glob '*.txt' --glob '*.md' --glob '*.pot' .
git diff --check
```

These validate PHP syntax, JavaScript syntax, LF line endings, and whitespace errors in the Git diff. Run Theme Check separately in a WordPress installation before a WordPress.org submission.

## License

GPL-2.0-or-later. See [license.txt](license.txt).

## Bundled Resources

- Theme screenshot and logo fallback assets: Copyright 2026 Andrei Olaru, GPL-2.0-or-later.
- K logo SVG: Copyright 2026 Andrei Olaru, GPL-2.0-or-later.
