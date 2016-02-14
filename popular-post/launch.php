<?php

// Load the configuration data ...
$c_popular_post = $config->states->{'plugin_' . md5(File::B(__DIR__))};

Widget::add('popularPost', function() use($config, $speak, $c_popular_post) {
    if( ! $page_views_counter = Plugin::exist('page-views-counter')) {
        return $speak->plugin_popular_post->description->error;
    }
    $html = "";
    $T1 = TAB;
    $T2 = str_repeat(TAB, 2);
    $T3 = str_repeat(TAB, 3);
    $T4 = str_repeat(TAB, 4);
    $T5 = str_repeat(TAB, 5);
    $stats = array();
    foreach(glob($page_views_counter . DS . 'assets' . DS . 'lot' . DS . 'posts' . DS . 'article' . DS . '*.txt', GLOB_NOSORT) as $stat) {
        $stats[File::N($stat)] = (int) File::open($stat)->get(1);
    }
    natsort($stats);
    $stats = array_reverse($stats);
    $html = O_BEGIN . '<div class="widget widget-popular widget-popular-post kind-' . Text::parse($c_popular_post->kind, '->slug') . '"' . (count($stats) ? ' id="widget-popular-post-' . (Config::get('popular_post', 0) + 1) . '"' : "") . '>' . NL;
    include __DIR__ . DS . 'workers' . DS . $c_popular_post->kind . '.php';
    return $html . '</div>' . O_END;
});

Weapon::add('shell_after', function() {
    echo Asset::stylesheet(__DIR__ . DS . 'assets' . DS . 'shell' . DS . 'widgets.css', "", 'shell/widget.' . File::B(__DIR__) . '.min.css');
});