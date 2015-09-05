<input type="search" placeholder="Search Mail" class="form-control mail-search" />

<ul class="mail-list">


 <?php if(isset($messages) && $messages !== FALSE): ?>
  <?php foreach($messages as $message): ?>
    <li>
     <a href="">
       <span class="pull-right mail-subject"><?php echo timespan(strtotime($message['date_sent'])); ?></span>
       <span class="mail-sender"><?php echo $message['username']; ?></span>
       <span class="mail-subject"><?php echo $message['subject']; ?></span>
       <span class="mail-message-preview"><?php echo $message['message'];?></span>
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
