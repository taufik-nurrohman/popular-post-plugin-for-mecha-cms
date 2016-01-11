<?php

// TODO: show thumbnail

$i = 0;
$html .= $T1 . '<ul class="popular-post-list">' . NL;
foreach($stats as $k => $v) {
    if($i === $popular_post_config['total']) break;
    if( ! $post = Get::articleHeader($k)) continue;
    $html .= $T2 . '<li class="popular-post">' . NL;
    $html .= $T3 . '<div class="popular-post-header">' . NL;
    $html .= $T4 . '<a class="popular-post-title" href="' . $post->url . '">' . $post->title . '</a>' . NL;
    $html .= $T3 . '</div>' . NL;
    $html .= $T3 . '<div class="popular-post-body">' . $post->description . '</div>' . NL;
    $html .= $T3 . '<div class="popular-post-footer">' . NL;
    $html .= $T4 . '<span class="popular-post-time">' . NL;
    $html .= $T5 . '<time datetime="' . $post->date->W3C . '">' . $post->date->FORMAT_3 . '</time>' . NL;
    $html .= $T5 . ' &middot; <span>' . sprintf($speak->plugin_popular_post->views, $v) . '</span>' . NL;
    $html .= $T4 . '</span>' . NL;
    $html .= $T3 . '</div>' . NL;
    $html .= $T2 . '</li>' . NL;
    ++$i;
}
$html .= $T1 . '</ul>' . NL;