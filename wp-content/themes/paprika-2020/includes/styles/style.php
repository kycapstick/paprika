<?php 
    $custom_colors = get_option('custom_colors');
    $opacities = ['10','15','50','95'];
?>

<style>
    <?php if (is_array($custom_colors) && count($custom_colors) > 0): ?>
        <?php foreach ($custom_colors as $key => $color): ?>
            <?php 
                if (intval(strlen($color)) === 7) {
                    $opaque_values = paprika_hex_to_rgb($opacities, $color);
                }
            ?>

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
                background-color: <?php echo $color ?>;
            } 
            .footer__contact.page-<?php echo $key ?> .btn--dark {
                background-color: <?php echo $color ?>;
            }

            /* HEADER */
            .page-<?php echo $key ?> .header__text,
            .page-<?php echo $key ?> .header__link {
                color: <?php echo $color ?>;
            }

            /* BLOCKQUOTE */
            .page-<?php echo $key ?> blockquote::before {
                color: <?php echo $color ?>;
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
                color: black;
            }

            /* DEFAULT BLOCKS */
            .default-block.page-<?php echo $key ?> a {
                color: <?php echo $color ?>;
            }

            .default-block.page-<?php echo $key ?> a:hover,
            .default-block.page-<?php echo $key ?> a:focus {
                color: black;
            }
            .default-block.page-<?php echo $key ?> h2::after {
                background-color: <?php echo $color ?>;
            }
            .container.default-block.page-<?php echo $key ?> ul li::before {
                background-color: <?php echo $color ?>;
            }

            /* CTAs */
            .cta-block.page-<?php echo $key ?> {
                background-color: <?php echo $color ?>;
            }

            /* NEWS BLOCK */
            .news-block.page-<?php echo $key ?> .news-block__subheader svg path {
                stroke: <?php echo $color ?>;
            }

            /* TWO COLUMNS */
            .two-columns.page-<?php echo $key ?> h2::after {
                background: <?php echo $color ?>;
            }
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
        /* FESTIVAL SPECIFIC STYLES */
        .page-about .header__banner__bar {
            background-image: url(<?php echo get_template_directory_uri() . '/images/topography.svg' ?>),
            linear-gradient(<?php echo $color ?>, <?php echo $color ?>);
        }
        .name-tag::before,
        .staff__name::before {
            background-color: <?php echo $color ?>;
        }
        .post__aside__link,
        .post__recent__link,
        .post__archive li a,
        .post__card__byline a {
            color: <?php echo $color; ?>;

        }
        .post__aside__link:hover,
        .post__aside__link:focus,
        .post__recent__link:hover,
        .post__recent__link:focus,
        .post__archive li a:hover,
        .post__archive li a:focus,
        .post__card__byline a:hover,
        .post__card__byline a:focus {
            color: black;
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
            background-image: url(<?php echo get_template_directory_uri() . '/images/hexagons.svg' ?>),
            linear-gradient(<?php echo $color ?>, <?php echo $color ?>);
        }
        .btn--schedule,
        .festivals__card__link::before {
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
        .festivals__card__link:focus::before {
            background: <?php echo $color ?>;
        }
        .home .header,
        .homepage .cta-block,
        .artist-block__name::before,
        .participants-block__name::before,
        .schedule__toggle__single:checked + label,
        .schedule__time .schedule__active::before,
        .festivals__button .btn--dark {
            background-color: <?php echo $color ?>;
        }
        .show-block a,
        .show-block__date__link:hover,
        .festivals__link:hover,
        .festivals__archive .archive__link {
            color: <?php echo $color; ?>
        }

        .festivals__archive .archive__link:hover,
        .festivals__archive .archive__link:focus {
            color: black;
        }

        .artist-block--reverse {
            background-color: <?php echo $opaque_values['15']; ?> 
        }
        .participants-block__overlay,
        .schedule__card__overlay {
            background-color: <?php echo $opaque_values['95']; ?>
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
        .donor-block__price span::before {
            color: <?php echo $color; ?>;
        }
        .donor-block--two-up {
            background: linear-gradient(to right, #fff 50%, <?php echo $opaque_values['15']; ?> 50%);
        }
		.donor-block--two-up:nth-of-type(2n) {
			background: linear-gradient(to left, #fff 50%, <?php echo $opaque_values['15']; ?> 50%);
		}
    <?php endif; ?>
</style>

