=== Ajax Search Lite ===
Contributors: wpdreams
Donate link: http://wp-dreams.com
Tags: search, better wordpress search, search plugin, relevance search, widget, Post, ajax search, search filter, wp ajax search, custom fields search, better search, ajax search plugin, wp search, wp search plugin, filter, relevant search plugin, wordpress search, Live Search, shortcode, google, autocomplete, suggest, woocommerce, woocommerce search, product, product search, custom search, ajax, suggest, autosuggest, search autocomplete, live, plugin, sidebar, product tag search, products, woocommerce tag search, WooCommerce Plugin, shop, search by sku, relevant search, highlight, term, image, custom search, ecommerce, Predictive Search, search product, shop, typehead, suggest, instant-search
Requires at least: 3.5
Requires PHP: 7.0
Tested up to: 6.3
Stable tag: 4.11.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A powerful ajax search engine for WordPress. Add a live search form to your site with filters. Custom post types, custom fields, categories supported

== Description ==

**Ajax Search Lite** is a live search plugin for WordPress. This responsive live search engine, which will boost your user experience by providing a user friendly ajax powered search form - a live search bar. You can filter the results with the category and post type filter boxes as well. Google autocomplete and keyword suggestions also included.

Very smooth animations with mobile device support and regular updates. Use **Ajax Search Lite** as a replacement for the default WordPress search with a better looking, more efficient search engine.
Fine-tune the user experience by providing a powerful ajax search plugin to your visitors. Supports custom post types and custom fields and more. Boost your site search engine with this custom built live search engine.

