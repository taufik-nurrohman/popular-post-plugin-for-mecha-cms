<?php

$i = 0;
$html .= $T1 . '<ul>' . NL;
foreach($stats as $k => $v) {
    if($i === $c_popular_post->total) break;
    if( ! $post = Get::articleAnchor($k)) continue;
    $html .= $T2 . '<li' . ($post->url === $config->url_current ? ' class="' . Widget::$config['classes']['current'] . '"' : "") . '>' . NL;
    $html .= '<a href="' . $post->url . '" title="' . sprintf($speak->plugin_popular_post->title->views, $v) . '">' . $post->title . '</a>';
    $html .= '</li>' . NL;
    ++$i;
}
$html .= $T1 . '</ul>' . NL;