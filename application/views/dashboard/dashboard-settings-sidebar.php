<div class="panel panel-default">
  <div class="panel-heading">
    <h4>Personal Settings</h4>
  </div>
  <div class="panel-body">

    <ul class="list-group list-category">
      <?php foreach($settings_labels as $setting): ?>
        <?php if($setting['setting_type'] == 'profile'): ?>
          <a href="<?php linkify_to_dashboard($setting['setting_class']); ?>" class="list-group-item <?php echo ($active_link == $setting['setting_class'] ? 'active' : '')?>"><?php echo $setting['setting_name']; ?></a>
        <?php endif; ?>
      <?php endforeach; ?>
    </ul>

  </ul>
</div>
</div>

<div class="panel panel-default">
  <div class="panel-heading">
    <h4>Items</h4>
  </div>
  <div class="panel-body">

    <ul class="list-group list-category">
      <?php foreach($settings_labels as $setting): ?>
        <?php if($setting['setting_type'] == 'item'): ?>
          <a href="<?php linkify_to_dashboard($setting['setting_class']); ?>" class="list-group-item <?php echo ($active_link == $setting['setting_class'] ? 'active' : '')?>"><?php echo $setting['setting_name']; ?></a>
        <?php endif; ?>
      <?php endforeach; ?>
    </ul>

  </ul>
</div>
</div>

<div class="panel panel-default">
  <div class="panel-heading">
    <h4>Offers</h4>
  </div>
  <div class="panel-body">

    <ul class="list-group list-category">
      <?php foreach($settings_labels as $setting): ?>
        <?php if($setting['setting_type'] == 'offer'): ?>
          <a href="<?php linkify_to_dashboard($setting['setting_class']); ?>" class="list-group-item <?php echo ($active_link == $setting['setting_class'] ? 'active' : '')?>"><?php echo $setting['setting_name']; ?></a>
        <?php endif; ?>
      <?php endforeach; ?>
    </ul>

  </ul>
</div>
</div>

<div class="panel panel-default">
  <div class="panel-heading">
    <h4>Activity Logs</h4>
  </div>
  <div class="panel-body">

    <ul class="list-group list-category">
      <?php foreach($settings_labels as $setting): ?>
        <?php if($setting['setting_type'] == 'log'): ?>
          <a href="<?php linkify_to_dashboard($setting['setting_class']); ?>" class="list-group-item <?php echo ($active_link == $setting['setting_class'] ? 'active' : '')?>"><?php echo $setting['setting_name']; ?></a>
        <?php endif; ?>
      <?php endforeach; ?>
    </ul>

  </ul>
</div>
</div>