[Live Demo](https://ajaxsearchpro.com) | [Facebook](https://www.facebook.com/wpdreams/) | [Twitter](https://twitter.com/ernest_marcinko)

#### Features List

* Search in **posts** and **pages**
* Search in **custom post types** such as WooCommerce **Products**, **Events**, **Portfolio** items and more
* Search in **title**, **description**, **excerpt**, **categories** and **tags** and any **custom fields**
* Automatic search replacement as well as **widget** and **shortcode** availalbe
* Custom Filter boxes (checkbox filters) for categories and post types
* **WPML** and **QtranslateX** compatible
* 8 built in templates + options for color adjustments
* Retina ready vectorized **SVG** and **CSS3** icons
* Category and post exclusions
* Frontend search settings boxes
* Images in search results
* Fully ajax powered
* **40+ options** on the backend
* Caches images for faster response time
* Performance Options
* **Google analytics integration** - both as **Events** and Pageviews
* Primary and Secondary ordering options
* Highly compatible and responsive

[Demo](https://ajaxsearchpro.com)

#### Support
Feel free to [contact us](https://wordpress.org/support/plugin/ajax-search-lite/) via the support forums.

#### In Pro version

* [Front-end demo](https://ajaxsearchpro.com) | [Back-end demo](https://ajaxsearchpro.com/admin-demo/)
* Search in BuddyPress, BBPress, JigoShop, Woocommerce
* Search in Media Attachments and contents (PDF, Excel, Word, PowerPoint etc..)
* Search in BuddyPress activity feed, users and group names
* Search in PeepSo Groups and Group Activities
* Search result grouping by categories or post types
* Search in custom fields
* Advanced caching technology - image precaching, search phrase caching
* Category filters, custom field filters, post type filters, tag filters, taxonomy term filters and date filters
* Post grouping by category, post type or content type
* Search in comments
* 100+ Themes - Fully configurable and editable - with theme customizer & preview window
* 4 layouts: Vertical, Horizontal, Polaroid and Isotopic (with pagination)
* 400+ Admin options                                                    
* Google keyword suggestions and autocomplete
* Compatibility options and features
* Caching options & Search statistics
* Keyword Highlighting & more...
* Highly compatible and responsive
* [Full Features List](https://ajaxsearchpro.com/features/)


== Installation ==

1. Upload `ajax-search-lite` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Place the shortcode from the settings into your template or post-page

== Frequently asked questions ==

= After an update, the plugin stopped working or the layout is broken =

It is most likely a cache related issue. Make sure to clear all website cache, including page, minify, browser and CDN as well.
After that, refresh your browser window by hitting CTRL + SHIFT + R buttons (CMD + SHIFT + R on Mac) a few times.

= The images are not showing, what is wrong? =

The search parses the first image from the post/page content. Most likely there 
is no image in post.

= When I type in something, the search wheel is spinning, but nothing happens =

It is most likely, that another plugin or the template is throwing errors while the
ajax request is generated. Disabling all the plugins one by one can help you rule out which plugin
is creating the issue.

= I disabled all the plugins but the search wheel is still spinning to infinity, nothing happens =

You should contact me on the support forum with your website url. I will check your website
and will let you know what to do.


== Screenshots ==

1. Ajax Search Lite in action - 2 themes
2. Administrator area - nice and smooth

== Changelog ==
= 4.11.4 =
* Fixed a layout issue with the magnifier icon

= 4.11.3 =
* New shortcode argument: post_parent="1,2,3" - where the search results can be restricted to the list of parent posts (or any other post type IDs). Ex: `[wpdreams_ajaxsearchlite post_parent="1, 2, 3, 4"]`
* Added tabindexes (tabindex=0) to the filters for better navigation
* Moved the magnifier button in the DOM to after the input field
* Greatly improved the custom field search logic and performance
* Changed the default texts in some ARIA labels
* Using the {_sale_price} pseudo variable in [advanced title and content fields](https://documentation.ajaxsearchlite.com/advanced-options/advanced-title-and-content-fields) will check if the item is on sale
* Changed the button inner div tag to a span for validation

= 4.11.2 =
* Fixed an issue with duplicated filter checkbox IDs (label removed, replaced with aria-label) for accessibility
* Changed the "more results" element from an anchor to a span for better compatibility with menu positions
* Added an inline position correction script - when the plugin is placed within a menu, the parent is usually an anchor - in that case the plugin will automatically replace the anchor with a DIV so the layout is valid
* Various cosmetic fixes for the back-end

= 4.11.1 =
* Fixed styling for back-end advanced options tab
* Improved security for custom field search handler and maintenance panel

= 4.11 =
* Added options to change the accessibility "aria" form labels excplicitly
* Changed the live results image containers and added loading="lazy" attribute for native lazy loading support
* Fixed an issue with the "More resulst" link
* Fixed an issue with the google analitycs tracker script
* Adjusted the tabindexes for better compatibility
* Added a nonce for the custom field selector setting for better security
* Removed a large chunk of unused and deprecated code
* Removed the simplebar script
* Removed all the old jQuery legacy scripts

= 4.10.3 =
* Added a few lines of CSS to fix common layout override issues
* Changed the autocomplete field for a negative tabindex, so it is excluded from keyboard navigation
* For better compatibility, changed the javascript response delimiters to not include "!" characters
* Fixed an issue with the japanese ideographic space character
* Fixed an issue with the search box container width
* Fixed an issue, where the plugin width would "jump" whenever placed in a dynamic width element

= 4.10.2 =
* Fixed an issue with the script destructor for the init method
* Updated core .pot translation file

= 4.10.1 =
* Added a new option to change the results box snapping
* Improved Init method - Using intersection observer for the init script instead of the "inViewPort" solution
* Greatly improved the overall script loading method. [Old (~8ms)](https://i.imgur.com/Li6v3jd.png) vs. [New (~0.5ms)](https://i.imgur.com/UAstMci.png)
* Now every existing installation is switched to the new, more powerful non-legacy scripts. The legacy scripts are now deprecated.
* Improved the browser pushstate (back and forward) button behavior
* Scrollbar script disabled and deprecated by default - using modern browser scrollbar styling instead
* Greatly improved the loading of the single font asset
* Fixed the keyboard navigation for the results
* Fixed an issue with the thumbnail generator library
* Fixed a z-index issue when the search was placed in a fixed container
* Fixed an issue with accented characters in the keyword highlighter feature
* Hovering results and settings box positioning - fixed an issue, where the body margin was incorrectly subtracted from the position, when body transformation was not present
* Fixed an issue with accented characters in the keyword highlighter feature

= 4.10 =
* The plugin no longer requires jQuery, it had been reworked to more efficient ES6 standards. By default, the old "legacy" scripts are still in use for existing installations - please see [this documentation](https://documentation.ajaxsearchlite.com/compatibility-settings/javascript-compatibility) on how to change it. It will be automatically changed in a future release.
* Added a [results page live loader](https://documentation.ajaxsearchlite.com/general-options/results-page-live-loader) feature.
* Added an option to change the results window width
* It is now possible to change the date format manually for the live results
* Fixed various minor issues

= 4.9.5 =
* Image parser - now handles array (of images) values from custom field sources
* Scrolling now does not trigger checkbox selection on mobile devices
* Scrollbar script updated to a newer release (IE Edge only support)

= 4.9.4 =
* wp_get_attachment_image_url instead of the wp_get_attachment_url is used for custom field images so the size argument is applied to them
* Fixed the issues with the new widgets screen, the styling should now correctly appear
* Polylang issue fixes - now the results page should respect when the polylang compatibility is turned off
* Keyword suggestions now working correctly
* Polylang - better compatibility when the site language is selected
* Fixed an issue with the script registration process

= 4.9.3 =
* Fixed: image parser now works correctly, when the result descriptions are turned off
* Improved: the plugin script now tries to detect possible loading conflicts or timing issues and tries to resolve them

= 4.9.2 =
* Fixed: Pagination on results page missing
* Fixed: Some strings on the back-end incorrect
* Fixed: Divi visual builder not working

= 4.9.1 =
* Fixed: Category exclusions sometimes caused missing results

= 4.9 =
* Added: Keyword highlighting and scrolling on the single results page
* Added: JS hooks
* Added: Options to change theme colors, result background, results box background, title fonts, description and other fonts
* Added: Ordering - by menu order and by custom field added
* Added: advanced title and content fields
* Added: description context option
* Added: exact match location option
* Added: image options -> background cover
* Added: Advanced Options -> Keyword exceptions tab
* Added: image options -> image filename exclusions
* Changed: Updated the engine and the API from the Pro version
* Changed: jquery.gestures.js removed - not needed anymore
* Compatibility checked against WP 5.7
* Fixed: Posts per page option - changed to "auto" by default, parses the wordpress value if not set
* Fixed: Results keyword highlighter now supports accented/non-accented keywords
* Fixed: Context finder function - fixed an issue when the minimum word length is below the first phrase word lenght, the function returned the incorrect (long) string
* Fixed: Context finder function - now accented and non-accented variations will also work
* Fixed: Russian quotation marks for exact matches are now recognized: «»
* Fixed: wp_localize_script - some uses of that function replaced with an internal solution, to prevent cache plugin incompatibilities
* Fixed: Known possible jQuery.migrate deprecation warnings

= 4.8.6 =
* Added: get_asl_result_field and the_get_asl_result_field functions
* Reset/Wipe options now work correctly
* Issue on multisite results pages
* Fixed missing script files from previous commit

= 4.8.5 =
* Option to exclude Password protected posts
* Exact matching - Full exact matching added (mathing a field exactly, from start to the end)
* asl_load_css, asl_load_js and asl_load_css_js hooks - when returns true, the JS, CSS or both are stopped from loading
* WP 5.6 compatible
* Image parsing on multisite - now automatically tries to fetch the images from across blogs on the results page

= 4.8.4 =
* Option to exclude WooCommerce hidden catalog products
* Fixed issues with the singleton class structures:   https://wordpress.org/support/topic/feature-requests-177/#post-13145770
* Detection the search within dynamically loaded elements - like Elementor pop-ups and similar.
* Removes [embed] shortcodes and embed Gutenberg blocks from the content

= 4.8.3 =
* Better escaping method
* Possible security issue fixed

= 4.8.2 =
* Reworked Google Analytics integration - supporting Events tracking and both Universal and Gtag integration methods

= 4.8.1 =
* Image parser - now the number of image to get from the content can be defined. The parser will check for alternative image attributes as well
* Scrollbar script switched to simplebar
* Results box now supports multiple, adjustable number of columns
* Width options - now adjustable for desktop/mobile/tablet versions
* Multiple jQuery version detection
* WordPress 5.4 compatibility tested
* Some language strings corrected

= 4.8 =
* Basic RTL layout support
* Duplication check - the script now detects and tries to fix duplicate output (ex. menus cloning the search bar) and fixing it's functionality automatically
* Removed some old MS CSS filters (alpha opacity)

= 4.7.26 =
* Date format now follows the WP date format
* Analytics is now correctly triggered only when the search is finished
* Results page results are no longer limited to a maximum of 500
* Polylang translated WooCommerce product variations are now display correctly in the correct language
* New option: Results count per page (General->Behavior), to adjust the results count per page

= 4.7.25 =
* Fixed an issue with the content image parser, that was introduced in the previous release by accident

= 4.7.24 =
* Image parser - now correctly parsing images from post excerpt and contents, even if these fields are not in use

= 4.7.23 =
* Exclude posts - input validation (to prevent extra commas at the end)
* Image parser - now correctly gets the first image from post contents/excerpts, instead of the second

= 4.7.22 =
* Fixed a rapid return key trigger prevention method

= 4.7.21 =
* Added: Search By post/cpt ID
* Added: Searching other post statuses is now possible
* Fix: More robust https detection, as in some cases incorrectly configured site URLs resulted in wrong protocol urls
* Fix: 'Redirect to first result' feature now correctly redirects on both cases

= 4.7.20 =
* Custom CSS box
* Pro and Lite version differences list
* Analytics tracker fix
* Protocolless resource URLs replaced with protocoled version for better compatibility

= 4.7.19 =
* Added OR and AND logic with exact word matches + notice about word boundaries for clarification
* Added a notice for the back-end, when choosing the Post override method, that the plugin may use Cookies to store the pagination and the filter states (functional cookies only)
* Better stripping of CSS and script contents
* Back-end override no longer triggers, when the Post method is enabled
* Analytics tracker - support of 3rd party plugins and the __gaTracker function
* domDocument and multibyte functions check before use

= 4.7.18 =
* Fix - Minification issue causing a scrollbar malfunction fixed

= 4.7.17 =
* Change - Main LIKE query re-worked: better cross-field (title, content etc..) matching, better relevance calculation and faster execution
* Change - Words within double quotes will now be matched exactly (in order), and can be combined with other keywords. For example, entering phrase - "nobel prize" 2018 - will use keywords: "nobel prize" and "2018"
* Change - The default keyword logic set to AND
* Fix - Remaining form title labels moved to aria-label attributes
* Fix - Other minor code bugfixes

= 4.7.16 =
* Input font now can be changed
* Additional theme options: search box background color, icon colors, icon background colors and border
* Theme Chooser option moved to Layout Options -> Search box layout panel
* Theme Chooser option now displays a static preview of the original themes
* WCAG improvements: some title labels replaced with aria-labels instead
* Some redundant options removed from the front-end script, fixing apostrophe related issues

= 4.7.15 =
* New Option: to exclude out-of-stock WooCommerce results
* New option: Exact match location - Starting with, Anywhere, Ending with
* Post type option re-worked for a better layout, merged with the 'Search in posts' and 'Search in pages' options
* By default, the front-end filters are disabled now
* FixURL function now only accepts 2 parameters, for better compabitlity
* jQuery 3+ compatibility
* 'create_function' notice fixed on widget creation (PHP 7 support)

= 4.7.14 =
* Post type and Content type CSS classes to results output + new filter: asl_result_css_class
* The close icon now displays on more occasions
* .label and .option deprecated classes removed (announced in 4.7.12)
* $post().fail(...) handler. Outputs errors to the results box if any.
* The result max height option default value changed to the correct 'none' from 'auto'

= 4.7.13 =
* Redirection location now can be set to a new tab as well
* Max-height attribute to results container (default: auto)
* The magnifier and return redirection/action options have been merged
* The main search input trigger method changed from 'keyup' to 'input' event
* The main query now properly gets cancelled when the override query is executed.
* Fixed container detection - The results and settings container no longer 'jumps' when the search bar is placed in a fixed container.

= 4.7.12 =
* Results templating is available now as in the pro version
* The plugin can remember the last keyword when hitting the browser back button (enable under the Compatibility settings menu)
* .option and .label CSS classes deprecated, replaced by asl_option_inner and .asl_option_label classes (location: front-end drop-down settings)
* Visibility exclusion for older WooCommerce versions (with post meta solution)
* Result keyword highlighter now support unicode character sets on exact word matching

= 4.7.11 =
* WPML compatibility fix, where links sometimes pointed to incorrect location
* asl_print_search_query filter added to the search input text on the results page
* Minification of all front-end CSS files, ~35% space saved
* New CSS classes: asl_w, asl_m, asl_s, asl_r (global class, main box class, settings box class, results box class)

= 4.7.10 =
* Category exclusions issue fixed, where excluded categories caused whole, not affected post types to get excluded
* ACF image field gets parsed correctly when image custom field is selected as image source
* Some more acessibility fixes

= 4.7.9 =
* Added an option to open results in a new tab
* Added accessibility switch for back-end configuration
* Web accessibility fixes in HTML layout (forms, inputs, labels etc..)
* Mobile checkbox trigger fix
* Translation fix for 'No results' text

= 4.7.8 =
* Compatibility settings: Fallback option for old IE (<=8) browsers
* Compatibility settings: Option to disable loading google fonts
* Assets are now loaded protocolless
* :before and :after elements within the form are now forced to invisible (compatibility)
* String translation function now supports qTranslatex

= 4.7.7 =
* Checkbox labels are now clickable
* Input focus and results opening now works if there is no search phrase entered
* Back-end menu links were changed to a nicer URL
* Context find bugfix - where with empty phrase the search might return the full text
* Fixed a bug with WPML where product variations were displayed in incorrect language
* Fixed 3 WooCommerce related error messages
* IOS devices will no longer zoom unexpectedly
* Function keys [F1-F12] will not trigger the search anymore
* PHP Compatibility checker false positive fix: __sleep(), __clone() and __wakeup() magic method overrides removed

= 4.7.6 =
* Nicer URLs on redirection in some cases
* Typo fixes in CSS files
* WooCommerce: Product variation title repetition fix
* WooCommerce: Product variations now respect the parent product status
* WooCommerce: Hidden products now can be excluded (enabled by default)
* Added an exception filter to allow stop plugin loading completely: asl_stop_loading filter
* Content image parser - now converts the content to UTF8 first

= 4.7.5 =
* A category filtering bug fixed
* Better compatibility with ACF

= 4.7.4 =
* Clicking on the input or on empty character input the plugin will open the latest successful result list
* Empty space bar trigger fix
* Mobile submit issue fix
* Phrases matching the start of titles have a much greater relevance now
* Moved the search placeholder text option to the correct tab on the back-end

= 4.7.3 =
* Better context finder
* Custom field options updated to ajax, to prevent issues
* Results page orderby and order query variables respect
* WooCommerce results page price filter and ordering respect
* Mobile device related fixes
* Ajax page loading related fixes
* Custom field based filtering optimizations

= 4.7.2 =
* Featured image source size is adjustable
* Shortcode now functions as menu item
* WooCommerce catalog visibility is now respected
* Mobile bugfix: double tap issue
* WPML translation issue fix

= 4.7.1 =
* Default character count to trigger set to 0
* Node.js and Require.js module loading disabled, as not neccessary.
* Curvy themes, background is white, changed to transparent

= 4.7.0 =
* FROM action tag removed
* qtranslateX comppatibility functions
* Override bugfix, where it was enabled even if disabled
* asl_results execution fix, where it was executed two times, instead of one
* more results link override fix, where it redirected only, without override
* New redirection options for Magnifier and Enter events
* Custom redirection URI scheme option
* Polylang string translations support
* asl_custom_fonts filter to access font inclusions
* asl_layout_in_form action to access form
* GET method is now the default for override
* Session is removed, using COOKIES instead, yumm
* asl_active query variable removed for POST requests

= 4.6.6 =
* Scroll script is now possible to turn off
* Better scroll script compatibility and namespace
* Polylang compatibility implemented
* Image width and height issue solved
* Permalinkg name search implemented
* Fixed an issue with string encodings

= 4.6.5 =
* Category exclusions for objects without assigned terms fix
* WooCommerce form override is now possible (if supported)
* Additional init method for redundancy (window.load)
* Init data moved to div attributes instead of content
* Scrollbar updated to latest version
* Font import removed, using wp_enqueue_style() instead

= 4.6.4 =
* Keyword logic option added (OR, AND)
* Checkbox layout changed to flex
* Allow search in all custom fields option
* Settings no longer hide when search is triggered

= 4.6.3 =
* Session related fixes and optimizations
* Bakc-end script fixes

= 4.6.2 =
* Keyword highlighting implemented
* IE11 back-end fixes
* Removed unused and deprecated files 
* W3C style validation related fix

= 4.6.1 =
* Mobile close button fix
* Mobile keyboard behavior fix 
* QtranslateX compatibility fix
* Initialization fix
* Better back-end script loading
* Debug information fixed

= 4.6.0 =
* Core reworked to a much better structure
* Visual Composer bugfix
* Better shortcode stripping algo
* More performant context finder
* imagecache.class.php file removal
* Animations have been replaced with CSS3 animations
* Primary and Secondary ordering implemented
* Placeholder WPML string translation ready
* Private custom fields are displayed on the back-end now
* Option saving returns to the parent tab
* Search box and results override
* Ajax detection initializer
* Javascript sources & initialization switch
* Width and Margin option
* Results position and width fix for low bar widths

= 4.5.5 =
* New menu: Compatibility Options
* Compatibility allowing to force case sensitive, insensitive, UTF8 and UNICODE queries
* Excerpt search fixed
* CSS fixes, including a placeholder fix
* A new escaping method, supporting more characters

= 4.5.4 =
* Autocomplete and Keyword suggestions introduced
* Keyboard navigation fixes
* 3 new curvy styles
* Animation and navigation fixes

= 4.5.1 =
* Scripts are moved to the footer by default
* Inline scripts removed, using JS files for initialization
* Description context option introduced
* A CSS fix for title display
* An image parsing fix

= 4.5 =
* New menus: Performance Options and Support
* JSON responses transformed into HTML
* Input focusing after clicking on close button
* Added an option to control the facet change event
* Custom Ajax Handler implemented
* Image cropping disabled, added an option to control it
* Debug data gathering for more effective support
* Some scrolling issues fixes
* A category and term related bug fixed

= 4.0 =
* Major Query optimizations
* Scrolling calculation and experience fixes
* CSS fixes for older IE browsers
* Input elements changed to flex layout
* Bugs fixed where input would resize to 0 pixels
* Term exclusion is now possible by ID
* Mobile search and type fix
* WooCommerce product variation Title and URL fixes

= 3.11 =
* WPML compatibility fix
* A possible security issue fix

= 3.1 =
* Updated engine with full UTF8 charset support
* Languages like chinese, persian are now searchable
* Language files added

= 3.06 =
* Fixed long label names in frontend settings dropdown
* Title and description substrings at word endings
* Removed an unneccessary CSS rule
* Fixed a bug with custom post type names

= 3.05 =
* Hotfix for disabled categories

= 3.0 =
* Fully reworked from version 1.7
* Added 30+ more options & much nicer options panel
* Brand new themes: Simple, Classic and Underline
* Google analytics integration
* Now possible to search custom post types
* Possible to search custom fields and excerpts
* Possible to exclude categories and posts by ID-s
* Possible to change image sources and set a default image
* Possible to add custom field and category selectors to the frontend

= 1.7 =
* Reworked the admin section
* New template: metro blue

= 1.6 =
* Removed an unnecessary link

= 1.5 =
* Stripping shortcodes from results content

= 1.4 =
* Security fix

= 1.3 =
* 2 brand new themes!
* Very stable custom built javascript
* Stabilised frontend and backend
* All compatibility issues fixed

= 1.2 =
* Search widget added
* Multisite fix

= 1.1 =
* Disappear bugfix
* WordPress 3.5 compatible


== Upgrade notice ==
* Nothing to say here :)


== Plugin website ==

`http://ajaxsearchpro.com`