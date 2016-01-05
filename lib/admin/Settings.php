<?php
namespace Barrel\SocialFeeds\Admin;

/**
 * Creates the admin page for configuring plugin settings.
 */
class Settings extends AdminPage {

  static $page_title = 'Social Feed Settings';
  static $menu_title = 'Feed Settings';
  static $parent_slug = 'edit.php?post_type=social-post';
  static $capability = 'manage_options';
  static $menu_slug = 'feed-settings';

  function initialize_options() {
    add_option('instagram_client_id', '');
    add_option('instagram_client_secret', '');
    add_option('instagram_feed_hashtag', 'barrelny');
    add_option('instagram_feed_username', 'barrelny');

    add_settings_section(
      'instagram_settings',
      'Instagram Settings',
      function() {
        // echo '<p>Enter your credentials for the Instagram API.</p>';
      },
      self::$menu_slug
    );

    add_settings_field(
      'instagram_client_id',
      'Instagram Client ID',
      array($this, 'render_text_setting'),
      self::$menu_slug,
      'instagram_settings',
      array('instagram_client_id')
    );

    register_setting('instagram_settings', 'instagram_client_id');

    add_settings_field(
      'instagram_client_secret',
      'Instagram Client Secret',
      array($this, 'render_text_setting'),
      self::$menu_slug,
      'instagram_settings',
      array('instagram_client_secret')
    );

    register_setting('instagram_settings', 'instagram_client_secret');

    add_settings_field(
      'instagram_feed_hashtag',
      'Instagram Hashtag(s)',
      array($this, 'render_text_setting'),
      self::$menu_slug,
      'instagram_settings',
      array('instagram_feed_hashtag', 'Enter one or more tags separated with spaces. (Optional)')
    );

    register_setting('instagram_settings', 'instagram_feed_hashtag');

    add_settings_field(
      'instagram_feed_username',
      'Instagram Username(s)',
      array($this, 'render_text_setting'),
      self::$menu_slug,
      'instagram_settings',
      array('instagram_feed_username', 'Enter one or more usernames separated with spaces. (Optional)')
    );

    register_setting('instagram_settings', 'instagram_feed_username');
  }

  function display_options_page() {
    ?>
    <div class="wrap">
      <h2><?= self::$page_title ?></h2>
      <form action="options.php" method="post">
        <?php
        settings_fields( 'instagram_settings' );
        do_settings_sections( self::$menu_slug );
        submit_button();
        ?>
      </form>
    </div>
    <?php
  }

}