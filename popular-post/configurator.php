<?php

$c_popular_post = $config->states->{'plugin_' . md5(File::B(__DIR__))};
$c_popular_post_css = File::open(__DIR__ . DS . 'assets' . DS . 'shell' . DS . 'widgets.css')->read();

?>
<label class="grid-group">
  <span class="grid span-2 form-label"><?php echo $speak->plugin_popular_post->title->style; ?></span>
  <span class="grid span-4"><?php

  $_ = 'unit:' . time();
  $options = array();
  foreach(glob(__DIR__ . DS . 'workers' . DS . '*.php') as $kind) {
      $kind = File::N($kind);
      $options[$kind] = sprintf($speak->plugin_popular_post->title->style_, $kind);
  }
  echo Form::select('kind', $options, $c_popular_post->kind);

  ?></span>
</label>
<label class="grid-group">
  <span class="grid span-2 form-label"><?php echo $speak->plugin_popular_post->title->display; ?></span>
  <span class="grid span-4"><?php echo Form::number('total', $c_popular_post->total); ?></span>
</label>
<label class="grid-group">
  <span class="grid span-2 form-label"><?php echo $speak->plugin_popular_post->title->thumbnail . ' ' . Jot::info($speak->plugin_popular_post->description->thumbnail); ?></span>
  <span class="grid span-4"><?php echo Form::number('thumbnail', $c_popular_post->thumbnail); ?></span>
</label>
<div class="grid-group">
  <label class="grid span-2 form-label" for="<?php echo $_; ?>"><?php echo $speak->plugin_popular_post->title->css; ?></label>
  <span class="grid span-4"><?php echo Form::textarea('css', $c_popular_post_css, null, array(
      'class' => array(
          'textarea-block',
          'textarea-expand',
          'code'
      ),
      'id' => $_
  )); ?></span>
</div>
<div class="grid-group">
  <span class="grid span-2 form-label"></span>
  <span class="grid span-4"><?php echo Jot::button('action', $speak->update); ?></span>
</div>