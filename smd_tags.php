<?php

// This is a PLUGIN TEMPLATE for Textpattern CMS.

// Copy this file to a new name like abc_myplugin.php.  Edit the code, then
// run this file at the command line to produce a plugin for distribution:
// $ php abc_myplugin.php > abc_myplugin-0.1.txt

// Plugin name is optional.  If unset, it will be extracted from the current
// file name. Plugin names should start with a three letter prefix which is
// unique and reserved for each plugin author ("abc" is just an example).
// Uncomment and edit this line to override:
$plugin['name'] = 'smd_tags';

// Allow raw HTML help, as opposed to Textile.
// 0 = Plugin help is in Textile format, no raw HTML allowed (default).
// 1 = Plugin help is in raw HTML.  Not recommended.
# $plugin['allow_html_help'] = 1;

$plugin['version'] = '0.6.1-beta';
$plugin['author'] = 'Stef Dawson';
$plugin['author_uri'] = 'https://stefdawson.com/';
$plugin['description'] = 'Unlimited tag taxonomy for articles, images, files and links';

// Plugin load order:
// The default value of 5 would fit most plugins, while for instance comment
// spam evaluators or URL redirectors would probably want to run earlier
// (1...4) to prepare the environment for everything else that follows.
// Values 6...9 should be considered for plugins which would work late.
// This order is user-overrideable.
$plugin['order'] = '5';

// Plugin 'type' defines where the plugin is loaded
// 0 = public              : only on the public side of the website (default)
// 1 = public+admin        : on both the public and admin side
// 2 = library             : only when include_plugin() or require_plugin() is called
// 3 = admin               : only on the admin side (no AJAX)
// 4 = admin+ajax          : only on the admin side (AJAX supported)
// 5 = public+admin+ajax   : on both the public and admin side (AJAX supported)
$plugin['type'] = '5';

// Plugin "flags" signal the presence of optional capabilities to the core plugin loader.
// Use an appropriately OR-ed combination of these flags.
// The four high-order bits 0xf000 are available for this plugin's private use
if (!defined('PLUGIN_HAS_PREFS')) define('PLUGIN_HAS_PREFS', 0x0001); // This plugin wants to receive "plugin_prefs.{$plugin['name']}" events
if (!defined('PLUGIN_LIFECYCLE_NOTIFY')) define('PLUGIN_LIFECYCLE_NOTIFY', 0x0002); // This plugin wants to receive "plugin_lifecycle.{$plugin['name']}" events

$plugin['flags'] = '3';

// Plugin 'textpack' is optional. It provides i18n strings to be used in conjunction with gTxt().
// Syntax:
// ## arbitrary comment
// #@event
// #@language ISO-LANGUAGE-CODE
// abc_string_name => Localized String

$plugin['textpack'] = <<<EOT
#@language en, en-gb, en-us
#@admin-side
smd_tags => Tags (smd)
#@smd_tag
smd_tag_ac_std => Standard
smd_tag_ac_str => Strict
smd_tag_all_lbl => All
smd_tag_already_exists => already exists
smd_tag_assign_parent_lbl => Assign parent
smd_tag_bi_both => Both
smd_tag_bi_down => Down
smd_tag_bi_up => Up
smd_tag_by_column => Column
smd_tag_by_row => Row
smd_tag_category_linked_lbl => Linked to category "{category}":
smd_tag_category_unlinked_lbl => Unlinked:
smd_tag_children_and => and its children
smd_tag_children_del => Delete children
smd_tag_children_pro => Promote children
smd_tag_clear => clr
smd_tag_clink_lbl => Linked cat
smd_tag_count_lbl => Matched tags:
smd_tag_created => {type} tag "{name}" created
smd_tag_created_rep_lbl => Created tags:
smd_tag_create_lbl => Create/Edit tag
smd_tag_deleted => {type} tag "{name}" deleted
smd_tag_deleted_lbl => Deleted tags:
smd_tag_err_in_use_lbl => Tags in use:
smd_tag_err_orphaned_lbl => Orphaned tags:
smd_tag_exists => {type} tag "{name}" already exists
smd_tag_extras => More...
smd_tag_import_results_pt1 => Articles:
smd_tag_import_results_pt2 => Tags linked:
smd_tag_in_use => {type} tag "{name}" is in use
smd_tag_link_to_cat_lbl => Link to category
smd_tag_manage_lbl => Manage tags
smd_tag_missing_rep_lbl => Missing tags:
smd_tag_multi_delete => Tags deleted: {number} (see report for details)
smd_tag_not_available => Tables are not installed
smd_tag_not_created => {type} tag "{name}" NOT created
smd_tag_not_created_rep_lbl => Tags NOT created:
smd_tag_not_parent_linked_lbl => Not linked:
smd_tag_not_updated => {type} tag "{name}" NOT updated
smd_tag_no_desc => No description available
smd_tag_no_name => {type} tag NOT created: needs a name
smd_tag_no_parent => No parent tags.
smd_tag_no_sections => No sections
smd_tag_no_tags => No {type} tags defined
smd_tag_parent_lbl => Parent
smd_tag_parent_linked_lbl => Assigned these tag(s) to "{parent}":
smd_tag_pool_lbl => Tag pool
smd_tag_prefs_installed => Preferences installed
smd_tag_prefs_not_installed => Preferences not installed.
smd_tag_prefs_p => Interface settings
smd_tag_prefs_pane => Prefs
smd_tag_prefs_removed => Preferences removed
smd_tag_prefs_some => Not all preferences available.
smd_tag_prefs_some_explain => This is either a new installation or a different version<br />of the plugin to one you had before.
smd_tag_prefs_some_opts1 => Choose "Remove prefs" to remove them all or "Install prefs" to add<br />any new ones, leaving all existing prefs untouched.
smd_tag_prefs_some_opts2 => Click "Install tables" to add or update the tables<br />leaving all existing data untouched.
smd_tag_prefs_some_tbl => Not all table info available.
smd_tag_prefs_t => Tag management
smd_tag_prefs_title => Tag Preferences
smd_tag_prefs_u => URL management
smd_tag_pref_install_lbl => Install prefs
smd_tag_pref_remove_lbl => Remove prefs
smd_tag_pref_show_lbl => Preferences
smd_tag_p_enable => Enable tags in
smd_tag_p_input => Enter tags using
smd_tag_p_lbi => Bi-directional tag trees
smd_tag_p_linkcat => Link tags to categories
smd_tag_p_listpar => Permit parent tag selection
smd_tag_p_master => Master parent tag
smd_tag_p_qtag => Quick tag (<a href="http://plugins.jquery.com/project/autocompletex">requires plugin</a>)
smd_tag_p_qtpath => JS plugin dir
smd_tag_p_qtstyl => JS style dir
smd_tag_p_size => Select/textarea rows
smd_tag_recent_report => Display recent report
smd_tag_report_lbl => Report: smd_tags
smd_tag_rss_uc_only => (ignored for tru_tags)
smd_tag_rss_uc_tru_tags_only => (ignored for Textpattern cats)
smd_tag_sel_list => Select list
smd_tag_sync_cfs_delim_lbl => Custom field delimiter
smd_tag_sync_cfs_lbl => Custom field
smd_tag_sync_delete_orig_lbl => Delete original
smd_tag_sync_force_cat_lbl => Force category link if tag already exists
smd_tag_sync_force_parent_lbl => Force parent if tag already exists
smd_tag_sync_import_opts => Import options
smd_tag_sync_lbl => Import tags
smd_tag_sync_link_cat_lbl => Link tags to category
smd_tag_sync_parent_cat_lbl => Link to category
smd_tag_sync_parent_lbl => Start from parent category
smd_tag_sync_parent_tag_lbl => Assign to parent tag
smd_tag_sync_plugin_opts => Source options
smd_tag_sync_plugs_not_installed => tru_tags or rss_unlimited_categories must be installed and activated to import
smd_tag_sync_section_lbl => Articles from section
smd_tag_sync_txpcats_lbl => Textpattern category
smd_tag_sync_type1 => tru_tags
smd_tag_sync_type2 => rss_unlimited_categories
smd_tag_sync_type3 => Textpattern categories
smd_tag_sync_type4 => Custom field
smd_tag_sync_type_lbl => Import from
smd_tag_tags_pane => Manage tags
smd_tag_tag_search => Tag search
smd_tag_tbl_installed => Tag tables installed.
smd_tag_tbl_install_lbl => Install tables
smd_tag_tbl_not_installed => Tag tables NOT installed.
smd_tag_tbl_not_removed => Tag tables NOT removed.
smd_tag_tbl_rebuild_lbl => Rebuild tags
smd_tag_tbl_rebuilt => Tag tables rebuilt
smd_tag_tbl_removed => Tag tables removed.
smd_tag_tbl_remove_lbl => Remove tables
smd_tag_textbox => Text area
smd_tag_textboxplus => Text area+
smd_tag_textlist => Text list
smd_tag_title => Tags
smd_tag_toggle => tog
smd_tag_t_astart => Initial pane
smd_tag_t_auto => Auto name
smd_tag_t_cols => Tag layout
smd_tag_t_colsord => Order tags by
smd_tag_t_count => Show tag usage counts
smd_tag_t_deltree => When deleting a parent
smd_tag_t_delused => Allow deletion of used tags
smd_tag_t_desc_textile => Textile description
smd_tag_t_desc_tooltip => Show description as tooltip
smd_tag_t_enrep => Automatically display reports
smd_tag_t_hilite => Clicked RGB colour
smd_tag_t_hover => Mouse-over RGB colour
smd_tag_t_indent => Sub-tag level indicator
smd_tag_t_mdelim => Multi-tag delimiter (1 char)
smd_tag_t_size_desc => Description width, height
smd_tag_unable_to_create => cannot create
smd_tag_updated => {type} tag "{name}" updated
smd_tag_u_combi => Use tag combinations
smd_tag_u_combi_and => AND combinator char
smd_tag_u_combi_or => OR combinator char
smd_tag_u_pnam => URL name parameter
smd_tag_u_ptyp => URL type parameter
smd_tag_u_sec => Trigger(s) for tag lists
smd_tag_with_filtered => With filtered:
EOT;

if (!defined('txpinterface'))
        @include_once('zem_tpl.php');

# --- BEGIN PLUGIN CODE ---
//<?php
/**
 * smd_tags: A Textpattern CMS plugin for unlimited, structured taxonomy across content types.
 *
 * Features:
 *   Article, image, file and link tags
 *   Rapid tag creation / editing / multi-editing
 *   Optionally import tags from rss_uc, tru_tags, category1/2 or custom fields
 *   Create tag lists, trees and clouds
 *   Find related content based on tag
 *   Tag combinators from the URL
 *
 * @author Stef Dawson
 * @link   https://stefdawson.com/
 *
 * @todo
 * Remove EvalElse()
 * Alter tag pool layout to allow collapsing groups of parent->children
 * Use article_row_info(), link_format_info()
 * Investigate storing tag data as jQuery .data() instead of in <span>s (from Txp 4.6+ it can be done in HTML data-* attributes)
 * Pagination of tag lists / related content
 * Feed handler prefs to inject tags into RSS+Atom (like tru_tags: code at bottom of this plugin)
 * Add option to display tag lists AND TextArea(+) on list pages
 * See if rapid tagging can be made more intuitive wrt Create/Save to avoid clobbering already created tags (from pieman http://forum.textpattern.com/viewtopic.php?pid=240099#p240099)
 * When refreshing the Manage tab, FF remembers the Title and tries to add it on page load, throwing a msgarea warning about the tag already exists (or that name is empty)
 * Possibility of section tags? (from jakob)
 * Per-section / per-category tag counts
 * Query tags without section/article context (Dwayne: http://forum.textpattern.com/viewtopic.php?pid=246750#p246750)
 * On list pages:
 *   AJAX fetch of the tag set for TextArea and TextArea+ modes to improve page load time (plus we then only grab the ones in the current category hierarchy)
 *   Add autocomplete options to smd_tags prefs so autofill etc can be configured (from aswihart)
 *   Check what happens when deleting content (e.g. images): it sometimes triggers " '' is not an Integer " assertion (from curiouz http://forum.textpattern.com/viewtopic.php?pid=236023#p236023)
 *   Perhaps offer sort option for List mode to a) retain hierarchy, b) strict alphabetical, c) group them somehow to show how sets of tags are related (from pieman)
 * @tofix
 * Sanitize tags from custom fields / cats during import
 * Blob of output from AJAX (cf. "If you spot such JavaScript responses your plugin breaks AJAX at the write tab, for instance by echo()ing something as text/html when send_script_response() with text/javascript would be the proper reply with the expected mime type.")
 * Query count -- cache tag sets and verify URL tag lists are as optimum as possible (see smd_bio)
 * Live search sometimes gives wrong results when group tags contain no (or very few) children
 * Verify limit/offset behaviour (giz: http://forum.textpattern.com/viewtopic.php?pid=244020#p244020)
 * smd_tags_context() : Invalid argument supplied for foreach() (frickinmuck: http://forum.textpattern.com/viewtopic.php?pid=249250#p249250)
 * Deal with parent attribute in smd_tag_name better (stop it showing 'root'?)
 * Detect scenario when article saves fail and don't update tags under these circumstances (e.g. when concurrent users are editing the same document)
 */

// ------------------------
// ADMIN SIDE CODE
if (txpinterface === 'admin') {
    add_privs('smd_tags','1,2');
    add_privs('smd_tags_users','1,2,3,4,5,6');
    add_privs('plugin_prefs.smd_tags','1,2');

    // Extensions tab
    register_tab('extensions', 'smd_tags', gTxt('smd_tags'));
    register_callback('smd_tags', 'smd_tags');
    register_callback('smd_tags_users', 'smd_tags_users');

    // Note the callbacks are ordered with 'save' first
    register_callback('smd_tags_multi_edit', 'list', 'list_multi_edit');
    register_callback('smd_tags_savelist', 'article', 'create');
    register_callback('smd_tags_savelist', 'article', 'edit');
    register_callback('smd_tags_loadlist', 'article');

    register_callback('smd_tags_multi_edit', 'image', 'image_delete');
    register_callback('smd_tags_savelist', 'image', 'image_save');
    register_callback('smd_tags_loadlist', 'image');

    register_callback('smd_tags_multi_edit', 'file', 'file_delete');
    register_callback('smd_tags_savelist', 'file', 'file_save');
    register_callback('smd_tags_loadlist', 'file');

    register_callback('smd_tags_multi_edit', 'link', 'link_multi_edit');
    register_callback('smd_tags_savelist', 'link', 'link_post');
    register_callback('smd_tags_savelist', 'link', 'link_save');
    register_callback('smd_tags_loadlist', 'link');

    register_callback('smd_tags_setup', 'plugin_prefs.smd_tags');
    register_callback('smd_tags_welcome', 'plugin_lifecycle.smd_tags');
    register_callback('smd_tags_inject_css', 'admin_side', 'head_end');
} elseif (txpinterface === 'public') {
    if (class_exists('\Textpattern\Tag\Registry')) {
        Txp::get('\Textpattern\Tag\Registry')
            ->register('smd_tag_list')
            ->register('smd_tag_name')
            ->register('smd_tag_count')
            ->register('smd_tag_info')
            ->register('smd_if_tag')
            ->register('smd_if_tag_list')
            ->register('smd_related_tags');
    }

    register_callback('smd_tags_url_handler', 'pretext');
}

if (!defined('SMD_TAG')) {
    define("SMD_TAG", 'smd_tags');
}
if (!defined('SMD_TAGC')) {
    define("SMD_TAGC", 'smd_tags_cat');
}
if (!defined('SMD_TAGU')) {
    define("SMD_TAGU", 'smd_tags_used');
}

/**
 * Runs on plugin installation.
 *
 * @param      string  $evt    Textpattern event (panel)
 * @param      string  $stp    Textpattern step (action)
 */
function smd_tags_welcome($evt, $stp)
{
    $msg = '';
    switch ($stp) {
        case 'installed':
            smd_tags_table_install(0);
            $msg = 'Happy tagging!';
            break;
        case 'deleted':
            smd_tags_prefs_remove('', 0);
            break;
    }
    return $msg;
}

/**
 * Step dispatcher.
 *
 * @param      string  $evt    Textpattern event (panel)
 * @param      string  $stp    Textpattern step (action)
 */
function smd_tags($evt, $stp)
{
    $available_steps = array(
        'smd_tag_catlist'           => true,
        'smd_tag_create'            => true,
        'smd_tag_parentlist'        => true,
        'smd_tag_save'              => true,
        'smd_tags_delete'           => true,
        'smd_tags_import'           => true,
        'smd_tags_import_one'       => true,
        'smd_tags_manage'           => false,
        'smd_tags_multi_set_parent' => true,
        'smd_tags_multi_catlink'    => true,
        'smd_tags_prefs_show'       => false,
        'smd_tags_prefs_install'    => false,
        'smd_tags_prefs_remove'     => false,
        'smd_tags_prefs_update'     => true,
        'smd_tags_sync'             => false,
        'smd_tags_table_install'    => false,
        'smd_tags_table_remove'     => false,
        'smd_tags_table_rebuild'    => false,
    );

    if (!$stp or !bouncer($stp, $available_steps)) {
        $pref = smd_tags_pref_get('smd_tag_t_astart');
        $stp = 'smd_tags_prefs_show';

        if ($pref) {
            switch ($pref['smd_tag_t_astart']['val']) {
                case 1:
                    $stp = 'smd_tags_manage';
                    break;
                case 0:
                default:
                    $stp = 'smd_tags_prefs_show';
            }
        }
    }

    $stp();
}

/**
 * Ajax step dispatcher.
 *
 * @param      string  $evt    Textpattern event (panel)
 * @param      string  $stp    Textpattern step (action)
 */
function smd_tags_users($evt, $stp)
{
    $available_steps = array(
        'smd_tag_catlist'    => true,
        'smd_tag_parentlist' => true,
        'smd_tag_get_desc'   => true,
    );

    if (!$stp or !bouncer($stp, $available_steps)) {
        // Do nothing
    } else {
        $stp();
    }
}

// ------------------------
// Create dropdown and populate it with tags of the relevant type, highlighting any $sel tags
function smd_multiTreeSelectInput($select_name = '', $tree = '', $sel = '') {
    $pref = smd_tags_pref_get(array('smd_tag_p_size', 'smd_tag_p_listpar'), 1);
    $rows = $pref['smd_tag_p_size']['val'];
    $incl = $pref['smd_tag_p_listpar']['val'];

    $out[] = '<select id="'.$select_name.'" name="'.$select_name.'[]" class="list" size="'. $rows .'"' .(($rows==1) ? '' : ' multiple="multiple"'). '>';
    foreach ($tree as $leaf) {
        if ($leaf['name'] == 'root') continue;

        $selected='';
        foreach ($sel as $gid => $item) {
            if ($leaf['id'] == $item['tag_id']) {
                $selected = ' selected="selected"';
                continue;
            }
        }

        $leaf['name'] = htmlspecialchars($leaf['name']);
        $indent = ($leaf['level'] > 0) ? str_repeat(sp.sp,$leaf['level']) : '';
        $selectable = (!$incl && $leaf['children'] > 0) ? ' disabled="disabled"' : '';
        $out[] = t.'<option value="'.$leaf['id'].'"'.$selected.$selectable.'>'.$indent.htmlspecialchars($leaf['title']).'</option>';
    }
    $out[] = '</select>';
    return join('',$out);
}

// ------------------------
// Called whenever one of the 4 main tabs are used on the admin side. Inserts the input method if required
function smd_tags_loadlist($evt, $stp) {
    global $app_mode, $step;

    if (smd_tags_table_exist()) {
        $ctrls = smd_tags_pref_get(array('smd_tag_p_enable', 'smd_tag_p_input', 'smd_tag_p_size', 'smd_tag_p_qtag', 'smd_tag_p_qtpath', 'smd_tag_p_qtstyl', 'smd_tag_p_linkcat', 'smd_tag_t_desc_tooltip'), 1);
        $onoff = smd_tags_pref_explode($ctrls['smd_tag_p_enable']['val']);
        $iptyp = $ctrls['smd_tag_p_input']['val'];
        $selsz = $ctrls['smd_tag_p_size']['val'];
        $quick = $ctrls['smd_tag_p_qtag']['val'];
        $jsdir = $ctrls['smd_tag_p_qtpath']['val'];
        $csdir = $ctrls['smd_tag_p_qtstyl']['val'];
        $clink = $ctrls['smd_tag_p_linkcat']['val'];
        $toolt = $ctrls['smd_tag_t_desc_tooltip']['val'];
        $jstail = ($jsdir) ? '/' : '';
        $cstail = ($csdir) ? '/' : '';
        $addIt = false;

        $itemID = smd_getID();
        $edtBtn = has_privs('smd_tags') ? ' ['.eLink('smd_tags', 'smd_tags_manage', 'smd_tag_type', $evt, gTxt('edit')).'] ' : '';
        $tagtop = gTxt('smd_tag_title').$edtBtn;
        $selist = '<span id="smd_tags" name="smd_tags_bylist" class="smd_tagip"></span>';
        $selhid = '<span id="smd_tags" name="smd_tags_bylist" class="smd_hidden"></span>';
        $tooltip = ($toolt) ? '<span id="smd_tag_tt" class="smd_tooltip smd_hidden"></span>' : '';
        $widget = '';

        switch ($iptyp) {
            case 0:
                $ipmeth = $selist;
                break;
            case 1:
                $ipmeth = '<span name="smd_tags_bylink" id="smd_tags_bylink" class="smd_tagip"></span>'.$selhid;
                break;
            case 2:
            case 3:
                $ipmeth = '<textarea name="smd_tags_bytext" rows="'.$selsz.'" class="smd_tagip"></textarea>'.$selhid;
                break;
        }

        switch ($evt) {
            case "article":
                $addIt = ($onoff[gTxt('tab_list')] == 1) ? true : false;
                if ($addIt) {
                    extract(gpsa(array('view','from_view')));
                    $view = ($view) ? $view : "text";
                    $grabcats = 'jQuery("#category-1 option:selected, #category-2 option:selected")';
                    $jsElem = 'jQuery(".category-2").parent()';
                    $trigger = 'jQuery("#category-1, #category-2")';
                    if ($view != 'text') {
                        $widget = '';
                    } else {
                        $widget = escape_js('<div>'.$tagtop.'</div>' . $ipmeth);
                    }
                }
                break;
            case "image":
                if ($step == "image_edit") {
                    $addIt = ($onoff[gTxt('tab_image')] == 1) ? true : false;
                    if ($addIt) {
                        $grabcats = 'jQuery("#image_category option:selected")';
                        $jsElem = 'jQuery(".edit-image-category")';
                        $trigger = 'jQuery("#image_category")';
                        $widget = escape_js(inputLabel('smd_tags', $ipmeth, $tagtop));
                    }
                }
                break;
            case "file":
                if ($step == "file_edit") {
                    $addIt = ($onoff[gTxt('tab_file')] == 1) ? true : false;
                    if ($addIt) {
                        $grabcats = 'jQuery("#file_category option:selected")';
                        $jsElem = 'jQuery(".edit-file-category")';
                        $trigger = 'jQuery("#file_category")';
                        $widget = escape_js(inputLabel('smd_tags', $ipmeth, $tagtop));
                    }
                }
                break;
            case "link":
                if ($step == "link_edit") {
                    $addIt = ($onoff[gTxt('tab_link')] == 1) ? true : false;
                    if ($addIt) {
                        $grabcats = 'jQuery("#link_category option:selected")';
                        $jsElem = 'jQuery(".edit-link-category")';
                        $trigger = 'jQuery("#link_category")';
                        $widget = escape_js(inputLabel('smd_tags', $ipmeth, $tagtop));
                    }
                }
                break;
        }

        // Don't re-serve the css+javascript if this is an AJAX save
        if ($app_mode == 'async') {
            $addIt = false;
        }

        // Add the dropdown and js toggle/clear options if required
        if ($addIt) {
            $qs = array(
                "event" => "smd_tags_users",
            );

            $qsVars = "index.php".join_qs($qs);

            if ($quick > 0) {
                echo <<<EOJS
<script type="text/javascript" src="{$jsdir}{$jstail}jquery.autocomplete.pack.js"></script>
<link rel="stylesheet" type="text/css" href="{$csdir}{$cstail}jquery.autocomplete.css"></script>
EOJS;
            }

            echo script_js(<<<EOJS
jQuery(function() {
    {$jsElem}.after('{$widget}{$tooltip}');

    function smd_tagList(typ) {
        var grabcats = [];
        {$grabcats}.each(function() {
            if (jQuery(this).val() != '') {
               grabcats.push(jQuery(this).val());
            }
        });
        grabcats = grabcats.join(",");
        var smd_link_mode = (('{$clink}'=='0') ? '2' : ((grabcats=='') ? 1 : ''));

        jQuery.post('{$qsVars}', { step: "smd_tag_parentlist", name: 'smd_tag_parent', type: typ, cat: grabcats, link_mode: smd_link_mode, itemid: "{$itemID}", _txp_token: textpattern._txp_token },
            function(data) {
                jQuery("#smd_tags").html(data);
                jQuery("#smd_tags_bylink").empty();
                var smd_tagpool = [];
                var smd_tagsel = [];
                var smd_taglinks = [];
                jQuery('#smd_tags select option').each(function() {
                    var curr = jQuery(this);
                    var txt = jQuery.trim(curr.text());
                    smd_tagpool.push(txt);

                    if (jQuery("#smd_tags_bylink").text() != "") {
                        jQuery("#smd_tags_bylink").append(" &middot; ");
                    }

                    if (curr.prop("selected") == true) {
                        smd_tagsel.push(txt);
                        jQuery("#smd_tags_bylink").append('<span class="smd_sel">'+txt+'</span>');
                    } else {
                        jQuery("#smd_tags_bylink").append('<span>'+txt+'</span>');
                    }
                });

                jQuery("#smd_tags_bylink span").click(function() {
                    jQuery(this).toggleClass("smd_sel");
                    var ltxt = jQuery(this).text();
                    jQuery("#smd_tags select option").each(function() {
                        var curr = jQuery(this);
                        if (jQuery.trim(curr.text()) == ltxt) {
                            this.selected = !this.selected;
                        }
                    });
                });

                jQuery("textarea[name='smd_tags_bytext']").val(smd_tagsel.join(", "));

                if ({$quick} > 0) {
                    jQuery("textarea[name='smd_tags_bytext']").autocomplete(smd_tagpool, {
                        multiple: true,
                        mustMatch: (($quick==2)?true:false),
                        autoFill: true
                    });
                }
                jQuery("textarea[name='smd_tags_bytext']").keyup(function() {
                    smd_tagsResyncSelect({$quick});
                });
                jQuery('#smd_clr').click(function() {
                    jQuery('#smd_tags select option').prop("selected", "");
                });
                jQuery('#smd_tog').click(function() {
                    jQuery('#smd_tags select option').each(function() {
                        this.selected = !this.selected;
                    });
                });

                // Tooltips
                if ('{$toolt}' == '1') {
                    jQuery('#smd_tags select, #smd_tags_bylink').hover( function(ev) {
                        // Do nothing
                }, function() {
                        // Hide tooltip when exiting the entire tag area
                        jQuery('.smd_tooltip').hide('fast');
                    });
                    jQuery('#smd_tags select option, #smd_tags_bylink span').hover( function(ev) {
                        var thisTag = jQuery(this).val();
                        if (!thisTag) {
                            thisTag = jQuery(this).html();
                        }
                        if (jQuery('#smd_tag_tt').data(thisTag)) {
                            smd_tags_show_desc(ev, jQuery('#smd_tag_tt').data(thisTag));
                        } else {
                            jQuery.post('{$qsVars}',
                            {
                                step: "smd_tag_get_desc",
                                tag_ref: thisTag,
                                _txp_token: textpattern._txp_token
                            },
                            function(data) {
                                jQuery('#smd_tag_tt').data(thisTag, data);
                                smd_tags_show_desc(ev, jQuery('#smd_tag_tt').data(thisTag));
                            });
                        }
                    });
                }
            }
        );
    }

    function smd_tags_show_desc(ev, content) {
        jQuery('#smd_tag_tt').hide().empty().append(content).show();
        jQuery('.smd_tooltip').css('left', ev.pageX - 60).css('top', ev.pageY + 15).css('display', 'block');
    }

    smd_tagList('{$evt}');
    if ('{$clink}'=='1') {
        {$trigger}.change(function() {
            smd_tagList('{$evt}');
        });
    }

    function smd_tagsResyncSelect(lvl) {
        var tbTags = jQuery("textarea[name='smd_tags_bytext']").val().split(/,\s+?/);
        jQuery("#smd_tags select option").each(function() {
            var curr = jQuery(this);
            if(jQuery.inArray(jQuery.trim(curr.text()), tbTags) == -1) {
                curr.prop("selected", "");
            } else {
                curr.prop("selected", true);
            }
        });
    }
});
EOJS
            );
        }
    }
}

