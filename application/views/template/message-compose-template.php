<?php
if (isset($forward) && $forward !== FALSE) {
  $subject = "FORWARD:" . (isset($forward[0]['subject']) ? $forward[0]['subject'] : '');
  $body = "--Forwarded Mesage -- \n\r" . "FROM: " . $forward[0]['username'][0]['username'] ."\n\r". (isset($forward[0]['message']) ? $forward[0]['message'] : '');
}else if(isset($reply) && $reply !== FALSE){
  $subject = "RE:" . (isset($reply[0]['subject']) ? $reply[0]['subject'] : '');
}
?>

<?php if (isset($options) && $options == 'from-profile'): ?>
  <div class="modal-header">
  	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
  	<h4 class="modal-title" id="myModalLabel">Compose Message</h4>
  </div>
<?php endif; ?>

<div class="row">
  <div class="container-fluid">

    <div class="col-md-12">

      <form id="message-create-form" action="message/create" method="POST" accept-charset="utf-8">
        <div class="form-group">
          <input value="<?php echo (isset($reply[0]['username']) ? $reply[0]['username'] : ''); ?>" id="send-to" type="text" name="recepient" class="form-control" placeholder="To" />
        </div>
        <div class="form-group">
          <input value="<?php echo (isset($subject) ? $subject : ''); ?>" id="send-subject" type="text" name="subject" class="form-control" placeholder="Subject" />
        </div>
        <textarea  id="send-message" name="message" class="form-control" placeholder="message">
          <?php echo (isset($body) ?  $body : ''); ?>
        </textarea>
        <div class="btn-send">
          <button class="form-control btn btn-success">Send</button>
        </div>
      </form>
    </div>

  </div>

</div>

<?php if (isset($options) && $options == 'from-profile'): ?>
  <div class="modal-footer">
  	</div>
<?php endif; ?>
