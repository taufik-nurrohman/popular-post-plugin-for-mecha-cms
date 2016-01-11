<?php

// Load the configuration data ...
$popular_post_config = File::open(__DIR__ . DS . 'states' . DS . 'config.txt')->unserialize();

Widget::add('popularPost', function() use($config, $speak, $popular_post_config) {
    if( ! File::exist(PLUGIN . DS . 'page-views-counter')) {
        return $speak->plugin_popular_post->error;
    }
    $html = "";
    $T1 = TAB;
    $T2 = str_repeat(TAB, 2);
    $T3 = str_repeat(TAB, 3);
    $T4 = str_repeat(TAB, 4);
    $T5 = str_repeat(TAB, 5);
    $stats = array();
    foreach(glob(PLUGIN . DS . 'page-views-counter' . DS . 'assets' . DS . 'lot' . DS . 'posts' . DS . 'article' . DS . '*.txt', GLOB_NOSORT) as $stat) {
        $stats[File::N($stat)] = (int) File::open($stat)->get(1);
    }
    natsort($stats);
    $stats = array_reverse($stats);
    $html = O_BEGIN . '<div class="widget widget-popular widget-popular-post kind-' . Text::parse($popular_post_config['kind'], '->slug') . '"' . (count($stats) ? ' id="widget-popular-post-' . (Config::get('popular_post', 0) + 1) . '"' : "") . '>' . NL;
    include __DIR__ . DS . 'workers' . DS . $popular_post_config['kind']. '.php';
    return $html . '</div>' . O_END;
});

Weapon::add('shell_after', function() {
    echo Asset::stylesheet(__DIR__ . DS . 'assets' . DS . 'shell' . DS . 'widgets.css');
});