// ------------------------
// Update the tags used table if some tags have been added/saved
function smd_tags_savelist($evt, $stp) {
    if (smd_tags_table_exist()) {
        $ctrls = smd_tags_pref_get(array('smd_tag_p_qtag', 'smd_tag_p_input', 'smd_tag_p_linkcat', 'smd_tag_p_master'), 1);
        $quick = $ctrls['smd_tag_p_qtag']['val'];
        $iptyp = $ctrls['smd_tag_p_input']['val'];
        $clink = $ctrls['smd_tag_p_linkcat']['val'];
        $god = $ctrls['smd_tag_p_master']['val'];
        $god_clause = ($god == '') ? '' : " AND parent = '" . doSlash($god) . "'";

        $itemID = smd_getID();

        if ($itemID) {
            // Can't use the 'edit' step because otherwise save triggers on article page load;
            // hence, the 'save' button state is used instead. Also, on article creation, the global
            // step is set to 'edit' by the time the plugin is hit, so we hack the step if the 'publish'
            // button was hit
            $stp = (ps('publish')) ? 'publish' : $stp;
            $saveSteps = array('create', 'publish', 'image_save', 'file_save', 'link_save', 'link_post');
            if (ps('save') || in_array($stp, $saveSteps)) {
                safe_delete(SMD_TAGU, 'item_id="'.$itemID.'" AND type="'.$evt.'"');

                $tags = ps('smd_tag_parent') ? ps('smd_tag_parent') : array();

                $allowedTags = array();
                if ($god_clause) {
                    $allowedTags = safe_column('id', SMD_TAG, "type='$evt'" . $god_clause);
                }

                // Validate the incoming tags to those in the currently selected category|ies
                if ($clink) {
                    $usedCats = ($evt=="article") ? array(gps('Category1'), gps('Category2')) : array(gps('category'));
                    $catids = safe_column('id', 'txp_category', "name IN (" .join(',', quote_list($usedCats)). ") AND type='$evt'");
                    $validTags = ($catids) ? safe_column('tag_id', SMD_TAGC, "cat_id IN (" .join(',', quote_list($catids)). ")") : array();
                    foreach ($validTags as $validTag) {
                        $rows = smd_tag_tree(safe_field('name',SMD_TAG,"id='".doSlash($validTag)."'"), $evt, '1=1', SMD_TAG);
                        foreach ($rows as $row) {
                            $allowedTags[] = $row['id'];
                        }
                    }
                    $tags = array_intersect(array_unique($allowedTags), $tags);
                }

                $vals = array();
                foreach($tags as $val){
                    safe_insert(SMD_TAGU, 'tag_id = "'.$val.'", item_id="'.$itemID.'", type="'.$evt.'"');
                    $vals[] = $val;
                }
                $tagsText = preg_split("/,\s+?/", ps('smd_tags_bytext'));

                // If we're in non-STRICT mode and there are any typed tags that are not in the select list, check they exist and make links to them
                if ($quick < 2) {
                    $added = ($vals) ? safe_column("title", SMD_TAG, "id IN ('".join("','",$vals)."') AND type='$evt'") : array();
                    $tagsText = array_diff($tagsText, $added);

                    // Only loop over tags that don't appear to be already defined
                    foreach($tagsText as $tag) {
                        if ($tag == "") continue;
                        $exists = safe_field('id', SMD_TAG, "name = '$tag' AND type = '$evt'"); // 1st check

                        // Textarea+ input system can add (linked) tags with impunity
                        if ($iptyp == 3 && !$exists) {
                            $tagBits = explode('-->', $tag);
                            if (count($tagBits) == 2) {
                                $tagparent = strtolower(sanitizeForUrl($tagBits[0]));
                                $tagparent = safe_field('name', SMD_TAG, "name = '$tagparent' AND type = '$evt'"); // Check parent exists for this type
                                $tagparent = ($tagparent === false) ? 'root' : $tagparent;
                                $tagchild = $tagBits[1];
                            } else {
                                $tagparent = 'root';
                                $tagchild = $tagBits[0];
                            }
                            $sanitag = strtolower(sanitizeForUrl($tagchild));
                            $already = safe_field('id', SMD_TAG, "name = '$sanitag' AND type = '$evt'"); // Check again because parent-->child will fail 1st check
                            if ($already === false) {
                                $exists = safe_insert(SMD_TAG, "name='".$sanitag."', title='$tagchild', parent='$tagparent', type='$evt'");
                            }
                            $catfield = ($evt=="article") ? gps('Category1') : gps('category');
                            if ($clink && $catfield && $exists) {
                                // Assign new tag to current category (cat1 for articles)
                                $catid = safe_insert(SMD_TAGC,"tag_id='$exists', cat_id=(SELECT id FROM ".PFX."txp_category WHERE name='$catfield' AND type='$evt')");
                            }
                            rebuild_tree_full($evt, SMD_TAG);
                        }
                        if ($exists) {
                            safe_insert(SMD_TAGU, 'tag_id = "'.$exists.'", item_id="'.$itemID.'", type="'.$evt.'"');
                        }
                    }
                }
            }
        }
    }
}

// ------------------------
// Handle changes to the tags table during multi-item edits
function smd_tags_multi_edit($evt, $stp) {
    // In Txp 4.0.6 the only tabs to allow multi-edits are the Article (list) and Link tabs. Cheat for now
    if (smd_tags_table_exist()) {
        switch ($evt) {
            case "list":
            case "link":
                $method = ps('edit_method');
                $selected = ps('selected');
                break;
            default:
                $method = "delete";
                $selected = array(ps('id'));
                break;
        }

        // 'list' is a special case that equates to articles
        $type = ($evt == "list") ? "article" : $evt;

        if ($selected) {
            switch ($method) {
                case "delete":
                    $ids = array();
                    foreach ($selected as $id) {
                        $id = assert_int($id);
                        if (safe_delete(SMD_TAGU, 'item_id = '.$id.' AND type="'.$type.'"')) {
                            $ids[] = $id;
                        }
                    }
                    return join(', ', $ids);
                    break;
            }
        }
        return '';
    }
}

// ------------------------
// Grab the current article/image/file/link ID
function smd_getID()
{
    if (!empty($GLOBALS['ID'])) { // newly-saved item
        $itemID = intval($GLOBALS['ID']);
    } else {
        $itemID = (gps('ID')) ? gps('ID') : gps('id');
    }

    return $itemID;
}

/**
 * @param  string $evt Textpattern event (panel)
 * @param  string $stp Textpattern step (action)
 */
function smd_tags_inject_css($evt, $stp)
{
    global $event;

    $eventmap = array(
        'article' => 'list',
        'file'    => 'file',
        'image'   => 'image',
        'link'    => 'link',
        'list'    => 'list',
    );

    $smd_tag_preflist = smd_tags_get_prefs('name');
    $prefset = smd_tags_pref_get($smd_tag_preflist);
    $onoff = smd_tags_pref_explode($prefset['smd_tag_p_enable']['val']);
    $mapped = isset($eventmap[$event]) ? $eventmap[$event] : '';
    $addIt = ($mapped && $onoff[gTxt('tab_'.$mapped)] == 1) ? true : false;

    $stylereps = array(
        '{hov}' => $prefset['smd_tag_t_hover']['val'],
        '{cur}' => $prefset['smd_tag_t_hilite']['val'],
    );

    $plugin_styles = array();

    if ($event === 'smd_tags') {
        $plugin_styles[] = smd_tags_get_style_rules('all');
    } elseif ($addIt) {
        $plugin_styles[] = smd_tags_get_style_rules('common');
    }

    if ($plugin_styles) {
        echo '<style>' . strtr(implode(n, $plugin_styles), $stylereps) . '</style>';
    }

    return;
}

/**
 * CSS definitions: hopefully kind to themers.
 */
function smd_tags_get_style_rules($type = 'all')
{
    $smd_tags_styles['tag'] = array(
        '.smd_current { padding:3px; font-weight:bold; background:#{cur}; }',
        '.smd_tags_showpars, .smd_tags_linkcat { max-width:12em; }',
        '.smd_tag_list_adm { display: flex; flex-wrap: wrap; justify-content: space-between; }',
        '.smd_tag_list_adm.byrow { flex-direction: column; }',
        '.smd_tag_list_adm.bycol ul { border:1px solid #ccc; padding:1em; }',
        '.smd_tag_list_adm.byrow li { display:inline-block;  }',
        '.smd_tag_list_adm.bycol li { list-style-type:none; }',
        '#smd_tag_filt { float:right; margin:0; padding:1em 2em; box-shadow: 4px 4px 5px #999; }',
        '#smd_tag_multisel { margin:10px 0 0; }',
        '.smd_tags_new label {display:block; margin:2px 1px; }',
        '.smd_tags_new input[type="submit"] { margin:1.5em 0 0; }',
        '.smd_tags_input_group { float:left; margin:0 1em; }',
        '.smd_tags_pool { clear:both; padding:1em 0;}',
        '#smd_tag_report_pane { display:none; position:absolute; left:200px; max-width:500px; border:3px ridge #999; opacity:.92; filter:alpha(opacity:92); padding:15px 20px; background-color:#e2dfce; color:#80551e; }',
        '#smd_tag_report_pane .publish { float:right; }',
        '.smd_tags_btn_ok { position: absolute; top: .27777777777778em; right: .72222222222222em; font-size: 18px; font-weight: 700; text-decoration: none; }',
        '.txp-actions { float:right; }',
    );

    $smd_tags_styles['common'] = array(
        '.smd_hidden { display:none; }',
        '.smd_hover { cursor:pointer; background:#{hov}; }',
        '.smd_fakebtn, #smd_tags_bylink span { cursor:pointer; }',
        '.smd_tagip { margin:.4em 0 .8em; max-width:400px; }',
        '.smd_sel { font-weight:bold; }',
        '.smd_tooltip { position:absolute; background:#eee; max-width:300px; min-width:150px; border:1px solid black; padding:1em; box-shadow:5px 5px 4px #999; z-index:100; }',
    );

    $out = array();

    if ($type === 'all') {
        $out = array_merge($smd_tags_styles['tag'], $smd_tags_styles['common']);
    } elseif (array_key_exists($type, $smd_tags_styles)) {
        $out = $smd_tags_styles[$type];
    }

    return implode(n, $out);
}

/**
 * Fetch all prefs.
 *
 * Internally, it tracks two lists:
 * a) Current prefs
 * b) Legacy prefs that needs removing
 */
function smd_tags_get_prefs($type)
{
    $current = array(
        'smd_tag_prefs_p' => array(
            'smd_tag_p_enable'  => '1111', // one digit for article/image/file/link. 1=enabled; 0=disabled
            'smd_tag_p_input'   => '0', // 0=select, 1=links, 2=textarea, 3=textarea+
            'smd_tag_p_lbi'     => '0',
            'smd_tag_p_linkcat' => '0',
            'smd_tag_p_listpar' => '1', // permit parent in tag tree on content pages
            'smd_tag_p_master'  => '', // special 'global' category (per type: same name for each)
            'smd_tag_p_qtag'    => '0', // 0=no autocomplete, 1=std a/c, 2=strict a/c
            'smd_tag_p_qtpath'  => '', // Dir to js file(s) relative to textpattern dir
            'smd_tag_p_qtstyl'  => '', // Dir to css file(s)
            'smd_tag_p_size'    => '6',
        ),
        'smd_tag_prefs_t' => array(
            'smd_tag_t_astart'       => '0',
            'smd_tag_t_auto'         => '1',
            'smd_tag_t_cols'         => '1',
            'smd_tag_t_colsord'      => '0',
            'smd_tag_t_count'        => '1',
            'smd_tag_t_deltree'      => '0',
            'smd_tag_t_delused'      => '0',
            'smd_tag_t_desc_textile' => '1',
            'smd_tag_t_desc_tooltip' => '1',
            'smd_tag_t_enrep'        => '1',
            'smd_tag_t_hilite'       => '91919a',
            'smd_tag_t_hover'        => 'aaa',
            'smd_tag_t_indent'       => '&nbsp;&nbsp;',
            'smd_tag_t_mdelim'       => ',',
            'smd_tag_t_size_desc'    => '240, 80',
        ),
        'smd_tag_prefs_u' => array(
            'smd_tag_u_combi'     => '1',
            'smd_tag_u_combi_and' => '+',
            'smd_tag_u_combi_or'  => '|',
            'smd_tag_u_pnam'      => 'smd_tag',
            'smd_tag_u_ptyp'      => 'smd_tagtype',
            'smd_tag_u_sec'       => 'smd_tags',
        ),
    );

    $old = array(
        'smd_tag_p_first',
    );

    switch ($type) {
        case 'set':
            $out = $current;
            break;
        case 'nameval':
            foreach ($current as $grp => $pref) {
                foreach ($pref as $name => $dflt) {
                    $out[$name] = $dflt;
                }
            }
            break;
        case 'name':
            foreach ($current as $grp => $pref) {
                foreach ($pref as $name => $dflt) {
                    $out[] = $name;
                }
            }
            break;
        case 'old':
            $out = $old;
            break;
        case 'default':
            $out = array();
            break;
    }

    return $out;
}

// ------------------------
function smd_tags_table_exist($all='0') {
    static $smd_tags_table_ok = array();

    if (isset($smd_tags_table_ok[$all])) {
        return $smd_tags_table_ok[$all];
    }

    if ($all) {
        $tbls = array(SMD_TAG => 9, SMD_TAGC => 2, SMD_TAGU => 3);
        $out = count($tbls);
        foreach ($tbls as $tbl => $cols) {
            if (gps('debug')) {
                echo "++ TABLE " . $tbl . " HAS " . count(@safe_show('columns', $tbl)) . " COLUMNS; REQUIRES " . $cols . " ++" . br;
            }
            if (count(@safe_show('columns', $tbl)) == $cols) {
                $out--;
            }
        }
        $ret = ($out===0) ? 1 : 0;
        $smd_tags_table_ok[1] = $ret;
        return $ret;
    } else {
        if (gps('debug')) {
            echo "++ TABLE " . SMD_TAG . " HAS " . count(@safe_show('columns', SMD_TAG)) . " COLUMNS;";
        }
        $ret = @safe_show('columns', SMD_TAG);
        $smd_tags_table_ok[0] = $ret;
        return $ret;
    }
}

// ------------------------
// Add tag tables if not already installed
function smd_tags_table_install($showpane='1') {
    global $DB;

    $debug = gps('debug');
    $GLOBALS['txp_err_count'] = 0;

    $ret = '';
    $sql = array();
    $sql[] = "CREATE TABLE IF NOT EXISTS `".PFX.SMD_TAG."` (
        `id` int(6) NOT NULL auto_increment,
        `name` varchar(64) NOT NULL default '' COLLATE utf8_general_ci,
        `type` varchar(64) NOT NULL default '' COLLATE utf8_general_ci,
        `parent` varchar(64) NOT NULL default '' COLLATE utf8_general_ci,
        `lft` int(6) NOT NULL default '0',
        `rgt` int(6) NOT NULL default '0',
        `title` varchar(255) NOT NULL default '' COLLATE utf8_general_ci,
        `description` text NULL COLLATE utf8_general_ci,
        `desc_html` text NULL COLLATE utf8_general_ci,
        PRIMARY KEY (`id`)
    ) ENGINE=MyISAM PACK_KEYS=1 AUTO_INCREMENT=5 CHARACTER SET=utf8";

    if (!smd_tags_table_exist()) {
        $sql[] = "INSERT INTO `".PFX.SMD_TAG."` VALUES (1, 'root', 'article', '', 1, 2, 'root', 'DO NOT DELETE', NULL)";
        $sql[] = "INSERT INTO `".PFX.SMD_TAG."` VALUES (2, 'root', 'link', '', 1, 2, 'root', 'DO NOT DELETE', NULL)";
        $sql[] = "INSERT INTO `".PFX.SMD_TAG."` VALUES (3, 'root', 'image', '', 1, 2, 'root', 'DO NOT DELETE', NULL)";
        $sql[] = "INSERT INTO `".PFX.SMD_TAG."` VALUES (4, 'root', 'file', '', 1, 2, 'root', 'DO NOT DELETE', NULL)";
    }

    $sql[] = "CREATE TABLE IF NOT EXISTS `".PFX.SMD_TAGC."` (
        `tag_id` int(6) NOT NULL default '0',
        `cat_id` int(6) NOT NULL default '0',
        PRIMARY KEY (`tag_id`,`cat_id`)
    ) ENGINE=MyISAM";

    $sql[] = "CREATE TABLE IF NOT EXISTS `".PFX.SMD_TAGU."` (
        `item_id` int(11) NOT NULL default '0',
        `tag_id` int(6) NOT NULL default '0',
        `type` varchar(64) NOT NULL default '' COLLATE utf8_general_ci,
        PRIMARY KEY (`item_id`,`tag_id`)
    ) ENGINE=MyISAM CHARACTER SET=utf8";

    if($debug) {
        dmp($sql);
    }
    foreach ($sql as $qry) {
        $ret = safe_query($qry);
        if ($ret===false) {
            $GLOBALS['txp_err_count']++;
            echo "<b>" . $GLOBALS['txp_err_count'] . ".</b> " . mysqli_error($DB->link) . "<br />\n";
            echo "<!--\n $qry \n-->\n";
        }
    }

    // Upgrade table collation if necessary
    $ret = getRows("SHOW TABLE STATUS WHERE name IN ('".PFX.SMD_TAG."', '".PFX.SMD_TAGU."')");
    if ($ret[0]['Collation'] != 'utf8_general_ci') {
        $ret = safe_alter(SMD_TAG, 'CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci', $debug);
    }
    if ($ret[1]['Collation'] != 'utf8_general_ci') {
        $ret = safe_alter(SMD_TAGU, 'CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci', $debug);
    }

    // Add the description column on upgrade
    $flds = getThings('SHOW COLUMNS FROM `'.PFX.SMD_TAG.'`');
    if (!in_array('description',$flds)) {
        safe_alter(SMD_TAG, "ADD `description` TEXT NULL AFTER `title`", $debug);
    }
    if (!in_array('desc_html',$flds)) {
        safe_alter(SMD_TAG, "ADD `desc_html` TEXT NULL AFTER `description`", $debug);
    }

    if ($GLOBALS['txp_err_count'] == 0) {
        $message = gTxt('smd_tag_tbl_installed');
        smd_tags_prefs_install($message, $showpane);
    } else {
        if ($showpane) {
            $message = gTxt('smd_tag_tbl_not_installed');
            smd_tags_prefs_show($message);
        }
    }
}

// ------------------------
// Drop tag tables if in database
function smd_tags_table_remove() {
    global $DB;

    $ret = '';
    $sql = array();
    $GLOBALS['txp_err_count'] = 0;
    if (smd_tags_table_exist()) {
        $sql[] = "DROP TABLE IF EXISTS " .PFX.SMD_TAG. "; ";
        $sql[] = "DROP TABLE IF EXISTS " .PFX.SMD_TAGU. "; ";
        $sql[] = "DROP TABLE IF EXISTS " .PFX.SMD_TAGC. "; ";
        if(gps('debug')) {
            dmp($sql);
        }
        foreach ($sql as $qry) {
            $ret = safe_query($qry);
            if ($ret===false) {
                $GLOBALS['txp_err_count']++;
                echo "<b>" . $GLOBALS['txp_err_count'] . ".</b> " . mysqli_error($DB->link) . "<br />\n";
                echo "<!--\n $qry \n-->\n";
            }
        }
    }
    if ($GLOBALS['txp_err_count'] == 0) {
        $message = gTxt('smd_tag_tbl_removed');
        smd_tags_prefs_remove($message);
    } else {
        $message = gTxt('smd_tag_tbl_not_removed');
        smd_tags_prefs_show($message);
    }
}
// ------------------------
// Rebuild modified preorder tag links
function smd_tags_table_rebuild() {
    $types = array('article', 'image', 'file', 'link');
    foreach ($types as $tag_type) {
        rebuild_tree_full($tag_type, SMD_TAG);
    }
    $message = gTxt('smd_tag_tbl_rebuilt');
    smd_tags_prefs_show($message);
}

// ------------------------
// Add plugin preferences to prefs
function smd_tags_prefs_install($message = '', $showpane = '1') {
    $smd_tag_prefs = smd_tags_get_prefs('nameval');

    $ctr = safe_count('txp_prefs', 'event="smd_tags"') + 1;

    foreach ($smd_tag_prefs as $pref => $dflt) {
        if (!get_pref($pref)) {
            set_pref($pref, $dflt, 'smd_tags', PREF_PLUGIN, 'text_input', $ctr);
            $ctr++;
        }
    }

    $smd_tag_prefs = smd_tags_get_prefs('old');

    // Tidy up any legacy prefs
    foreach ($smd_tag_prefs as $pref) {
        remove_pref($pref, 'smd_tags');
    }

    if ($showpane) {
        $message .= gTxt('smd_tag_prefs_installed');
        smd_tags_prefs_show($message);
    }
}

// ------------------------
// Remove plugin preferences from prefs table.
function smd_tags_prefs_remove($message = '', $showpane = '1') {
    $smd_tag_prefs = array_merge(smd_tags_get_prefs('name'), smd_tags_get_prefs('old'));

    foreach ($smd_tag_prefs as $pref) {
        remove_pref($pref, 'smd_tags');
    }

    if ($showpane) {
        $message .= gTxt('smd_tag_prefs_removed');
        smd_tags_prefs_show($message);
    }
}

// ------------------------
// Saves plugin preferences
function smd_tags_prefs_update($message = '') {
    $smd_tag_prefs = smd_tags_get_prefs('name');

    $post = doSlash(stripPost());

    foreach ($smd_tag_prefs as $pref) {
        if (isset($post[$pref])) {
            update_pref($pref, $post[$pref]);
        }
    }

    $message .= gTxt('preferences_saved');
    smd_tags_prefs_show($message);
}

// ------------------------
// Split a multi-char preference value into an array of keys/values.
// Note: value is passed in and not read directly from the prefs array in this function - intentionally
function smd_tags_pref_explode($val) {
    $order = array_values(array(gTxt('tab_list'),gTxt('tab_image'),gTxt('tab_file'),gTxt('tab_link')));
    $onoff = array_values(preg_split('//', $val, -1, PREG_SPLIT_NO_EMPTY));
    $out = array();

    foreach($order as $key1 => $value1) {
        $out[(string)$value1] = $onoff[$key1];
    }

    return $out;
}

// ------------------------
// Get values from prefs - pass either a single key or an array.
// If 2nd arg is set and the pref doesn't exist, read it from the plugin default
function smd_tags_pref_get($keys, $dflt = 0) {
    static $smd_tag_prefstore;

    $smd_tag_prefs = smd_tags_get_prefs('nameval');
    $prefout = array();

    if (!is_array($keys)) {
        $keys = array($keys);
    }

    // For later looping round defaults
    $allkeys = $keys;

    // Check the cache and remove any keys we've already fetched
    foreach ($keys as $idx => $key) {
        if (isset($smd_tag_prefstore[$key])) {
            $prefout[$key] = $smd_tag_prefstore[$key];
            unset($keys[$idx]);
        }
    }

    if ($keys) {
        $prefkeys = doQuote(join("','",doSlash($keys)));
        $rs = safe_rows('name,val,html','txp_prefs','name IN ('.$prefkeys.') ORDER BY name');

        foreach($rs as $pref) {
            $smd_tag_prefstore[$pref['name']] = $prefout[$pref['name']] = array_slice($pref, 1);
        }
    }

    if ($dflt) {
        foreach ($allkeys as $pref) {
            if (!isset($prefout[$pref])) {
                $prefout[$pref] = $smd_tag_prefs[$pref];
            }
        }
    }

    return $prefout;
}

// ------------------------
// Common buttons on the admin panel
function smd_tags_buttons() {
    $ret = array (
        'btnPrefsSave' => fInput('submit', 'submit', gTxt('save'), 'publish'),
        'btnInstallTbl' => sLink('smd_tags', 'smd_tags_table_install', '<span class="ui-icon ui-extra-icon-upload"></span> '.gTxt('smd_tag_tbl_install_lbl')),
        'btnRemoveTbl' => sLink('smd_tags', 'smd_tags_table_remove', '<span class="ui-icon ui-icon-trash"></span> '.gTxt('smd_tag_tbl_remove_lbl')),
        'btnRebuildTbl' => sLink('smd_tags', 'smd_tags_table_rebuild', '<span class="ui-icon ui-icon-refresh"></span> '.gTxt('smd_tag_tbl_rebuild_lbl')),
        'btnInstall' => sLink('smd_tags', 'smd_tags_prefs_install', '<span class="ui-icon ui-extra-icon-upload"></span> '.gTxt('smd_tag_pref_install_lbl')),
        'btnRemove' => sLink('smd_tags', 'smd_tags_prefs_remove', '<span class="ui-icon ui-icon-trash"></span> '.gTxt('smd_tag_pref_remove_lbl')),
        'btnPrefs' => sLink('smd_tags', 'smd_tags_prefs_show', '<span class="ui-icon ui-icon-gear"></span> '.gTxt('smd_tag_pref_show_lbl')),
        'btnManage' => sLink('smd_tags', 'smd_tags_manage', '<span class="ui-icon ui-icon-tag"></span> '.gTxt('smd_tag_manage_lbl')),
        'btnSync' => sLink('smd_tags', 'smd_tags_sync', '<span class="ui-icon ui-icon-arrowreturn-1-n"></span> '.gTxt('smd_tag_sync_lbl')),
        'btnSyncGo' => fInput('submit', 'smd_tags_do_import', gTxt('go'), 'publish'),
        'btnHelp' => '<a class="pophelp" rel="help" href="?event=plugin'.a.'step=plugin_help'.a.'name=smd_tags">?</a>',
        'btnCreate' => fInput('submit', 'smd_tag_create', gTxt('create'), 'publish', '', 'smd_tags_step=this.name;smd_presub()'),
        'btnSave' => fInput('submit', 'smd_tag_save', gTxt('update'), '', '', 'smd_tags_step=this.name;smd_presub()'),
        'btnDelete' => fInput('submit', 'smd_tags_delete', '×', '', '', 'smd_tags_step=this.name;smd_presub()'),
        'btnStyle' => ' style="border:0;height:25px"',
    );
    return $ret;
}

// ------------------------
// A stub that can be called from a Txp event
function smd_tags_setup($evt='', $stp='', $message='') {
    smd_tags_prefs_show();
}

/**
 * Display the prefs panel.
 *
 * @param      string  $message  The message to display
 */
