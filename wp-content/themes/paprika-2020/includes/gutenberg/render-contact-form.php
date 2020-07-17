<?php 
    if (!function_exists('paprika_render_contact_form')) {
        function paprika_render_contact_form($block) {
            ob_start();
        ?>
            <div class="contact-form">
                <div class="container default-block">
                    <h2>General Inquiries</h2>
                    <form action="">
                        <div class="form__field">
                            <label class="form__label" for="name">Your Name (Required) </label>
                            <input class="form__input" id="name" type="text">
                        </div>
                        <div class="form__field">
                            <label class="form__label" for="email">Your Email (Required) </label>
                            <input class="form__input" id="email" name="email" type="text">
                        </div>
                        <div class="form__field">
                            <label class="form__label" for="subject">Subject Line</label>
                            <input class="form__input" name="subject" id="subject" type="text">
                        </div>
                        <div class="form__field">
                            <label class="form__label" for="message">Message</label>
                            <textarea class="form__input" name="message" id=message"" cols="30" rows="10"></textarea>
                        </div>
                        <input class="btn btn--dark" type="submit" value="Submit">
                    </form>
                </div>  
            </div>
        <?php
            return ob_get_clean();
        }
    }