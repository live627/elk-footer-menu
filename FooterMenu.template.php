<?php

/**
 * @package Footer Menu
 * @version 1.0
 * @author John Rayes <live627@gmail.com>
 * @copyright Copyright (c) 2014-2016, John Rayes
 * @license http://opensource.org/licenses/MIT MIT
 */

function template_editcategory()
{
    global $context, $txt, $scripturl;

    echo '
    <div id="admincenter">
        <form action="', $scripturl, '?action=admin;area=footermenu;sa=editcategory" method="post" accept-charset="UTF-8">
            <div class="category_header">
                <h3>
                    ', $context['page_title'], '
                </h3>
            </div>
            <div class="content">';

    echo '
                <fieldset>
                    <legend>', $txt['footer_menu_general'], '</legend>

                    <dl class="settings">
                        <dt>
                            <strong>', $txt['footer_menu_name'], ':</strong>
                        </dt>
                        <dd>
                            <input type="text" name="name" value="', $context['item']['name'], '" size="20" maxlength="40">
                        </dd>
                    </dl>
                </fieldset>
                <div class="righttext">
                    <input type="submit" name="save" value="', $txt['save'], '" class="button_submit">';

    if ($context['in'])
        echo '
                    <input type="submit" name="delete" value="', $txt['delete'], '" onclick="return confirm(', JavaScriptEscape($txt['footer_menu_delete_sure']), ');" class="button_submit">';

    echo '
                </div>
            </div>
            <input type="hidden" name="', $context['session_var'], '" value="', $context['session_id'], '">';

    if ($context['in'])
        echo '
            <input type="hidden" name="in" value="', $context['in'], '">';

    echo '
        </form>
    </div>';
}

function template_edit()
{
    global $context, $txt, $scripturl;

    echo '
    <div id="admincenter">
        <form action="', $scripturl, '?action=admin;area=footermenu;sa=edit" method="post" accept-charset="UTF-8">
            <div class="category_header">
                <h3>
                    ', $context['page_title'], '
                </h3>
            </div>
            <div class="content">';

    echo '
                <fieldset>
                    <legend>', $txt['footer_menu_general'], '</legend>

                    <dl class="settings">
                        <dt>
                            <strong>', $txt['footer_menu_name'], ':</strong>
                        </dt>
                        <dd>
                            <input type="text" name="name" value="', $context['item']['name'], '" size="20" maxlength="40">
                        </dd>
                        <dt>
                            <strong>', $txt['footer_menu_url'], ':</strong>
                        </dt>
                        <dd>
                            <input type="text" name="url" value="', $context['item']['url'], '" size="20" maxlength="400">
                        </dd>
                        <dt>
                            <strong>', $txt['footer_menu_category'], ':</strong>
                        </dt>
                        <dd>
                            <select name="category">';

    foreach ($context['categories'] as $id => $category)
        echo '
                                <option value="', $id, '"', $id == $context['item']['category'] ? ' selected="selected"' : '', '>', $category, '</option>';

    echo '
                            </select>
                        </dd>
                    </dl>
                </fieldset>
                <fieldset>
                    <legend>', $txt['footer_menu_advanced'], '</legend>
                    <dl class="settings">
                        <dt>
                            <strong>', $txt['footer_menu_groups'], ':</strong>
                            <br /><span class="smalltext">', $txt['footer_menu_groups_desc'], '</span>
                        </dt>
                        <dd>
                            <div class="information">
                                <label><input type="checkbox" class="input_check" onclick="invertAll(this, this.form, \'groups[]\');"', $context['all_groups_checked'] ? ' checked' : '', '>
                                <em>', $txt['check_all'], '</em></label><br />';

    foreach ($context['groups'] as $id_group => $group_link)
        echo '
                                <label><input type="checkbox" name="groups[]" value="', $id_group, '"', in_array($id_group, $context['item']['groups']) ? ' checked' : '', '>
                                ', $group_link, '</label><br />';

    echo '
                            </div>
                        </dd>
                        <dt>
                            <strong>', $txt['footer_menu_active'], ':</strong>
                        </dt>
                        <dd>
                            <input type="checkbox" name="active"', $context['item']['active'] ? ' checked' : '', '>
                        </dd>
                    </dl>
                </fieldset>
                <div class="righttext">
                    <input type="submit" name="save" value="', $txt['save'], '" class="button_submit">';

    if ($context['in'])
        echo '
                    <input type="submit" name="delete" value="', $txt['delete'], '" onclick="return confirm(', JavaScriptEscape($txt['footer_menu_delete_sure']), ');" class="button_submit">';

    echo '
                </div>
            </div>
            <input type="hidden" name="', $context['session_var'], '" value="', $context['session_id'], '">';

    if ($context['in'])
        echo '
            <input type="hidden" name="in" value="', $context['in'], '">';

    echo '
        </form>
    </div>';
}

function template_footer_menu_above() {}

function template_footer_menu_below()
{
    global $context;

    echo '
        <section id="footermenu">';

    foreach ($context['footer_menu'] as $cat)
        if (!empty($cat['items']))
        {
            echo '
            <ul>
                <li>', $cat['name'], '</li>';

                foreach ($cat['items'] as $item)
                    echo '
                <li><a href="', $item['url'], '">', $item['name'], '</a></li>';

            echo '
            </ul>';
        }

    echo '
        </section>';
}