function smd_tags_prefs_show($message = '')
{
    $smd_tag_prefs = smd_tags_get_prefs('set');
    $smd_tag_preflist = smd_tags_get_prefs('name');

    pagetop(gTxt('smd_tag_prefs_title'), $message);
    extract(smd_tags_buttons());

    // Prefs check
    $prefset = smd_tags_pref_get($smd_tag_preflist);
    $numReqPrefs = count($smd_tag_preflist);
    $numPrefs = count($prefset);
    $adv_text = gTxt('smd_tag_extras');

    echo script_js(<<<EOJS
// Concatenate checkbox options for storage
function smd_presub() {
    var smd_out = "";
    jQuery("#prefs-smd_tag_p_enable :checkbox").each(function() {
        smd_out += (this.checked) ? 1 : 0;
    });
    jQuery("#smd_tag_p_enable").val(smd_out);
    return true;
}
jQuery(function() {
    jQuery('.smd_tag_btn_advanced_toggle').click(function(e) {
        e.preventDefault();
        jQuery('.smd_tag_btn_advanced').toggle('fast');
    });
});
EOJS
    );

    if (smd_tags_table_exist(1)) {
        // Tables installed
        echo '<form method="post" action="?event=smd_tags' . a . 'step=smd_tags_prefs_update" onsubmit="return smd_presub();">';
        echo '<div class="txp-layout">'.
            n. '<div class="txp-layout-2col">'.
            n. '<h1 class="txp-heading">'.gTxt('smd_tag_prefs_title').sp.$btnHelp.'</h1>'.
            n. '</div>'.
            n. '<div class="txp-layout-2col">'.
            graf(
                    $btnManage
                    .n.$btnSync
                    .n.tag($btnInstall.n.$btnRemove.n.$btnRemoveTbl.n.$btnRebuildTbl, 'span', ' class="smd_tag_btn_advanced smd_hidden"')
                    .n.href($adv_text, '#', ' class="smd_tag_btn_advanced_toggle"')
                , ' class="txp-actions"').
            n. '</div>';

        if ($numPrefs == $numReqPrefs) {
            // Prefs all installed
            $groupOut = array();
            $prefOut = array();

            foreach ($smd_tag_prefs as $grp => $pset) {
                $out = array();
                $groupOut[] = n.tag(href(
                        gTxt($grp),
                        '#prefs_group_'.$grp,
                        array(
                            'data-txp-pane'  => $grp,
                            'data-txp-token' => md5($grp.'prefs'.form_token().get_pref('blog_uid')),
                        )),
                    'li');

                foreach ($pset as $pnam => $pdflt) {
                    $pval = get_pref($pnam, $pdflt, 1);
                    $label = '<label for="'.$pnam.'">'.gTxt($pnam).'</label>';
                    $widget = '';

                    switch($pnam) {
                        case "smd_tag_p_enable":
                            $options = smd_tags_pref_explode($pval);
                            foreach ($options as $opt => $onoff) {
                                $widget .= '<label>'.$opt.'</label>' . checkbox("enable".$opt, 1, $onoff) . '&#160;&#160;';
                            }

                            $widget .= fInput('hidden', 'smd_tag_p_enable', join($options),'','','','','','smd_tag_p_enable');
                            break;
                        case "smd_tag_p_size":
                        case "smd_tag_t_size_desc":
                        case "smd_tag_t_cols":
                        case "smd_tag_t_hilite":
                        case "smd_tag_t_hover":
                        case "smd_tag_t_indent":
                        case "smd_tag_u_pnam":
                        case "smd_tag_u_ptyp":
                        case "smd_tag_u_sec":
                        case "smd_tag_p_master":
                        case "smd_tag_u_combi_and":
                        case "smd_tag_u_combi_or":
                            $widget = fInput('text', $pnam, $pval, 'edit', '', '', 20, '', $pnam);
                            break;
                        case "smd_tag_t_mdelim":
                            $widget = fInput('text', $pnam, $pval, 'edit', '', '', 1, '', $pnam);
                            break;
                        case "smd_tag_p_qtpath":
                        case "smd_tag_p_qtstyl":
                            $widget = fInput('text', $pnam, $pval, 'edit', '', '', 30, '', $pnam);
                            break;
                        case "smd_tag_t_auto":
                            $widget = onoffRadio($pnam, $pval);
                            break;
                        case "smd_tag_t_colsord":
                            $rset = array(0 => gTxt('smd_tag_by_column'), 1 => gTxt('smd_tag_by_row'));
                            $widget = radioSet($rset, $pnam, $pval);
                            break;
                        case "smd_tag_t_deltree":
                            $rset = array(0 => gTxt('smd_tag_children_pro'), 1 => gTxt('smd_tag_children_del'));
                            $widget = radioSet($rset, $pnam, $pval);
                            break;
                        case "smd_tag_t_count":
                        case "smd_tag_t_delused":
                        case "smd_tag_t_desc_textile":
                        case "smd_tag_t_desc_tooltip":
                        case "smd_tag_t_enrep":
                        case "smd_tag_p_linkcat":
                        case "smd_tag_p_listpar":
                        case "smd_tag_u_combi":
                            $widget .= yesnoRadio($pnam, $pval);
                            break;
                        case "smd_tag_t_astart":
                            $rset = array(0 => gTxt('smd_tag_prefs_pane'), 1 => gTxt('smd_tag_tags_pane'));
                            $widget = radioSet($rset, $pnam, $pval);
                            break;
                        case "smd_tag_p_qtag":
                            $rset = array(0 => gTxt('off'), 1 => gTxt('smd_tag_ac_std'), 2 => gTxt('smd_tag_ac_str'));
                            $widget = radioSet($rset, $pnam, $pval);
                            break;
                        case "smd_tag_p_input":
                            $rset = array(0 => gTxt('smd_tag_sel_list'), 1 => gTxt('smd_tag_textlist'), 2 => gTxt('smd_tag_textbox'), 3 => gTxt('smd_tag_textboxplus'));
                            $widget = radioSet($rset, $pnam, $pval);
                            break;
                        case "smd_tag_p_lbi":
                            $rset = array(0 => gTxt('no'), 1 => gTxt('smd_tag_bi_up'), 2 => gTxt('smd_tag_bi_down'), 3 => gTxt('smd_tag_bi_both'));
                            $widget = radioSet($rset, $pnam, $pval);
                            break;
                    }

                    $out[] = inputLabel(
                        $pnam,
                        $widget,
                        $label,
                        '',
                        array(
                            'class' => 'txp-form-field',
                            'id'    => 'prefs-'.$pnam,
                        )
                    );

                }

                $prefOut[] = tag(
                    hed(gTxt($grp), 2, array('id' => 'prefs_group_'.$grp.'-label')).
                    join(n, $out), 'section', array(
                        'class'           => 'txp-prefs-group',
                        'id'              => 'prefs_group_'.$grp,
                        'aria-labelledby' => 'prefs_group_'.$grp.'-label',
                    )
                );
            }

        echo tag_start('div', array('class' => 'txp-layout-4col-alt')).
            wrapGroup(
                'smd_tags_prefs',
                n.tag(join($groupOut), 'ul', array('class' => 'switcher-list')),
                'smd_tag_prefs_title'
            );

        echo graf(fInput('submit', 'submit', gTxt('save'), 'publish'), array('class' => 'txp-save'));

        echo n.tag_end('div'). // End of .txp-layout-4col-alt.
            n.tag_start('div', array('class' => 'txp-layout-4col-3span')).
            join(n, $prefOut).
            n.tag_end('div'). // End of .txp-layout-4col-3span.
            tInput();
        } elseif ($numPrefs > 0 && $numPrefs < $numReqPrefs) {
            // Prefs possibly corrupt, or plugin updated
            echo startTable()
                .tr(tda(strong(gTxt('smd_tag_prefs_some')).br.br
                    .gTxt('smd_tag_prefs_some_explain').br.br
                    .gTxt('smd_tag_prefs_some_opts1'), ' colspan="2"')
                )
                .tr(
                    tda($btnRemove,$btnStyle)
                    . tda($btnInstall, $btnStyle)
                )
                .endTable();
        } else {
            // Prefs not installed
            echo startTable()
                .tr(tda(gTxt('smd_tag_prefs_not_installed'), ' colspan="2"'))
                .tr(tda($btnInstall, $btnStyle))
                .endTable();
        }
    } else {
        // Tables not installed
        echo startTable()
            .tr(tda(strong(gTxt('smd_tag_prefs_some_tbl')).br.br
                .gTxt('smd_tag_prefs_some_explain').br.br
                .gTxt('smd_tag_prefs_some_opts2'), ' colspan="2"')
            )
            .tr(tda($btnInstallTbl, $btnStyle))
            .endTable();
    }

    echo '</div></form>';
}

/**
 * Manage tags in a similar way to the categories tab.
 *
 * @param      string  $message  The message to display
 * @param      string  $report   The report to display
 */
function smd_tags_manage($message = '', $report = '')
{
    $smd_tag_prefs = smd_tags_get_prefs('name');

    extract(doSlash(gpsa(array('smd_tag_name', 'smd_tag_title', 'smd_tag_description', 'smd_tag_parent', 'smd_tag_cat', 'smd_tag_type', 'smd_tag_id'))));
    pagetop(gTxt('smd_tag_manage_lbl'),$message);
    extract(smd_tags_buttons());

    // Prefs check
    $prefset = smd_tags_pref_get($smd_tag_prefs);
    $numReqPrefs = count($smd_tag_prefs);
    $numPrefs = count($prefset);

    $types = array(
        'article' => ucfirst(gtxt('article')),
        'image' => gtxt('tag_image'),
        'file' => gtxt('file'),
        'link' => gtxt('tag_link'),
    );

    // Make up the radio buttons.
    $smd_tag_type = (!empty($smd_tag_type)) ? $smd_tag_type : 'article';

    $radios = array();

    foreach ($types as $key => $val) {
        $id = 'smd_tags_type-'.$key;
        $radios[] = n.radio('smd_tags_type', $key, ($smd_tag_type == $key) ? 1 : 0, $id).n.
                '<label for="'.$id.'">'.$val.'</label>';
    }

    $radios = join(n, $radios).n;

    // Create all the lists but hide them with CSS.
    // jQuery takes over and switches between them on demand.
    if (smd_tags_table_exist(1) && $numPrefs == $numReqPrefs) {
        // Sanitize the multi-tag delimiter
        $mdelim = substr($prefset['smd_tag_t_mdelim']['val'], 0, 1);
        $mdelim = ($mdelim == '') ? '' : '\\'.$mdelim;

        $colOpts = do_list($prefset['smd_tag_t_cols']['val'], ':');
        $layout = ($colOpts[0] == '0' || $colOpts[0] == 'list') ? 'list' : (($colOpts[0] == 'group') ? 'listgrp' : 'table');
        $colOrder = ($prefset['smd_tag_t_colsord']['val'] == 0) ? 'bycol' : 'byrow';
        $wraptag = $layout.':';

        if ($layout == 'table') {
            $tagCols = (is_numeric($colOpts[0]) && $colOpts[0] > 0) ? $colOpts[0] : 1;
            $wraptag .= $tagCols;
            $sel = 'td';
        } else {
            $wraptag .= (isset($colOpts[1])) ? $colOpts[1] : '0';
            $sel = 'li';
        }
        $wraptag .= ':cols:'.$colOrder;
        $counts = $prefset['smd_tag_t_count']['val'];
        $clink = $prefset['smd_tag_p_linkcat']['val'];
        $showrep = $report && $prefset['smd_tag_t_enrep']['val'];

        foreach (array_keys($types) as $type) {
            $divtagid = "smd_tags_grp_".$type;
            $taglist = "tags_".$type;
            $$taglist = smd_tag_list_adm(
                array(
                    "type" => $type,
                    "wraptag" => $wraptag,
                    "count" => $counts,
                    "indent" => $prefset['smd_tag_t_indent']['val']
                )
            );

            // @todo Find a way to add the divtagid only when needed. At the moment it appears twice on the page (illegal DOM)
            $tagout[$type] = '<div id="'.$divtagid.'">'.($$taglist ? $$taglist : gTxt('smd_tag_no_tags', array('{type}' => $type))).'</div>';
            echo '<div class="smd_hidden">' . $tagout[$type] . '</div>';
        }

        $qs = array(
            "event" => "smd_tags",
        );


        $qsVars = "index.php".join_qs($qs);
        $count_lbl = gTxt('smd_tag_count_lbl');

        echo script_js(<<<EOJS
var smd_tags_step = '';

// Page initialisation
jQuery(function() {
    // Indicate parent list is loading
    jQuery(".smd_tags_showpars").ajaxStart(function() {
        jQuery(this).fadeTo("normal", 0.33);
    }).ajaxStop(function() {
        jQuery(this).fadeTo("normal", 1);
    });

    // Switch between types
    jQuery("input[name='smd_tags_type']").change(function () {
        var smd_newcontent = jQuery("#smd_tags_grp_"+jQuery(this).val()).html();
        jQuery("input[name='smd_tag_id']").val(''); // Changing type forces any 'save' to trigger the 'create' behaviour
        jQuery(".smd_tags_showlist").html(smd_newcontent);
        var nam = jQuery("input[name='smd_tag_oname']").val();
        var dsc = jQuery("input[name='smd_tag_description']").val();
        var tid = jQuery("input[name='smd_tag_id']").val();
        var typ = jQuery("input[name='smd_tags_type']:checked").val();
        var par = 'root';
        var cat = '';

        jQuery(".smd_tags_showlist {$sel} span[name='smd_tagnam']").each(function() {
            if (jQuery(this).text() == nam) {
                jQuery(this).parent().addClass('smd_current');
                par = jQuery(this).siblings(":eq(2)").text();
                cat = jQuery(this).siblings(":eq(3)").text();
                dsc = jQuery(this).siblings(":eq(4)").text();
                tid = (tid == '') ? jQuery(this).siblings(":eq(0)").text() : tid;
            } else {
                jQuery(this).parent().removeClass('smd_current');
            }
        });

        // Re-insert the ID if this named item exists in the new list
        jQuery("input[name='smd_tag_id']").val(tid);

        // Update the UI
        smd_parentHandler(nam, typ, tid, par);
        smd_catHandler(cat, typ);
        jQuery(".smd_tags_linkcat select option[value='"+cat+"']").prop("selected", true);
        smd_autofocus();
        smd_cellHandler();
        jQuery("input[name='smd_tags_type']").each(function () {
            if (jQuery(this).val() == typ) {
                jQuery(this).next().addClass('smd_current');
            } else {
                jQuery(this).next().removeClass('smd_current');
            }
        });
    });

    // Call the onchange handler for the current type
    jQuery("input[name='smd_tags_type']:checked").change();

    // Autotag - TODO: foreign character dumbdown for URI
    if ({$prefset['smd_tag_t_auto']['val']}) {
        spcRE = /\s/g;
        badRE = /[^a-zA-Z0-9_\-{$mdelim}]/g;
        jQuery("input[name='smd_tags_newtitle']").keyup(function() {
            tagname = jQuery(this).val().replace(spcRE, '-').replace(badRE, '').toLowerCase();
            jQuery("input[name='smd_tags_newname']").val(tagname);
        });
    }
    // Bind Enter key to create
    jQuery("input[name^='smd_tag']").keyup(function(ev) {
        if (ev.keyCode == 13) {
            jQuery("input[name='smd_tag_create']").click();
        }
    });

    // Prepare the live filter
    jQuery('#smd_tag_filt legend a').click(function() {
        if (jQuery(this).parent().hasClass('expanded')) {
            jQuery('#smd_tagfilter').focus();
        }
    });

    jQuery('.smd_tag_list_adm {$sel}').addClass('visible');

    jQuery('#smd_tagfilter').keyup(function(event) {
        // if esc is pressed or nothing is entered
        if (event.keyCode == 27 || jQuery(this).val() == '') {
            jQuery(this).val('');
            jQuery('.smd_tag_list_adm {$sel}').removeClass('visible').show().addClass('visible');
            jQuery("#smd_tag_filter_count").empty();
        } else {
            currOpt = jQuery('#smd_tag_filt_radios :radio:checked').val();
            subfilt = (currOpt == 'smd_all') ? '' : currOpt;
            smd_tag_filter('.smd_tag_list_adm {$sel}', jQuery(this).val(), subfilt);
        }
    });
    // Trigger the filter if the radio buttons are clicked
    jQuery('#smd_tag_filt_radios :radio').change(function() {
        jQuery('#smd_tagfilter').keyup().focus();
    });
    if ('{$showrep}') {
        smd_tags_toggle_report();
    }

    jQuery('#smd_tags_report_toggler, .smd_tags_btn_ok').on('click', smd_tags_toggle_report_handler);
});

// Keep track of which tag has been clicked so it can be edited/updated
function smd_cellHandler() {
    // Cell highlights
    jQuery(".smd_tags_showlist {$sel}").each(function() {
        if (jQuery.trim(jQuery(this).text()) != "") {
            jQuery(this).hover(
                function () {
                    jQuery(this).addClass('smd_hover');
                },
                function () {
                    jQuery(this).removeClass('smd_hover');
                }
            )
            .click(function() {
                var nam = jQuery(this).children(":eq(0)").text();
                var tid = jQuery(this).children(":eq(1)").text();
                var ttl = jQuery(this).children(":eq(2)").text();
                var par = jQuery(this).children(":eq(3)").text();
                var cat = jQuery(this).children(":eq(4)").text();
                var dsc = jQuery(this).children(":eq(5)").text();
                var typ = jQuery("input[name='smd_tags_type']:checked").val()
                jQuery("input[name='smd_tag_oname']").val(nam);
                jQuery("input[name='smd_tags_newname']").val(nam);
                jQuery("input[name='smd_tag_id']").val(tid);
                jQuery("input[name='smd_tags_newtitle']").val(ttl);
                jQuery("textarea[name='smd_tags_description']").val(dsc);
                jQuery(".smd_tags_linkcat select option[value='"+cat+"']").prop("selected", true);
                smd_parentHandler(nam, typ, tid, par);
                jQuery(".smd_tags_showlist ${sel}").removeClass('smd_current');
                jQuery(this).addClass('smd_current');
                smd_autofocus();
            });
        }
    });
}

// Ask Txp for the parent dropdown without child entries
function smd_parentHandler(nam, typ, tid, par) {
    jQuery.post('{$qsVars}', { step: "smd_tag_parentlist", name: nam, type: typ, id: tid, link_mode: '2', _txp_token: textpattern._txp_token },
        function(data) {
            jQuery(".smd_tags_showpars").html(data);
            if (par == "root" || par == "") {
                jQuery(".smd_tags_showpars select option:first").prop("selected", true);
            } else {
                jQuery(".smd_tags_showpars select option[value='"+par+"']").prop("selected", true);
            }
        }
    );
}

// Ask Txp for the category dropdown
function smd_catHandler(cat, typ) {
    jQuery(".smd_tags_linkcat").fadeTo("normal", 0.33);
    jQuery.post('{$qsVars}', { step: "smd_tag_catlist", name: cat, type: typ, _txp_token: textpattern._txp_token },
        function(data) {
            jQuery(".smd_tags_linkcat").html(data);
            if (cat == "root" || cat == "") {
                jQuery(".smd_tags_linkcat select option:first").prop("selected", true);
            } else {
                jQuery(".smd_tags_linkcat select option[value='"+cat+"']").prop("selected", true);
            }
            jQuery(".smd_tags_linkcat").fadeTo("normal", 1);
        }
    );
}

function smd_autofocus() {
    jQuery("input[name='smd_tags_newtitle']").focus().select();
}

// Make sure what is in the visible boxes is POSTed via the hidden form
function smd_presub() {
    jQuery("#smd_tag_postit input[name='step']").val(smd_tags_step);
    jQuery("#smd_tag_postit input[name='smd_tag_name']").val(jQuery("input[name='smd_tags_newname']").val());
    jQuery("#smd_tag_postit input[name='smd_tag_title']").val(jQuery("input[name='smd_tags_newtitle']").val());
    jQuery("#smd_tag_postit input[name='smd_tag_type']").val(jQuery("input[name='smd_tags_type']:checked").val());
    jQuery("#smd_tag_postit input[name='smd_tag_parent']").val(jQuery(".smd_tags_showpars option:selected").val());
    jQuery("#smd_tag_postit input[name='smd_tag_cat']").val(jQuery(".smd_tags_linkcat option:selected").val());
    jQuery("#smd_tag_postit input[name='smd_tag_description']").val(jQuery("textarea[name='smd_tags_description']").val());
    jQuery("#smd_tag_postit").submit();
}

function smd_multisub() {
    theType = jQuery("input[name='smd_tags_type']:checked").val();
    jQuery("#smd_tag_multiform input[name='step']").val(smd_tags_step);
    jQuery("#smd_tag_multiform input[name='smd_tag_type']").val(theType);
    jQuery("#smd_tag_multiform input[name='smd_tag_id']").val(jQuery.map( jQuery("#smd_tags_grp_"+theType+" .visible").find("span[name='smd_tagid']"), function(n,i) {return jQuery(n).text()} ));
    jQuery("#smd_tag_multiform input[name='smd_tag_name']").val(jQuery.map( jQuery("#smd_tags_grp_"+theType+" .visible").find("span[name='smd_tagnam']"), function(n,i) {return jQuery(n).text()} ));
    jQuery("#smd_tag_multiform input[name='smd_tag_description']").val(jQuery.map( jQuery("#smd_tags_grp_"+theType+" .visible").find("span[name='smd_tagdsc']"), function(n,i) {return jQuery(n).text()} ));
    jQuery("#smd_tag_multiform input[name='smd_tag_extra']").val(jQuery("#smd_tag_sel_secondary option:selected").val());
}

// Live tag filter
function smd_tag_filter(selector, query, nam) {
    var count_lbl = '{$count_lbl}';
    var query = jQuery.trim(query);
    query = query.replace(/ /gi, '|'); // add OR for regex query
    var re = new RegExp(query, "i");
    jQuery(selector).each(function() {
        sel = (typeof nam=="undefined" || nam=='') ? jQuery(this) : jQuery(this).find("span[name='"+nam+"']");
        (sel.text().search(re) < 0) ? jQuery(this).hide().removeClass('visible') : jQuery(this).show().addClass('visible');
    });

    // Display the matched count
    theType = jQuery("input[name='smd_tags_type']:checked").val();
    num_matches = count_lbl + jQuery("#smd_tags_grp_"+theType+" .visible").length;
    jQuery("#smd_tag_filter_count").text(num_matches);
}

// Handle secondary multi-select options
function smd_tags_seledit(obj) {
    smd_tags_step = jQuery(obj).val();
    theType = jQuery("input[name='smd_tags_type']:checked").val();

    switch(smd_tags_step) {
        case "smd_tags_multi_set_parent":
            // Grab all elements of the current type that have data in them
            listitems = jQuery("#smd_tags_grp_"+theType+" {$sel}").filter(function() {return jQuery(this).find('span').length > 0}).get();
            listitems.sort(function(a, b) {
                var compA = jQuery(a).text().toUpperCase();
                var compB = jQuery(b).text().toUpperCase();
                return (compA < compB) ? -1 : (compA > compB) ? 1 : 0;
            });

            out = '<select id="smd_tag_sel_secondary">';
            out += '<option value="0"></option>';
            jQuery.each(listitems, function() {
                item = jQuery(this);
                tagid = jQuery(this).find("span[name='smd_tagid']").text();
                tagnam = jQuery(this).find("span[name='smd_tagnam']").text();
                out += '<option value="'+tagid+'">'+tagnam+'</option>';
            });
            out += '</select>';
            jQuery("#smd_tag_multi_placeholder").html(out);
            break
        case "smd_tags_multi_catlink":
            jQuery.post('{$qsVars}', { step: "smd_tag_catlist", type: theType, html_id: 'smd_tag_sel_secondary', _txp_token: textpattern._txp_token  },
                function(data) {
                    jQuery("#smd_tag_multi_placeholder").html(data);
                }
            );
            break
        case "smd_tags_delete":
        case '':
            jQuery("#smd_tag_multi_placeholder").empty();
            break;
    }
}

/**
 * jQuery callback for displaying tag report.
 */
function smd_tags_toggle_report_handler(ev) {
    ev.preventDefault();
    smd_tags_toggle_report();
}

function smd_tags_toggle_report() {
    jQuery("#smd_tag_report_pane").toggle('fast');
}
EOJS
        );
    }

    // The tag management panel
    if (smd_tags_table_exist()) {
        // Tables installed
        if ($numPrefs == $numReqPrefs) {
            // Prefs all installed
            echo '<div class="txp-layout">'.
                n. '<div class="txp-layout-2col">'.
                n. hed(gTxt('smd_tag_manage_lbl').sp.$btnHelp, 1).
                n. '</div>'.
                n. '<div class="txp-layout-2col">'.
                graf(
                    $btnSync
                    .n.$btnPrefs
                , ' class="txp-actions"').
            n. '</div>';

            // Live search / multi-edit
            $filtopts = array(
                'smd_all' => gTxt('smd_tag_all_lbl'),
                'smd_tagttl' => gTxt('title'),
                'smd_tagdsc' => gTxt('description'),
                'smd_tagnam' => gTxt('name'),
                'smd_tagpar' => gTxt('smd_tag_parent_lbl'),
            );
            $withselopts = array(
                'smd_tags_delete' => gTxt('delete'),
                'smd_tags_multi_set_parent' => gTxt('smd_tag_assign_parent_lbl'),
            );
            // Tack on the category link items if required
            if ($clink) {
                $filtopts['smd_tagcat'] = gTxt('smd_tag_clink_lbl');
                $withselopts['smd_tags_multi_catlink'] = gTxt('smd_tag_link_to_cat_lbl');
            }

            $descsizes = do_list($prefset['smd_tag_t_size_desc']['val']);
            $descw = (int)$descsizes[0];
            $desch = (isset($descsizes[1])) ? (int)$descsizes[1] : $descw;
            echo '<div class="txp-layout-1col">';
            echo n. '<form id="smd_tag_multiform" action="?event=smd_tags" method="post" onsubmit="smd_multisub(); return verify(\''.gTxt('are_you_sure').'\')">'
                .n. '<fieldset id="smd_tag_filt"><legend class="txp-summary lever'.(get_pref('pane_smd_tag_filters_visible') ? ' expanded' : '').'"><a href="#smd_tag_filters">'.gTxt('smd_tag_tag_search').'</a></legend><div id="smd_tag_filters" class="toggle" style="display:'.(get_pref('pane_smd_tag_filters_visible') ? 'block' : 'none').'">'
                .n. hInput('step', '')
                .n. hInput('smd_tag_type', '')
                .n. hInput('smd_tag_id', '')
                .n. hInput('smd_tag_name', '')
                .n. hInput('smd_tag_description', '')
                .n. hInput('smd_tag_extra', '')
                .n. tInput()
                .n. '<input type="text" name="smd_tagfilter" value="" id="smd_tagfilter" size="30" />'
                .n. '<span id="smd_tag_filter_count"></span>'
                .n. '<div id="smd_tag_filt_radios">'.radioSet($filtopts, 'smd_tag_filtopt', 'smd_all', '', 'smd_tag_filtopt').'</div>'
                .n. '<div id="smd_tag_multisel">'.gTxt('smd_tag_with_filtered').selectInput('smd_tag_multisel',$withselopts, '', true, ' onchange="smd_tags_seledit(this); return false;"').n.fInput('submit', '', gTxt('go'), 'publish').'</div>'
                .n. '<div id="smd_tag_multi_placeholder"></div><a href="#" id="smd_tags_report_toggler">'.gTxt('smd_tag_recent_report').'</a>'
                .n. '</div>'
                .n. '</fieldset>'
                .n. '</form>';

            // Report popup
            echo n. '<div id="smd_tag_report_pane"><div>'.href('&#215;', '#close', ' class="smd_tags_btn_ok" role="button" title="'.gTxt('close').'" aria-label="'.gTxt('close').'"').'<h3>'.gTxt('smd_tag_report_lbl').'</h3>'.$report.'</div></div>'
                .n. '<form method="post" id="smd_tag_postit" action="?event=smd_tags">'
                .n. hInput('step', '')
                .n. hInput('smd_tag_id', $smd_tag_id)
                .n. hInput('smd_tag_name', '')
                .n. hInput('smd_tag_oname', $smd_tag_name)
                .n. hInput('smd_tag_parent', '')
                .n. hInput('smd_tag_cat', '')
                .n. hInput('smd_tag_title', '')
                .n. hInput('smd_tag_type', '')
                .n. hInput('smd_tag_description', '')
                .n. tInput()
                .n. '</form>';

            // Tag create/edit row
            echo n.hed(gTxt('smd_tag_create_lbl'), 2)
                .n.'<div class="smd_tags_new">'
                    .n.'<div class="smd_tags_input_group">'
                        . '<label for="smd_tags_newtitle">'.gTxt('title').'</label>'
                        . fInput('text', 'smd_tags_newtitle', $smd_tag_title, '', '', '', '', '', 'smd_tags_newtitle')
                        . '<label for="smd_tags_newname">'.gTxt('name').'</label>'
                        . fInput('text', 'smd_tags_newname', $smd_tag_name, '', '', '', '', '', 'smd_tags_newname')
                    .n.'</div>'
                    .n.'<div class="smd_tags_input_group">'
                        . '<label for="smd_tags_description">'.gTxt('description').'</label>'
                        . text_area('smd_tags_description', $desch, $descw, $smd_tag_description, 'smd_tags_description')
                    .n.'</div>'
                    .n.'<div class="smd_tags_input_group">'
                        . '<label>'.gTxt('parent').'</label>'
                        . '<span class="smd_tags_showpars"></span>'
                        . (($clink)
                            ? n. '<label>'.gTxt('smd_tag_clink_lbl').'</label>'
                                .n. '<span class="smd_tags_linkcat"></span>'
                            : ''
                        )
                    .n.'</div>'
                    .n.'<div class="smd_tags_input_group">'
                        .n. $btnCreate
                        .n. $btnSave
                        .n. $btnDelete
                    .n.'</div>'
                .n.'</div>';

            // The tags themselves
            echo '<div class="smd_tags_pool">'
                    .n. hed(gTxt('smd_tag_pool_lbl'), 2)
                    .n. '<div class="smd_tags_type_selection">' . $radios .n. '</div>'
                    .n. '<div class="smd_tags_showlist">' . $tagout[$smd_tag_type] .n. '</div>'
                .n.'</div>'
                .n.'</div>';
        } elseif ($numPrefs > 0 && $numPrefs < $numReqPrefs) {
            // Prefs possibly corrupt, or plugin updated
            echo n. startTable()
                .n. tr(
                    tda(strong(gTxt('smd_tag_prefs_some')).br.br
                        .gTxt('smd_tag_prefs_some_explain').br.br
                        .gTxt('smd_tag_prefs_some_opts1'), ' colspan="2"')
                )
                .n. tr(
                    tda($btnRemove,$btnStyle)
                    . tda($btnInstall, $btnStyle)
                )
                .n. endTable();

        } else {
            // Prefs not installed
            echo n. startTable()
                .n. tr(tda(gTxt('smd_tag_prefs_not_installed'), ' colspan="2"'))
                .n. tr(tda($btnInstall, $btnStyle))
                .n. endTable();
        }
    } else {
        // Tables not installed
        echo n. startTable()
            .n. tr(tda(strong(gTxt('smd_tag_prefs_some_tbl')).br.br
                .gTxt('smd_tag_prefs_some_explain').br.br
                .gTxt('smd_tag_prefs_some_opts2'), ' colspan="2"')
            )
            .n. tr(tda($btnInstallTbl, $btnStyle))
            .n. endTable();
    }

    echo '</div>';
}

