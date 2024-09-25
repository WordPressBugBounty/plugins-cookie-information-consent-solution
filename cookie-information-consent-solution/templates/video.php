<?php \defined( 'ABSPATH' ) or exit ?>
if(window.CookieInformation){
    window.CookieInformation.enableYoutubeNotVisibleDescription=true;
    window.CookieInformation.youtubeCategorySdk="<?= $category ?>";
    window.CookieInformation.youtubeNotVisibleDescription="<?= $placeholder ?>";
    window.CookieInformation.youtubeBlockedCSSClassName="<?= $class ?>";
}