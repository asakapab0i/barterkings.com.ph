<h3>Add item</h3>
        <hr>
            <form id="Add item" method="POST" action="<?php echo base_url('item/add'); ?>">
                <div class="form-group">
                    <label for="name" class="control-label">Name</label>
                    <input required type="text" class="form-control" id="name" name="name" value="" required="" title="Please enter you name">
                    <span class="help-block"></span>
                </div>
                 <div class="form-group">
                    <label for="category" class="control-label">Category</label>
                    <input required type="text" class="form-control" id="category" name="category" value="" required="" title="Please enter you email">
                    <span class="help-block"></span>
                </div>
                <div class="form-group">
                   <label for="size" class="control-label">Size</label>
                    <input required type="text" class="form-control" id="Size" name="size" value="" required="" title="Please enter you email">
                    <span class="help-block"></span> 
                </div>
                <div class="form-group">
                   <label for="Description" class="control-label">Description</label>
                   <textarea name="description" class="form-control" id="description"></textarea>
                    <span class="help-block"></span> 
                </div>
                <div class="form-group">
                   <label for="value" class="control-label">Value</label>
                    <input required type="text" class="form-control" id="value" name="value" value="" required="" title="Please enter you email">
                    <span class="help-block"></span> 
                </div>
                <hr>
                <input type="submit" class="btn btn-primary btn-block" value="Add item">
            </form>