// ------------------------
// Store the tag that is currently being edited/created
function smd_tag_save() {
    // Defer doSlash of description until after Textile's had a go
    extract(doSlash(gpsa(array('smd_tag_oname', 'smd_tag_name', 'smd_tag_title', 'smd_tag_parent', 'smd_tag_cat', 'smd_tag_type', 'smd_tag_id'))));
    include_once txpath.'/publish.php'; // for parse()

    $smd_tag_description = $smd_tags_desctile = ps('smd_tag_description');

    $ctrls = smd_tags_pref_get(array('smd_tag_t_mdelim', 'smd_tag_t_desc_textile'), 1);
    $mdelim = $ctrls['smd_tag_t_mdelim']['val'];
    $txt_desc = $ctrls['smd_tag_t_desc_textile']['val'];

    $message = $report = '';
    $missing = 0;
    $ok = $notok = array();
    $smd_tag_parent = (!empty($smd_tag_parent)) ? $smd_tag_parent : 'root';
    $smd_tag_name = trim($smd_tag_name);

    $textile = new \Textpattern\Textile\Parser();
    $smd_tags_desctile = doSlash((($txt_desc) ? $textile->parse(parse($smd_tag_description)) : parse($smd_tag_description)));
    $smd_tag_description = doSlash($smd_tag_description);

    // Can't use safe_upsert() because the WHERE is for ID AND type
    if (empty($smd_tag_id)) {
        // Create
        if ($smd_tag_name == '' && $smd_tag_title == '') {
            $message = array(gTxt('smd_tag_no_name', array('{type}' => ucfirst($smd_tag_type))), E_WARNING);
        } else {
            $alltagnam = do_list($smd_tag_name, $mdelim);
            $alltagttl = do_list($smd_tag_title, $mdelim);
            $numtags = count($alltagnam);

            foreach ($alltagnam as $idx => $theTag) {
                if ($theTag == '') {
                    $missing++;
                }

                $theTtl = (isset($alltagttl[$idx]) && $alltagttl[$idx] != '') ? $alltagttl[$idx] : $theTag;
                $theNam = ($theTag == '') ? sanitizeForUrl($theTtl) : sanitizeForUrl($theTag);

                $exists = safe_field('name', SMD_TAG, "name = '$theNam' AND type = '$smd_tag_type'");
                $parex = safe_field('name', SMD_TAG, "name = '$smd_tag_parent' AND type = '$smd_tag_type'");

                if ($exists) {
                    if ($numtags > 1) {
                        $notok[$idx] = 'smd_tag_already_exists';
                    } else {
                        $message = array(gTxt('smd_tag_exists', array('{name}' => $theNam, '{type}' => ucfirst($smd_tag_type))), E_WARNING);
                    }
                } else {
                    $smd_tag_id = safe_insert(
                        SMD_TAG,
                        "name='$theNam', title='$theTtl', description='$smd_tag_description', desc_html='$smd_tags_desctile', parent='".(($parex) ? $smd_tag_parent : 'root')."', type='$smd_tag_type'"
                    );
                    if ($smd_tag_id > 0) {
                        if ($smd_tag_cat) {
                            safe_insert(SMD_TAGC,"tag_id='$smd_tag_id', cat_id=(SELECT id FROM ".PFX."txp_category WHERE name='$smd_tag_cat' AND type='$smd_tag_type')");
                        }
                        if ($numtags > 1) {
                            $ok[] = $theNam;
                        } else {
                            $message = gTxt('smd_tag_created', array('{name}' => $theNam, '{type}' => ucfirst($smd_tag_type)));
                        }
                    } else {
                        if ($numtags > 1) {
                            $notok[$idx] = 'smd_tag_unable_to_create';
                        } else {
                            $message = array(gTxt('smd_tag_not_created', array('{name}' => $smd_tag_name, '{type}' => ucfirst($smd_tag_type))), E_WARNING);
                        }
                    }
                }
            }

            // Generate the report
            if ($ok) {
                $report = gTxt('smd_tag_created_rep_lbl').join(', ', $ok).'.';
            }
            if ($notok) {
                $msgs = array();
                foreach ($notok as $idx => $reason) {
                    $msgs[] = $alltagnam[$idx].sp.'('.gTxt($reason).')';
                }
                $report .= br.br.gTxt('smd_tag_not_created_rep_lbl').join(', ', $msgs);
                $report .= ($missing) ? br.br.gTxt('smd_tag_missing_rep_lbl').$missing : '';
            }
        }
    } else {
        // Update - no need to maintain referential integrity unlike txp_cats
        // since tags are stored against item IDs
        $smd_tag_title = (empty($smd_tag_title)) ? $smd_tag_name : $smd_tag_title;
        $smd_tag_name = (empty($smd_tag_name)) ? sanitizeForUrl($smd_tag_title) : sanitizeForUrl($smd_tag_name);
        $existing_id = safe_field('id', SMD_TAG, "name = '$smd_tag_name' and type = '$smd_tag_type'");

        if ($existing_id and $existing_id != $smd_tag_id) {
            $message = array(gTxt('smd_tag_exists', array('{name}' => $smd_tag_name, '{type}' => ucfirst($smd_tag_type))), E_WARNING);
        } else {
            if (safe_update(
                    SMD_TAG,
                    "name='$smd_tag_name', title='$smd_tag_title', parent='$smd_tag_parent', description='$smd_tag_description', desc_html='$smd_tags_desctile'",
                    "type='$smd_tag_type' AND id=$smd_tag_id"
                )) {
                safe_update(SMD_TAG, "parent='$smd_tag_name'", "parent='$smd_tag_oname' AND type='$smd_tag_type'");
                if ($smd_tag_cat) {
                    safe_upsert(SMD_TAGC, "cat_id=(SELECT id FROM ".PFX."txp_category WHERE name='$smd_tag_cat' AND type='$smd_tag_type')", "tag_id = '$smd_tag_id'");
                } else {
                    safe_delete(SMD_TAGC, "tag_id=$smd_tag_id");
                }
                $message = gTxt('smd_tag_updated', array('{name}' => $smd_tag_name, '{type}' => ucfirst($smd_tag_type)));
            } else {
                $message = array(gTxt('smd_tag_not_updated', array('{name}' => $smd_tag_name, '{type}' => ucfirst($smd_tag_type))), E_WARNING);
            }
        }
    }

    rebuild_tree_full($smd_tag_type, SMD_TAG);

    // Force smd_tag_id to the new ID so it can be immediately edited
    $_POST['smd_tag_id'] = $smd_tag_id;

    smd_tags_manage($message, $report);
}

// ------------------------
// Store new tag - uses smd_tag_save without the ID/old_name
function smd_tag_create() {
//  extract(doSlash(gpsa(array('smd_tag_name', 'smd_tag_title', 'smd_tag_description', 'smd_tag_parent', 'smd_tag_type'))));
    unset($_POST['smd_tag_id']);
    smd_tag_save();
}

// ------------------------
// Check if the passed tag exists.
// Return its ID if it does or insert it if it doesn't. Optionally assign it to a parent tag / Txp category
function smd_tag_getsert($tag_name, $tag_type, $tag_title='', $tag_parent='', $tag_cat='', $tag_desc='', $force_parent=false, $force_cat=false) {
    $ctrls = smd_tags_pref_get(array('smd_tag_p_linkcat'), 1);
    $clink = $ctrls['smd_tag_p_linkcat']['val'];
    $tag_title = ($tag_title == '') ? $tag_name : $tag_title;
    $tag_title = doSlash($tag_title);
    $tag_name = doSlash(sanitizeForUrl($tag_name));
    $tag_type = doSlash($tag_type);
    $tag_desc = doSlash($tag_desc);
    $tag_parent = ($tag_parent) ? doSlash(sanitizeForUrl($tag_parent)) : 'root';
    $tag_cat = doSlash($tag_cat);

    $ret = safe_field('id', SMD_TAG, "name = '$tag_name' AND type = '$tag_type'");
    if (!$ret) {
        $ret = safe_insert(SMD_TAG, "name='".$tag_name."', title='$tag_title', parent='$tag_parent', type='$tag_type', description='$tag_desc', desc_html='$tag_desc'");
        rebuild_tree_full($tag_type, SMD_TAG);
    } elseif($force_parent) {
        $upd = safe_update(SMD_TAG, "parent='$tag_parent'", "id='".doSlash($ret)."'");
        rebuild_tree_full($tag_type, SMD_TAG);
    }

    // Assign tag to category if required
    $ret = doSlash($ret);
    if ($clink && $tag_cat) {
        $catid = safe_field('cat_id', SMD_TAGC, "tag_id='$ret'");

        if ($catid && $force_cat) {
            safe_delete(SMD_TAGC, "cat_id='".$catid."' AND tag_id='".$ret."'");
            $catid = false;
        }

        if(!$catid) {
            safe_insert(SMD_TAGC, "tag_id='$ret', cat_id=(SELECT id FROM ".PFX."txp_category WHERE name='$tag_cat' AND type='$tag_type')");
        }
    }

    return $ret;
}

// ------------------------
// Link the passed tags array with the given item ID
function smd_tag_link($itemid, $tagarr, $tag_type) {
    assert_int($itemid);

    // TODO: Remove any existing tags?? Perhaps make this an option?
//  safe_delete(SMD_TAGU, 'item_id="'.$itemid.'" AND type="'.doSlash($tag_type).'"');
    $tag_type = doSlash($tag_type);

    $ctr = $ret = 0;
    foreach ($tagarr as $theTag) {
        if ($theTag == '') continue;
        $theTag = doSlash($theTag); // Probably not necessary

        $exists = safe_field('item_id', SMD_TAGU, "tag_id = '$theTag' AND item_id = '$itemid' AND type = '$tag_type'");

        if (!$exists) {
            $ret = safe_insert(SMD_TAGU, 'tag_id = "'.$theTag.'", item_id="'.$itemid.'", type="'.$tag_type.'"');
            if ($ret) {
                $ctr++;
            }
        }
    }

    return $ctr;
}

// ------------------------
// Delete the given tag(s). Respects noclobber/tree/orphans depending on prefs
function smd_tags_delete() {
    extract(doSlash(gpsa(array('smd_tag_id', 'smd_tag_name', 'smd_tag_type'))));

    $message = $msgExtra = $report = '';
    $ok = $notok = array();

    $pref = smd_tags_pref_get(array('smd_tag_t_delused', 'smd_tag_t_deltree'));
    $delu = $pref['smd_tag_t_delused']['val'];
    $delt = $pref['smd_tag_t_deltree']['val'];

    $smd_tag_id = do_list($smd_tag_id);
    $smd_tag_name = do_list($smd_tag_name);

    $with_child = safe_column('id', SMD_TAG, "id IN ('".join("','", $smd_tag_id)."') AND (((rgt-lft-1)/2) > 0) AND type='$smd_tag_type'");
    $used_tags = safe_column('tag_id', SMD_TAGU, "tag_id IN ('".join("','", $smd_tag_id)."') AND type='$smd_tag_type'");

    $to_del = $smd_tag_id;
    // Protect used and child tags if required
    if ($delu == 0) {
        $to_del = array_diff($smd_tag_id, $with_child, $used_tags);
        foreach (array_merge($with_child, $used_tags) as $delid) {
            $notok[] = $smd_tag_name[array_search($delid, $smd_tag_id)];
        }
    }

    $orphans = array();
    if ($delt) {
        // Add child tags if they are to be deleted
        $ids = $to_del;
        foreach ($to_del as $delid) {
            $row = safe_row('*', SMD_TAG, "id = '$delid' AND type='$smd_tag_type'");
            $ids = array_merge($ids, safe_column('id', SMD_TAG, "type = '$smd_tag_type' AND (lft BETWEEN ".$row['lft']." AND ".$row['rgt'].")"));
        }
        $to_del = array_unique($ids);
        $msgExtra = gTxt('smd_tag_children_and');
    } else {
        // Collect the potential orphans and prepare to promote them
        foreach ($to_del as $delid) {
            $children = safe_column('id', SMD_TAG, "parent = '".$smd_tag_name[array_search($delid, $smd_tag_id)]."' AND type='$smd_tag_type'");
            $children = array_diff($children, $to_del);
            if ($children) {
                $orphans += $children;
            }
        }
    }

    // Everything's prepped: begin the deletion
    $numdel = count($to_del);

    // Make a note of what we're about to do for the report
    $all_dels = safe_rows('id, name', SMD_TAG, "id IN (" . join(',', quote_list($to_del)) . ")");
    $all_names = array();
    foreach ($all_dels as $aname) {
        $all_names[$aname['id']] = $aname['name'];
    }
    foreach ($to_del as $delid) {
        if (isset($all_names[$delid])) {
            $ok[] = $all_names[$delid];
        }
    }

    // First get rid of the direct tags
    $where = " IN ('".join("','", $to_del)."')";
    $ret = safe_delete(SMD_TAG, 'id'.$where." AND type='$smd_tag_type'");
    if ($ret) {
        if (!$delt) {
            // Promote the orphans if required
            $orphlist = safe_column('name', SMD_TAG, "type='$smd_tag_type' AND id IN ('".join("','", $orphans)."')");
            safe_update(SMD_TAG, "parent='root'", "type='$smd_tag_type' AND id IN ('".join("','", $orphans)."')");
        }
        // Remove references to any deleted tags in articles and linked categories
        safe_delete(SMD_TAGU, 'tag_id'.$where." AND type='$smd_tag_type'");
        safe_delete(SMD_TAGC, 'tag_id'.$where);

        // Force all smd_tag_ boxes clear in the form
        $_POST['smd_tag_id'] = $_POST['smd_tag_oname'] = $_POST['smd_tag_name'] = $_POST['smd_tag_title'] = $_POST['smd_tag_parent'] = '';
    }

    // Build and generate the final report
    if ($numdel > 1) {
        $message = gTxt('smd_tag_multi_delete', array('{number}' => $numdel));
        if ($ok) {
            $report = gTxt('smd_tag_deleted_lbl').join(', ', $ok).'.';
        }
        if ($notok) {
            $report .= br.br.gTxt('smd_tag_err_in_use_lbl').join(', ', $notok);
        }
        if ($orphans) {
            $report .= br.br.gTxt('smd_tag_err_orphaned_lbl').join(', ', $orphlist);
        }
    } else {
        if ($ok) {
            $message = gTxt('smd_tag_deleted', array('{type}' => ucfirst($smd_tag_type), '{name}' => join(', ', $ok))).$msgExtra;
        } elseif ($notok) {
            $message = gTxt('smd_tag_in_use', array('{type}' => ucfirst($smd_tag_type), '{name}' => join(', ', $notok)));
        }
    }

    rebuild_tree_full($smd_tag_type, SMD_TAG);

    smd_tags_manage($message, $report);
}

// ------------------------
// Make the passed tag a child of the given parent (if possible)
function smd_tag_assign_parent($parid, $childid, $tag_type, $childnam, $rebuild = true) {
    assert_int($childid);
    assert_int($parid);
    $status = array();
    if ($childid == $parid) {
        $status[] = 'err_self_parent';
    } else {
        $exists = safe_field('name', SMD_TAG, "id = '".doSlash($parid)."' AND type = '".doSlash($tag_type)."'");
        $exists = ($exists == '') ? 'root' : $exists;
        $ret = safe_update(SMD_TAG, "parent='".doSlash($exists)."'", "id='".$childid."'");
        if ($rebuild) {
            // Doesn't hurt to rebuild it anyway, even if the assignment fails
            rebuild_tree_full($tag_type, SMD_TAG);
        }
        if ($ret) {
            $status[] = 'parent_linked';
        } else {
            $status[] = 'parent_not_linked';
        }
    }

    return $status;
}


// ------------------------
// Assign a parent to a bunch of tags at once
// Cheating code really; just calls the smd_tag_assign_parent for each tag but delays the
// tree rebuild until the end for speed
function smd_tags_multi_set_parent() {
    extract(doSlash(gpsa(array('smd_tag_type', 'smd_tag_id', 'smd_tag_name', 'smd_tag_extra'))));

    $message = $report = '';
    $ok = $notok = array();
    $theList = array_combine(do_list($smd_tag_id), do_list($smd_tag_name));

    foreach ($theList as $idx => $name) {
        $status = smd_tag_assign_parent($smd_tag_extra, $idx, $smd_tag_type, $name, false);
        if (in_array('parent_linked', $status)) {
            $ok[] = $name;
        } else {
            if (($pos = array_search('parent_not_linked', $status)) !== false) {
                unset($status[$pos]);
            }
            $notok[$idx] = $status;
        }
    }

    if ($ok) {
        $parnam = safe_field('name', SMD_TAG, "id='".doSlash($smd_tag_extra)."'");
        $parnam = ($parnam == '') ? 'root' : $parnam ;
        $report = gTxt('smd_tag_parent_linked_lbl', array('{parent}' => $parnam)).join(', ', $ok).'.';
    }
    if ($notok) {
        $msgs = array();
        foreach ($notok as $idx => $reasons) {
            $rsn = array();
            foreach ($reasons as $reason) {
                $rsn[] = gTxt($reason);
            }
            $msgs[] = $theList[$idx].sp.'('.join('/', $rsn).')';
        }
        $report .= br.br.gTxt('smd_tag_not_parent_linked_lbl').join(', ', $msgs);
    }

    // Rebuild the tree now all the manipulation has been done
    rebuild_tree_full($smd_tag_type, SMD_TAG);

    smd_tags_manage($message, $report);
}

// ------------------------
// Links the passed tag with the given category
function smd_tag_assign_category($parnam, $childid, $cat_type, $childnam) {
    assert_int($childid);
    $status = array();

    // Unlink if parent category name is empty
    if ($parnam == '') {
        safe_delete(SMD_TAGC, "tag_id='".doSlash($childid)."'");
        $status[] = 'category_unlinked';
    } else {
        $exists = safe_field('id', 'txp_category', "name = '".doSlash($parnam)."' AND type = '".doSlash($cat_type)."'");
        if ($exists) {
            safe_delete(SMD_TAGC, "tag_id='".doSlash($childid)."'");
            $ret = safe_insert(SMD_TAGC, "cat_id='".doSlash($exists)."', tag_id = '".doSlash($childid)."'");
            if ($ret) {
                $status[] = 'category_linked';
            } else {
                $status[] = 'category_unlinked';
            }
        }
    }
    return $status;
}


// ------------------------
// Assign a bunch of tags to a category
// Cheatingly calls smd_tag_assign_category multiple times
function smd_tags_multi_catlink() {
    extract(doSlash(gpsa(array('smd_tag_type', 'smd_tag_id', 'smd_tag_name', 'smd_tag_extra'))));

    $message = $report = '';
    $ok = $notok = array();

    $theList = array_combine(do_list($smd_tag_id), do_list($smd_tag_name));

    // Add in any child elements since they all need to take the category too
    foreach ($theList as $idx => $name) {
        $row = safe_row('*', SMD_TAG, "id='".doSlash($idx)."'");
        $rs = safe_rows('id, name', SMD_TAG, "type = '".doSlash($smd_tag_type)."' AND (lft BETWEEN " .$row['lft']. " AND " .$row['rgt']. ")");
        if ($rs) {
            foreach ($rs as $rec) {
                $theList[$rec['id']] = $rec['name'];
            }
        }
    }

    foreach ($theList as $idx => $name) {
        $status = smd_tag_assign_category($smd_tag_extra, $idx, $smd_tag_type, $name);
        if (in_array('category_linked', $status)) {
            $ok[] = $name;
        } elseif (in_array('category_unlinked', $status)) {
            $notok[$idx] = $status;
        }
    }

    if ($ok) {
        $report = gTxt('smd_tag_category_linked_lbl', array('{category}' => $smd_tag_extra)).join(', ', $ok).'.';
    }
    if ($notok) {
        $msgs = array();
        foreach ($notok as $idx => $reasons) {
            $msgs[] = $theList[$idx];
        }
        $report .= br.br.gTxt('smd_tag_category_unlinked_lbl').join(', ', $msgs);
    }

    smd_tags_manage($message, $report);
}

/**
 * Allow tags to be imported from other tagging / unlimited cats plugins, or txp fields.
 *
 * @param      string  $message  The message to display
 * @param      string  $report   The report to display
 */
function smd_tags_sync($message = '', $report = '')
{
    global $plugins;

    $smd_tag_prefs = smd_tags_get_prefs('name');

    extract(doSlash(gpsa(array('smd_tags_sync_type', 'smd_tags_sync_cfs', 'smd_tags_sync_cfs_delim', 'smd_tags_sync_section', 'smd_tags_sync_parent', 'smd_tags_delete_orig', 'smd_tags_import_tag_parent', 'smd_tags_import_cat_parent', 'smd_tags_import_force_parent', 'smd_tags_import_force_cat', 'smd_tags_do_import'))));

    $ctrls = smd_tags_pref_get(array('smd_tag_p_linkcat', 'smd_tag_t_enrep'), 1);
    $clink = $ctrls['smd_tag_p_linkcat']['val'];
    $showrep = $report && $ctrls['smd_tag_t_enrep']['val'];

    pagetop(gTxt('smd_tag_sync_lbl'),$message);
    extract(smd_tags_buttons());

    $plug_tt = (is_array($plugins) && in_array('tru_tags',$plugins));
    $plug_uc = (is_array($plugins) && in_array('rss_unlimited_categories',$plugins));

    // Prefs check
    $prefset = smd_tags_pref_get($smd_tag_prefs);
    $numReqPrefs = count($smd_tag_prefs);
    $numPrefs = count($prefset);

    // Perform the import via AJAX due to the quantity of tags that may be involved
    if ($smd_tags_do_import) {
        $impopts = array(
            'smd_tags_sync_type' => $smd_tags_sync_type,
            'smd_tags_sync_cfs' => $smd_tags_sync_cfs,
            'smd_tags_sync_cfs_delim' => $smd_tags_sync_cfs_delim,
            'smd_tags_sync_section' => $smd_tags_sync_section,
            'smd_tags_sync_parent' => $smd_tags_sync_parent,
            'smd_tags_delete_orig' => $smd_tags_delete_orig,
            'smd_tags_import_tag_parent' => $smd_tags_import_tag_parent,
            'smd_tags_import_cat_parent' => $smd_tags_import_cat_parent,
            'smd_tags_import_force_parent' => $smd_tags_import_force_parent,
            'smd_tags_import_force_cat' => $smd_tags_import_force_cat,
        );
        smd_tags_import($impopts);
    }

    $qs = array(
        "event" => "smd_tags",
    );

    $qsVars = "index.php".join_qs($qs);

    echo script_js(<<<EOS
jQuery(function() {
    function smd_tagRestrict(typ) {
        grabcat = jQuery("#smd_tags_import_cat_parent option:selected").val();
        var smd_link_mode = (('{$clink}'=='0') ? '2' : ((grabcat=='') ? '2' : ''));

        if (grabcat != "undefined" || grabcat != '') {
            jQuery.post('{$qsVars}', { step: "smd_tag_parentlist", name: 'smd_tag_parent', type: typ, cat: grabcat, listonly: true, html_id: 'smd_tags_import_tag_parent', link_mode: smd_link_mode, _txp_token: textpattern._txp_token },
                function(data) {
                    jQuery("#smd_tags_import_tag_parent_holder").html(data);
                    jQuery("#smd_tags_import_tag_parent_holder select option[value='{$smd_tags_import_tag_parent}']").prop("selected", true);
                }
            );
        }
    }

    smd_tagRestrict('article');

    if ('{$clink}' == '1') {
        jQuery("#smd_tags_import_cat_parent").change(function() {
            smd_tagRestrict('article');
        });
    }
    if ('{$showrep}' == '1') {
        smd_tags_toggle_report();
    }

    jQuery('input[name="smd_tags_sync_type"]').change(function() {
        if (jQuery(this).filter(':checked').val() == '3') {
            jQuery('.smd_tags_sync_txp').show();
        } else {
            jQuery('.smd_tags_sync_txp').hide();
        }
    }).change();

    jQuery('#smd_tags_report_toggler, .smd_tags_btn_ok').on('click', smd_tags_toggle_report_handler);
});

/**
 * jQuery callback for displaying tag report.
 */
function smd_tags_toggle_report_handler(ev) {
    ev.preventDefault();
    smd_tags_toggle_report();
}

function smd_tags_toggle_report() {
    jQuery("#smd_tag_report_pane").toggle('fast');
}
EOS
    );

    // The tag sync preferences
    if (smd_tags_table_exist()) {
        // Tables installed
        if ($numPrefs == $numReqPrefs) {
            // Prefs all installed
            echo '<form method="post" id="smd_syncit" action="?event=smd_tags&step=smd_tags_sync">'.
                n.'<div class="txp-layout">'.
                n. '<div class="txp-layout-2col">'.
                n. hed(gTxt('smd_tag_sync_lbl').sp.$btnHelp, 1).
                n. '</div>'.
                n. '<div class="txp-layout-2col">'.
                graf(
                    $btnManage
                    .n.$btnPrefs
                , ' class="txp-actions"').
            n. '</div>';

            echo n. '<div id="smd_tag_report_pane">'
                .n. '<div>'
                .n. href('&#215;', '#close', ' class="smd_tags_btn_ok" role="button" title="'.gTxt('close').'" aria-label="'.gTxt('close').'"')
                .n. '<h3>', gTxt('smd_tag_report_lbl'), '</h3>'
                .$report
                .n. '</div>'
                .n. '</div>'
                .n. '<div class="txp-layout-1col">';

            $lblStyle = ' class="pref-label"';

            echo '<a id="smd_tags_report_toggler" href="#">'.gTxt('smd_tag_recent_report').'</a>';
            echo '<section class="txp-prefs-group">';
            echo hed(gTxt('smd_tag_sync_plugin_opts'), 3);
            $rset = array();

            if ($plug_tt) {
                $rset[0] = gTxt('smd_tag_sync_type1');
            }

            if ($plug_uc) {
                $rset[1] = gTxt('smd_tag_sync_type2');
            }

            $rset[2] = gTxt('smd_tag_sync_type3');
            $rset[3] = gTxt('smd_tag_sync_type4');

            $rsel = 0;

            if (empty($smd_tags_sync_type) || $plug_tt) {
                $rsel = 0;
            }

            if ($smd_tags_sync_type == 1 || ($plug_uc && !$plug_tt)) {
                $rsel = 1;
            } elseif ($smd_tags_sync_type == 2 || (!$plug_uc && !$plug_tt)) {
                $rsel = 2;
            } elseif ($smd_tags_sync_type == 3 || (!$plug_uc && !$plug_tt && !$smd_tags_sync_type == 2)) {
                $rsel = 3;
            }

            echo inputLabel(
                'smd_tags_sync_type',
                radioSet($rset, 'smd_tags_sync_type', $rsel),
                'smd_tag_sync_type_lbl',
                '',
                array(
                    'class' => 'txp-form-field',
                    'id'    => 'prefs-smd_tags_sync_type',
                )
            );

            // Txp category / custom_field import options
            $cfs = getCustomFields();

            echo ($cfs)
                ? inputLabel(
                    'smd_tags_sync_cfs',
                    selectInput('smd_tags_sync_cfs', $cfs, $smd_tags_sync_cfs, true),
                    'smd_tag_sync_cfs_lbl',
                    '',
                    array(
                        'class' => 'txp-form-field smd_tags_sync_txp',
                        'id'    => 'prefs-smd_tags_sync_cfs',
                    )
                )
                : '';

            echo ($cfs)
                ? inputLabel(
                    'smd_tags_sync_cfs_delim',
                    fInput(
                        'text',
                        'smd_tags_sync_cfs_delim',
                        ($smd_tags_sync_cfs_delim ? $smd_tags_sync_cfs_delim : ','),
                        '',
                        '',
                        '',
                        INPUT_XSMALL),
                    'smd_tag_sync_cfs_delim_lbl',
                    '',
                    array(
                        'class' => 'txp-form-field smd_tags_sync_txp',
                        'id'    => 'prefs-smd_tags_sync_cfs_delim',
                    )
                )
                : '';

            // Section import
            $rs = safe_column('name', 'txp_section', "name != 'default'");

            if ($rs) {
                $widget = selectInput('smd_tags_sync_section', $rs, $smd_tags_sync_section, true);
            } else {
                $widget = gTxt('smd_tag_no_sections');
            }

            echo inputLabel(
                'smd_tags_sync_section',
                $widget,
                'smd_tag_sync_section_lbl',
                '',
                array(
                    'class' => 'txp-form-field',
                    'id'    => 'prefs-smd_tags_sync_section',
                )
            );

            // Start at parent category (rss_uc only)
            // The list is populated anyway even if the plugin isn't active because $rsCats is used later
            if ($clink) {
                $rsCats = getTree('root', 'article');

                if ($rsCats) {
                    $catlist = treeSelectInput('smd_tags_sync_parent', $rsCats, $smd_tags_sync_parent, 'smd_tags_sync_parent', 35)
                        .(($plug_tt) ? gTxt('smd_tag_rss_uc_only') : '');
                } else {
                    $catlist = gTxt('smd_tag_no_parent');
                }

                echo inputLabel(
                    'smd_tags_sync_parent',
                    $catlist,
                    'smd_tag_sync_parent_lbl',
                    '',
                    array(
                        'class' => 'txp-form-field',
                        'id'    => 'prefs-smd_tags_sync_parent',
                    )
                );
            }

            // Delete original
            echo inputLabel(
                'smd_tags_delete_orig',
                yesnoRadio('smd_tags_delete_orig', (int)$smd_tags_delete_orig).n.gTxt('smd_tag_rss_uc_tru_tags_only'),
                'smd_tag_sync_delete_orig_lbl',
                '',
                array(
                    'class' => 'txp-form-field',
                    'id'    => 'prefs-smd_tags_delete_orig',
                )
            );

            echo '</section>';
            echo hed(gTxt('smd_tag_sync_import_opts'), 3);
            echo '<section class="txp-prefs-group">';

            // Assign to category
            if ($clink) {
                if ($rsCats) {
                    $catlist = treeSelectInput('smd_tags_import_cat_parent', $rsCats, $smd_tags_import_cat_parent, 'smd_tags_import_cat_parent', 35);
                } else {
                    $catlist = gTxt('smd_tag_no_parent');
                }

                echo inputLabel(
                    'smd_tags_import_cat_parent',
                    $catlist .br. checkbox('smd_tags_import_force_cat', 1, (int)$smd_tags_import_force_cat, 0, 'smd_tags_import_force_cat').n.'<label for="smd_tags_import_force_cat">'.gTxt('smd_tag_sync_force_cat_lbl').'</label>',
                    'smd_tag_sync_parent_cat_lbl',
                    '',
                    array(
                        'class' => 'txp-form-field',
                        'id'    => 'prefs-smd_tags_sync_parent_cat',
                    )
                );
            }

            // Assign to parent tag
            echo inputLabel(
                'smd_tags_import_tag_parent',
                '<div id="smd_tags_import_tag_parent_holder"></div>'
                    .n.checkbox('smd_tags_import_force_parent', 1, (int)$smd_tags_import_force_parent, 0, 'smd_tags_import_force_parent').n.'<label for="smd_tags_import_force_parent">'.gTxt('smd_tag_sync_force_parent_lbl').'</label>',
                'smd_tag_sync_parent_tag_lbl',
                '',
                array(
                    'class' => 'txp-form-field',
                    'id'    => 'prefs-smd_tags_sync_parent_tag',
                )
            );

            // Report viewer
            echo gTxt('smd_tag_import_results_pt1') . '<span id="smd_tags_import_icurr"></span><span id="smd_tags_import_itot"></span> '
                .br. gTxt('smd_tag_import_results_pt2') . '<span id="smd_tags_import_lnk_curr"></span>';
            echo '</section>';

            echo n.$btnSyncGo;
            echo tInput()
                . '</div></form>';
        } elseif ($numPrefs > 0 && $numPrefs < $numReqPrefs) {
            // Prefs possibly corrupt, or plugin updated
            echo startTable()
                .n. tr(tda(strong(gTxt('smd_tag_prefs_some')).br.br
                    .gTxt('smd_tag_prefs_some_explain').br.br
                    .gTxt('smd_tag_prefs_some_opts1'), ' colspan="2"')
                )
                .n. tr(
                    tda($btnRemove,$btnStyle)
                    . tda($btnInstall, $btnStyle)
                )
                .n. endTable();
        } else {
            // Prefs not installed
            echo startTable()
                .n. tr(tda(gTxt('smd_tag_prefs_not_installed'), ' colspan="2"'))
                .n. tr(tda($btnInstall, $btnStyle))
                .n. endTable();
        }
    } else {
        // Tables not installed
        echo startTable()
            .n. tr(tda(strong(gTxt('smd_tag_prefs_some_tbl')).br.br
                .gTxt('psmd_tag_refs_some_explain').br.br
                .gTxt('smd_tag_prefs_some_opts2'), ' colspan="2"')
            )
            .n. tr(tda($btnInstallTbl, $btnStyle))
            .n. endTable();
    }

    echo '</div>';
}

