<div class="panel panel-default">
  <div class="panel-heading"><h4>Saved Searches</h4></div>
  <div class="panel-body">
    <ul class="list-group">
      <?php if (is_array($searches)):?>
        <?php foreach ($searches as $search): ?>
          <li class="list-group-item"><?php echo $search['keyword']; ?><!-- <span class="badge">14 results</span> --></li>
        <?php endforeach; ?>
      <?php else: ?>
          <li class="list-group-item" style="text-align: center;"> <span>No recent searches found</span></li>
      <?php endif;?>
    </ul>
  </div>
</div>
