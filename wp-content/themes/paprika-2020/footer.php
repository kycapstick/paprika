<?php 
    $query_args = array(
        'name' => 'land-acknowledgement',
        'post_type'   => 'post',
        'post_status' => 'publish',
        'numberposts' => 1,
    );
    $land_acknowledgement = get_option('land_acknowledgement');
    $footer_class = paprika_custom_colors();
    ?>
    <footer class="footer">
    <?php
        if (!empty($land_acknowledgement)):
    ?>
        <div class="footer__land">
            <div class="container">
                <div class="flex">
                    <div class="footer__land__title col-6">
                        <h3 class="subtitle">Land Acknowledgement</h3>
                    </div>
                    <div class="footer__land__copy col-6">
                        <p><?php echo $land_acknowledgement ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer__contact <?php echo $footer_class ?>">
            <div class="container">
                <div class="flex">
                    <?php $mailchimp_list = get_option('mailchimp_list'); ?>
                    <div class="footer__contact__form col-6">
                        <form action="/wp-admin/" id="footer__form" class="form" novalidate method="POST" data-list="<?php echo isset($mailchimp_list) && strlen($mailchimp_list) > 0 ? $mailchimp_list : null ?>" data-nonce="<?php echo wp_create_nonce('mailing-list') ?>">
                            <input type="hidden" name="list_id" value="">
                            <div class="form__field">
                                <label class="form__label form__label--dark" for="first_name">Your First Name (required) </label>
                                <input class="form__input form__input--dark" type="text" name="first_name" id="first_name" required aria-describedby="first_name_error">
                                <p id="first_name_error" class="copy--italic copy--small form__error form__error--dark"></p>
                            </div>
                            <div class="form__field">
                                <label class="form__label form__label--dark" for="last_name">Your Last Name (required) </label>
                                <input class="form__input form__input--dark" type="text" name="last_name" id="last_name" required aria-describedby="last_name_error">
                                <p id="last_name_error" class="copy--italic copy--small form__error form__error--dark"></p>
                            </div>
                            <div class="form__field">
                                <label class="form__label form__label--dark" for="email">Your Email Address (required)</label>
                                <input class="form__input form__input--dark" type="email" name="email" id="email" required aria-describedby="email_error">
                                <p id="email_error" class="copy--italic copy--small form__error form__error--dark"></p>
                            </div>
                            <input class="btn btn--dark" type="submit" value="Subscribe">
                        </form>
                        <div class="copy--medium success-message copy--dark">Thanks for Subscribing!</div>
                        <div class="copy--medium error-message copy--dark">Something went wrong.</div>
                    </div>
                    <div class="footer__contact__title col-6">
                        <h3 class="subtitle subtitle--dark">Signup <span>for our newsletter</span></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer__social">
            <div class="container">
                <p class="copy copy--dark">Copyright 2020</p>
            </div>
        </div>
    <?php
        endif;
    ?>
    </footer>

</body>