// ------------------------
// Import tags from other places
function smd_tags_import($smd_tag_options) {
    extract($smd_tag_options);

    $message = '';
    $iparent = ($smd_tags_sync_parent) ? " AND parent = \'".doSlash($smd_tags_sync_parent)."\' " : '';

    $rs = safe_rows('*', 'textpattern', (($smd_tags_sync_section) ? "Section='".doSlash($smd_tags_sync_section)."'" : '1=1'));
    $row_ctr = $tag_ctr = 0;
    $total = count($rs);
    $ctrls = smd_tags_pref_get(array('smd_tag_t_enrep'), 1);
    $showrep = $ctrls['smd_tag_t_enrep']['val'];

    echo '<script type="text/javascript">';
    echo "var ictr = 0; var itot = {$total}; var lnk_ctr = 0;";
    echo 'jQuery(function() {';
    echo 'jQuery("#smd_tags_import_itot").text("/'.$total.'");';
    if ($rs) {
        foreach ($rs as $row) {
            switch ($smd_tags_sync_type) {
                case '0':
                    // tru_tags
                    $idata = doSlash($row['Keywords']);
                    break;
                case '1':
                case '2':
                    // rss_uc / Txp cats
                    $idata = doSlash($row['ID']);
                    break;
                case '3':
                    // CFs
                    $idata = (($smd_tags_sync_cfs && isset($row['custom_'.$smd_tags_sync_cfs])) ? doSlash($row['custom_'.$smd_tags_sync_cfs]) : '');
                    break;
            }
            $ititle = doSlash($row['Title']);
            $artid = doSlash($row['ID']);
            echo <<<EOJS
            sendAsyncEvent(
            {
                event: textpattern.event,
                step: 'smd_tags_import_one',
                smd_tags_sync_type: '{$smd_tags_sync_type}',
                smd_tags_sync_id: '{$artid}',
                smd_tags_sync_data: '{$idata}',
                smd_tags_sync_title: '{$ititle}',
                smd_tags_sync_parent: '{$iparent}',
                smd_tags_sync_cfs: '{$smd_tags_sync_cfs}',
                smd_tags_sync_cfs_delim: '{$smd_tags_sync_cfs_delim}',
                smd_tags_import_tag_parent: '{$smd_tags_import_tag_parent}',
                smd_tags_import_cat_parent: '{$smd_tags_import_cat_parent}',
                smd_tags_import_force_parent: '{$smd_tags_import_force_parent}',
                smd_tags_import_force_cat: '{$smd_tags_import_force_cat}',
                smd_tags_delete_orig: '{$smd_tags_delete_orig}'
            }, smd_tags_group_feedback);
EOJS;
        }
        echo '});';
        echo <<<EOJS
        function smd_tags_group_feedback(data) {
            ictr++;
            jQuery('#smd_tags_import_icurr').text(ictr);
            jQuery('#smd_tag_report_pane').append(jQuery(data).find('smd_tags_report').attr('value'));
            lnk_ctr += (jQuery(data).find('smd_tags_link_ctr').attr('value')) * 1; // multiply by 1 to convert to number
            jQuery('#smd_tags_import_lnk_curr').text(lnk_ctr);
            if ('{$showrep}' == '1' && ictr >= itot) {
                smd_tags_toggle_report();
            }
        }
EOJS;
        echo '</script>';
    }
}

// ------------------------
function smd_tags_import_one() {
    $smd_tags_sync_type = gps('smd_tags_sync_type');
    $smd_tags_sync_data = gps('smd_tags_sync_data');
    $smd_tags_sync_id = gps('smd_tags_sync_id');
    $smd_tags_sync_title = gps('smd_tags_sync_title');
    $smd_tags_sync_parent = gps('smd_tags_sync_parent');
    $smd_tags_sync_cfs = gps('smd_tags_sync_cfs');
    $smd_tags_sync_cfs_delim = gps('smd_tags_sync_cfs_delim');
    $smd_tags_import_tag_parent = gps('smd_tags_import_tag_parent');
    $smd_tags_import_cat_parent = gps('smd_tags_import_cat_parent');
    $smd_tags_import_force_parent = gps('smd_tags_import_force_parent');
    $smd_tags_imort_force_cat = gps('smd_tags_import_force_cat');
    $smd_tags_delete_orig = gps('smd_tags_delete_orig');

    $tag_ids = $tag_names = $keylist = array();

    if (in_array($smd_tags_sync_type, array ('0', '3'))) {
        // tru_tags / Txp CF
        $dlm = ($smd_tags_sync_type == '3' && $smd_tags_sync_cfs_delim) ? $smd_tags_sync_cfs_delim : ',';
        $keys = do_list($smd_tags_sync_data, $dlm);
        foreach ($keys as $key) {
            if ($key=='') continue;
            $keylist[] = array('name' => $key, 'title' => $key);
        }
    } elseif ($smd_tags_sync_type == '1') {
        // rss_uc
        $clause = 'tc.article_id = '.doSlash($smd_tags_sync_data);
        $keylist = getRows("SELECT c.name, c.title FROM ".PFX."textpattern_category as tc LEFT JOIN ".PFX."txp_category as c ON tc.category_id = c.id WHERE ".$clause.$smd_tags_sync_parent);
        $keylist = ($keylist) ? $keylist : array();
    } elseif ($smd_tags_sync_type == '2') {
        // txp cats
        $clause = 'txt.ID = '.doSlash($smd_tags_sync_data);
        $keylist = getRows("SELECT c.name, c.title FROM ".PFX."textpattern as txt LEFT JOIN ".PFX."txp_category as c ON (txt.Category1 = c.name OR txt.Category2 = c.name) WHERE ".$clause.$smd_tags_sync_parent);
        $keylist = ($keylist) ? $keylist : array();
    }

    // Insert /update each tag in the given place
    foreach ($keylist as $item) {
        $itn = trim($item['name']);
        $itt = trim($item['title']);

        // Skip invalid entries
        if ($itn == '' || $itn == NULL || $itt == '' || $itt == NULL) continue;

        $id = smd_tag_getsert($itn, 'article', $itt, $smd_tags_import_tag_parent, $smd_tags_import_cat_parent, '', $smd_tags_import_force_parent, $smd_tags_import_force_cat);
        if ($id) {
            $tag_ids[] = $id;
            $tag_names[] = $itn;
        }
    }

    if ($tag_ids) {
        $report = strong($smd_tags_sync_title).': '.join(', ', $tag_names).br;
        if ($smd_tags_delete_orig) {
            if ($smd_tags_sync_type == '0') {
                safe_update('textpattern', "Keywords=''", "id='".doSlash($smd_tags_sync_id)."'");
            } elseif ($smd_tags_sync_type == '1') {
                safe_delete('textpattern_category', "article_id='".doSlash($smd_tags_sync_id)."'");
            } elseif ($smd_tags_sync_type == '2') {
                // Conspicuously missing until such time as a suitable method can be found to deal with it
            } elseif ($smd_tags_sync_type == '3') {
                safe_update('textpattern', "custom_$smd_tags_sync_cfs=''", "id='".doSlash($smd_tags_sync_id)."'");
            }
        }
    }
    $tag_ctr = smd_tag_link($smd_tags_sync_id, $tag_ids, 'article');
    send_xml_response(array('smd_tags_report' => $report, 'smd_tags_link_ctr' => $tag_ctr));
}

