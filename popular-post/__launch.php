<?php


/**
 * Plugin Updater
 * --------------
 */

Route::accept($config->manager->slug . '/plugin/' . File::B(__DIR__) . '/update', function() use($config, $speak) {
    if($request = Request::post()) {
        Guardian::checkToken($request['token']);
        File::serialize($request['css'])->saveTo(PLUGIN . DS . File::B(__DIR__) . DS . 'assets' . DS . 'shell' . DS . 'widget.css');
        unset($request['token']); // Remove token from request array
        unset($request['css']); // Remove CSS from request array
        File::serialize($request)->saveTo(PLUGIN . DS . File::B(__DIR__) . DS . 'states' . DS . 'config.txt', 0600);
        Notify::success(Config::speak('notify_success_updated', $speak->plugin));
        Guardian::kick(File::D($config->url_current));
    }
});