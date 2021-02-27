<?php

/**
 * Plugin Name: Setting API Plugin
 * 
 * Description: created for Setting' API word replace
 * Author: sher.com
 * Version: 4.0.0
 *
 * Text Domain: sher
 *
 */




add_action('admin_menu', 'replace_word');

function replace_word()
{
    add_menu_page('Replace word setting', 'replace word', 'manage_options', 'word_change', 'word_change_page', 'dashicons-edit-page');
}

function word_change_page()
{
?>
    <div class="wrap">
        <h2><?php echo esc_html(get_admin_page_title()); ?></h2>
        <form action="options.php" method="post">
            <?php
            // output security fields for the registered setting "wporg"
            settings_fields('word_change');
            // output setting sections and their fields
            // (sections are registered for "wporg", each field is registered to a specific section)
            do_settings_sections('word_change');
            // output save settings button
            submit_button('Save Settings');
            ?>
        </form>
    </div>
<?php
}



// add_filter('the_content', 'my_replace_word');

// function my_replace_word($content)
// {
//     $hi = '/\bhi\b/i';
//     $content = preg_replace($hi, "bye", $content);
//     echo get_option('formCheck');
//     // if (get_option('formCheck')) {
//     return $content;
//     // }
// }



function my_settings_init()
{
    register_setting('word_change', 'my_setting_name');


    add_settings_section(
        'my_settings_id',
        'my replace word Settings Section title',
        'my_settings_section_callback',
        'word_change'
    );


    add_settings_field(
        'my_settings_id',
        'check here to Replace "hi" to "bye" ',
        'my_settings_field_callback',
        'word_change',
        'my_settings_id'
    );
}


add_action('admin_init', 'my_settings_init');


function my_settings_section_callback()
{
    echo '<p>my word Section Check.</p>';
}


function my_settings_field_callback()
{

    $setting = get_option('my_setting_name');
?>
    <!-- <input type="text" name="my_setting_name" value="<?php // echo isset($setting) ? esc_attr($setting) : ''; 
                                                            ?>"> -->

    <input type="checkbox" name="my_setting_name" <?php
                                                    $my_db = get_option('my_setting_name');
                                                    if ($my_db == "on") {
                                                        echo "checked";
                                                    }
                                                    ?>>
<?php
}



add_filter('the_content', 'title_change');

function title_change($title)
{
    $my_db = get_option('my_setting_name');
    if ($my_db == "on") {
        $hi = '/\bhi\b/i';
        $title = preg_replace($hi, "bye", $title);
    }
    return $title;
}
