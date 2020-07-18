<?php 
    $query_args = array(
        'name' => 'land-acknowledgement',
        'post_type'   => 'post',
        'post_status' => 'publish',
        'numberposts' => 1,
    );
    $land_acknowledgement = get_posts($query_args);
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
                        <h3 class="subtitle"><?php echo $land_acknowledgement[0]->post_title ?></h3>
                    </div>
                    <div class="footer__land__copy col-6">
                        <p><?php echo $land_acknowledgement[0]->post_content ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer__contact <?php echo $footer_class ?>">
            <div class="container">
                <div class="flex">
                    <div class="footer__contact__form col-6">
                        <form action="/">
                            <div class="form__field">
                                <label class="form__label form__label--dark" for="name">Your First Name (required) </label>
                                <input class="form__input form__input--dark" type="text" name="name" id="name">
                            </div>
                            <div class="form__field">
                                <label class="form__label form__label--dark" for="name">Your Last Name (required) </label>
                                <input class="form__input form__input--dark" type="text" name="name" id="name">
                            </div>
                            <div class="form__field">
                                <label class="form__label form__label--dark" for="email">Your Email Address (required)</label>
                                <input class="form__input form__input--dark" type="email" name="email" id="email">
                            </div>
                            <input class="btn btn--dark" type="submit" value="Subscribe">
                        </form>
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
