<?php


/**
 * Plugin Updater
 * --------------
 */

Route::over($config->manager->slug . '/plugin/' . File::B(__DIR__) . '/update', function() {
    File::write(Request::post('css'))->saveTo(__DIR__ . DS . 'assets' . DS . 'shell' . DS . 'widgets.css');
    unset($_POST['css']);
});