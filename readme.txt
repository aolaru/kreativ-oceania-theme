=== Kreativ Core ===
Contributors: andreiolaru
Requires at least: 6.4
Tested up to: 7.1
Requires PHP: 7.4
Stable tag: 1.0.23
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

== Privacy ==

Kreativ Core does not set cookies or send visitor data to external services. The optional dark mode preference is stored only in the visitor's browser localStorage under the `kreativ-dark` key.

== Upgrade Notice ==

= 1.0.22 =

Prevents navigation from covering content, improves large-menu behavior, and adds a visible header search submit button.

= 1.0.21 =

Wide pages now use a broader reading measure, standard pages use a tighter header rhythm, and the desktop dark-mode control is less visually intrusive.

= 1.0.20 =

Improves dark-mode homepage contrast, clarifies mobile navigation state, and keeps the appearance control out of the content area on phones.

= 1.0.19 =

Refines archive and search cards with compact typography, fixed-ratio media, and clearer page-result labels.

= 1.0.18 =

Prevents the header fallback navigation from expanding with nested pages and scopes its menu styles to Kreativ Core.

= 1.0.17 =

Adds dedicated archive handling, generic fixed-ratio post-card media, improved landmarks and multi-level navigation, and earlier accessible dark-mode initialization.

== Changelog ==

= 1.0.22 =

* changed the primary header to sticky positioning and removed the fixed body offset
* moved custom header images outside the navigation header and widened the mobile navigation breakpoint
* improved multi-level menu behavior, header title overflow, search submission, and RTL metadata

= 1.0.21 =

* broadened the content measure for the Wide page template
* tightened the header spacing on standard pages
* refined the desktop dark-mode toggle size, spacing, and hover treatment

= 1.0.20 =

* uses theme color tokens for the homepage so dark mode remains readable and visually consistent
* moves the mobile dark-mode control into the fixed header to avoid obscuring content
* adds active navigation styling, changes the expanded mobile menu label to Close menu, and styles native content forms and tables

= 1.0.19 =

* added fixed-ratio thumbnail and neutral fallback media to archive and search cards
* reduced archive and search heading and card density for long titles and varied content
* labels page results as pages rather than displaying post publication metadata

= 1.0.18 =

* scoped header navigation styles to Kreativ Core, constrained the no-menu fallback to top-level pages, guarded empty archive pagination output, improved single-post media presentation, and refined related-post and submenu layouts

= 1.0.17 =

* added a dedicated archive template with archive titles, descriptions, and pagination
* corrected posts-page headings and the main-content landmark structure
* replaced logo post-image fallbacks with neutral fixed-ratio placeholders
* added multi-level menu support with accessible mobile submenu toggles
* removed legacy marketplace code and duplicate editor stylesheet loading
* improved dark mode accessibility and removed its initial light-mode flash

= 1.0.16 =

* removed repository-control files from the distributable theme package

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

Kreativ Core screenshot asset
Copyright 2026 Andrei Olaru
License: GPL-2.0-or-later
Source: bundled with this theme

K logo SVG
Copyright 2026 Andrei Olaru
License: GPL-2.0-or-later
Source: bundled with this theme