// ------------------------
// MIDDLEWARE - ADMIN/PUBLIC GLUE
// ------------------------
// Grab a valid tag parent list as HTML. Cannot be done easily from fixed data: AJAX is the only reliable way.
// Needs to take into account the various use cases:
//  * full list (link_mode=2)
//  * from given parent nodes (link_mode=1)
//  * excluding forbidden items (e.g. when assigning parent to tag that is already in the subtree)
//  * adding interface elements like [clr] and [tog] buttons
// TODO: take the bi-directional setting into account
function smd_tag_parentlist() {
    $trycat = isset($_POST['cat']);
    extract(doSlash(gpsa(array('name', 'type', 'id', 'cat', 'itemid', 'listonly', 'html_id', 'link_mode'))));

    while(@ob_end_clean()); // Get rid of any page so far

    $listonly = ($listonly == '' || $listonly == 'undefined') ? '' : $listonly;
    $html_id = ($html_id == '' || $html_id == 'undefined') ? 'smd_tag_parent' : $html_id;
    $type = ($type == '' || $type == 'undefined') ? 'article' : $type;
    $cat = ($cat == '' || $cat == 'undefined') ? '' : $cat;
    $link_mode = ($link_mode == '' || $link_mode == 'undefined') ? '1' : $link_mode;
    $tags = ($itemid == '' || $itemid == 'undefined') ? array() : safe_rows('tag_id', SMD_TAGU, "type='$type' AND item_id='$itemid'");
    $clrBtn = '[<span id="smd_clr" class="smd_fakebtn">'.gTxt('smd_tag_clear').'</span>]';
    $togBtn = '[<span id="smd_tog" class="smd_fakebtn">'.gTxt('smd_tag_toggle').'</span>]';

    $pref = smd_tags_pref_get(array('smd_tag_p_listpar', 'smd_tag_p_master', 'smd_tag_p_linkcat'), 1);
    $incl = $pref['smd_tag_p_listpar']['val'];
    $god = $pref['smd_tag_p_master']['val'];
    $clink = $pref['smd_tag_p_linkcat']['val'];
   $god_clause = ($god == '') ? '' : "txt.parent = '" . doSlash($god) . "'";

    if ($cat && $clink) {
       $cat = do_list($cat);
       $rsid = array();
       $rsc = getRows("SELECT DISTINCT txt.id, txt.parent, txt.lft, txt.rgt
            FROM ".PFX.SMD_TAG." AS txt, ".PFX."txp_category AS txc, ".PFX.SMD_TAGC." AS txl
            WHERE ( ( txt.id = txl.tag_id
            AND  txl.cat_id = txc.id
            AND txc.name IN ('" .join("','", $cat). "') )" . ($god_clause ? ' OR '.$god_clause : '') . ")
            AND txt.type = '$type'");
        if ($rsc) {
            foreach ($rsc as $row) {
                $include_parent = ($incl || $row['parent'] == $god) ? '' : ' AND lft != '.$row['lft'];
                $ids = safe_column('id', SMD_TAG, "type = '$type' AND (lft BETWEEN " .$row['lft']. " AND " .$row['rgt']. ")" . $include_parent);
                $rsid = array_merge($rsid, $ids);
            }
        }
        $cat = ($rsc) ? ' AND id IN ('.doQuote(join("','",$rsid)).')' : '';
    } elseif ($god != '' && $link_mode == '1') {
        $ids = safe_column('id', SMD_TAG, "type = '$type' AND parent = '" . doSlash($god) . "'");
        $cat = ($ids) ? ' AND id IN ('.doQuote(join("','",$ids)).')' : '';
    } else {
        $cat = '';
    }

    $link_mode = (($cat && $link_mode == '1') || $link_mode == '2') ? '1=1' : '1=0';

    if ($id) {
        $id = assert_int($id);
        list($lft, $rgt) = array_values(safe_row('lft, rgt', SMD_TAG, 'id = '.$id));
        $rs = smd_tag_tree('root', $type, "lft not between $lft and $rgt".$cat, SMD_TAG);
    } else {
        $rs = smd_tag_tree('root', $type, $link_mode.$cat, SMD_TAG);
    }

    if ($rs) {
       if ($trycat && !$listonly) {
            echo smd_multiTreeSelectInput($html_id, $rs, $tags).$clrBtn.$togBtn;
        } else {
            echo treeSelectInput($html_id, $rs, $name);
        }
    } else {
        echo gTxt('smd_tag_no_parent');
    }
    exit(); // Don't call page_end()
}

// ------------------------
// Grab a valid category list
function smd_tag_catlist($cat='') {
    extract(doSlash(gpsa(array('name','type','html_id'))));
    while(@ob_end_clean()); // Get rid of any page so far

    $type = ($type == "" || $type == "undefined") ? 'article' : $type;
    $html_id = ($html_id == "" || $html_id == "undefined") ? 'smd_tags_catlist' : $html_id;
    $rs = getTree('root', $type, "1=1");

    if ($rs) {
        echo treeSelectInput($html_id, $rs, $name, $html_id);
    } else {
        echo gTxt('no_categories_available');
    }
    exit(); // Don't call page_end()
}

// ------------------------
// Fetch a description for use as a tooltip
function smd_tag_get_desc() {
    extract(doSlash(gpsa(array('tag_ref'))));
    while(@ob_end_clean()); // Get rid of any page so far

    $tag_ref = ($tag_ref == "" || $tag_ref == "undefined") ? '' : $tag_ref;

    if ($tag_ref) {
        $field = is_numeric($tag_ref) ? 'id' : 'title';
        $desc = safe_field('desc_html', SMD_TAG, "$field='" . doSlash($tag_ref) . "'");
        echo ($desc) ? $desc : gTxt('smd_tag_no_desc');
    } else {
        send_xml_response(array('http-status' => '400 Bad Request'));
    }

    exit(); // Don't call page_end()
}

// ------------------------
// Remove empty URL elements (used as callback to array_filter())
function smd_tags_remove_empty($var) {
    return($var != '');
}

// ------------------------
// Handle fake tag section URL
function smd_tags_url_handler($evt, $stp) {
    global $smd_tag_type, $pretext, $permlink_mode;

    if (!smd_tags_table_exist()) {
        return;
    }

    $prefs = smd_tags_pref_get(array('smd_tag_u_sec', 'smd_tag_u_pnam', 'smd_tag_u_ptyp'), 1);
    $urlsec = do_list($prefs['smd_tag_u_sec']['val']);
    $urlnam = $prefs['smd_tag_u_pnam']['val'];
    $urltyp = $prefs['smd_tag_u_ptyp']['val'];

    $subpath = preg_replace("/https?:\/\/.*(\/.*)/Ui", "$1", hu);
    $regsafesubpath = preg_quote($subpath, '/');
    $req = preg_replace("/^$regsafesubpath/i", '/', serverSet('REQUEST_URI'));

    $qs = strpos($req, '?');
    $qatts = ($qs ? a.substr($req, $qs + 1) : '');

    if ($qs) $req = substr($req, 0, $qs);
    $parts = array_values(array_filter(explode('/', $req), 'smd_tags_remove_empty'));
    $validTypes = array('article','image','file','link');

    // Deal with clean URL syntax first, trying to avoid clashes with built-in permlink schemes.
    if (count($parts) > 1) {
        // Determine if this URL is one we care about.
        // If so, find where the tag portion begins (immediately after the trigger).
        $pos = false;
        foreach($urlsec as $trigger) {
            if (($pos = array_search($trigger, $parts)) !== false) {
                $pos++; // Start of the tag info
                break;
            }
        }

        if ($pos !== false) {
            // Try to detect section/id/title permlink scheme
            $sit = false;
            if (count($parts) == 3) {
                // Note that '0' is not a valid article ID but is numeric and could be the name of a tag, so it needs special treatment
                if (is_numeric($parts[1]) && $parts[1] != '0') {
                    $sit = true;
                }
            }

            // As long as this is a regular permlink scheme, set the tag to be the remaining URL portion
            if (!$sit) {
                if (in_array($parts[$pos], $validTypes)) {
                    $smd_tag_type = $parts[$pos];
                    $pos++;
                } else {
                    $smd_tag_type = $validTypes[0];
                }

                $smd_tag = join('/', array_slice($parts, $pos));
                smd_tags_set($smd_tag_type, $smd_tag);
                $_SERVER['QUERY_STRING'] = $qatts;
                $_SERVER['REQUEST_URI'] = $subpath . $parts[0]; // Drop back to section list mode
//              $_SERVER['QUERY_STRING'] = $urlnam.'='.$smd_tag .a. $urltyp.'='.$smd_tag_type . $qatts;
//              $_SERVER['REQUEST_URI'] = $subpath . $parts[0] . '/?' . serverSet('QUERY_STRING');
            }
        }
    } elseif ((count($parts) == 1) && (in_array($parts[0], $urlsec) || in_array(gps('s'), $urlsec))) {
        // Default or named section (or /title permlink mode) + possible messy tag syntax
        $theType = gps($urltyp);
        $smd_tag = gps($urlnam);
        $smd_tag_type = (empty($theType) && empty($smd_tag)) ? '' : ((in_array($theType, $validTypes)) ? $theType : $validTypes[0]);
        smd_tags_set($smd_tag_type, $smd_tag);
        $_SERVER['QUERY_STRING'] = (($permlink_mode == 'messy') ? $urlnam.'='.$smd_tag .a. $urltyp.'='.$smd_tag_type : '') . $qatts;
        $_SERVER['REQUEST_URI'] = $subpath . $parts[0] . (($permlink_mode == 'messy') ? '/?' . serverSet('QUERY_STRING') : '');
    }
}

// ------------------------
function smd_tags_set($typ, $tag='', $item='') {
    global $smd_tags;

    $smd_tags = array();

    $prefs = smd_tags_pref_get(array('smd_tag_u_combi', 'smd_tag_u_combi_and', 'smd_tag_u_combi_or'), 1);
    $combi = $prefs['smd_tag_u_combi']['val'];
    $cand = $prefs['smd_tag_u_combi_and']['val'];
    $cor = $prefs['smd_tag_u_combi_or']['val'];

    // Multi-tag filtering
    if ($tag) {
        $taglist = explode($cor, $tag);
        $num_or = count($taglist);
        if ($num_or == 1) {
            // Only one item in the exploded list could mean one of two things:
            //  a) only one item(!)
            //  b) the 'and' delimiter is in use
            $andlist = explode($cand, $tag);
            $num_and = count($andlist);
            if ($num_and > 1) {
                $smd_tags['meta']['search_mode'] = 'and';
                $smd_tags['meta']['tag_head'] = $andlist[0];
                $smd_tags['meta']['tag_tail'] = $andlist[count($andlist)-1];
                $taglist = $andlist;
            } else {
                $smd_tags['meta']['search_mode'] = 'single';
                $smd_tags['meta']['tag_head'] = $smd_tags['meta']['tag_tail'] = $andlist[0];
            }
        } elseif ($num_or > 1) {
            $smd_tags['meta']['search_mode'] = 'or';
            $smd_tags['meta']['tag_head'] = $taglist[0];
            $smd_tags['meta']['tag_tail'] = $taglist[count($taglist)-1];
        }
        $smd_tags['meta']['tag_list'] = $taglist;
        $tag = join(',', quote_list($taglist));
    }

    // Override the search mode if it's switched off in prefs
    if (!$combi) {
        $smd_tags['meta']['search_mode'] = 'single';
    }

    // MONSTER!
    $rs = startRows(
        "SELECT id, name, txt.type, parent, title, desc_html AS description, count(item_id) AS count"
        .",(SELECT CAST((rgt - lft - 1) / 2 AS UNSIGNED)) AS children"
        .",(SELECT COUNT(*) FROM ".PFX.SMD_TAG." WHERE name=name" . (($typ) ? " AND type='$typ'" : "") . " AND lft < txt.lft AND rgt > txt.rgt)-1 AS level"
        ." FROM ".PFX.SMD_TAG." AS txt, ".PFX.SMD_TAGU." AS txu"
        ." WHERE tag_id = id"
        .(($typ) ? " AND txt.type='$typ'" : "")
        .(($tag) ? " AND name IN ($tag)" : "")
        .(($item) ? " AND item_id='$item'" : "")
        ." GROUP BY id");
    smd_tags_populate($rs, $typ);

    // In case one of the URL tags isn't in use, populate $smd_tags with the tag details.
    // Note this one requires type.
    if (!$item) {
        $rs = startRows(
            "SELECT id, name, txt.type, parent, title, desc_html AS description"
            .",(SELECT CAST((rgt - lft - 1) / 2 AS UNSIGNED)) AS children"
            .",(SELECT COUNT(*) FROM ".PFX.SMD_TAG." WHERE type='$typ' AND name=name AND lft < txt.lft AND rgt > txt.rgt)-1 AS level"
            ." FROM ".PFX.SMD_TAG." AS txt"
            ." WHERE txt.type='$typ'"
            .(($tag) ? " AND name IN ($tag)" : "")
            ." GROUP BY id");
        smd_tags_populate($rs, $typ);
    }
}

// ------------------------
function smd_tags_populate($rs, $typ) {
    global $smd_tags;

    while ($row = nextRow($rs)) {
        $cnt = (isset($row['count'])) ? $row['count'] : '0';
        $smd_tags[$typ][$row['id']] = array('tag_name' => $row['name'], 'tag_title' => $row['title'], 'tag_description' => $row['description'], 'tag_parent' => $row['parent'], 'tag_count' => $cnt, 'tag_children' => $row['children'], 'tag_level' => $row['level']);
        $smd_tags[$typ]['tag_name'][$row['id']] = $row['name'];
        $smd_tags[$typ]['tag_title'][$row['id']] = $row['title'];
        $smd_tags[$typ]['tag_description'][$row['id']] = $row['description'];
        $smd_tags[$typ]['tag_parent'][$row['id']] = $row['parent'];
        $smd_tags[$typ]['tag_count'][$row['id']] = $cnt;
        $smd_tags[$typ]['tag_children'][$row['id']] = $row['children'];
        $smd_tags[$typ]['tag_level'][$row['id']] = $row['level'];
    }
}

// ------------------------
// Add tags to the global scope, depending on context.
// Returns the current context
function smd_tags_context() {
    global $thisarticle, $thisfile, $thislink, $thisimage, $smd_tag_type, $smd_tag_items, $smd_tags, $smd_thistag;

    $ctxt = $smd_tag_type;
    $ids = array();
    $scp = isset($smd_tags[$ctxt]) ? $smd_tags[$ctxt] : array();

    // Individual article or list
    $id = '';
    if (!empty($thisimage)) {
        $id = $thisimage['id'];
        $ctxt = 'image';
        $scp = $thisimage;
    } elseif (!empty($thisfile)) {
        $id = $thisfile['id'];
        $ctxt = 'file';
        $scp = $thisfile;
    } elseif (!empty($thislink)) {
        $id = $thislink['id'];
        $ctxt = 'link';
        $scp = $thislink;
    } elseif (!empty($thisarticle)) {
        $id = $thisarticle['thisid'];
        $ctxt = 'article';
        $scp = $thisarticle;
    }

    if ($id) {
        smd_tags_set($ctxt, '', $id);
    }

    if (isset($smd_tags[$ctxt])) {
        foreach($smd_tags[$ctxt] as $rid => $row) {
            if (is_int($rid)) {
                $ids[] = $rid;
            }
        }
    }

    // TODO: is this needed to overwrite if tag already set?
    if (!empty($smd_thistag)) {
        $ids = array($smd_thistag['tag_id']);
    }

    return array('context' => $ctxt, 'scope' => $scp, 'id' => $ids);
}

// ------------------------
// Load current tag into global scope
function smd_tag_populate($row) {
    global $smd_thistag;
    $smd_thistag['tag_id'] = $row['id'];
    $smd_thistag['tag_name'] = $row['name'];
    $smd_thistag['tag_lettername'] = smd_tags_utf8_substr($row['name'], 0, 1);
    $smd_thistag['tag_lettertitle'] = smd_tags_utf8_substr($row['title'], 0, 1);
    $smd_thistag['tag_type'] = $row['type'];
    $smd_thistag['tag_parent'] = $row['parent'];
    $smd_thistag['tag_title'] = $row['title'];
    $smd_thistag['tag_description'] = $row['description'];
    $smd_thistag['tag_children'] = $row['children'];
    $smd_thistag['tag_level'] = $row['level'];
    $smd_thistag['tag_count'] = $row['count'];
    $smd_thistag['tag_indent'] = $row['indent'];
    $smd_thistag['tag_weight'] = $row['weight'];
    $smd_thistag['tag_first'] = $row['first'];
    $smd_thistag['tag_last'] = $row['last'];
}

// Thanks http://us2.php.net/manual/en/function.substr.php
function smd_tags_utf8_substr($str, $start) {
    preg_match_all("/./u", $str, $ar);
    if(func_num_args() >= 3) {
        $end = func_get_arg(2);
        return join('',array_slice($ar[0],$start,$end));
    } else {
        return join('',array_slice($ar[0],$start));
    }
}

// ------------------------
// All tags/counts
function smd_tag_list_adm($atts) {
    include_once txpath.'/publish/taghandlers.php';
    extract(lAtts(array(
        'type'       => 'article',
        'indent'     => '&#160;&#160;',
        'count'      => 1,
        'label'      => '',
        'labeltag'   => '',
        'wraptag'    => '',
        'break'      => '',
        'class'      => __FUNCTION__,
        'breakclass' => '',
    ),$atts));

    $validTypes = array('list' => 'article', 'image' => 'image', 'file' => 'file', 'link' => 'link');
    $rs = smd_tag_tree('root', $type, '1=1', SMD_TAG);
    $rsc = getRows("SELECT txl.tag_id, txc.name
            FROM ".PFX.SMD_TAG." AS txt, ".PFX.SMD_TAGC." AS txl, ".PFX."txp_category AS txc
            WHERE txt.type = '$type' AND txt.id = txl.tag_id AND txl.cat_id = txc.id");
    $rscout = array();
    if ($rsc) {
        foreach ($rsc as $idx => $row) {
            $rscout[$row['tag_id']] = $row['name'];
        }
    }

    if ($rs) {
        $out = array();
        $totals = array();
        $pref = smd_tags_pref_get('smd_tag_p_master', 1);
        $god = $pref['smd_tag_p_master']['val'];

        // Tally each tag's usage
        if ($count) {
            $rsu = safe_rows_start('tag_id, count(*) as num', SMD_TAGU, "type='$type' GROUP BY tag_id");
            while ($row = nextRow($rsu)) {
                $tagid = $row['tag_id'];
                $num = $row['num'];
                $ids = safe_column('item_id', SMD_TAGU, "type='$type' AND tag_id='$tagid'");
                $totals[$tagid] = array($num, join(",",$ids));
            }
        }

        foreach ($rs as $row) {
            extract($row);
            $parent = (isset($parent)) ? $parent : ''; // Parent might not be defined
            $row['type'] = $type;
            if (isset($totals[$id])) {
                $row['count'] = $totals[$id][0];
                $ev = array_keys($validTypes,$type);
                $url = 'index.php?event='.$ev[0].a.'search_method=id'.a.'crit='.$totals[$id][1];
                $cntop = sp.href('('.$totals[$id][0].')', $url);
            } else {
                $row['count'] = 0;
                $cntop = sp.'(0)';
            }

            $rowdata = '<span name="smd_tagnam" class="smd_hidden">'.$name
                    .'</span><span name="smd_tagid" class="smd_hidden">'.$id
                    .'</span><span name="smd_tagttl" class="smd_hidden">'.$title
                    .'</span><span name="smd_tagpar" class="smd_hidden">'.$parent
                    .'</span><span name="smd_tagcat" class="smd_hidden">'.((isset($rscout[$id])) ? $rscout[$id] : '')
                    .'</span><span name="smd_tagdsc" class="smd_hidden">'.$description
                    .'</span>';
            $out[] = array(
                'data' => $rowdata.str_repeat($indent, $level * 1) . $title . (($count) ? $cntop : '').n,
                'level' => $level,
                'class' => ($god==$name ? array('smd_tag_master', 'smd_tag_parent') : ($god==$parent ? array('smd_tag_master','smd_tag_child') : array())),
                );
//          $smd_thistag = array();
        }

        if ($out) {
            $wrapit = do_list($wraptag, ":");

            if ($wrapit[0] == 'table') {
                // Tables are a special case
                $totalItems = $rows = count($rs);
                $step = 1;
                $cols = 1;
                $numopts = count($wrapit);
                // Each successive level overrides the previous step so by the end of the ifs,
                // 3 values are set up: step, rows and cols
                if ($numopts > 1) {
                    $cols = $wrapit[1];
                    $rows = ceil($totalItems/$cols);
                }

                if ($numopts > 2) {
                    if ($wrapit[2] == 'rows') {
                        $rows = $wrapit[1];
                        $cols = ceil($totalItems/$rows);
                    }
                }

                if ($numopts > 3) {
                    if ($wrapit[3] == 'bycol') {
                        $step = ($wrapit[2]=='cols') ? ceil($totalItems/$cols) : $rows;
                        if ($wrapit[2]=='cols') {
                            $rows = $step;
                        } else {
                            $cols = ceil($totalItems/$rows);
                        }
                    }
                }

                // Generate table based on above rules
                $tblout = array();
                $cellCtr = 0;
                $class = (!empty($class)) ? ' class="'.$class.'"' : '';
                $breakclass = (!empty($breakclass)) ? ' class="'.$breakclass.'"' : '';

                for ($idx = 0; $idx < $rows; $idx++) {
                    $bld = array();
                    for ($jdx = 0; $jdx < $cols; $jdx++) {
                        $offset = ($wrapit[3]=='bycol') ? ($jdx * $step) + $idx : $cellCtr;
                        $bclass = (isset($out[$offset]['class'])) ? join(' ', $out[$offset]['class']) : '';
                        $bld[] = (isset($out[$offset]['data'])) ? tda($out[$offset]['data'], ($bclass ? ' class = "'.$bclass.'"': '')) : td('');
                        $cellCtr++;
                    }
                    $tblout[] = tr(join('', $bld), $breakclass);
                }

                return doLabel($label, $labeltag).tag(join(n, $tblout), $wrapit[0], $class);
            } elseif ($wrapit[0] == 'list') {
                // Tags by list, optionally split into new row/col every N items
                $totalItems = count($rs);
                $lim = 0;

                $numopts = count($wrapit);

                if ($numopts > 1) {
                    $lim = $wrapit[1];
                }

                // Generate the list
                $listout = array();
                $itemCtr = 0;
                $class = (!empty($class)) ? ' class="'.$class.'"' : '';

                foreach ($out as $item) {
                    $bclass = join(' ', array_merge($item['class'], array($breakclass)));
                    $bclass = (!empty($bclass)) ? ' class="'.$bclass.'"' : '';
                    if ($itemCtr == 0) {
                        $listout[] = "<ul>";
                    }
                    $listout[] = '<li'.$bclass.'>'.$item['data'].'</li>';
                    $itemCtr++;
                    if (($lim > 0 && $itemCtr >= $lim) || $itemCtr >= $totalItems-1) {
                        $listout[] = '</ul>';
                        $itemCtr = 0;
                    }
                }

                return doLabel($label, $labeltag).tag(join(n, $listout), 'div', $class);
            } elseif ($wrapit[0] == 'listgrp') {
                // Tags by list, split into new row/col every time a new level 'N' is reached
                $totalItems = count($rs);
                $level = 0;

                $numopts = count($wrapit);

                if ($numopts > 1) {
                    $level = $wrapit[1];
                }

                if ($numopts > 3) {
                    $class .= ($wrapit[3] == 'byrow') ? ' byrow' : ' bycol';
              }

                // Generate the list
                $listout = array();
                $itemCtr = 0;
                $class = (!empty($class)) ? ' class="'.$class.'"' : '';

                $prevel = 0;
                foreach ($out as $item) {
                    $bclass = join(' ', array_merge($item['class'], array($breakclass)));
                    $bclass = (!empty($bclass)) ? ' class="'.$bclass.'"' : '';
                    if ($prevel >= $item['level'] && $item['level'] <= $level) {
                        if ($itemCtr > 0) {
                            $listout[] = '</ul>';
                        }
                        $listout[] = "<ul>";
                    }
                    $listout[] = '<li'.$bclass.'>'.$item['data'].'</li>';
                    $prevel = $item['level'];
                    if ($itemCtr >= $totalItems-1) {
                        $listout[] = '</ul>';
                    }
                    $itemCtr++;
                }

                return doLabel($label, $labeltag).tag(join(n, $listout), 'div', $class);

            } else {
                //TODO: only use the data column from $out
                return doLabel($label, $labeltag).doWrap($out, $wrapit[0], $break, $class, $breakclass);
            }
        }
        return '';
    }
}

// -------------------------------------------------------------
// Cloned getTree() from txplib_db.php because that function doesn't extract description
function smd_tag_tree($root, $type, $where='1=1', $tbl='txp_category') {
    $root = doSlash($root);
    $type = doSlash($type);

    $rs = safe_row(
        "lft as l, rgt as r",
        $tbl,
        "name='$root' and type = '$type'"
    );

    if (!$rs) return array();
    extract($rs);

    $out = array();
    $right = array();

    $rs = safe_rows_start(
        "id, name, lft, rgt, parent, title, description, desc_html",
        $tbl,
        "lft between $l and $r and type = '$type' and name != 'root' and $where order by lft asc"
    );

    while ($rs and $row = nextRow($rs)) {
        extract($row);
        while (count($right) > 0 && $right[count($right)-1] < $rgt) {
            array_pop($right);
        }

        $out[] =
            array(
                'id' => $id,
                'name' => $name,
                'title' => $title,
                'level' => count($right),
                'children' => ($rgt - $lft - 1) / 2,
                'description' => $description,
                'desc_html' => $desc_html,
                'parent' => $parent,
            );

        $right[] = $rgt;
    }
    return($out);
}

// ------------------------
// Find some value in a tree and return the matching entries
function smd_tag_tree_search($val, $tree, $limit=0, $field='name') {
    $ctr = 0;
    $out = array();
    foreach ($tree as $idx => $entry) {
        if ($entry[$field] == $val) {
            $out[] = $tree[$idx];
            $ctr++;
        }
        if ($limit > 0 && $ctr == $limit) {
            break;
        }
    }
    return $out;
}

// ------------------------
// PHP4 equivalent of array_combine (from http://www.php.net/manual/en/function.array-combine.php)
if (!function_exists('array_combine')) {
function array_combine($arr1, $arr2) {
    $out = array();

    $arr1 = array_values($arr1);
    $arr2 = array_values($arr2);

    foreach($arr1 as $key1 => $value1) {
    $out[(string)$value1] = $arr2[$key1];
    }

    return $out;
}
}

// ------------------------
// PUBLIC TAGS
// ------------------------
// Check tags of a particular type, or those that have a specific property in context.
function smd_if_tag ($atts, $thing) {
    global $smd_tags, $smd_tag_type, $smd_thistag;

    if (!smd_tags_table_exist()) {
        trigger_error(gTxt('smd_tag_not_available'));
        return;
    }

    extract(lAtts(array(
        'type'        => NULL,
        'id'          => NULL,
        'name'        => NULL,
        'title'       => NULL,
        'description' => NULL,
        'parent'      => NULL,
        'count'       => NULL,
        'children'    => NULL,
        'level'       => NULL,
        'search_mode' => NULL,
        'is'          => NULL,
    ),$atts));

    // Validate atts
    $validTypes = array('article','image','file','link');
    $ctxt = smd_tags_context();
    $ctype = $ctxt['context'];
    $type = (in_array($type, $validTypes)) ? $type : ( ($ctxt['context']) ? $ctxt['context'] : ( ($smd_tag_type) ? $smd_tag_type :  $validTypes[0] ) );

    $eqtest = array();
    $nutest = array();
    $searchtest = array();
    $opRE = '/(\>|\>\=|\<|\<\=|\!)([0-9a-zA-Z- ]+)/';

    // Master tag?
    $pref = smd_tags_pref_get('smd_tag_p_master', 1);
    $god = $pref['smd_tag_p_master']['val'];
    $eqtest['master'] = (($is == 'master') && ($god != '')) ? $god : NULL;

    // Start / end of list?
    $eqtest['first'] = ($is == 'first') ? 1 : NULL;
    $eqtest['last'] = ($is == 'last') ? 1 : NULL;

    // Combination moade?
    $searchtest['single'] = ($search_mode == 'single') ? 1 : NULL;
    $searchtest['or'] = ($search_mode == 'or') ? 1 : NULL;
    $searchtest['and'] = ($search_mode == 'and') ? 1 : NULL;

    // TODO: Consolidate this into a loop for each 'id', 'name', type', 'title', ...
    $num = preg_match_all($opRE, $id, $parts);
    $eqtest['id'] = ($num<=0) ? $id : NULL;
    if ($num>0) $nutest['id'] = array($parts[1][0] => $parts[2][0]);

    $num = preg_match_all($opRE, $name, $parts);
    $eqtest['name'] = ($num<=0) ? $name : NULL;
    if ($num>0) $nutest['name'] = array($parts[1][0] => $parts[2][0]);

    $num = preg_match_all($opRE, $type, $parts);
    $eqtest['type'] = ($num<=0) ? $type : NULL;
    if ($num>0) $nutest['type'] = array($parts[1][0] => $parts[2][0]);

    $num = preg_match_all($opRE, $title, $parts);
    $eqtest['title'] = ($num<=0) ? $title : NULL;
    if ($num>0) $nutest['title'] = array($parts[1][0] => $parts[2][0]);

    $num = preg_match_all($opRE, $description, $parts);
    $eqtest['description'] = ($num<=0) ? $description : NULL;
    if ($num>0) $nutest['description'] = array($parts[1][0] => $parts[2][0]);

    $num = preg_match_all($opRE, $parent, $parts);
    $eqtest['parent'] = ($num<=0) ? $parent : NULL;
    if ($num>0) $nutest['parent'] = array($parts[1][0] => $parts[2][0]);

    $num = preg_match_all($opRE, $count, $parts);
    $eqtest['count'] = ($num<=0) ? $count : NULL;
    if ($num>0) $nutest['count'] = array($parts[1][0] => $parts[2][0]);

    $num = preg_match_all($opRE, $children, $parts);
    $eqtest['children'] = ($num<=0) ? $children : NULL;
    if ($num>0) $nutest['children'] = array($parts[1][0] => $parts[2][0]);

    $num = preg_match_all($opRE, $level, $parts);
    $eqtest['level'] = ($num<=0) ? $level : NULL;
    if ($num>0) $nutest['level'] = array($parts[1][0] => $parts[2][0]);

    trace_add('[smd_if_tag equality tests: '. implode(', ', $eqtest) . ']');
    trace_add('[smd_if_tag search_mode tests: '. implode(', ', $searchtest) . ']');
    trace_add('[smd_if_tag numeric tests: '.  print_r($nutest, true) . ']');

    // Init
    $out = $result = $numTests = 0;
    if (!isset($smd_tags[$type]) && empty($smd_thistag)) {
        // not in scope
    } else {
        // Equality comparisons
        foreach ($eqtest as $tname => $tval) {
            if (!is_null($tval)) {
                $numTests++;

                // Master is a special case which checks if the parent is the master tag
                $tname = ($tname == 'master') ? 'parent' : $tname;

                if ($smd_thistag) {
                    // Local scope.
                    if ($smd_thistag['tag_'.$tname] == $tval) {
                        $out++;
                    }
                } else {
                    // Global scope.
                    if ($tname == "type") {
                        if ($smd_tag_type == $type || $ctype == $type) {
                            $out++;
                        }
                    }
                    if (isset($smd_tags[$type]['tag_'.$tname]) && in_array($tval, $smd_tags[$type]['tag_'.$tname], empty($tval) && $tval !== '0')) {
                        $out++;
                    }
                }
            }
        }
        // Search comparisons
        foreach ($searchtest as $tname => $tval) {
            if (!is_null($tval)) {
                $numTests++;

                // Global scope only for search mode.
                if (isset($smd_tags['meta']['search_mode']) && $smd_tags['meta']['search_mode'] == $tname) {
                    $out++;
                }
            }
        }
        // Numeric comparisons
        foreach ($nutest as $tname => $tval) {
            $numTests++;
            $op = current(array_keys($tval));
            $val = current($tval);
            if ($smd_thistag) {
                $comparison = $smd_thistag['tag_'.$tname];
            } else {
                $comparison = $smd_tags[$type]['tag_'.$tname];
            }
            switch ($op) {
                case '>':
                    if (isset($comparison) && $comparison > $val) {
                        $out++;
                    }
                    break;
                case '>=':
                    if (isset($comparison) && $comparison >= $val) {
                        $out++;
                    }
                    break;
                case '<':
                    if (isset($comparison) && $comparison < $val) {
                        $out++;
                    }
                    break;
                case '<=':
                    if (isset($comparison) && $comparison <= $val) {
                        $out++;
                    }
                    break;
                case '!':
                    if (isset($comparison) && $comparison != $val) {
                        $out++;
                    }
                    break;
            }
        }

        trace_add('[smd_if_tag num tests | results: ' . $numTests . '|' . $out . ']');

        // Count how many successes there were
        if ($numTests == $out) {
            $result = 1;
        }
    }

    return parse(EvalElse($thing, $result));
}

// ------------------------
function smd_if_tag_list ($atts, $thing)
{
    global $smd_tag_type;
    return parse(EvalElse($thing, (!empty($smd_tag_type))));
}

// ------------------------
// Return name/title of current tag
function smd_tag_name($atts = array(), $thing = null)
{
    global $smd_thistag, $permlink_mode, $plugins;

    if (!smd_tags_table_exist()) {
        trigger_error(gTxt('smd_tag_not_available'));
        return;
    }

    extract(lAtts(array(
        'title'       => 1,
        'link'        => '',
        'section'     => '',
        'cleanurls'   => 1,
        'parent'      => 0, // not useful to print but good for URLs to nav back up the tree
        'parentlabel' => 'Up a level',
        'wraptag'     => '',
        'class'       => __FUNCTION__,
        'style'       => '',
        'pad_str'     => '',
        'pad_pos'     => 'left', // left/right/both with optional :in suffix to indicate if it's to go inside the link
    ), $atts));

    $smdpref = smd_tags_pref_get(array('smd_tag_u_sec', 'smd_tag_u_pnam', 'smd_tag_u_ptyp'), 1);
    $urlsec = do_list($smdpref['smd_tag_u_sec']['val']);
    $section = ($section) ? $section : $urlsec[0];
    $in_default = (in_array($section, $urlsec));
    $urlnam = $smdpref['smd_tag_u_pnam']['val'];
    $urltyp = $smdpref['smd_tag_u_ptyp']['val'];

    // gbp_permanent_links sets messy mode behind the scenes but still uses non-messy URLs
    // so it requires an exception
    $gbp_pl = (is_array($plugins) && in_array('gbp_permanent_links', $plugins));
    $messy = ($permlink_mode == 'messy') && (!$gbp_pl);

    $parentlabel = ($parentlabel) ? $parentlabel : (($parent) ? $smd_thistag['tag_parent'] : $smd_thistag['tag_name']);
    $label = ($parent) ? $parentlabel : (($title) ? $smd_thistag['tag_title'] : $smd_thistag['tag_name']);
    $tname = ($parent) ? $smd_thistag['tag_parent'] : $smd_thistag['tag_name'];
    $level = $smd_thistag['tag_level'];
    $style = ($style) ? ' style="'.$style.'"' : '';
    $padding = ($pad_str) ? str_repeat($pad_str, $level) : '';
    $pad_pos = do_list($pad_pos, ':');
    $pad['lin'] = ($padding && (in_array('left', $pad_pos) !== false || in_array('both', $pad_pos) !== false) && in_array('in', $pad_pos) !== false) ? $padding : '';
    $pad['rin'] = ($padding && (in_array('right', $pad_pos) !== false || in_array('both', $pad_pos) !== false) && in_array('in', $pad_pos) !== false) ? $padding : '';
    $pad['l'] = ($padding && (in_array('left', $pad_pos) !== false || in_array('both', $pad_pos) !== false) && (empty($pad['lin']) || !$link)) ? $padding : '';
    $pad['r'] = ($padding && (in_array('right', $pad_pos) !== false || in_array('both', $pad_pos) !== false) && (empty($pad['rin']) || !$link)) ? $padding : '';
    $dest = ($messy || !$cleanurls)
                ? pagelinkurl(array('s' => $section, $urlnam => $tname, $urltyp => $smd_thistag['tag_type']))
                : hu.$section.'/'.(($in_default) ? '' : $urlsec[0].'/').$smd_thistag['tag_type'].'/'.$tname;
    if ($thing) {
        $out = '<a'.
            ($messy ? '' : ' rel="tag"').
            ( ($class and !$wraptag) ? ' class="'.$class.'"' : '' ).
            ' href="'.$dest.'"'.
            ($title ? ' title="'.$label.'"' : '').
            '>'.parse($thing).'</a>';
    } elseif ($link) {
        $out = $pad['l'].'<a'.
            ($messy ? '' : ' rel="tag"').
            ' href="'.$dest.'">'.$pad['lin'].$label.$pad['rin'].'</a>'.$pad['r'];
    } else {
        $out = $pad['l'].$label.$pad['r'];
    }

    return doTag($out, $wraptag, $class, $style);
}

// ------------------------
// Return # of items associated with this tag
//TODO: think about per-section / per-category counts
function smd_tag_count($atts = array(), $thing = null)
{
    global $smd_thistag, $smd_tags;

    if (!smd_tags_table_exist()) {
        trigger_error(gTxt('smd_tag_not_available'));
        return;
    }

    extract(lAtts(array(
        'class'      => __FUNCTION__,
        'style'      => '',
        'wraptag'    => '',
        'wrapcount'  => ' (:)',
        'showempty'  => '1',
        'paramdelim' => ':',
    ), $atts));

    $wrapcount = explode($paramdelim, $wrapcount); // do_list does a trim: don't want that
    $style = ($style) ? ' style="'.$style.'"' : '';

    if (count($wrapcount) == 1) {
        $wrapcount[1] = $wrapcount[0];
    }

    if ($smd_thistag) {
        $out = $smd_thistag['tag_count'];
    } else {
        $out = isset($smd_tags['meta']['content_count']) ? $smd_tags['meta']['content_count'] : '';
    }

    $out = ($out == 0 && !$showempty) ? '' : $wrapcount[0].$out.$wrapcount[1];

    return doTag($out, $wraptag, $class, $style);
}

// ------------------------
// Return other info about the current tag
function smd_tag_info($atts = array(), $thing = null)
{
    global $smd_thistag;

    if (!smd_tags_table_exist()) {
        trigger_error(gTxt('smd_tag_not_available'));
        return;
    }

    extract(lAtts(array(
        'item'       => 'name',
        'wraptag'    => '',
        'break'      => 'br',
        'class'      => __FUNCTION__,
        'breakclass' => '',
    ), $atts));

    $out = array();
    $items = do_list($item);
    $availableItems = array(
        'id',
        'name',
        'title',
        'description',
        'lettername',
        'lettertitle',
        'type',
        'parent',
        'children',
        'level',
        'count',
        'indent',
        'weight',
    );

    foreach ($items as $whatnot) {
        if (in_array($whatnot, $availableItems)) {
            $out[] = $smd_thistag['tag_'.$whatnot];
        }
    }

    return doWrap($out, $wraptag, $break, $class, $breakclass);
}

// ------------------------
// Related articles/images/files/links by tag
function smd_related_tags($atts = array(), $thing = null)
{
    global $thisarticle, $thisfile, $thislink, $thisimage, $pretext, $prefs, $smd_tags, $smd_thistag;

    static $smd_tags_pc;

    if (!smd_tags_table_exist()) {
        trigger_error(gTxt('smd_tag_not_available'));
        return;
    }

    extract(lAtts(array(
        'type'       => '',
        'section'    => $pretext['s'],
        'status'     => '4',
        'limit'      => 99999,
        'offset'     => 0,
        'form'       => '',
        'match'      => 'tag_name',
        'match_self' => 0,
        'no_widow'   => @$prefs['title_no_widow'],
        'sort'       => '',
        'label'      => '',
        'labeltag'   => '',
        'wraptag'    => '',
        'break'      => 'br',
        'class'      => __FUNCTION__,
        'delim'      => ',',
        'paramdelim' => ':',
        'debug'      => '0',
    ), $atts));

    // Validate atts
    $validTypes = array('article','image','file','link');
    $ctxt = smd_tags_context();

    $scope = $ctxt['scope'];
    $idlist = $ctxt['id'];
    $ctype = $ctxt['context'];
    $type = (in_array($type, $validTypes)) ? $type : (($ctxt['context']) ? $ctxt['context'] : $validTypes[0]);

    if (!isset($smd_tags_pc[$type])) {
        $smd_tags_pc[$type] = array(
            'all' => array(),
            'parlist' => array(),
            'chilist' => array(),
        );
    }

    $sectionClause = ($section) ? " AND txp.Section IN ('".join("','", doSlash(do_list($section)))."')" : '';
    $status = do_list($status);
    $stati = array();

    foreach ($status as $stat) {
        if (empty($stat)) {
            continue;
        } elseif (is_numeric($stat)) {
            $stati[] = $stat;
        } else {
            $stati[] = getStatusNum($stat);
        }
    }

    $statSQL = ' AND txp.Status IN ('.join(',', $stati).')';

    $out = array();

    if (!$sort) {
        switch ($type) {
            case "article":
                $sort = "Posted desc";
                break;
            case "image":

            case "link":
                $sort = "date desc";
                break;
            case "file":
                $sort = "created desc";
                break;
        }
    }

    $cfs = getCustomfields();
    $cfKeys = implode(',', array_map(
        function($k) { return 'custom_' . $k; }, array_keys($cfs)
    ));

    // Lookup table for making SQL queries
    $sqlStubs = array(
        "article" => array(
            "select" => "txp.ID, Posted, Expires, AuthorID, LastMod, LastModID, txp.Title, Title_html, Body, Body_html, Excerpt, Excerpt_html, Image, Category1, Category2, Annotate, AnnotateInvite, comments_count, Status, textile_body, textile_excerpt, Section, override_form, Keywords, txp.description, url_title" . ($cfKeys ? ','. $cfKeys : '') . ", uid, feed_time, unix_timestamp(Posted) as uPosted, unix_timestamp(LastMod) as uLastMod, unix_timestamp(Expires) as uExpires, COUNT(smt.name) as tag_sum",
            "table" => "textpattern",
            "gtags" => $thisarticle,
            "gid" => "thisid",
        ),
        "image" => array(
            "select" => "txp.id, txp.name, txp.category, txp.ext, txp.w, txp.h, txp.alt, txp.caption, txp.date, txp.author, txp.thumb_w, txp.thumb_h, txp.thumbnail, tu.item_id, tu.tag_id, smt.id AS smtid, smt.name AS smtname, smt.desc_html AS smtdescription, smt.type, smt.parent, smt.lft, smt.rgt, smt.title as tag_title, COUNT(smt.name) as tag_sum",
            "table" => "txp_image",
            "gtags" => $thisimage,
            "gid" => "id",
        ),
        "file" => array(
            "select" => "txp.id, txp.filename, txp.title, txp.category, txp.permissions, txp.description, txp.downloads, txp.status, txp.modified, txp.created, txp.size, tu.item_id, tu.tag_id, smt.id AS smtid, smt.name AS smtname, smt.desc_html AS smtdescription, smt.type, smt.parent, smt.lft, smt.rgt, smt.title as tag_title, COUNT(smt.name) as tag_sum",
            "table" => "txp_file",
            "gtags" => $thisfile,
            "gid" => "id",
        ),
        "link" => array(
            "select" => "txp.id, txp.date, txp.category, txp.url, txp.linkname, txp.linksort, txp.description, tu.item_id, tu.tag_id, smt.id AS smtid, smt.name AS smtname, smt.desc_html AS smtdescription, smt.type, smt.parent, smt.lft, smt.rgt, smt.title as tag_title, COUNT(smt.name) as tag_sum",
            "table" => "txp_link",
            "gtags" => $thislink,
            "gid" => "id",
        ),
    );

    // Extract stuff to match & make up query replacement variables
    $match = do_list($match, $paramdelim);
    $matchType = array_shift($match);

    if (count($match) == 0) {
        // Assume current type unless a tag is being matched (in which case, use $ctype)
        $matchWith = array($matchType);
        $matchType = (strpos($matchWith[0], 'tag_') !== false) ? $ctype : $type;
    } else {
        $matchWith = $match;
    }

    $matches = array();

    foreach ($matchWith as $matchItem) {
        if (strpos($matchItem, 'tag_') !== false) {
            $lookin = (isset($smd_tags[$matchType])) ? $smd_tags[$matchType] : ( (isset($smd_thistag)) ? $smd_thistag : array() );
        } else {
            $lookin = $sqlStubs[$matchType]["gtags"];
        }

        if (isset($lookin[$matchItem])) {
            $thismatch = $lookin[$matchItem];

            if (is_array($thismatch)) {
                foreach ($thismatch as $subID => $subItem) {
                    if (in_array($subID, $idlist)) {
                        $matches[] = $subItem;
                    }
                }
            } else {
                $matches[] = $thismatch;
            }
        }
    }

    $matches = array_unique($matches);

    // Should the tag hierarchy be taken into account?
    $opts = smd_tags_pref_get(array('smd_tag_p_lbi', 'smd_tag_u_combi'));
    $bidir = $opts['smd_tag_p_lbi']['val'];
    $combi = $opts['smd_tag_u_combi']['val'];

    if ($matches) {
        $parents = $children = array();

        if ($smd_tags_pc[$type]['all']) {
            $full_tag_tree = $smd_tags_pc[$type]['all'];
        } else {
            $full_tag_tree = $smd_tags_pc[$type]['all'] = smd_tag_tree('root', $type, '1=1', SMD_TAG);
        }

        // Build two lists from the full tag tree:
        //  1) parlist: each node's parent
        //  2) chilist: list of nodes below the current
        if (!$smd_tags_pc[$type]['parlist'] || !$smd_tags_pc[$type]['chilist']) {
            foreach ($full_tag_tree as $node) {
                $smd_tags_pc[$type]['parlist'][$node['name']] = $node['parent'];

                if ($node['parent'] == 'root') {
                    $smd_tags_pc[$type]['chilist'][$node['name']] = array();
                } else {
                    $smd_tags_pc[$type]['chilist'][$node['parent']][] = $node['name'];

                    foreach ($smd_tags_pc[$type]['chilist'] as $key => $nodes) {
                        if (in_array($node['parent'], $nodes)) {
                            $smd_tags_pc[$type]['chilist'][$key][] = $node['name'];
                        }
                    }
                }
            }
        }

        // Reverse lookup to find parents of child
        if ($bidir == 1 || $bidir == 3) {
            foreach ($matches as $matchit) {
                $theparent = $matchit;

                while (array_key_exists($theparent, $smd_tags_pc[$type]['parlist'])) {
                    if ($smd_tags_pc[$type]['parlist'][$theparent] == 'root') {
                        break;
                    }
                    $parents[] = $theparent = $smd_tags_pc[$type]['parlist'][$theparent];
                }
            }
        }

        // Forward lookup to find children of parent
        if ($bidir == 2 || $bidir == 3) {
            foreach ($matches as $matchit) {
                if (array_key_exists($matchit, $smd_tags_pc[$type]['chilist'])) {
                    $children = array_merge($children, $smd_tags_pc[$type]['chilist'][$matchit]);
                }
            }
        }

        $matches = array_unique(array_merge( $matches, $parents, $children ));
    }

    trace_add('[smd_related_tags matches: ' . join(', ', $matches) . ']');

    // Convert above opts to SQL query clauses
    $excludeClause = ($match_self) ? '' : ' AND txp.id != "'.$sqlStubs[$type]["gtags"][$sqlStubs[$type]["gid"]].'"';

    $and_mode = (isset($smd_tags['meta']['search_mode']) && ($smd_tags['meta']['search_mode'] == 'and')) ? true : false;
    $and_modeClause = ($and_mode && $matches) ? ' HAVING COUNT(*) = ' . count($matches) : '';

    $last_tag = (isset($smd_tags['meta']['tag_tail'])) ? $smd_tags['meta']['tag_tail'] : '';
    $matchClause = " AND " .(($matches) ? ($combi ? "smt.name IN (" .join(",", quote_list($matches)). ")" : "smt.name = '".$last_tag."'") : "smt.name = ''");
    $orderBy = " ORDER BY " .$sort. " LIMIT " .$offset. "," .$limit;
    $contentCount = 0;

    switch ($type) {
        case "article":
            $rs = getRows("SELECT SQL_CALC_FOUND_ROWS " . $sqlStubs[$type]["select"] . " FROM " . safe_pfx($sqlStubs[$type]["table"]) . " AS txp
                LEFT JOIN ".PFX.SMD_TAGU. " AS tu ON txp.id = tu.item_id
                LEFT JOIN ".PFX.SMD_TAG. " AS smt ON tu.tag_id = smt.id
                WHERE tu.type = 'article'" . $statSQL . $excludeClause . $sectionClause . $matchClause . ' GROUP BY txp.id' . $and_modeClause . $orderBy, $debug);
            $contentResult = mysqli_fetch_assoc(safe_query('SELECT FOUND_ROWS() AS found', $debug));
            $contentCount = $contentResult['found'];

            if ($rs) {
                trace_add('[smd_related_tags article records: ' . print_r($rs, true) . ']');
                $uniqrs = array();

                foreach ($rs as $row) {
                    if (!in_array($row['ID'], $uniqrs)) {
                        $safe = ($thisarticle) ? $thisarticle : NULL;
                        populateArticleData($row);
                        $row['Title'] = ($no_widow) ? noWidow(escape_title($row['Title'])) : escape_title($row['Title']);
                        $out[] = ($form) ? parse_form($form) : (($thing) ? parse($thing) : href($row['Title'], permlinkurl($row)));
                        $uniqrs[] = $row['ID'];
                        $thisarticle = $safe;
                    }
                }
            }
            break;
        case "image":
            $rs = getRows("SELECT SQL_CALC_FOUND_ROWS " . $sqlStubs[$type]["select"] . " FROM " . safe_pfx($sqlStubs[$type]["table"]) . " AS txp
                LEFT JOIN ".PFX.SMD_TAGU. " AS tu ON txp.id = tu.item_id
                LEFT JOIN ".PFX.SMD_TAG. " AS smt ON tu.tag_id = smt.id
                WHERE tu.type = 'image'" . $excludeClause . $matchClause . ' GROUP BY txp.id' . $and_modeClause . $orderBy, $debug);
            $contentResult = mysqli_fetch_assoc(safe_query('SELECT FOUND_ROWS() AS found', $debug));
            $contentCount = $contentResult['found'];

            if ($rs) {
                trace_add('[smd_related_tags image records: ' . print_r($rs, true) . ']');
                $uniqrs = array();

                foreach ($rs as $row) {
                    if (!in_array($row['id'], $uniqrs)) {
                        $safe = ($thisimage) ? $thisimage : NULL;
                        $thisimage = image_format_info($row);
                        $out[] = ($form) ? parse_form($form) : (($thing) ? parse($thing) : image(array('id' => $row['id'])));
                        $uniqrs[] = $row['id'];
                        $thisimage = $safe;
                    }
                }
            }
            break;
        case "file":
            $rs = getRows("SELECT SQL_CALC_FOUND_ROWS " . $sqlStubs[$type]["select"] . " FROM " . safe_pfx($sqlStubs[$type]["table"]) . " AS txp
                LEFT JOIN ".PFX.SMD_TAGU. " AS tu ON txp.id = tu.item_id
                LEFT JOIN ".PFX.SMD_TAG. " AS smt ON tu.tag_id = smt.id
                WHERE tu.type = 'file'" . $statSQL . $excludeClause . $matchClause . ' GROUP BY txp.id' . $and_modeClause . $orderBy, $debug);
            $contentResult = mysqli_fetch_assoc(safe_query('SELECT FOUND_ROWS() AS found', $debug));
            $contentCount = $contentResult['found'];

            if ($rs) {
                trace_add('[smd_related_tags file records: ' . print_r($rs, true) . ']');
                $uniqrs = array();

                foreach ($rs as $row) {
                    if (!in_array($row['id'], $uniqrs)) {
                        $safe = ($thisfile) ? $thisfile : NULL;
                        $thisfile = file_download_format_info($row);
                        $out[] = ($form) ? parse_form($form) : (($thing) ? parse($thing) : file_download_link(array('filename' => $row['filename']), $row['filename']));
                        $uniqrs[] = $row['id'];
                        $thisfile = $safe;
                    }
                }
            }
            break;
        case "link":
            $rs = getRows("SELECT SQL_CALC_FOUND_ROWS " . $sqlStubs[$type]["select"] . " FROM " . safe_pfx($sqlStubs[$type]["table"]) . " AS txp
                LEFT JOIN ".PFX.SMD_TAGU. " AS tu ON txp.id = tu.item_id
                LEFT JOIN ".PFX.SMD_TAG. " AS smt ON tu.tag_id = smt.id
                WHERE tu.type = 'link'" . $excludeClause . $matchClause . ' GROUP BY txp.id' . $and_modeClause . $orderBy, $debug);
            $contentResult = mysqli_fetch_assoc(safe_query('SELECT FOUND_ROWS() AS found', $debug));
            $contentCount = $contentResult['found'];

            if ($rs) {
                trace_add('[smd_related_tags link records: ' . print_r($rs, true) . ']');
                $uniqrs = array();

                foreach ($rs as $row) {
                    if (!in_array($row['id'], $uniqrs)) {
                        $safe = ($thislink) ? $thislink : NULL;
                        $thislink = array(
                            'id'          => $row['id'],
                            'linkname'    => $row['linkname'],
                            'url'         => $row['url'],
                            'description' => $row['description'],
                            'date'        => $row['date'],
                            'category'    => $row['category'],
                        );
                        $out[] = ($form) ? parse_form($form) : (($thing) ? parse($thing) : href($row['linkname'], $row['url']));
                        $uniqrs[] = $row['id'];
                        $thislink = $safe;
                    }
                }
            }
            break;
    }

    $smd_tags['meta']['content_count'] = $contentCount;

    if ($out) {
        return doLabel($label, $labeltag).doWrap($out, $wraptag, $break, $class);
    }

    return '';
}

// ------------------------
// List tags from current context, or given type
function smd_tag_list($atts = array(), $thing = null)
{
    global $smd_tags, $smd_thistag;
    static $smd_tags_tree = array();
    static $smd_tags_count = array();

    if (!smd_tags_table_exist()) {
        trigger_error(gTxt('smd_tag_not_available'));
        return;
    }

    extract(lAtts(array(
        'flavour'      => 'list', // 1) list: only tags with assignments, 2) cloud (adds weighting to smd_thistag), 3) head (first tag in list), 4) tail (last tag in list)
        'showall'      => '0', // 0: just used, 1: include empties
        'type'         => '',
        'id'           => '',
        'name'         => '',
        'exclude'      => '',
        'parent'       => '', // Start list from here
        'sublevel'     => '', // Get tags from this sub-level only (0=top level, 1-level 1, ..., all=everything)
        'auto_detect'  => '1',
        'offset'       => 0,
        'limit'        => 999999,
        'form'         => '',
        'indent'       => '&#160;&#160;',
        'section_link' => '',
        'sort'         => '',
        'shuffle'      => 0,
        'label'        => '',
        'labeltag'     => '',
        'wraptag'      => 'ul',
        'break'        => 'li',
        'class'        => __FUNCTION__,
        'active_class' => '', // TODO
        'breakclass'   => '',
    ), $atts));

    // Validate client side atts
    $validTypes = array('article','image','file','link');
    $ids = '';
    $where = array();
    $ctxt = smd_tags_context();

    $attemptMatch = (empty($name) && empty($id) && empty($exclude) && !empty($ctxt['id'])) ? false : true;
    $type = (in_array($type, $validTypes)) ? $type : (($ctxt['context']) ? $ctxt['context'] : $validTypes[0]);
    $ids = ($id) ? do_list($id) : (($auto_detect && $ctxt['id']) ? $ctxt['id'] : '');

    // Unique identifiers for cacheing the lists
    $gopts = $name.$id.$exclude.$parent.$sublevel;
    $guid = md5($gopts);

    if ($name) {
        $name = "name IN (" .join(',', quote_list(do_list($name))). ")";
        $where[] = $name;
        $ids = ''; // name trumps id; TODO: maybe offer a way of combining them?
    }

    if ($ids) {
        $ids = "id IN (" .join(',', quote_list($ids)). ")";
        $where[] = $ids;
    }

    if ($exclude) {
        $exclude = "name NOT IN (" .join(',', quote_list(do_list($exclude))). ")";
        $where[] = $exclude;
    }

    if (strtolower($parent) == 'smd_auto') {
        $parent = '';
        $plist = (isset($smd_tags[$type])) ? $smd_tags[$type]['tag_name'] : '';
        if (is_array($plist)) {
            foreach ($plist as $idx => $pname) {
                $parent = $pname;
                break;
            }
        }
    }

    $where = join(' AND ', $where);
    $oper = '';

    if (!$where && isset($smd_tags[$type])) {
        // Use URL tags
        if ($showall) {
            if (isset($smd_tags_tree[$type][$guid]['all'])) {
                $rs = $smd_tags_tree[$type][$guid]['all'];
            } else {
                $rs = $smd_tags_tree[$type][$guid]['all'] = smd_tag_tree((($parent) ? $parent : 'root'), $type, '1=1', SMD_TAG);
            }
        } else {
            // Was just the parent attribute supplied?
            if ($parent) {
                $rs = $smd_tags_tree[$type][$guid]['all'] = smd_tag_tree($parent, $type, '1=1', SMD_TAG);
            } else {
                $rs = $smd_tags[$type];
            }
        }
    } else {
        if (!$where && $attemptMatch && !$showall) {
            $where = '';
            $rs = array();
        } else {
            $where = ($where) ? $where : '1=1';
        }

        if ($where) {
            trace_add('[smd_tag_list query: ' . $where . ']');
        }

        if ($where) {
            if ( ($showall || $where == '1=1') && isset($smd_tags_tree[$type][$guid]['all']) ) {
                $rs = $smd_tags_tree[$type][$guid]['all'];
            } else {
                $windex = md5($gopts.$where);

                if (isset($smd_tags_tree[$type][$windex])) {
                    $rs = $smd_tags_tree[$type][$windex];
                } else {
                    $rs = $smd_tags_tree[$type][$windex] = smd_tag_tree((($parent) ? $parent : 'root'), $type, (($showall) ? '1=1' : $where), SMD_TAG);
                }
            }
        }

        $sublevel = ($parent && $sublevel=='') ? ((smd_tag_tree_search($parent, $rs, 1)) ? '>=1' : '>=0') : $sublevel;
        preg_match('/([=<>]+)?([\d]+|all)/', $sublevel, $matches);

        if ($matches) {
            $oper = ($matches[1] && in_list($matches[1], '>, <, >=, <=')) ? $matches[1] : '==';
            $sublevel=$matches[2];
        } else {
            $oper = '==';
        }

        trace_add('[smd_tag_list sublevel | operator | matches: ' . $sublevel . '|' . $oper . '|' . join(', ', $matches) . ']');
    }

    trace_add('[smd_tag_list tree: ' . print_r($rs, true) . ']');

    if ($rs) {
        $out = array();
        $totals = array();
        $outsub = array();

        foreach ($rs as $key => $row) {
            // Only add the row if one of:
            // 1) showall is on
            // 2) sublevel = 'all'
            // 3) no parent specified
            // 4) sublevel is equal/greater/less than the row's level
            if ($showall == 1 || strtolower($sublevel) == "all" || !$parent || ($oper=='=='? $row['level'] == $sublevel : (($oper=='>=') ? $row['level'] >= $sublevel : (($oper=='<=') ? $row['level'] <= $sublevel : (($oper=='>') ? $row['level'] > $sublevel : $row['level'] < $sublevel) ) ) ) ) {
                $outsub[] = $row;
            }
        }

        $rs = $outsub;
        trace_add('[smd_tag_list sublevel records: ' . print_r($rs, true) . ']');

        if ($shuffle) {
            shuffle($rs);
        } elseif ($sort) {
            $sortPrefix = "SORT_";
            $sortOrder = array();
            $sort = do_list($sort);
            $nsrt = count($sort);

            for ($idx = 0; $idx < $nsrt; $idx++) {
                $sort_dir = explode(' ', $sort[$idx]);

                if (count($sort_dir) <= 1) {
                    $sort_dir[1] = "asc";
                }

                $direction = ($sort_dir[1] == "desc") ? $sortPrefix.'DESC' : $sortPrefix.'ASC';
                $sortOrder[] = array("col" => $sort_dir[0], "sort" => $direction);
            }

            // Translate the rows into columns that can be sorted
            foreach ($rs as $key => $row) {
                foreach ($row as $identifier => $item) {
                    $varname = "col_".$identifier;
                    ${$varname}[$key] = $item;
                }
            }

            // Make up an array_multisort arg list and execute it.
            // The necessary evil() is because we don't know how many cols there will be in the array
            for ($idx = 0; $idx < count($sortOrder); $idx++) {
                $sortargs[] = '$col_'.$sortOrder[$idx]['col'];
                $sortargs[] = $sortOrder[$idx]['sort'];
            }

            $sortit = 'array_multisort('.join(", ",$sortargs).', $rs);';
            eval($sortit);
        }

        $rs = array_slice($rs, $offset, $limit);
        trace_add('[smd_tag_list post-filter records: ' . print_r($rs, true) . ']');
        $numrecs = count($rs);

        // Cache the relevant info from the tag usage table
        if (!isset($smd_tags_count[$type])) {
            $taguse = safe_rows('tag_id, count(*) AS tally', SMD_TAGU, "type='" . doSlash($type) . "' GROUP BY tag_id");

            foreach ($taguse as $tagblob) {
                $smd_tags_count[$type][$tagblob['tag_id']] = $tagblob['tally'];
            }
        }

        // Set up the cloud weighting if desired
        $flavour = do_list($flavour, ':');

        if ($flavour[0] == 'cloud') {
            $minPercent = (isset($flavour[1]) && !empty($flavour[1])) ? $flavour[1] : 100;
            $maxPercent = (isset($flavour[2]) && !empty($flavour[2])) ? $flavour[2] : 200;
            $max = 1; $min = 99999; $count = 0;

            foreach ($rs as $row) {
                $count = (isset($smd_tags_count[$type][$row['id']])) ? $smd_tags_count[$type][$row['id']] : 0;
                $max = ($count > $max ? $count : $max);
                $min = ($min > $count ? $count : $min);
            }

            $multiplier = ($max > $min) ? ($maxPercent - $minPercent) / ($max - $min) : 1;
        }

        $tag_head = (isset($smd_tags['meta']['tag_head'])) ? $smd_tags['meta']['tag_head'] : '';
        $tag_tail = (isset($smd_tags['meta']['tag_tail'])) ? $smd_tags['meta']['tag_tail'] : '';
        $tag_list = (isset($smd_tags['meta']['tag_list'])) ? $smd_tags['meta']['tag_list'] : array();

        // Preserve the current tag so lists in lists can be created
        $old_tag = $smd_thistag;

        // Iterate over the tags, populate the local context (global!) variable and parse through the form/container
        foreach ($rs as $idx => $row) {
            $index = $idx; // Because we can muck about with this value without affecting the loop counter

            if (($flavour[0] == 'head') && ($row['name'] != $tag_head)) {
                continue;
            }

            if (($flavour[0] == 'tail') && ($row['name'] != $tag_tail)) {
                continue;
            }

            $row['type'] = $type;
            $row['count'] = (isset($smd_tags_count[$type][$row['id']])) ? $smd_tags_count[$type][$row['id']] : 0;
            $row['indent'] = str_repeat($indent, $row['level'] * 1);
            $row['weight'] = ($flavour[0] == 'cloud') ? floor($minPercent + (($max - ( $max - ($row['count'] - $min))) * $multiplier)) : 1;

            if (($flavour[0] == 'crumb') && (($pos = array_search($row['name'], $tag_list)) !== false)) {
                // Override the position of this entry in the list to fake a crumbtrail
                $index = $pos;
            }

            $row['first'] = ($index == 0) ? 1 : 0;
            $row['last'] = ($index == ($numrecs-1)) ? 1 : 0;

            smd_tag_populate($row);
            $out[$index] = ($thing) ? parse($thing) : (($form) ? parse_form($form) :
                    str_repeat($indent, $row['level'] * 1)
                    .smd_tag_name(array('title' => 1, 'section' => $section_link))
                    .smd_tag_count(array()));
            $smd_thistag = array();
        }

        // In case the order has been fudged for crumbtrail
        ksort($out);

        // Restore previous tag, if any
        $smd_thistag = $old_tag;

        if ($out) {
            return doLabel($label, $labeltag).doWrap($out, $wraptag, $break, $class, $breakclass);
        }
    }

    return '';
}

/*

register_callback('tru_tags_atom_handler', 'atom_entry');
function tru_tags_atom_handler($event, $step) { return tru_tags_feed_handler(true); }
register_callback('tru_tags_rss_handler', 'rss_entry');
function tru_tags_rss_handler($event, $step) { return tru_tags_feed_handler(false); }

function tru_tags_feed_handler($atom) {
    global $thisarticle, $tru_tags_prefs;
    extract($thisarticle);

    $tags = tru_tags_get_tags_for_article($thisid);

    if ($tru_tags_prefs[TAGS_IN_FEED_BODY]->value) {
        $extrabody = '';
        $FORM_NAME = 'tru_tags_feed_tags';
        if (fetch('form', 'txp_form', 'name', $FORM_NAME)) {
            $form = fetch_form($FORM_NAME);
            $extrabody = trim(parse($form));
        } else {
            $atts = tru_tags_get_standard_cloud_atts(array(), false, true);
            $extrabody = '<p>tags: ' . tru_tags_render_cloud($atts, $tags, $tags) . '</p>';
        }
        global $thisarticle;
        if (trim($thisarticle['excerpt'])) {
            $thisarticle['excerpt'] = trim($thisarticle['excerpt']).n.$extrabody.n;
        }
        $thisarticle['body'] = trim($thisarticle['body']).n.$extrabody.n;
    }

    if ($tru_tags_prefs[TAGS_IN_FEED_CATEGORIES]->value) {
        $output = array();
        foreach ($tags as $tag) {
            if ($atom) {
                $output[] = '<category term="' . htmlspecialchars($tag) . '" />';
            } else {
                $output[] = '<category>' . htmlspecialchars($tag) . '</category>';
            }
        }
        return n.join(n, $output).n;
    }
}

*/
# --- END PLUGIN CODE ---
if (0) {
?>
<!--
# --- BEGIN PLUGIN HELP ---
h1. smd_tags

Tag articles, images, files and links with stuff, then use the public-side tags to display the lists, filter or find related content.

h2(features). Features

Admin-side:

* Unlimited tags for articles, images, files and links
* Fast tagging system for copying, auto-naming, and optional auto-completion
* Nesting of tags
* Live search / filter, with multi-tag operations
* Optionally link tags to Txp categories so clients can only choose from a limited set of tags
* Assign tags via a dropdown select list, a text area or a list of clickable tags
* Set up (optional) dedicated sections to allow public side tag filtering
* Import (article) tags from other tagging plugins or Txp's categories / custom fields

Public-side:

* List / filter tags by type and name. Weighted (cloud) or alphabetical lists possible
* Show related content:
** by tag _between types_. For example if you have set up common tags for both articles and files, when viewing an article you can ask the plugin what files are related (or vice versa: what articles are related to the current file!)
** between other content, e.g. ask it to match the tags from the current file with the article category or a custom field
* Multi-tag filtering
* Tag conditionals and counts

To do (possibly):

* Fix for foreign character autotag dumbdown
* Tag and article paging support: next/prev/older/newer

h2(install). Installation / Uninstallation

p(important). Requires Textpattern 4.6.2+.

p(important). If upgrading from plugin v0.20 or earlier: delete smd_tags_client and smd_tags_admin plugins first, then install and activate this plugin. Your prefs and tags will be retained.

Download the plugin from either "GitHub":https://github.com/Bloke/smd_tags/releases or the "software page":https://stefdawson.com/sw. Paste into the Txp _Admin->Plugins_ panel, install and enable the plugin.

Visit the _Extensions->Tags (smd)_ panel. If it has not already been done automatically for you, click the Install tables/Install prefs buttons. The necessary tables and preferences will be installed. From this page you can Install, Delete and Save the plugin preferences or remove the plugin's tables to empty your tags entirely and start again.

To completely remove smd_tags, visit the _Tag Preferences_ page, hit 'Remove tables' to remove the preferences and tag tables from the database, then simply delete the plugin as normal from the _Admin->Plugins_ page.

Visit the "forum thread":http://forum.textpattern.com/viewtopic.php?id=28621 for more info and to report the success (or otherwise) of this plugin.

h2. Admin-side buttons

* *Manage tags*: Switch to the "tag management page":#manage
* *Preferences*: Switch to the "preferences page":#prefs
* *Import tags*: "Import tags":#import from tru_tags, rss_unlimited_categories or Txp categories/custom fields
* *Install prefs &#8224;*: Install the plugin preferences; useful if your have upgraded or wish to resync missing prefs. Any existing preference values will be retained.
* *Remove prefs &#8224;*: Delete the plugin preferences; useful if your prefs have become corrupted or you simply want to return to "default" operation.
* *Remove tables &#8224;*: Delete the tags tables. This will permanently erase all tags against all articles, images, files and links. Be very sure you mean it before clicking this!
* *Rebuild tags &#8224;*: If your tag table is corrupt you *may* be able to fix it with this option. However, if it is badly damaged you may just get a white screen of death. If that is the case, your options are then to either fix it by hand or delete the bad entries, rebuild the table with the remaining items and then repopulate the tags.

&#8224; Use the *More...* link to reveal these items.

h2(#prefs). The preferences

h3. Interface setting prefs

* *Enable tags in*: a tag entry mechanism is added to the admin side of each of the checked pages.
* *Enter tags using*: the mechanism you wish to use to assign tags. @Text area+@ allows new tags to be added on the fly via contributors (a bit like tru_tags).
* *Bi-directional tag trees*: when you assign a tag to an item, any time you display related items by tag, only exact matching items are returned. If you organise your tags in hierarchical trees, you may wish to have parent or child tags automatically considered. Choose from:
** *No*: Only exact tag matches are considered when returning related content.
** *Up*: for any given tag assigned to an item, consider all its parent tags also implicitly assigned.
** *Down*: for any given tag assigned to an item, consider all its child tags also implicitly assigned.
** *Both*: for any given tag assigned to an item, consider all its parent and child tags also implicitly assigned.
* *Link tags to categories*: allow tags to be associated with Txp categories. If this is on and @Text area+@ is being used, any new tags added via the article, image, file or link screens will be associated with the currently selected category (or category1 in the case of articles).
* *Permit parent tag selection*: if set to 'yes', the parent tags assigned to the chosen categories are selecteable as tags. Set to 'no' if your tag hierarchy is such that the parent tag is just a placeholder or "group leader" with no intrinsic value other than as a parent for a bunch of child tags.
* *Master parent tag*: the name of a tag that you designate as the 'master' tag. Assigning any tags beneath this one will be added to any per-category tags to make up the final available tag pool.
* *Quick tag*: if using a textarea and you install the jQuery autocomplete plugin, this determines which method of auto-complete to use: @strict@ prevents tags being submitted that are disallowed by the current Txp category; @standard@ allows new tags to be entered. Note that you *may not enter new tags at all* if Quick tags is in @strict@ mode: it overrides @Text area+@.
* *js plugin dir*: the directory in which your auto-complete plugin resides (the filename it expects is @jquery.autocomplete.pack.js@). If you begin the directory name with a @/@ the path will be relative to your site root. Without a preceding '/' it is relative to the 'textpattern' directory. The trailing slash is optional and will be added internally if you omit it. This gives you the freedom to put the files wherever it suits you and reference them like this:
** use @my_js@ for 'textpattern/my_js/jquery.autocomplete.pack.js'
** use either @../my_scripts@  or @/my_scripts@ for 'site_root/my_scripts/jquery.autocomplete.pack.js'
* *js style dir*: the directory in which your auto-complete CSS files reside (the file name it expects is @jquery.autocomplete.css@). The same comments hold true about the path as above.
* *Select/textarea rows*: number of rows in the select list or textarea. If set to @1@ a select list will become non-multiple and you can then only choose 1 tag. Set to @0@ to show a multiple select list containing all tags. Other values show a multiple select list with the given number of rows but be aware this may turn out to be a guide as certain browser factors may override the value. For example, in Firefox if you choose a select list value of @2@ you cannot see the whole list because the input is not big enough to show the scrollbar (you get a scrollbar from a value of @3@ or more). Also, if you are using autocomplete for the text area you may not get the number of rows you expect due to the CSS that comes with the autocomplete plugin.

h3. Tag management prefs

* *Initial pane*: when you click _Extensions -> Tags (smd)_, show either the preferences page or the tag management page.
* *Auto name*: helps speed tag creation by automatically naming them based on the title you use.
* *Tag layout*: can be either:
** the number of columns of tags to display in the management page. This creates a table.
** the word @list@ to show them as an unordered list. If you specify @list:N@ then the list will be split every 'N' tags and start a new row/column (depending on your setting of _Order tags by_).
** the word @group@ to start a new row or column each time a new top-level tag is encountered. Useful for heavily nested or hierarchical tags.
* *Order tags by*: 'column' to have the tags work down the page first; 'row' to work across the page.
* *Show tag usage counts*: whether to indicate the number of items for which a tag is used.
* *When deleting a parent*: choose whether any child tags will be promoted to the same level as the tag you just deleted, or the entire tree below the deleted tag will be removed as well.
* *Allow deletion of used tags*: when set to 'no', if a tag has been used by an article/image/file/link it cannot be deleted.
* *Textile description*: allow Textile to be used in tag descriptions.
* *Show description as tooltip*: when on a content panel and you have elected to use Select List or Text List input modes, this setting tells the plugin to popup a tooltip of the description as you hover over a tag.
* *Automatically display reports*: after operations that affect multiple tags, a report listing the alterations is available. If set to 'yes' this report is popped up for you to read immediately after the operation. If set to 'no' you can view the report by clicking the _Display recent report_ link in the Tag Search box.
* *Clicked RGB colour*: the CSS background colour for the currently edited tag.
* *Mouse-over RGB colour*: the CSS background colour as you move over each item in the list.
* *Sub-tag level indicator*: the HTML entity or text you wish to precede each sub-tag with. Level 1 tags have one of these symbols added, level 2 tags have two added, and so on.
* *Multi-tag delimiter*: allows you to specify more than one tag at a time during creation. If you enter more than one character here, only the first will be used. To disable this feature, empty the box contents.
* *Description width, height*: width and height (comma-separated, in pixels) of the description textarea input field.

h3. URL management prefs

* *Use tag combinations*: If set to yes, you may perform multi-tag searches from the URL. If set to no, only the last tag is taken into account.
* *AND combinator char*: The character to use between tags when you want to find smd_related_tags that match ALL the tags in the URL. Default: @+@.
* *OR combinator char*: The character to use between tags when you want to find smd_related_tags that match ANY of the tags in the URL. Default: @|@.
* *URL name parameter*: When filtering by tag name, this is the URL string used to indicate a tag.
* *URL type parameter*: When filtering by tag type, this is the URL string used to indicate a tag type.
* *Trigger(s) for tag lists*: A comma-separated list of trigger words, or Txp Sections which are valid tag landing pages[1]. Any automatically generated links from the public-side tags will be sent to the _first_ section in the list for display. Can be overridden on a tag-by-tag basis with the @section_link@ attribute.

fn1. If using this feature for Sections, they must exist in your Txp Sections tab, unless you are using some gbp_permanent_links magic. Note that URLs can be any of the following formats:

* Full clean : @site.com/trigger/tag-type/tag-name@
* Short-circuited clean : @site.com/trigger/tag-name@ (defaults to @article@ tag type)
* Messy default : @site.com/trigger?smd_tagtype=tag-type&smd_tag=tag-name@ (smd_tagtype can be omitted to mean 'article')
* Messy per-section: @site.com/section?smd_tagtype=tag-type&smd_tag=tag-name@
* Clean per-section: @site.com/section/trigger/tag-type/tag-name@
* Short-circuited per-section clean : @site.com/section/trigger/tag-name@
* Short-circuited per-section messy : @site.com/section?smd_tag=tag-name@

(the URL params @smd_tag@ and @smd_tagtype@ can be altered from the prefs).

Watch out if you are using clean urls because they may clash with your individual article views. For example, if you chose to detect tag lists on your @widgets@ section and you're using the section/title permlink scheme, the plugin won't know the difference between:

* /widgets/how-to-order (an individual article under the /section/title permlink scheme)
* /widgets/widget-c (a tag for widget-c)

So you should make sure in this case that you either a) use a dedicated (non-article-bearing) section for your tag lists, b) always use the full tag syntax including type: @widgets/article/widget-c@, c) use messy tag syntax, d) change permlink scheme. The plugin tries to avoid clobbering @/section/id/title@ format by detecting the presence of the numeric id, so that may be the safest option if you are mixing tag landing pages with article sections.

h2(#manage). Tag management pane

Displays a list of all defined tags. In contrast to the built-in categories, only one type is shown at a time; switch between them with the radio buttons in the 'Filter' row.

The input row at the top has four or five fields in it, depending if you have chosen to link tags to categories:

* *Title*: The display name of the tag on the public site.
* *Description*: A description to explain the tag's purpose.
* *Parent*: Whether the tag is in a sub-category. The empty item is considered 'root' (top level).
* *Linked cat*: (optional) Whether the tag is associated with a Txp category. Any sub-tags are automatically assigned to the chosen category as well.
* *Name*: The 'internal' Txp tag name. Probably shouldn't contain spaces or weird characters, although you can put them in if you know what you're doing.

With the auto-name feature enabled, whatever you type in the Title field will be mimicked in the Name field, but with only lower case alphanumeric characters. Spaces will be converted to dashes. Note that at present, foreign characters are not 'dumbed down' to ASCII. This feature is planned but for the time being it is probably best to switch off the auto-name feature if you are dealing heavily with unicode characters. Your tags will still be dumbed down according to Txp's internal rules exactly like they are on the Categories panel; you just won't be able to see its name until you click to highlight it.

If you have elected to use multi-tag entry, you may put as many tags as you like in the Tag Title/Tag Name boxes, each separated by your chosen delimiter character (see the _Multi-tag delimiter_ preference).

Hit Save (or Create) to define the tag(s), or use the Enter key when in any input field as a shortcut for Create. The tag(s) will be created in the currently selected type (article, image, file or link) and assigned to the currently chosen Parent/Category. If you have added only one tag, it will remain 'selected' after creation and will also stay selected when switching between types. This allows for rapid creation of similar-named tags or for very quickly 'copying' tags from one type to another.

You can edit any tag by clicking on it in the list to pull it into the edit line at the top. Make any changes and hit Save to overwrite the existing tag, or hit Create to make a new one. Use the 'x' button to delete the selected tag; note there is no confirmation step, since the act of clicking the tag is the confirmation itself! When you switch between types, if the currently edited tag exists in another type, it will be selected automatically upon switching.

If the option to display counts is selected the number of articles / images / files / links will be shown in brackets alongside each tag. If the value is greater than 0 the number can be clicked to view the list of items containing that tag.

Notes:

* If you Edit a tag and try to Save it when it has the same name as an existing tag, you will receive a warning message.
* If you try to delete a tag that is in use and the preference 'Allow deletion of used tags' is set to 'no', it will be forbidden.
* The parent list is populated via AJAX from the database each time you click a tag, and the Linked cat list is populated each time you change type. This is unfortunately unavoidable. The lists will fade out while the request is taking place. Occasionally it may get "stuck" if you click too quickly between tags or the server is slow to respond. In these circumstances, refreshing the page by clicking the _smd_tags_ tab will restore things.
* When using the auto-tag feature, if you want to change the Name field, do it _after_ you have finished typing in the Title field; any subsequent changes to the Title field will overwrite anything in the Name field.
* Deleting a tag will remove all references to it, so be careful.

h3. Live tag search

You can use the _Tag search_ box to filter your tag list in real-time. This facilitates easy searching when your tag list becomes large. Simply start typing in the text box and your tags will be filtered as you type. An indicator to the right shows how many tags match your current search criteria. You can choose that your text be matched against the tag's name, its title, its parent tag, linked category (if you have allowed tags to be linked), or all of the above.

When you flick between tag types your search criteria remain in force. Hit the _ESCape_ key to clear the text box and return your tag list to its unfiltered state. You may hide/display the filter box by clicking its heading to toggle its visibility (the current state is remembered for you).

Notes:

* Searches are case insensitive.
* Multi-word searches find tags with _any_ of the matching words. This allows you to build up complex searches using many words and apply actions to them all.
* Linked categories and tag names/parents are escaped so they will not contain any non-ASCII or special characters. For example, if your tag title is _Paul O'Grady_ you can search its title for _O'Gr_ and it will locate the tag. If, however, you wanted to find all tags that have _Paul O'Grady_ as their parent tag you'd have to type _ogra_ to have it filter by this parameter.

h3. Performing actions on filtered tags

While you are filtering the tags, you can perform a set of actions on all the visible tags. Simply enter some search criteria and, when you are happy with the presented list of tags, select one of the actions from the _With filtered_ dropdown.  You can multi-delete, assign a parent tag, or (if permitted) assign a linked category.

Choosing to _Assign parent_ or _Link to category_ presents a further dropdown. Select the parent tag/category to which you wish to assign the filtered tags. When you select _Go_ and confirm you are sure, the action will be applied to all selected tags.

Things to note:

* If you try to assign a parent to a tag that is itself, it will be safely ignored.
* If the _Automatically show reports_ preference is on, the result of the action will be popped up immediately upon completion.
* If you leave the search box empty, any multi-action you choose will be applied to ALL tags.
* You can view the most recent report at any time by clicking the _Display recent report_ link in the _Tag search_ box, but once you have navigated away from the Manage Tags panel, or performed another action such as creating a tag, the report is refreshed/lost.

h2(#import). Importing tags en-masse

p(important). Back up your database first!

If you have used tru_tags and/or rss_unlimited_categories you can import the information from either system and create smd_tags. You may also import tags from Textpattern's own category tree or from (delimited) custom fields. View the Import panel and set the following options to configure how the tags are imported:

h3. Source options

* *Import from*: Choose from where you wish to import. To see the plugin options, that particular plugin needs to be installed and activated for it to appear.
* *Custom field*: If you have elected to import from custom field, choose which one contains your tag list. If you want to import from more than one, import them one after another.
* *Custom field delimiter*: The character sequence that delimits each tag in your custom field. Default: comma.
* *Articles from section*: Only import tags from the articles in the selected section. If not chosen, it uses all articles in your site.
* *Start from parent category*: If you are importing category names from rss_unlimited_categories, you can choose to only import them from this parent and below.
* *Delete original*: Empty the Keywords field (tru_tags), custom field, or remove any rss_unlimited_categories linked to the articles you are importing from. For safety, you should do this in two steps; import the tags and leave the originals intact, then import again with _Delete originals_ set to 'yes' once you are happy with the results. Note that Textpattern category1 and category2 assignments are _not_ deleted.

h3. Import options

* *Link to category*: if you permit tags to be linked to category, this dropdown is available. All imported keywords/categories will be linked to this Txp category.
* *Force category link if tag already exists*: if checked, any tags that have already been imported will have their category re-assigned to the chosen category. If not checked, any tag that already exists will have its category left intact.
* *Assign to parent tag*: Link all imported keywords/categories beneath this smd_tag. If you are linking tags to categories then the available parent tags will be influenced by the setting of the category chosen above.
* *Force parent if tag already exists*: if checked, any tags that have already been imported will have their parent re-assigned to the chosen smd_tag. If not checked, any tag that already exists will have its tag hierarchy left intact.

Once you have chosen the relevant options, hit _Go_. The plugin will do your bidding and:

# Copy the information from the Keywords (tru_tags) / Categories (rss_uc), Textpattern article category, or custom field and create smd_tags for each item. If the tag already exists it will be ignored unless you override it with one of the 'force' options.
# Assign the created tags to the relevant parent, either for tags that do not exist or for all tags if the 'force' option is chosen.
# Link the created tags to the relevant category, either for tags that do not exist or for all tags if the 'force' option is chosen.
# Copy the assigned tags in each article from the Keywords/Categories so the same tags are assigned.
# (optionally) Delete the original custom field/Keywords/Unlimited categories (not from Textpattern category1/2).
# Remember your options so you can quickly make alterations and import tags in batches if you wish.

As the plugin goes through your articles it will update the counts below the import options: the number of articles done/out of total, and the number of tags that have been imported and linked to your articles. Once it has completed the task, a report is available detailing the actions the plugin took. It will either be displayed automatically (depending on your pref setting) or you can view it by clicking the _Display recent report_ link.

h2. Editing articles / images / files / links

On each of the four pages that have checkboxes set in the smd_tags preferences, your chosen input mechanism will appear beneath the category assignment. This allows you to tag a particular article, image, file or link with any number of items. Once you have selected your tags, the usual Save button on the screen will commit the changes. Note that if you have chosen to link tags with categories and you have not chosen any category(ies) -- or have chosen categories that are not linked to tags --  you will see no tags in the list modes! Further, in the Textarea mode you will not be able to save any tags unless you choose a valid category first. See below for more.

The @[Edit]@ link takes you to the Tag Management page that allows you to create new tags. If using a select list, two other buttons are available: @[Clr]@ deselects all tags and @[Tog]@ toggles all tags so if they were 'on' they become 'off', and vice versa.

Notes on the Text area entry mechanisms:

* Tags are case sensitive. Auto-complete is strongly recommended.
* New tags can _only_ be added if the @Text area+@ input method is chosen and Quick tag is *not* strict.
* New tags are normally assigned at the root level; if you wish to sub-tag them at this point, write the tag like this: @parent_tag-->new_tag@. Anything to the left of the hyphen-hyphen-arrow is first checked to see if it exists as a tag and, if it does, the new_tag is made a sub-tag of it. If the parent_tag doesn't exist, new_tag is assigned to root.
* New tags become Tag Titles. Corresponding tag names are subject to the usual lower case/dumbing down.
* If @Link tags to categories@ is set, only valid tags assigned to the chosen categories will be saved.
* If you alter category your tag list is rebuilt to only show / allow the ones in the selected category(ies). If you have already selected some tags, this will result in the ones you have selected since last save being removed/unhighlighted. So choose your categories first and then tag away.

h2(tag). Tag: @<txp:smd_tag_list>@

Display a list of tags matching certain criteria, from the current context (URL, article, file, link, or image) or a fixed context supplied as attributes. Use the following attributes to configure the tag:

; *type*
: Where to look for the list of tags. If omitted the best match is used based on where the tag is used. For example, if it is inside the @plainlinks@ form, the type would default to @link@. If a best match cannot be found, it uses @article@. Options are:
:: @article@
:: @image@
:: @file@
:: @link@
: Default: best match.
; *flavour*
: The type of tag list to display. Choose from:
:: @list@ : a standard list in parent->child (tree) order
:: @cloud@ : a weighted tag cloud
:: @crumb@ : a list of tags in the order they are presented in the URL
:: @head@ : the first tag listed in the URL
:: @tail@ : the last tag listed in the URL
: When using @cloud@, some weighting information is calculated for each tag at the expense of a little extra processing overhead. You can also, optionally, specify the scale by adding @:min:max@. For example: @flavour="cloud:75:300"@ would make the minimum weight 75 and the maximum 300. Default is @:100:150@.
: Default: @list@
; *id*
: List of tag IDs to show. If omitted and you were viewing an article it will default to the tags from the current article.
; *name*
: Fixed list of tag names to show. If used, they trump the @id@.
; *exclude*
: List of tag names you wish to omit from the list.
; *parent*
: Start the list from this parent tag.
: Default: unset (i.e. the 'root' node of this particular type)
; *sublevel*
: Only show tags matching this number level. You can either specify:
:: @all@ which shows all tags from all levels
:: _any number_ to match only tags from that level.
: You may also prefix the number with a comparison operator (e.g. @sublevel=">=1"@) which would only show tags from level 1 and its descendents. Valid operators are:
:: @>@
:: @<@
:: @>=@
:: @<=@
: If anything else is used, equality is assumed.
: Note that if you specify a parent, and that parent is in the current tag list, its level is 0 and the children beneath it start at level 1. If, however, your chosen parent is not in the current tag list, _the children will be at level 0 and any sub-children will start from level 1_. To help manage this, if you leave @sublevel@ empty the plugin figures out the appropriate level automatically and only shows tags below the given parent.
; *showall*
: Whether to show empty tags or not. Choose from:
:: 0: only show tags that are in use
:: 1: show all tags, even empty ones. Useful for generating hierarchical tag trees
: Default: 0
; *offset*
: Skip over this number of tags before starting to display them.
; *limit*
: The maximum number of tags to show.
: Default: 99999 (i.e. effectively unlimited)
; *form*
: Pass control to this form to display the tag list. You may also use the tag as a container. Without form or container, the tag name and its count will be output.
; *indent*
: Character sequence to use to indicate that a tag is a sub-tag of a parent.
: Default: two non-breaking spaces
; *section_link*
: If you want the tags to be clickable so they lead to another page of tag details, this can be used to override the 'landing page' they will appear on.
: Default: unset (it uses the value of the @Default section for tags@ preference)
; *sort*
: Order the results by this field, e.g. @sort="name asc"@.
; *shuffle*
: Randomly sort the tags.
; *label*
: Label the top of the list with this heading.
; *labeltag*
: Wrap the label with this HTML tag (e.g. @labeltag="div"@).
; *wraptag*
: Wrap the tag list with this HTML tag.
: Default: @ul@
; *class*
: Apply this CSS class to the tag list.
: Default: @smd_tag_list@
; *break*
: Wrap each tag with this HTML tag.
: Default: @li@
; *breakclass*
: Apply this CSS class to each tag.

h2(tag). Tag: @<txp:smd_tag_name>@

Display the name of the current tag. Ususally used inside an smd_tag_list container. Can be a container to add extra formatting around the name if you wish. Use the following attributes to customise the tag:

; *title*
: Whether to show the tag name or its title. Choose from:
:: 0: name
:: 1: title
: Default: 1
; *link*
: Whether to make the tag clickable to take visitors to a tag page about that particular tag. Choose from:
:: 0: not clickable
:: 1: clickable
: Default: 0
; *section*
: The section name to link to.
: Default: the first item in the @Trigger(s) for tag lists@ preference
; *cleanurls*
: Whether to generate clean URL syntax for trigger/tagtype/tag links. Choose from:
:: 0: messy tag mode (use this if you're having trouble with clean mode)
:: 1: clean mode
: Default: 1
; *parent*
: Not very useful to display, but can be useful to offer tree-browsing of tags. Choose from:
:: 0: don't use parent tag name
:: 1: use parent tag name
: Default: 0
; *parentlabel*
: The label to use for any parent links.
: Default: 'Up a level'
; *wraptag*
: Wrap the tag with this HTML tag.
; *class*
: Apply this CSS class to the wraptag.
: Default: @smd_tag_name@
; *style*
: Apply this CSS inline style definition to the tag.
; *pad_str*
: Put this string adjacent to the label to indicate its level in the hierarchy.
; *pad_pos*
: Where to put the padding. Choose from:
:: @left@
:: @right@
:: @both@
: If using @link@ you may add @:in@ to the pad_pos value to indicate if you want the string to be included inside the anchor (by default it will be outside).
: Default: @left@

h2(tag). Tag: @<txp:smd_tag_count>@

Display the number of articles, files, images or links that use the current tag. Use the following attributes to customise the tag:

; *showempty*
: Determines whether to display counts that have zero items.
:: 0: skip zero values
:: 1: show all values, even if zero
: Default: 1
; *wraptag*
: Wrap the count with this HTML tag.
; *class*
: Apply this CSS class to the count.
: Default: @smd_tag_count@
; *style*
: Apply this CSS inline style definition to the count.
; *wrapcount*
: Characters to wrap around the count itself. Specify up to two items, separated by a colon. If you use just one item it will appear on both sides of the count.
: Default: @ (:)@ (with a space at the start)
; *paramdelim*
: If you don't like the default separator for the @wrapcount@ attribute, change it.
: Default: @:@ (colon)

You may also uses this tag to return the _total_ number of pieces of content that match after using smd_related_tags. Any time immediately after encountering @<txp:smd_related_tags>@, you can use this tag to fetch the total number of articles, images, files or links that matched the given tag(s). Respects and/or matches.

h3. Example: display tags/counts from the current article

Here's an example, using the last three tags. In your default article form, add this to show a list of clickable tags associated with the current article:

bc. Filed in: <txp:smd_tag_list wraptag="" break=" | "
     shuffle="1" indent="">
  <txp:smd_tag_name link="1" />
  <txp:smd_tag_count wrapcount="/" />
</txp:smd_tag_list>

That might display:

bc. Filed in: UK /8/ | politics /1/ | media /14/ | money /9/ | banks /3/

h2(tag). Tag: @<txp:smd_tag_info>@

Display any other pieces of information about a tag. Use the following attributes to customise the tag:

; *item*
: List of one or more things to display. Can be any of:
:: @id@
:: @name@
:: @description@
:: @title@
:: @lettername@ (first unicode letter of the tag's name)
:: @lettertitle@ (first unicode letter of the tag's title)
:: @type@ (article, image, file, link)
:: @parent@ (the parent tag)
:: @children@ (number of child tags this tag has)
:: @level@ (level 0 = 'root')
:: @count@ (number of articles/images/files/links assigned to this tag)
:: @weight@ ('size' of this tag, weighted as a percentage of all tags based on the count: useful inside @style@ attribute of smd_tag_name for creating weighted tag clouds)
: Default: @name@
; *wraptag*
: Wrap the tag items with this HTML tag.
; *class*
: Apply this CSS class to the tag items.
: Default: @smd_tag_info@
; *break*
: Wrap each tag item with this HTML tag.
: Default: @br@
; *breakclass*
: Apply this CSS class to each tag item.

h3. Example: extended tag information

Inside an smd_tag_list, put this to display some information about each tag:

bc. <txp:smd_tag_info item="id" />:
 <p>parent | #children | level<br />
 <txp:smd_tag_info item="parent, children, level"
      break=" | " /></p>

h2(tag). Tag: @<txp:smd_if_tag_list>@

Conditional tag that returns true if the current scope is a tag list. Useful for detecting if a tag has been clicked and redirected to a landing page so you can take some action on that page.

h2(tag). Tag: @<txp:smd_if_tag>@

Rudimentary conditional to check a tag for certain parameters and execute the contained content if it matches. Every attribute you specify must match for the conditional content to be executed, otherwise any @<txp:else />@ branch will be followed. Use the following attributes to customise it:

; *type*
: Executes the contained statements if the type matches the one given. Takes one of:
:: @article@
:: @image@
:: @file@
:: @link@
; *id*
: Checks if the tag ID matches the one given.
; *name*
: Checks if the tag name matches the one given.
; *title*
: Checks if the tag title matches the one given.
; *description*
: Checks if the tag description matches the one given.
; *parent*
: Checks if the tag parent matches the one given.
; *count*
: Checks if the tag count matches the number given.
; *children*
: Checks if the number of children the tag has matches the number given.
; *level*
: Checks if the tag is at a specific level in the hierarchy.
; *is*
: Checks if the tag is of a particular variety. Choose from:
:: @master@ : one of the master tags
:: @first@ : the first tag in the list
:: @last@ : the last tag in the list

Each of the items (except @is@) may take an exact value/string to match or a modified syntax: you may precede the value with one of the following symbols to perform a mathematical/boolean comparison:

* @<@ : less than.
* @<=@ : less than or equal to.
* @>@ : greater than.
* @>=@ : greater than or equal to.
* @!@ : not equal to.

For example:

bc. <txp:smd_if_tag parent="!root" count=">8">
// Current tag is not a top-level tag and has
// more than 8 items associated with it
</txp:smd_if_tag>

For more fine-grained control or more detailed conditional branching, consider the smd_if plugin.

h2(tag). Tag: @<txp:smd_related_tags>@

The big one! This tag allows you to find and display any content that matches some facet of the current content. It defaults to matching tag names. For example, if the tag appeared on its own on an article page, it would find all 'related' articles that contained the same tags as the ones in the current article.

But it is not restricted to searching within its own type. You could find all the matching images or links that shared a tag with the current article. Or if showing a list of links, display all articles that share tags with the current link.

Finally, you can also match other stuff such as image, file, link or article categories, custom fields, and so on.

Use the following attributes to customise the tag:

; *type*
: The type of information you want to _find_. Can be one of:
:: @article@
:: @image@
:: @file@
:: @link@
: Default: the same type as the current context (i.e. if in an article, will look for other articles)
; *match*
: The information you want to _compare_. Can be one of:
:: @tag_name@
:: @tag_id@
:: @tag_title@
:: @tag_description@
:: @tag_parent@
:: @tag_count@
:: @tag_children@
:: @tag_level@
:: some field name such as @category@ or @custom1@
: Default: @tag_name@
; *match_self*
: Whether to include a reference to the current item. Usually you won't want this so it is off and in fact, setting it on can sometimes cause errors. Options:
:: 0: off
:: 1: on
: Default: 0
; *form*
: Pass control to the given form for rendering the tag output. Can also be used as a container. If you don't specify either a @form@ or a container, it outputs some sensible default based on the current context (i.e. the permlinked article title in the @article@ context, the file download link in the @file@ context, etc).
; *section*
: %(important)Only of use for articles%. Limits the search to articles in a particular section.
: Default: current section, but check the caveats below for a side-effect of this attribute
; *offset*
: Skip this number of matched items before starting to display them.
; *limit*
: The maximum number of items to display.
: Default: 99999 (i.e. virtually unlimited)
; *no_widow*
: When displaying article titles, prevent lone words on the 2nd line.
: Default: Txp Admin preference of the same name
; *sort*
: Reorder the items by some field.
: Default: @Posted desc@ for articles / @date desc@ for everything else
; *label*
: Display this label at the top of the list of items.
; *labeltag*
: Wrap this HTML tag around the label.
; *wraptag*
: Wrap this HTML tag around the items.
; *break*
: Wrap each item with this HTML tag.
: Default: @br@
; *class*
: Apply the given CSS class to the item list.
: Default: @smd_related_tags@
; *delim*
: If you prefer something other than the default to specify lists of items in the tag attributes, change it.
: Default: @,@ (comma)
; *paramdelim*
: If you prefer something other than the default to separate parameters inside attributes, change it.
: Default: @:@ (colon)

When specifying items to @match@ you are not restricted to searching the current context. For example, say you had a list of file downloads and next to each file you wanted to show the articles that matched the file's category. You might do this in your @files@ form:

bc. <txp:file_download_link>
  <txp:file_download_name />
</txp:file_download_link>
<txp:smd_related_tags type="article"
     label="You might also like" labeltag="p"
     match="file:category" wraptag="ul"
     break="li" />

h3. Caveat

Be careful with the @section@ attribute: on a tag list, _all_ items of a given type are considered, irrespective of section. Thus if you did:

bc. <txp:smd_if_tag_list>
  <h2>Tags list</h2>
  <txp:smd_tag_list>
    <txp:smd_tag_name title="1" link="1" />
    <txp:smd_tag_count />
    <txp:smd_related_tags section="archive" wraptag="ul" break="li" />
  </txp:smd_tag_list>
</txp:smd_if_tag_list>

You might see a tag name with a count of 12 but only 7 articles listed under it, if five of your articles that used that particular tag were from another section. To be sure, only use the @section@ attribute on individual article pages.

h2(#eg1). Example 1: linked tag tree

bc. <txp:smd_tag_list showall="1" parent="translations">
   <txp:smd_tag_info item="indent" />
   <txp:smd_if_tag children=">0">
      <txp:hide> A parent tag: do not link </txp:hide>
      <txp:smd_tag_name title="1" />
   <txp:else />
      <txp:hide> A child tag: link it to the default trigger section </txp:hide>
      <txp:smd_tag_name link="1" title="1" />
   </txp:smd_if_tag>
   [<txp:smd_tag_info item="count" />]
</txp:smd_tag_list>

h2(#eg2). Example 2: font-weighted tag cloud

bc. <txp:smd_tag_list parent="animals" flavour="cloud:75:300"
      wraptag="div" break="">
   <txp:variable name="fontweight">
      font-size:<txp:smd_tag_info item="weight" />%;
   </txp:variable>
   <txp:smd_tag_info item="indent" />
   <txp:smd_tag_name link="1" title="1" wraptag="span"
           style='<txp:variable name="fontweight" />' />
   (<txp:smd_tag_info item="count" />)
</txp:smd_tag_list>

h2(#eg3). Example 3: weighted alphabetic tag listing

bc. <txp:smd_tag_list showall="1" sort="name asc"
     break="" wraptag="div" flavour="cloud">
   <txp:if_different>
      <h2 class="alphachar"><txp:smd_tag_info item="lettername" /></h2>
   </txp:if_different>
   <span class="atag">
      <txp:smd_tag_name link="1" wraptag="span"
           style='font-size:<txp:smd_tag_info item="weight" />%;' />
      <txp:smd_tag_count />
   </span>
</txp:smd_tag_list>

Just take out the @flavour@ and @style@ attributes to render a regular alphabetic tag listing. Note that you could use @lettertitle@ but you would get both lower- and upper-case 'd' sections if you had tags 'Dastardly' and 'deviant'.

h2(known-issues). Known issues

Issue: Under Txp 4.6.x, the 'More...' link and the preference panel groups don't open/close. A JS error is thrown.
Cause: Bug in Textpattern's @textpattern.js@ file.
Fix: Edit the line that reads:

bc. if (selectedTab === undefined) {

and change it to:

bc. if (typeof selectedTab === 'undefined') {

h2(author). Author

"Stef Dawson":https://stefdawson.com/contact

# --- END PLUGIN HELP ---
-->
<?php
}
?>
