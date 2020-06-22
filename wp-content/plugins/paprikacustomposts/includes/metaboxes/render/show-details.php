<?php
    if (!function_exists('paprika_render_producton_details')) {
        function paprika_render_producton_details($post) {
            $team_meta = get_post_meta($post->ID, 'team', true);
            $team = !empty($team_meta) ? $team_meta : false;
            ob_start();
    ?>
        <div>
            <h3 class="custom-title">Production Team</h3>
            <input type="hidden" name="post_id" value="<?php echo $post->ID ?>">
            <label for="team">Team</label>
            <textarea class="custom-input" name="team" id="team" cols="30" rows="10"><?php if ($team) { echo $team; } ?></textarea>
        </div>
        <?php
            return ob_get_clean();
        }
    }
    