=== Kreativ Core ===
Contributors: andreiolaru
Requires at least: 6.4
Tested up to: 7.1
Requires PHP: 7.4
Stable tag: 1.0.15
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
* six Gutenberg patterns for editorial, case-study, quote, and newsletter content
* Journal, Studio, and Portfolio design variations

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

= How do I change the visual style? =

Use `Appearance > Customize > Theme Options` and select a design variation. Journal is the default editorial style, while Studio and Portfolio offer warmer and more structured alternatives.

== Changelog ==

= 1.0.15 =

* updated the author metadata to Kreativ WP and linked the theme to its dedicated Kreativ Core page

= 1.0.14 =

* fixed mobile menu keyboard focus order and focus management
* restored standard page loops and editor content for all page templates
* improved search-result metadata for pages and consolidated duplicate toggle styles

= 1.0.13 =

* added six Gutenberg patterns in the Kreativ pattern category
* added Journal, Studio, and Portfolio design variations in the Customizer

= 1.0.12 =

* removed the legacy framework stylesheet and replaced its required layout primitives with theme-owned CSS
* added editor typography, color palette, and dynamic accent-color support
* improved default color contrast, consolidated taxonomy archive queries, and completed responsive accessibility checks

= 1.0.11 =

* unified post, page, archive, search, author, and error templates around the editorial layout
* added Customizer controls for the archive heading, introduction, accent color, and spacing
* documented local checks for PHP, JavaScript, line endings, and Git whitespace

= 1.0.10 =

* fixed stylesheet loading, responsive navigation, search results, attachment handling, and wide-page content output
* improved output escaping, translation coverage, local storage resilience, and page/post pagination support

= 1.0.9 =

* added standards-based navigation, feed, post-class, comments, and threaded-reply support
* added block editor supports, a callout pattern, and configurable header and background settings
* passed Theme Check and WordPress Theme Test Data validation

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

Kreativ Core, Copyright 2026 Andrei Olaru, is distributed under the terms of the GNU General Public License v2 or later.

== Resources ==

Kreativ Core screenshot and logo fallback assets
Copyright 2026 Andrei Olaru
License: GPL-2.0-or-later
Source: bundled with this theme

K logo SVG and logo fallback PNG
Copyright 2026 Andrei Olaru
License: GPL-2.0-or-later
Source: bundled with this theme
