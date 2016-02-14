<?php

$i = 0;
$html .= $T1 . '<ul class="popular-posts">' . NL;
foreach($stats as $k => $v) {
    if($i === $c_popular_post->total) break;
    if( ! $post = Get::articleHeader($k)) continue;
    // get post thumbnail ...
    $s = explode(SEPARATOR, file_get_contents($post->path), 2);
    $s = Filter::colon('article:content', Filter::colon('article:shortcode', trim($s[1])));
    $s = Get::imagesURL($s, array());
    $size = $c_popular_post->thumbnail;
    if( ! isset($s[0]) || $s[0] === Image::placeholder()) {
        $s[0] = File::url(File::D(__DIR__) . '/assets/object/no-image.png');
    }
    // optimize image size where possible, with `thumbnail` plugin ...
    if(Plugin::exist('thumbnail') && strpos($s[0], $config->url . '/') === 0) {
        $s[0] = str_replace(File::url(ASSET) . '/', $config->url . '/t/' . $size . '/' . $size . '/', $s[0]);
    }
    $html .= $T2 . '<li class="popular-post' . ($post->url === $config->url_current ? ' ' . Widget::$config['classes']['current'] : "") . '">' . NL;
    $html .= $T3 . '<div class="popular-post-image">' . NL;
    $html .= $T4 . '<img src="' . $s[0] . '" alt="" width="' . $size . '" height="' . $size. '"' . ES . NL;
    $html .= $T3 . '</div>' . NL;
    $html .= $T3 . '<div class="popular-post-header">' . NL;
    $html .= $T4 . '<a class="popular-post-title" href="' . $post->url . '">' . $post->title . '</a>' . NL;
    $html .= $T3 . '</div>' . NL;
    $html .= $T3 . '<div class="popular-post-body">' . Converter::curt($post->description) . '</div>' . NL;
    $html .= $T3 . '<div class="popular-post-footer">' . NL;
    $html .= $T4 . '<span class="popular-post-time">' . NL;
    $html .= $T5 . '<time datetime="' . $post->date->W3C . '">' . Date::format($post->time, 'Y/m/d') . '</time>' . NL;
    $html .= $T5 . ' &middot; <span>' . sprintf($speak->plugin_popular_post->title->views, $v) . '</span>' . NL;
    $html .= $T4 . '</span>' . NL;
    $html .= $T3 . '</div>' . NL;
    $html .= $T2 . '</li>' . NL;
    ++$i;
}
$html .= $T1 . '</ul>' . NL;