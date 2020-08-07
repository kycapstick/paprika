<?php 
    $custom_colors = get_option('custom_colors');
    $opacities = ['10','15','25','50','95'];
?>

<style>
    <?php if (is_array($custom_colors) && count($custom_colors) > 0): ?>
        <?php foreach ($custom_colors as $key => $color): ?>
            <?php 
                if (intval(strlen($color)) === 7) {
                    $opaque_values = paprika_hex_to_rgb($opacities, $color);
                    $darker_color = paprika_adjust_brightness($color, -40);
                }
            ?>
            .header.page-<?php echo $key ?> {
                background-image: linear-gradient(<?php echo $opaque_values['10'] ?>, rgba(255, 255, 255, 0.8)), url(<?php echo get_template_directory_uri() . '/images/grit.jpg' ?>);
            }

            .page-<?php echo $key ?> .name-tag::before,
            .page-<?php echo $key ?> .artist-block__name::before,
            .page-<?php echo $key ?> .staff__name::before {
                background-color: <?php echo $color ?>;
            }

            .artist-block--reverse.page-<?php echo $key; ?> {
                background-color: <?php echo $opaque_values['15']; ?> 
            }

            .artist-block.page-<?php echo $key; ?> a {
                color: <?php echo $color; ?>;
            }

            .default-block.page-<?php echo $key ?> .wp-block-button__link {
                color: <?php echo $color; ?>;
                border: 2px solid <?php echo $color ?>;
            }
        

            /* HOMEPAGE CARDS */
            .homepage-cards .page-<?php echo $key ?> .homepage-cards__title::before {
                background-color: <?php echo $color; ?>
            }
            .homepage-cards .homepage-cards__card.page-<?php echo $key ?> {
                background-color: <?php echo $opaque_values['15']; ?>
            }
            /* FOOTER */
            .footer__contact.page-<?php echo $key ?> {
                background-color: <?php echo $opaque_values['95'] ?>;
            } 

            .footer__contact.page-<?php echo $key ?> .btn--dark {
                background-color: transparent;
            }

            /* HEADER */
            .page-<?php echo $key ?> .header__text,
            .page-<?php echo $key ?> .header__link {
                color: <?php echo $color; ?>;
            }

            .page-<?php echo $key ?> .header__link:focus, 
            .page-<?php echo $key ?> .header__link:hover {
                color: <?php echo $darker_color ?>;
            }

            /* BLOCKQUOTE */
            .page-<?php echo $key ?> blockquote::before {
                color: <?php echo $color ?>;
            }

            .block-quote.page-<?php echo $key ?>:nth-child(2n) {
                background: <?php echo $opaque_values['10']; ?>;
            }

            /* BUTTONs */
            .page-<?php echo $key ?> .btn--light {
                border: 2px solid <?php echo $color ?>;
                color: <?php echo $color ?>;
            }

            .page-<?php echo $key ?> .btn--dark {
                background-color: <?php echo $color ?>;
                border: 2px solid <?php echo $color ?>;
            }

            .page-<?php echo $key ?> .btn--light:hover,
            .page-<?php echo $key ?> .btn--light:focus {
                background-color: <?php echo $color; ?>;
                color: white;
            }

            .page-<?php echo $key ?> .btn--dark:hover,
            .page-<?php echo $key ?> .btn--dark:focus {
                background-color: white;
                color: <?php echo $color; ?>;
            }

            .page-<?php echo $key ?> .block-link {
                color: <?php echo $color ?>;
            }

            .page-<?php echo $key ?> .block-link:hover,
            .page-<?php echo $key ?> .block-link:focus {
                color: <?php echo $darker_color ?>;
            }

            /* DEFAULT BLOCKS */
            .default-block.page-<?php echo $key ?> a {
                color: <?php echo $color ?>;
            }

            .pagination__links a {
                color: <?php echo $color; ?>;
            }
            .pagination__links a:hover,
            .pagination__links a:focus {
                color: <?php echo $darker_color; ?>;
            }


            .default-block.page-<?php echo $key ?> a:hover,
            .default-block.page-<?php echo $key ?> a:focus {
                color: <?php echo $darker_color ?>;
            }
            .container.default-block.page-<?php echo $key ?> ul li::before {
                background-color: <?php echo $color ?>;
            }

            /* CTAs */
            .cta-block.page-<?php echo $key ?> {
                background-color: <?php echo $opaque_values['95'] ?>;
            }

            .cta-block + .cta-block.page-<?php echo $key ?> {
                background-color: white; 
                color: <?php echo $color; ?>
            }

            .cta-block + .cta-block.page-<?php echo $key ?> .wp-block-button__link {
                background: <?php echo $color; ?>;
            }

            .cta-block + .cta-block.page-<?php echo $key ?> .wp-block-button__link:hover {
                background: black;
            }

            /* TWO COLUMNS */
            .two-columns.page-<?php echo $key ?> a {
                color: <?php echo $color ?>;
            }

            /* TWO UP CARDS */
            .two-up-cards.page-<?php echo $key ?> .two-up-cards__card {
				background-color: <?php echo $opaque_values['15']; ?>
			}
			.two-up-cards.page-<?php echo $key ?> .two-up-cards__subtitle::before {
				display: none;
			}
            .two-up-cards.page-<?php echo $key ?> .wp-block-button__link {
                background: <?php echo $color; ?>;
            }
            .two-up-cards.page-<?php echo $key ?> .wp-block-button__link {
                border: 2px solid <?php echo $color ?>;
                background-color: <?php echo $color; ?>;
            }
            .two-up-cards.page-<?php echo $key ?> .wp-block-button__link:hover,
            .two-up-cards.page-<?php echo $key ?> .wp-block-button__link:focus {
                background-color: white;
                color: <?php echo $color; ?>;
            }
            .footer__contact .btn--dark {
                border: 2px solid white;
            }
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if (isset($custom_colors['about'])): ?>
        <?php $color = $custom_colors['about'] ?>
        <?php 
            if (intval(strlen($color)) === 7) {
                $opaque_values = paprika_hex_to_rgb($opacities, $color);
            }
        ?>
        /* ABOUT SPECIFIC STYLES */
        .page-about .header__banner__bar {
            background-image: url(<?php echo get_template_directory_uri() . '/images/topography.svg' ?>),
            linear-gradient(<?php echo $color ?>, <?php echo $color ?>);
        }

        .staff__block:nth-child(2n) {
            background-color: <?php echo $opaque_values['10']; ?>;
        }

        .two-up-cards.page-about .two-up-cards__subtitle::before {
            display: inline-block;
        }
        .post__aside__link,
        .post__recent__link,
        .post__card__byline a,
        .post__byline a {
            color: <?php echo $color; ?>;

        }

        .post__archive li a:hover,
        .post__archive li a:focus {
            color: <?php echo $color; ?>;
        }

        .post__aside__link:hover,
        .post__aside__link:focus,
        .post__recent__link:hover,
        .post__recent__link:focus,
        .post__card__byline a:hover,
        .post__card__byline a:focus {
            color: <?php echo $darker_color ?>;
        }
        .post__content:nth-child(2n) {
            background-color: <?php echo $opaque_values['15']; ?>;
        }
    <?php endif; ?>

    <?php if (isset($custom_colors['festivals'])): ?>
        <?php $color = $custom_colors['festivals'] ?>
        <?php 
            if (intval(strlen($color)) === 7) {
                $opaque_values = paprika_hex_to_rgb($opacities, $color);
            }
        ?>
        /* FESTIVAL SPECIFIC STYLES */
        .page-festivals .header__banner__bar {
            background-image: url(<?php echo get_template_directory_uri() . '/images/floating-cogs.svg' ?>),
            linear-gradient(<?php echo $color ?>, <?php echo $color ?>);
        }
        .btn--schedule,
        .festivals__card__link::before,
        .festivals__card__link {
            border: 2px solid <?php echo $color ?>;
        }

        .btn--schedule:focus,
        .btn--schedule:hover {
            color: white;
            background: <?php echo $color; ?>;
        }

        .festivals__card__link:hover .festivals__card__title,
        .festivals__card__link:focus .festivals__card__title {
            color: white;
        }

        .festivals__card__link:hover::before,
        .festivals__card__link:focus::before,
        .festivals__card__link:focus, 
        .festivals__card__link:hover {
            background: <?php echo $color ?>;
        }
        .participants-block__name::before,
        .schedule__toggle__single:checked + label,
        .schedule__time .schedule__active::before,
        .festivals__button .btn--dark {
            background-color: <?php echo $color ?>;
        }
        .home .header {
            background: <?php echo $color; ?>;
        }

        .homepage .cta-block {
            background-color: <?php echo $color?>;
        }


        .show-block a,
        .show-block__date__link:hover {
            color: <?php echo $color; ?>
        }

        .show-block a:focus,
        .show-block a:hover {
            color: <?php echo $darker_color ?>;
        }

        .festivals__archive .archive__link:hover,
        .festivals__archive .archive__link:focus {
            color: <?php echo $color ?>;
        }

        .schedule__card__image {
            background-color: <?php echo $opaque_values['10']; ?>
        }
        .schedule__card__overlay {
            background-color: <?php echo $opaque_values['15']; ?>
        }
        .participants-block__overlay {
            background-color: <?php echo $opaque_values['95']; ?>
        }
        @media (min-width: 764px) {
            .schedule__card__overlay {
                background-color: <?php echo $opaque_values['95']; ?>
            }
        }
        .participants-block__placeholder {
            border: 32px solid <?php echo $opaque_values['15'] ?>;
            background-image: url("<?php echo get_template_directory_uri() . '/images/missing-portrait.svg' ?>"),
			linear-gradient(to bottom, <?php echo $opaque_values['15'] ?>,<?php echo $opaque_values['15'] ?>);
        }	
    <?php endif; ?>
    <?php if (isset($custom_colors['press'])): ?>
        <?php $color = $custom_colors['press'] ?>
        <?php 
            if (intval(strlen($color)) === 7) {
                $opaque_values = paprika_hex_to_rgb($opacities, $color);
            }
        ?>
        .page-press .header__banner__bar {
            background-image: url(<?php echo get_template_directory_uri() . '/images/connections.svg' ?>),
            linear-gradient(<?php echo $color ?>, <?php echo $color ?>);
        }
        .media-quote .container::before {
			background-color: <?php echo $color; ?>;
        }
        .media-quote .wp-block-button__link {
            background-color: <?php echo $color; ?>;
            border: 2px solid <?php echo $color; ?>;
        }
        .media-quote .wp-block-button__link:hover,
        .media-quote .wp-block-button__link:focus {
            background-color: white;
            color: <?php echo $color; ?>;
        }
    <?php endif; ?>
    <?php if (isset($custom_colors['support'])): ?>
        <?php $color = $custom_colors['support'] ?>
        <?php 
            if (intval(strlen($color)) === 7) {
                $opaque_values = paprika_hex_to_rgb($opacities, $color);
            }
        ?> 
        .header-menu .btn--donations {
            background-color: <?php echo $color ?>;
            border: 2px solid <?php echo $color ?>;
        }

        .header-menu .btn--donations:focus,
        .header-menu .btn--donations:hover {
            color: <?php echo $color ?>;
        }

        .page-support .header__banner__bar {
            background-image: url(<?php echo get_template_directory_uri() . '/images/jigsaw.svg' ?>),
            linear-gradient(<?php echo $color ?>, <?php echo $color ?>);
        }
        .donor-block--two-up {
            background: linear-gradient(to right, rgba(255,255,255,0.2) 50%, <?php echo $opaque_values['15']; ?> 50%);
        }
        .donor-block--two-up:nth-of-type(2n) {
            background: linear-gradient(to left, rgba(255,255,255,0.2) 50%, <?php echo $opaque_values['15']; ?> 50%);
        }
        @media (max-width: 767px) {
            .donor-block--two-up .donor-block__card:nth-of-type(2n) {
                background: <?php echo $opaque_values['15'] ?>;
            }
        }
        @media (max-width: 767px) {
            .donor-block--two-up {
                background: none;
            }
        }
        @media (max-width: 767px) {
            .donor-block--two-up:nth-of-type(2n) {
                background: none;
            }
        }
        
    <?php endif; ?>
</style>

