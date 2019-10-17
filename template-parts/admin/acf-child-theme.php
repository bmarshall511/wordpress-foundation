<style>
#childThemeStatus.error,
#childThemeStatus.success {
  border-left: 4px solid #ffb900;
  box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
  padding: 1px 12px;
}

#childThemeStatus.success {
  border-color: #46b450;
}
</style>
<p><?php _e( "Use this to quickly generate a Foundation child theme. <strong><a href='https://github.com/bmarshall511/gulp-foundation' target='_blank'>gulp-foundation</a> will still need to be installed</strong> once the child theme has been created.", 'foundation' ); ?></p>
<div id="childThemeStatus"></div>
<table class="form-table">
  <tbody>
    <tr>
      <th scope="row"><label for="childThemeName"><?php _e( 'Name', 'foundation' ); ?></label></th>
      <td><input value="<?php echo esc_attr( __( 'Foundation Child', 'foundation' ) ); ?>" type="text" id="childThemeName" placeholder="<?php echo esc_attr( __( 'Foundation Child', 'foundation' ) ); ?>" class="regular-text ltr"></td>
    </tr>
    <tr>
      <th scope="row"><label for="childThemeTextDomain"><?php _e( 'Text Domain', 'foundation' ); ?></label></th>
      <td><input value="foundationchild" type="text" id="childThemeTextDomain" placeholder="foundationchild" class="regular-text ltr"></td>
    </tr>
    <tr>
      <th scope="row"><label for="childThemeDesc"><?php _e( 'Description', 'foundation' ); ?></label></th>
      <td><input value="<?php echo esc_attr( __( 'Custom built WordPress theme built using the <a href="https://github.com/bmarshall511/wordpress-foundation" target="_blank">Foundation</a> parent theme.', 'foundation' ) ); ?>" type="text" id="childThemeDesc" placeholder="<?php echo esc_attr( __( 'Custom built WordPress theme built using the <a href="https://github.com/bmarshall511/wordpress-foundation" target="_blank">Foundation</a> parent theme.', 'foundation' ) ); ?>" class="regular-text ltr"></td>
    </tr>
    <tr>
      <th scope="row"><label for="childThemeURL"><?php _e( 'URL', 'foundation' ); ?></label></th>
      <td><input value="https://github.com/bmarshall511/wordpress-foundation" type="url" id="childThemeURL" placeholder="https://github.com/bmarshall511/wordpress-foundation" class="regular-text ltr"></td>
    </tr>
    <tr>
      <th scope="row"><label for="childThemeTags"><?php _e( 'Tags', 'foundation' ); ?></label></th>
      <td>
        <input value="blog, e-commerce, education, grid-layout, one-column, two-columns, three-columns, four-columns, left-sidebar, right-sidebar, accessibility-ready, custom-logo, custom-menu, editor-style, featured-image-header, featured-images, footer-widgets, full-width-template, microformats, post-formats, sticky-post, theme-options, threaded-comments, translation-ready, block-styles, wide-blocks" type="text" id="childThemeTags" placeholder="blog, e-commerce, education, grid-layout, one-column, two-columns, three-columns, four-columns, left-sidebar, right-sidebar, accessibility-ready, custom-logo, custom-menu, editor-style, featured-image-header, featured-images, footer-widgets, full-width-template, microformats, post-formats, sticky-post, theme-options, threaded-comments, translation-ready, block-styles, wide-blocks" class="regular-text ltr">
        <p class="description"><?php _e( '<a href="https://make.wordpress.org/themes/handbook/review/required/theme-tags/" target="_blank">Click here</a> for a list of available theme tags.', 'foundation' ); ?></p>
      </td>
    </tr>
  </tbody>
</table>
<p><button class="button button-primary" id="generateChildTheme"><?php _e( 'Generate Child Theme', 'foundation' ); ?></button></p>
