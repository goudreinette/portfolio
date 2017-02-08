<?php

/**
 * Highlight
 */
wp_enqueue_style('highlight.js', 'https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.9.0/styles/default.min.css');
wp_enqueue_script('highlight.js', 'https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.9.0/highlight.min.js');
wp_enqueue_script('clojure-lang.js', 'https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.9.0/languages/clojure.min.js');
wp_enqueue_script('enable_highlight.js', get_theme_root_uri() . '/werkstatt-child/enable_highlight.js');
