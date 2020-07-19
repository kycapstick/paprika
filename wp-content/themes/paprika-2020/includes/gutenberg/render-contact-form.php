<?php 
    if (!function_exists('paprika_render_contact_form')) {
        function paprika_render_contact_form($block) {
            $custom_colors = paprika_custom_colors();
            ob_start();
        ?>
            <div class="contact-form">
                <div class="container default-block <?php echo $custom_colors ?>">
                    <h2>General Inquiries</h2>
                    <form action="/" id="contact__form" class="form" novalidate data-nonce="<?php echo wp_create_nonce('contact_form'); ?>" data->
                        <div class="form__field">
                            <label class="form__label" for="contact_name">Your Name (Required) </label>
                            <input class="form__input" name="contact_name" id="contact_name" type="text" required aria-describedby="contact_name_error">
                            <p id="contact_name_error" class="copy--italic copy--small form__error"></p>
                        </div>
                        <div class="form__field">
                            <label class="form__label" for="contact_email">Your Email (Required) </label>
                            <input class="form__input" id="contact_email" name="contact_email" type="text"  required aria-describedby="contact_email_error">
                            <p id="contact_email_error" class="copy--italic copy--small form__error"></p>
                        </div>
                        <div class="form__field">
                            <label class="form__label" for="contact_subject">Subject Line</label>
                            <input class="form__input" name="contact_subject" id="contact_subject" type="text" required aria-describedby="contact_subject_error">
                            <p id="contact_subject_error" class="copy--italic copy--small form__error"></p>
                        </div>
                        <div class="form__field">
                            <label class="form__label" for="message">Message</label>
                            <textarea class="form__input" name="contact_message" id="message"" cols="30" rows="10" required aria-describedby="contact_message_error"></textarea>
                            <p id="contact_message_error" class="copy--italic copy--small form__error"></p>
                        </div>
                        <input class="btn btn--dark" type="submit" value="Submit">
                    </form>
                    <div class="copy--medium success-message">Thanks for getting in touch!</div>
                    <div class="copy--medium error-message">Something went wrong.</div>
                </div>  
            </div>
        <?php
            return ob_get_clean();
        }
    }