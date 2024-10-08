# Faith Based Expeditions

A custom child theme of [Pro Theme by Themeco](https://theme.co/pro).

## Getting Started (Developers)

-   Take a look at the `src` folder for all front-end styles/code.
-   Take a look inside the `includes` folder for all PHP related code.

If you're looking to make changes and you're not a developer with Kingdom One, `style.css` and `functions.php` will behave as normal. Edit at your own risk!

-   See further documentation of Pro Theme at https://theme.co/docs.
-   See codebase of this child theme at https://github.com/kingdom-one/faith-based-expeditions

# Changelog

## 1.4.0

-   Added fonts to version control
-   Updated theme.json to use newly added fonts and proper [`theme.json` syntax](https://developer.wordpress.org/themes/global-settings-and-styles/styles/using-presets/#referencing-custom-presets).
-   Updated old references in css to custom font variable to newly registered preset font variable.

## 1.3.2

-   Refactor the `styles` folder to have more directories
-   Update the `summary/details` elements' stylings
-   Added 2 new WP Custom variables, `font-body` and `font-headings`
-   Updated typography to use Roboto for body and Cormorant for headings (as opposed to Cormorant everywhere)

## 1.3.0

-   Added 2 new patterns, Tour Leader and Flight Schedule, to the tours category

## 1.2.3

-   Provide base styling for WordPress `details` block

## 1.2.2

-   Update line height variable in `theme.json` to work better with "Cormorant" serif font.

## 1.2.1

-   Fix the patterns directory

## 1.2.0

-   Add default styling to CF7 Forms
-   Define scss mixins

## 1.1.0

-   Add Bootstrap grid classes (rows and cols) to the utilities file

## 1.0.3

-   update how font family is declared to be less specific

## 1.0.2

-   Define the `alignwide` class to match the `wide size` WP variable set in `theme.json`
-   Define font families for the site.

## 1.0.1

-   Update the Tour Dates block to render shortened date

## 1.0.0

-   Updates phpcs rules
-   Added new `Tour Dates` Block
-   Renamed the `egypt` pattern to `tour-content` and updated the pattern to use the new tour dates block
-   Disable discussion (comments) with code and hide it from admin menus
-   Register 2 new image sizes: `gallery-full` (4k) and `gallery-thumbnail` (600px square.)

## 0.3.0

-   Updated roles to allow only administrators to edit locked blocks.
-   Added `patterns` directory with first `egypt` tour pattern.

## 0.2.0

-   Implemented the Join a Tour redirect with Javascript.

## 0.1.2

-   Mirror WordPress layouts (content and wide sizes) in Cornerstone's layout (`.max` and `.width` classes)
-   Add gutters to the site

## 0.1.1

-   Add `text-wrap:pretty` for progressive enhancement
-   Update breakpoints and reduce bootstrap bundle

## 0.1.0

-   Init repo!
