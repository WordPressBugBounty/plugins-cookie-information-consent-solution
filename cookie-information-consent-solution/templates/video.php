<?php \defined( 'ABSPATH' ) or exit ?>
( function() {
    window.CookieInformation = window.CookieInformation || {};
    window.CookieInformation.enableYoutubeNotVisibleDescription=true;
    window.CookieInformation.youtubeCategorySdk="<?= $category ?>";
    window.CookieInformation.youtubeNotVisibleDescription="<?= $placeholder ?>";
    window.CookieInformation.youtubeBlockedCSSClassName="<?= $class ?>";
} )();