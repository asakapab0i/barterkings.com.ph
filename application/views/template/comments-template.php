<?php if(isset($comments) AND $comments !== FALSE): ?>
  <?php foreach($comments as $comment): ?>
    <div class="media">
      <p class="pull-right"><small><?php echo timespan(strtotime($comment['comment_date_inserted'])); ?></small></p>
      <a class="media-left" href="#">
        <img src="http://lorempixel.com/40/40/people/4/">
      </a>
      <div class="media-body">

        <h4 class="media-heading user_name">
        <a href="<?php echo base_url('account/profile/') .'/'. $comment['username']; ?>" title=""><?php echo $comment['username']; ?></a> 
          <small><i><?php echo $comment['title']; ?></i></small>
        </h4>
        <?php echo nl2br($comment['comment']); ?>
      </div>
    </div>
  <?php endforeach;?>
<?php else: ?>
  <div class="media">
    <p class="pull-right"><small></small></p>
    <a class="media-left" href="#">
      <!-- <img src="http://lorempixel.com/40/40/people/4/"> -->
    </a>
    <div class="media-body">

     No comments yet.

   </div>
 </div>
<?php endif;?>