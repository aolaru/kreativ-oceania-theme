=== Kreativ Core ===
Contributors: andreiolaru
Requires at least: 6.4
Tested up to: 6.9
Requires PHP: 7.4
Stable tag: 1.0.8
License: GPL-2.0-or-later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Tags: blog, portfolio, custom-logo, custom-menu, featured-images, threaded-comments, translation-ready

A lightweight, responsive WordPress theme for editorial sites, blogs, portfolios, and content-driven websites.

== Description ==

Kreativ Core is a clean, flexible theme for publishing-focused WordPress sites.

It includes:

* sectioned homepage templates
* responsive images using native WordPress image markup
* custom logo support
* footer menu support
* optional built-in related posts for single posts
* dark mode
* category-driven editorial layouts

== Installation ==

1. Upload the theme folder to the `/wp-content/themes/` directory.
2. Activate the theme through the `Appearance > Themes` screen in WordPress.
3. Assign a primary menu and, optionally, a footer menu.
4. Set a custom logo in `Appearance > Customize > Site Identity`.
5. Optionally use the `Editorial Home` or `Sectioned Home` page template for a category-driven homepage.

== Frequently Asked Questions ==

= How do I control the homepage sections? =

Use `Appearance > Customize > Theme Options` and set `Featured category slugs` to a comma-separated list. If left empty, the theme uses the most active categories automatically.

= Can I disable the theme related posts section? =

Yes. Use `Appearance > Customize > Theme Options` and disable `Show theme related posts on single posts`.

== Changelog ==

= 1.0.8 =

* removed SEO, social metadata, schema, login customization, and core hook removals from the theme package
* replaced the minified-only distributed stylesheet with a readable compiled stylesheet
* removed ICO assets and aligned theme tags with the WordPress.org allowed tag list

= 1.0.7 =

* removed an outdated script enqueue that pointed to a deleted source asset
* tightened theme metadata and submission packaging details

= 1.0.6 =

* removed marketplace-specific templates and helper files
* removed bundled proprietary font assets and switched to a system font stack
* aligned text domain, readme format, and translation template for WordPress.org submission prep

= 1.0.5 =

* generalized branding and homepage sections
* improved accessibility and responsive image performance
* refreshed theme documentation and icon assets

== License ==

Kreativ Core is licensed under the GPL-2.0-or-later license.

== Resources ==

Kreativ Core screenshot and icon assets
Copyright 2026 Andrei Olaru
License: GPL-2.0-or-later
Source: bundled with this theme

K logo SVG and generated PNG icon variants
Copyright 2026 Andrei Olaru
License: GPL-2.0-or-later
Source: bundled with this theme

Theme CSS in assets/dist/main.css includes Bootstrap-derived CSS components.
Bootstrap Copyright 2011-2018 Twitter, Inc. and The Bootstrap Authors
License: MIT
Source: https://getbootstrap.com/
