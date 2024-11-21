<?php \defined( 'ABSPATH' ) or exit ?>
<?= $notice ?>
<div class="metabox-holder">
    <div class="postbox-container">
        <div class="meta-box-sortables ui-sortable">
            <div id="registration" class="postbox<?= ( $registered ?? false ) ? ' closed' : '' ?>">
                <div class="postbox-header">
                    <h2 class="hndle ui-sortable-handle"><?= $plugin::__( 'You’re just a few steps away from displaying a consent banner on your website' ) ?></h2>
                    <div class="handle-actions hide-if-no-js">
                        <button type="button" class="handlediv" aria-expanded="true">
                            <span class="screen-reader-text"><?= $plugin::__( 'Toggle panel: Registration' ) ?></span>
                            <span class="toggle-indicator" aria-hidden="true"></span>
                        </button>
                    </div>
                </div>
                <div class="inside">
                    <div>
                        <div id="login">
                            <h3><?= $plugin::__( 'Already have an account?' ) ?></h3>
                            <p><?= $plugin::__( 'If you already have a Cookie Information account, visit your account. Add your domain, choose a consent template, customize it and complete your cookie banner setup.' ) ?></p>
                            <a href="https://app.cookieinformation.com/#/login" target="_blank" class="button button-primary"><?= $plugin::__( 'Go to my account' ) ?></a>
                        </div>
                        <div id="signup">
                            <h3><?= $plugin::__( 'Create an account' ) ?></h3>
                            <p><?= \sprintf( $plugin::__( 'You are creating an account for domain: %s' ), "<code>$canonicalDomain</code>" ) ?></p>
                            <?php if( $errors[ 'canonicalDomain' ] ?? [] ) : ?><p class="description"><span class="required"><?= \implode( '<br>', $errors[ 'canonicalDomain' ] ) ?></span></p><?php endif ?>
                            <form method="post">
                                <table class="form-table" role="presentation">
                                    <tbody>
                                    <tr>
                                        <th scope="row">
                                            <label for="accountName"><?= $plugin::__( 'Account name' ) ?><span class="required">*</span></label>
                                            <p class="description"><?= $plugin::__( 'Your account name identifies your organization within Cookie Information Consent Management Platform.' ) ?></p>
                                        </th>
                                        <td>
                                            <input type="text" name="accountName" id="accountName" class="regular-text<?php if( $errors[ 'accountName' ] ?? [] ) : ?> required<?php endif ?>" required value="<?= $accountName ?? '' ?>">
                                            <?php if( $errors[ 'accountName' ] ?? [] ) : ?><p class="description"><span class="required"><?= \implode( '<br>', $errors[ 'accountName' ] ) ?></span></p><?php endif ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <label for="email"><?= $plugin::__( 'Email' ) ?><span class="required">*</span></label>
                                            <p class="description"><?= $plugin::__( 'Enter the email address you want to use for your Cookie Information account.' ) ?></p>
                                        </th>
                                        <td>
                                            <input type="email" name="email" id="email" class="regular-text<?php if( $errors[ 'email' ] ?? [] ) : ?> required<?php endif ?>" required value="<?= $email ?? '' ?>">
                                            <?php if( $errors[ 'email' ] ?? [] ) : ?><p class="description"><span class="required"><?= \implode( '<br>', $errors[ 'email' ] ) ?></span></p><?php endif ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <label for="password"><?= $plugin::__( 'Password' ) ?><span class="required">*</span></label>
                                            <p class="description"><?= $plugin::__( 'Use at least 10 characters including uppercase and lowercase letters, plus at least one number.' ) ?></p>
                                        </th>
                                        <td>
                                            <input type="password" name="password" id="password" class="regular-text<?php if( $errors[ 'password' ] ?? [] ) : ?> required<?php endif ?>" minlength="10" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$" required value="<?= $password ?? '' ?>">
                                            <?php if( $errors[ 'password' ] ?? [] ) : ?><p class="description"><span class="required"><?= \implode( '<br>', $errors[ 'password' ] ) ?></span></p><?php endif ?>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div id="consent">
                                    <p><input type="checkbox" name="acceptedTermsAndConditions" id="acceptedTermsAndConditions" class="regular-text<?php if( $errors[ 'acceptedTermsAndConditions' ] ?? [] ) : ?> required<?php endif ?>" required<?php \checked( $acceptedTermsAndConditions ?? false ) ?>> <?= \sprintf( $plugin::__( 'I accept the %s, and the %s.' ), \sprintf( '<a href="https://cookieinformation.com/terms" target="_blank">%s</a>', $plugin::__( 'terms and conditions' ) ), \sprintf( '<a href="https://cookieinformation.com/data-processing-agreement/">%s</a>', $plugin::__( 'data processing agreement' ) ) ) ?><strong><span class="required">*</span></strong></p>
                                    <?php if( $errors[ 'acceptedTermsAndConditions' ] ?? [] ) : ?><p class="description"><span class="required"><?= \implode( '<br>', $errors[ 'acceptedTermsAndConditions' ] ) ?></span></p><?php endif ?>
                                    <p><input type="checkbox" name="acceptedEmailsAndOffers" id="acceptedEmailsAndOffers" class="regular-text<?php if( $errors[ 'acceptedEmailsAndOffers' ] ?? [] ) : ?> required<?php endif ?>"<?php \checked( $acceptedEmailsAndOffers ?? false ) ?>> <?= $plugin::__( "I'd like to receive marketing emails about Cookie Information’s products and services. You can unsubscribe at any time." ) ?></p>
                                    <?php if( $errors[ 'acceptedEmailsAndOffers' ] ?? [] ) : ?><p class="description"><span class="required"><?= \implode( '<br>', $errors[ 'acceptedEmailsAndOffers' ] ) ?></span></p><?php endif ?>
                                </div>
                                <?php \wp_nonce_field( 'registration', 'nonce' ) ?>
                                <p class="submit"><input type="submit" name="registration" class="button button-primary" value="<?= $plugin::__( 'Create account' ) ?>"></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>