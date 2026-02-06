(function() {
    window.wp_consent_type = 'optin';
    document.dispatchEvent(new CustomEvent('wp_consent_type_defined'));

    window.addEventListener('CookieInformationConsentGiven', function() {
        const ci = window.CookieInformation;
        if (!ci || !ci.getConsentGivenFor) return;

        wp_set_consent('functional', ci.getConsentGivenFor('cookie_cat_functional') ? 'allow' : 'deny');
        wp_set_consent('preferences', ci.getConsentGivenFor('cookie_cat_functional') ? 'allow' : 'deny');
        wp_set_consent('statistics', ci.getConsentGivenFor('cookie_cat_statistic') ? 'allow' : 'deny');
        wp_set_consent('statistics-anonymous', ci.getConsentGivenFor('cookie_cat_statistic') ? 'allow' : 'deny');
        wp_set_consent('marketing', ci.getConsentGivenFor('cookie_cat_marketing') ? 'allow' : 'deny');
    });
})();