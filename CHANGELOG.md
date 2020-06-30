# Changelog

## 0.8.1 - 2020-07-01

* Don't `doSlash()` fields for display. Prevents backslashes appearing in input boxes.
* Select tooltips by ID to allow for numeric tag names to be interpreted correctly.
* Show tag list on image/thumb/file replace too.
* Correct a few untranslated strings.
* Fix warning if trying to delete a single, used tag.

## 0.8.0 - 2020-05-31

* For Txp 4.8.0+.
* Alter load order by default to circumvent 404s.
* Remove `EvalElse()`.
* Fixed: Defend against empty 'this' contexts in `<txp:smd_related_tags>`.
* Append slashes in the URL handler.

## 0.7.0 - 2020-03-06

* For Txp 4.7.0+.
* Better support for PHP 7 (thanks, jools-r).
* Don't trample on core's title attribute (thanks, helsinkifrostbites).
* Support new Textile method signatures.
* Update Textpack.
* Fix admin-side warnings when prefs not installed.
* Kludge fix for 4.8.0 URL handling.
* Register tags on both admin and public sides for article preview support.

## 0.6.0 - 2017-04-08

* For Txp 4.6.2+.
* Complete overhaul of the admin-side layout to bring it in line with Txp 4.6+ layout.
* Tag layout now uses flexbox when grouping. Layout still leaves something to be desired, overall.
* Fixed: get-off-my-lawn messages when performing table/pref management actions (thanks, michaelkpate).

## 0.5.1 - 2015-06-29

* Removed hold-shift-for-advanced-options.
* Added Textpack.
* Fixed prefs page styling.
* Added total tag counts and sums (thanks, jakob/bojay).

## 0.5.0 - 2013-04-25

* For Txp 4.5.x.
* Improved performance (again) via cacheing.
* Rewrote URL handler.
* Added tag descriptions.
* Enabled AND/OR multi-tag searches.
* Added master tag support.
* Added import from Txp cat / custom field (thanks, josh).
* Permitted bi-directional tag tree searching.
* Permitted nested smd_tag_list tags (thanks, sacripant).
* Permitted tag parents assigned to categories to be removed from lists (thanks, pieman).
* Added `txp:smd_tag_list` flavours `crumb`, `head` and `tail`.
* Added `is` test to `txp:smd_if_tag`.
* Fixed `txp:smd_related_tags` to add DB columns from recent Txp releases.
* Fixed information_schema warning on new installs (thanks, jayrope).
* Fixed missing tag lists if no categories defined.
* Fixed bogus URLs in subdir installs in `txp:smd_tag_name` (thanks, sacripant / jpdupont).
* Fixed SQL error when deleting non-orphan tags (thanks, tye).
* Fixed if_tag_list context trigger with empty URL params.
* Fixed `txp:smd_tag_list` on empty list and non-list pages.
* Made `txp:smd_tag_name` play with gbp_permanent_links.
* Fixed `txp:smd_related_tags` in showall context.
* Swapped '&nbsp;' for '&#160;'

## 0.4.0 - 2011-02-05

* Added live search and multi-edit functions.
* Improved performance.
* Added tag import from tru_tags and rss_unlimited_categories.
* Enabled delimited tag entry.
* Fixed rogue slashes in cat lists.
* Fixed URL handler and `txp:smd_tag_name` to support per-section tag lists, clean URL syntax, and enabled multiple trigger words (all thanks, jakob).
* PHP 5.3 compatibility fix (thanks, birdhouse).
* Fixed warnings in smd_related_tags.
* Fixed tag list when no linked cats selected and when category changed.
* Added 'list' and 'group' tag display options.
* Added `sort`, `showall` and `flavour` to `txp:smd_tag_list` for tree and tag cloud support.
* Added `lettername`, `lettertitle` and `weight` items to `txp:smd_tag_info` for building alphabetic tag groups and clouds.
* Changed table collation to utf8_general_ci and improved unicode support.
* Fixed bug in smd_if_tag (again!) when using non-eq tests.
* Added `style` to `txp:smd_tag_name` and `txp:smd_tag_count`.

## 0.3.1_beta - 2010-04-13

* Fixed admin side bugs when privs less than Managing Editor.
* Fixed slow response when saving tags.
* Fixed tag category list when no cat(s) selected.
* Warning messages now blink.
* Tidied Tag Manager layout.
* Fixed parent / sublevel handling in smd_tag_list and allowed greater control over level output (thanks, woof).
* Added `pad_str` and `pad_pos` to `txp:smd_tag_name` tag.
* Fixed `txp:smd_if_tag` so it compares empty strings correctly (thanks, johnstephens).

## 0.3.0_beta - 2010-03-23

* Requires Txp 4.2.0+.
* Consolidated admin and client plugins.
* Added plugin lifecycle and prefs events.
* Fixed textarea/textarea+ jQuery '@' bug and non-saves (thanks, Zanza).
* Fixed middot HTML entity.
* Added table prefix to `txp:smd_related_tags` (thanks, MattD).

## 0.2.0_beta - 2009-04-16

* Added Text area+.
* Select list size of 1 converts tag input to a single-entry dropdown (thanks, thebombsite).
* Fixed width of tag list in link pane.
* Fixed potential context array warning.
* Non-messy URL rewriting fixed,
* Began work on multi-filtering.
* Fixed Txp 4.0.7+ database warnings.
* Added `status` attribute to `txp:smd_related_tags` (thanks, johnstephens).
* Fixed `txp:smd_if_tag` so it now correctly works outside `txp:smd_tag_list` context (thanks, danwoodward).

## 0.1.1_beta - 2008-10-16

* Improved help examples surrounding the autocomplete plugin (thanks, thebombsite).
* Fixed remove_tables, use of PFX and added debug to installation procedure (thanks, jpdupont).

## 0.1.0_beta - 2008-10-15

* Initial release.
