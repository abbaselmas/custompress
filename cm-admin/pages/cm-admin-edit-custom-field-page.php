<?php

function cm_admin_edit_custom_field_page( $custom_field, $post_types ) { ?>

    <div class="wrap cm-wrap">
        <div class="icon32" id="icon-edit"><br></div>
        <h2><?php _e('Edit Custom Field', 'custompress'); ?></h2>
        <form action="" method="post" class="cm-custom-fields">
            <?php wp_nonce_field( 'cm_submit_custom_field_verify', 'cm_submit_custom_field_secret' ); ?>
            <div class="cm-wrap-left">
                <div class="cm-table-wrap">
                    <div class="cm-arrow"><br></div>
                    <h3 class="cm-toggle"><?php _e('Field Title', 'custompress') ?></h3>
                    <table class="form-table">
                        <tr>
                            <th>
                                <label for="field_title"><?php _e('Field Title', 'custompress') ?> <span class="cm-required">( <?php _e('required', 'custompress'); ?> )</span></label>
                            </th>
                            <td>
                                <input type="text" name="field_title" value="<?php echo ( $custom_field['field_title'] ); ?>">
                                <span class="description"><?php _e('The title of the custom field.', 'custompress'); ?></span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="cm-table-wrap">
                    <div class="cm-arrow"><br></div>
                    <h3 class="cm-toggle"><?php _e('Field Type', 'custompress') ?></h3>
                    <table class="form-table">
                        <tr>
                            <th>
                                <label for="field_type"><?php _e('Field Type', 'custompress') ?> <span class="cm-required">( <?php _e('required', 'custompress'); ?> )</span></label>
                            </th>
                            <td>
                                <select name="field_type">
                                    <option value="text" <?php if ( $custom_field['field_type'] == 'text' ) echo ( 'selected="selected"' ); ?>>Text Box</option>
                                    <option value="textarea" <?php if ( $custom_field['field_type'] == 'textarea' ) echo ( 'selected="selected"' ); ?>>Multi-line Text Box</option>
                                    <option value="radio" <?php if ( $custom_field['field_type'] == 'radio' ) echo ( 'selected="selected"' ); ?>>Radio Buttons</option>
                                    <option value="checkbox" <?php if ( $custom_field['field_type'] == 'checkbox' ) echo ( 'selected="selected"' ); ?>>Checkboxes</option>
                                    <option value="selectbox" <?php if ( $custom_field['field_type'] == 'selectbox' ) echo ( 'selected="selected"' ); ?>>Drop Down Select Box</option>
                                    <option value="multiselectbox" <?php if ( $custom_field['field_type'] == 'multiselectbox' ) echo ( 'selected="selected"' ); ?>>Multi Select Box</option>
                                </select>
                                <span class="description"><?php _e('Select one or more post types to add this custom field to.', 'custompress'); ?></span>
                                <div class="cm-field-type-options">
                                    <h4><?php _e('Fill in the options for this field', 'custompress'); ?>:</h4>
                                    <p>
                                        <?php _e('Order By', 'custompress'); ?> :
                                        <select name="field_sort_order">
                                            <option value="default"><?php _e('Order Entered', 'custompress'); ?></option>
                                            <option value="asc"><?php _e('Name - Ascending', 'custompress'); ?></option>
                                            <option value="desc"><?php _e('Name - Descending', 'custompress'); ?></option>
                                        </select
                                    </p>
                                    
                                    <?php foreach ( $custom_field['field_options'] as $key => $field_option ): ?>
                                        <p>
                                            <?php _e('Option', 'custompress'); ?> <?php echo( $key ); ?>:
                                            <input type="text" name="field_options[<?php echo( $key ); ?>]" value="<?php echo( $field_option ); ?>" />
                                            <input type="radio" value="<?php echo( $key ); ?>" name="field_default_option" <?php if ( $custom_field['field_default_option'] == $key ) echo ( 'checked="checked"' ); ?> />
                                            <?php _e('Default Value', 'custompress'); ?>
                                            <?php if ( $key != 1 ): ?>
                                                <a href="#" class="cm-field-delete-option">[x]</a>
                                            <?php endif; ?>
                                        </p>
                                    <?php endforeach; ?>

                                    <div class="cm-field-additional-options"></div>
                                    <input type="hidden" value="<?php echo( count( $custom_field['field_options'] )); ?>" name="track_number">
                                    <p><a href="#" class="cm-field-add-option"><?php _e('Add another option', 'custompress'); ?></a></p>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="cm-table-wrap">
                    <div class="cm-arrow"><br></div>
                    <h3 class="cm-toggle"><?php _e('Field Description', 'custompress') ?></h3>
                    <table class="form-table">
                        <tr>
                            <th>
                                <label for="field_description"><?php _e('Field Description', 'custompress') ?></label>
                            </th>
                            <td>
                                <textarea name="field_description" cols="52" rows="3" ><?php echo( $custom_field['field_description'] ); ?></textarea>
                                <span class="description"><?php _e('Description for the custom field.', 'custompress'); ?></span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="cm-wrap-right">
                <div class="cm-table-wrap">
                    <div class="cm-arrow"><br></div>
                    <h3 class="cm-toggle"><?php _e('Post Type', 'custompress') ?></h3>
                    <table class="form-table">
                        <tr>
                            <th>
                                <label for="object_type"><?php _e('Post Type', 'custompress') ?> <span class="cm-required">( <?php _e('required', 'custompress'); ?> )</span></label>
                            </th>
                            <td>
                                <select name="object_type[]" multiple="multiple" class="cm-object-type">
                                    <?php if ( !empty( $post_types )): ?>
                                        <?php foreach( $post_types as $post_type ): ?>
                                            <option value="<?php echo ( $post_type ); ?>" <?php foreach ( $custom_field['object_type'] as $key => $object_type ) { if ( $object_type == $post_type ) echo( 'selected="selected"' ); } ?>><?php echo ( $post_type ); ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <br />
                                <span class="description"><?php _e('Select one or more post types to add this custom field to.', 'custompress'); ?></span>
                            </td>
                        </tr>
                    </table>
                </div>
                <?php /** @todo implement required fields
                <div class="cm-table-wrap">
                    <div class="cm-arrow"><br></div>
                    <h3 class="cm-toggle"><?php _e('Required Field', 'custompress') ?></h3>
                    <table class="form-table">
                        <tr>
                            <th>
                                <label for="required"><?php _e('Required Field', 'custompress') ?></label>
                            </th>
                            <td>
                                <span class="description"><?php _e('Should this field be required.', 'custompress'); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <th></th>
                            <td>
                                <input type="radio" name="required" value="1">
                                <span class="description"><strong><?php _e('TRUE', 'custompress'); ?></strong></span>
                                <br />
                                <input type="radio" name="required" value="0" checked="checked">
                                <span class="description"><strong><?php _e('FALSE', 'custompress'); ?></strong></span>
                            </td>
                        </tr>
                    </table>
                </div>
                */ ?>
            </div>
            <br style="clear: left" />
            <input type="submit" class="button-primary" name="cm_submit_update_custom_field" value="Update Custom Field">
            <br /><br /><br /><br />
        </form>
    </div> <?php
}
?>