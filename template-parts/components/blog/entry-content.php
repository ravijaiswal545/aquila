<?php
/*
* Entry Content template file
*
* @package Aquila
*/
?>
<div class="entry-content">
    <?php if (is_single()) {
        the_content(
            sprintf(
                wp_kses(
                    __(
                        'Continue Reading %s <span class="meta-nav">&rarr;</span>',
                        'aquila'
                    ),
                    [
                        'span' => [
                            'class' => []
                        ]
                    ]
                ),
                the_title('<span class="screen-reader-text">"', '"</span>', false)

            )
        );
        wp_link_pages(
            [
                'before' => '<div class="page-links">' . esc_html__('Pages:', 'aquila'),
                'after' => '</div>'
            ]
        );
    } else {
        echo aquila_the_excerpt(500);
        echo "</br>" . aquila_excerpt_read_more();
    }
    



    ?>
</div>