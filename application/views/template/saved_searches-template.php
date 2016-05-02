<div class="panel panel-default">
  <div class="panel-heading"><h4>Saved Searches</h4></div>
  <div class="panel-body">
    <div>
      <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#recent" aria-controls="recent" role="tab" data-toggle="tab">Recent Searches</a></li>
        <li role="presentation"><a href="#unfavorite" aria-controls="favorite" role="tab" data-toggle="tab">Favorite Searches</a></li>
      </ul>
      <!-- Tab panes -->
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="recent">
          <ul class="list-group list-height-limit">
            <?php if (is_array($searches)):?>
              <?php foreach ($searches as $search): ?>
                <?php if ($search['is_favorite'] == 0): ?>
                  <li class="list-group-item">
                    <a href="<?php $search["url_query"]; ?>">
                      <?php echo $search['keyword']; ?>
                    </a>
                    <span class="badge"><?php echo $search['result']; ?> result(s)</span>
                  </li>
                <?php endif; ?>
              <?php endforeach; ?>
            <?php else: ?>
              <li class="list-group-item" style="text-align: center;"> <span>No recent searches found</span></li>
            <?php endif;?>
          </ul>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="unfavorite">
          <ul class="list-group list-height-limit">
            <?php if( is_array($searches) ): ?>
              <?php foreach($searches as $search): ?>
                <?php if ($search['is_favorite'] == 1): ?>
                  <li class="list-group-item">
                    <a href="<?php $search["url_query"]; ?>">
                      <?php echo $search['keyword']; ?>
                    </a>
                    <span class="badge"><?php echo $search['result']; ?> result(s)</span>
                  </li>
                <?php endif; ?>
              <?php endforeach; ?>
            <?php else: ?>
            <li class="list-group-item" style="text-align: center;">No favorites saved</li>
          <?php endif;?>
        </ul>
      </div>
    </div>
  </div>
</div>
</div>
