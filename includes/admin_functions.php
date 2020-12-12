<?php

// register settings

function re_settings_init()
{
    register_setting(REST_EXPOSE_OPTION_NAME, REST_EXPOSE_OPTION_NAME, 're_validate_plugin_settings');
    add_settings_section(
        're_settings_section',
        'General',
        're_settings_section_callback',
        REST_EXPOSE_OPTION_NAME
    );
    add_settings_field(
        're_exposed_fields',
        'Fields to expose',
        're_exposed_fields_callback',
        REST_EXPOSE_OPTION_NAME,
        're_settings_section'
    );
}

add_action('admin_init', 're_settings_init');

function re_settings_section_callback()
{
    echo '<p>Add fields to expose in the form: [object_type].[meta_key]; [object_type].[meta_key]; ...</p>';
}

function re_exposed_fields_callback()
{
    $options = get_option(REST_EXPOSE_OPTION_NAME);
    $validInput = !empty($options['re_exposed_fields']) || empty($options['re_exposed_fields.input']);
    printf(
        '<input type="text" name="%s" value="%s" style="width: 100%%"/>',
        esc_attr(REST_EXPOSE_OPTION_NAME . '[re_exposed_fields]'),
        esc_attr($validInput ? $options['re_exposed_fields'] : $options['re_exposed_fields.input'])
    );
    if (!$validInput) {
        printf('<p style="color: red">Invalid format, no fields exposed!</p>');
    }
}

function re_validate_plugin_settings($input)
{
    $output['re_exposed_fields'] = sanitize_text_field($input['re_exposed_fields']);
    try {
        parseSetting($output['re_exposed_fields']);
    } catch (InvalidArgumentException $_) {
        $output['re_exposed_fields.input'] = $output['re_exposed_fields'];
        $output['re_exposed_fields'] = '';
    }
    return $output;
}

// register options page

function re_register_options_page()
{
    add_options_page('REST Expose Settings', 'REST Expose', 'manage_options', 'rest-expose', 're_options_page');
}

add_action('admin_menu', 're_register_options_page');

function re_options_page()
{
    ?>
    <h2>REST Expose Plugin Settings</h2>
    <form action="options.php" method="post">
        <?php
        settings_fields(REST_EXPOSE_OPTION_NAME);
        do_settings_sections(REST_EXPOSE_OPTION_NAME);
        ?>
        <input
                type="submit"
                name="submit"
                class="button button-primary"
                value="<?php esc_attr_e('Save'); ?>"
        />
    </form>
    <?php
}
