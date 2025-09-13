<?php
function enqueue_section_nav_style() {
    wp_enqueue_style( 'section-nav', get_theme_file_uri( 'css/section-nav.css' ) );
}
function get_section_nav($content) {
    preg_match_all('/<h([2-6])*[^>]*>(.*?)<\/h[2-6]>/',$content,$matches);
    $type = get_post_type();
    $output = "<nav class='section-nav sidebar-item'>";
    $output .= "<h2 class='section-nav-heading'>";
    if ( $type == 'post' ) {
        $output .= "In this post:";
    } elseif ( $type == 'page' ) {
        $output .= "On this page:";
    }
    $output .= "</h2>";
    $output .= "<ul class='section-nav-list section-nav-lvl-1-list'>";
    $prev = 2;
    foreach ($matches[0] as $i => $match){
        $curr = $matches[1][$i];
        $text = strip_tags($matches[2][$i]);
        $slug = strtolower(str_replace("--","-",preg_replace('/[^\da-z]/i', '-', $text)));
        $anchor = "<a name='$slug'>$text</a>";
        $prev <= $curr ?: $output .= str_repeat('</ul>',($prev - $curr));
        $prev >= $curr ?: $output .= "<ul class='section-nav-list section-nav-lvl-$curr-list'>";
        $output .= "<li class='section-nav-item section-nav-lvl-$curr-item'>";
        $output.= get_hsm_button( array(
            'text' => $text,
            'link' => "#$slug",
            'class' => "section-nav-link section-nav-lvl-$curr-link"
        ) );
        $output .= "</li>";
        $prev = $curr;
    }
    $output .= "</ul></nav>";
    return $output;
}
function section_nav($content) {
    echo get_section_nav($content);
}