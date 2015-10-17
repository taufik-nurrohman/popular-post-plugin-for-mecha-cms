<form class="form-plugin" action="<?php $popular_post_config = File::open(PLUGIN . DS . File::B(__DIR__) . DS . 'states' . DS . 'config.txt')->unserialize(); $popular_post_css = File::open(PLUGIN . DS . File::B(__DIR__) . DS . 'assets' . DS . 'shell' . DS . 'widget.css')->read(); echo $config->url_current; ?>/update" method="post">
  <?php echo Form::hidden('token', $token); ?>
  <label class="grid-group">
    <span class="grid span-2 form-label"><?php echo $speak->plugin_popular_post->style; ?></span>
    <span class="grid span-4">
    <?php

    $options = array();
    foreach(glob(PLUGIN . DS . File::B(__DIR__) . DS . 'workers' . DS . '*.php') as $kind) {
        $kind = File::N($kind);
        $options[$kind] = sprintf($speak->plugin_popular_post->style_, $kind);
    }
    echo Form::select('kind', $options, $popular_post_config['kind']);

    ?>
  </label>
  <label class="grid-group">
    <span class="grid span-2 form-label"><?php echo $speak->plugin_popular_post->display; ?></span>
    <span class="grid span-4"><?php echo Form::number('total', $popular_post_config['total']); ?></span>
  </label>
  <label class="grid-group">
    <span class="grid span-2 form-label"><?php echo $speak->plugin_popular_post->css; ?></span>
    <span class="grid span-4"><?php echo Form::textarea('css', $popular_post_css, null, array(
        'class' => array(
            'textarea-block',
            'textarea-expand',
            'code'
        )
    )); ?></span>
  </label>
  <div class="grid-group">
    <span class="grid span-2"></span>
    <span class="grid span-4"><?php echo Jot::button('action', $speak->update); ?></span>
  </div>
</form>