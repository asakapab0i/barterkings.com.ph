<?php if(isset($messages) && $messages !== FALSE): ?>
  <?php if(isset($display_tools) && $display_tools !== FALSE): ?>
   <div class="btn-group btn-group-justified" role="group" aria-label="...">
     <a href="#reply" data-toggle="tab" data-type="reply" data-message-id="<?php echo $messages[0]['message_id']; ?>" class="btn btn-default btn-success show-tab" role="button">Reply</a>
     <a href="#forward" data-toggle="tab" data-type="forward" data-message-id="<?php echo $messages[0]['message_id']; ?>" class="btn btn-default btn-primary show-tab" role="button">Forward</a>
     <?php if(isset($messages[0]['is_trash']) && $messages[0]['is_trash'] == 1): ?>
       <a href="#delete" data-toggle="tab" data-type="undelete" data-message-id="<?php echo $messages[0]['message_id']; ?>" class="btn btn-default btn-info show-tab" role="button">Restore</a>
     <?php else: ?>
      <a href="#delete" data-toggle="tab" data-type="delete" data-message-id="<?php echo $messages[0]['message_id']; ?>" class="btn btn-default btn-danger show-tab" role="button">Delete</a>
    <?php endif;?>
  </div>
<?php elseif(isset($display_search) && $display_search !== FALSE): ?>
  <input type="search" placeholder="Search Mail" class="form-control mail-search" />
<?php elseif(isset($display_reply) && $display_reply !== FALSE): ?>
  <?php $this->load->view('template/message-compose-template'); ?>
  <hr>
<?php endif; ?>
<?php foreach($messages as $message): ?>
  <ul class="mail-list">
    <li>
      <a <?php if(isset($message['is_read']) && $message['is_read'] == 0): ?> style="background-color: #DBF9FF;" <?php endif;?> href="#message" class="show-tab" data-type="view" data-toggle="tab" data-message-id="<?php echo $message['message_id']; ?>">
       <span class="pull-right mail-subject"><?php echo timespan(strtotime($message['date_sent'])); ?></span>
       <span class="mail-sender"><?php echo $message['username']; ?></span>
       <span class="mail-subject"><?php echo $message['subject']; ?></span>
       <span class="mail-message-preview"><?php echo nl2br($message['message']); ?></span>
     </a>
   </li>
 <?php endforeach; ?>
<?php else: ?>
 <li>
   <div class="text-center">
    <span class="">No messages.</span>
  </div>
</li>
<?php endif;?>
</ul>
