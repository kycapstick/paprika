<?php 
    $query_args = array(
        'name' => 'land-acknowledgement',
        'post_type'   => 'post',
        'post_status' => 'publish',
        'numberposts' => 1,
    );
    $land_acknowledgement = get_posts($query_args);
    ?>
    <footer class="container">
    <?php
        if (!empty($land_acknowledgement)):
    ?>
        <div class="footer__land">
            <h3><?php echo $land_acknowledgement[0]->post_title ?></h3>
            <p><?php echo $land_acknowledgement[0]->post_content ?></p>
        </div>
        <div class="footer__contact">
            <h3>Signup for our newsletter</h3>
            <label for="name">Your Name (required) </label>
            <input type="text" name="name" id="name">
            <label for="email">Your Email Address (required)</label>
            <input type="email" name="email" id="email">
            <input type="submit" value="Subscribe">
        </div>
    <?php
        endif;
    ?>
    </footer>

</body>
