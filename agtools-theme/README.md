# AG Tools WordPress Theme

`agtools-theme` is a custom, mobile-first WooCommerce theme for AG Tools. It has no page-builder dependency and uses reusable WordPress template parts.

## Install

1. Copy `agtools-theme` into `wp-content/themes/`.
2. Activate **AG Tools** in Appearance → Themes.
3. Install and activate WooCommerce.
4. Create and assign menus to **Primary navigation** and **Footer navigation**.
5. Mark products as featured to populate the homepage product section.

## Development

The browser-ready stylesheet is `assets/css/theme.css`. Source SCSS is modular under `assets/scss/`; compile `assets/scss/style.scss` to the CSS file with your preferred Sass build step.

## Homepage sections

- Hero
- WooCommerce product category grid
- Featured products
- Brand strip
- Benefits
- Newsletter callout
- Footer

No WooCommerce templates are overridden, keeping the theme compatible with WooCommerce updates.
