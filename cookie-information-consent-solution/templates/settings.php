<?php \defined( 'ABSPATH' ) or exit ?>
<?= $notice ?>
<div class="metabox-holder">
    <div class="postbox-container">
        <div class="meta-box-sortables ui-sortable">
            <div id="settings" class="postbox">
                <div class="postbox-header">
                    <h2 class="hndle ui-sortable-handle"><?= $plugin::__( 'Settings' ) ?></h2>
                    <div class="handle-actions hide-if-no-js">
                        <button type="button" class="handlediv" aria-expanded="true">
                            <span class="screen-reader-text"><?= $plugin::__( 'Toggle panel: Registration' ) ?></span>
                            <span class="toggle-indicator" aria-hidden="true"></span>
                        </button>
                    </div>
                </div>
                <div class="inside">
                    <div>
                        <div id="main">
                            <form method="post">
                                <table class="form-table" role="presentation">
                                    <tbody>
                                    <tr class="section">
                                        <th scope="row">
                                            <label for="popup"><?= $plugin::__( 'Consent banner' ) ?></label>
                                            <p class="description"><?= $plugin::__( 'Turn on the consent banner on your website.' ) ?></p>
                                        </th>
                                        <td>
                                            <input type="checkbox" name="popup" id="popup" class="regular-text"<?php \checked( $popup ) ?>>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <label for="tcf"><?= $plugin::__( 'IAB TCF v2' ) ?></label>
                                            <p class="description"><?= \sprintf( $plugin::__( 'If turned on, we’ll collect and send consent information to your vendors so that they can display personalized ads to users. You must use a dedicated template: %s.' ),  \sprintf( '<strong>%s</strong>', $plugin::__( 'IAB TCF v2.2. + Google Consent Mode v2' ) ) ) ?></p>
                                        </th>
                                        <td>
                                            <input type="checkbox" name="tcf" id="tcf" class="regular-text popupSetting"<?php \checked( $tcf ) ?>>
                                        </td>
                                    </tr>
                                    <tr class="section">
                                        <th scope="row">
                                            <label for="gcm"><?= $plugin::__( 'Google Consent Mode v2' ) ?></label>
                                            <p class="description"><?= $plugin::__( "If turned on, Google’s services will respect the user's privacy choices made via your consent form." ) ?></p>
                                        </th>
                                        <td>
                                            <input type="checkbox" name="gcm" id="gcm" class="regular-text popupSetting"<?php \checked( $gcm ) ?>>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <label for="videoAutoblocking"><?= $plugin::__( 'Video autoblocking' ) ?></label>
                                            <p class="description"><?= $plugin::__( 'Automatically block YouTube and Vimeo videos before the user consents.' ) ?></p>
                                        </th>
                                        <td>
                                            <input type="checkbox" name="videoAutoblocking" id="videoAutoblocking" class="regular-text"<?php \checked( $videoAutoblocking ) ?>>
                                        </td>
                                    </tr>
                                    <tr class="videoSetting">
                                        <th scope="row">
                                            <label for="videoCategory"><?= $plugin::__( 'Cookie category' ) ?></label>
                                            <p class="description"><?= $plugin::__( 'Choose the cookie category you want to use to block videos.' ) ?></p>
                                        </th>
                                        <td>
                                            <select name="videoCategory" id="videoCategory" class="regular-text">
                                                <?php foreach( $videoCategories as $value => $label ) : ?>
                                                    <option value="<?= $value ?>"<?php \selected( $videoCategory, $value ) ?>><?= $label ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr class="videoSetting">
                                        <th scope="row">
                                            <label for="videoPlaceholder"><?= $plugin::__( 'Placeholder text' ) ?></label>
                                            <p class="description"><?= $plugin::__( 'This text shows where the blocked video would appear.' ) ?></p>
                                        </th>
                                        <td>
                                            <textarea name="videoPlaceholder" id="videoPlaceholder" class="regular-text"><?= $videoPlaceholder ?></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="notice notice-info notice-alt">
                                            <strong><?= $plugin::__( 'Cookie Information - Cookie policy' ) ?> <?= $plugin::__( 'block' ) ?></strong><br>
                                            <?= $plugin::__( 'Use this block to display the Cookie Information cookie policy.' ) ?>
                                            <?= $plugin::__( 'We recommend it instead of shortcodes because it’s simpler to use.' ) ?>
                                            <?= $plugin::__( 'You can find it in the block inserter when building a page via the block editor.' ) ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <label for="cookiepolicy"><?= $plugin::__( 'Cookie policy shortcode' ) ?></label>
                                            <p class="description"><?= $plugin::__( 'Copy and paste this shortcode to your privacy policy page to display the most up-to-date cookie policy information.' ) ?></p>
                                        </th>
                                        <td>
                                            <input id="cookiepolicy" type="text" class="regular-text" value="[ci_cookiepolicy]" readonly>
                                            <button class="button button-secondary" onclick="copyToClipboard('cookiepolicy')"><?= $plugin::__( 'Copy' ) ?></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="notice notice-info notice-alt">
                                            <strong><?= $plugin::__( 'Cookie Information - Privacy controls' ) ?> <?= $plugin::__( 'block' ) ?></strong><br>
                                            <?= $plugin::__( 'Use this block to display an alternative to the cookie consent widget.' ) ?>
                                            <?= $plugin::__( 'We recommend it instead of shortcodes because it’s simpler to use.' ) ?>
                                            <?= $plugin::__( 'You can find it in the block inserter when building a page via the block editor.' ) ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <label for="privacycontrols"><?= $plugin::__( 'Privacy controls shortcode' ) ?></label>
                                            <p class="description"><?= $plugin::__( 'Copy and paste this shortcode to your website to view or change consent settings.' ) ?></p>
                                        </th>
                                        <td>
                                            <input id="privacycontrols" type="text" class="regular-text" value="[ci_privacycontrols]" readonly>
                                            <button class="button button-secondary" onclick="copyToClipboard('privacycontrols')"><?= $plugin::__( 'Copy' ) ?></button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <?php \wp_nonce_field( 'settings', 'nonce' ) ?>
                                <p class="submit"><input type="submit" name="settings" id="submit" class="button button-primary" value="<?= $plugin::__( 'Save changes' ) ?>"></p>
                            </form>
                        </div>
                        <div id="sidebar">
                            <a href="https://cookieinformation.com/wp-plugin-upgrade-link" target="_blank"><img src="https://cookieinformation.com/wp-plugin-upgrade-img" alt="Upgrade"></a>
                            <div id="resources">
                                <h3><?= $plugin::__( 'Useful resources:' ) ?></h3>
                                <ul>
                                    <li><a href="https://support.cookieinformation.com/en/collections/3119110-first-time-user-get-started" target="_blank"><?= $plugin::__( 'First-time user? Get started' ) ?></a></li>
                                    <li><a href="https://support.cookieinformation.com/" target="_blank"><?= $plugin::__( 'Support center' ) ?></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>