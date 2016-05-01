<div class="panel panel-default">
  <div class="panel-heading"><h4>Saved Searches</h4></div>
  <div class="panel-body">
    <ul class="nav nav-tabs" id="searches-tabs">
      <li role="presentation" class="active"><a href="#recent">Recent Searches</a></li>
      <li role="presentation"><a href="#favorite">Favorite Searches</a></li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane active" id="#recent">
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
      <div class="tab-pane" id="#favorite">
      </div>
    </div>

    </div>
  </div>
</div>
