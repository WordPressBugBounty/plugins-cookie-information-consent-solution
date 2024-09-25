<?php \defined( 'ABSPATH' ) or exit ?>
<div class="wrap">
    <h1><?= \esc_html( \get_admin_page_title() ) ?> - <?= $plugin::__( 'Cookie Banner with Consent Mode v2' ) ?></h1>
    <div id="poststuff">
        <?= $registration ?>
        <?= $settings ?>
        <p><?= \sprintf( $plugin::__( 'This plugin is designed to automatically detect the current language set by the %s plugin, allowing the consent solution to be used on multilanguage sites.' ), '<a href="https://wpml.org/" target="_blank">WPML</a>' ) ?></p>
    </div>
</div>