<div class="col-md-12">
<form id="message-create-form" action="message/create" method="POST" accept-charset="utf-8">
   <div class="form-group">
    <input id="send-to" type="text" name="to" class="form-control" placeholder="To" />
  </div>
  <div class="form-group">
    <input id="send-subject" type="text" name="subject" class="form-control" placeholder="Subject" />
  </div>
  <textarea id="send-message" name="message" class="form-control" placeholder="message"></textarea>
  <div class="btn-send">
    <button class="form-control btn btn-success">Send</button>
  </div> 
</form>
</div>