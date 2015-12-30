<h3>Barter my item</h3>
<hr>
<form id="Add item" method="POST" action="<?php echo base_url('item/add'); ?>">
    <div class="form-group">
        <label for="name" class="control-label">Item Name</label>
        <input required type="text" class="form-control" id="name" name="name" value="" required title="<h4>Please enter item name</h4>" data-toggle="tooltip">
    </div>
    <div class="form-group">
        <label for="category" class="control-label">Item Category</label>
        <select class="form-control" id="category" name="category" title="<h4>Please select a category</h4>" data-toggle="tooltip">
            <option></option>
            <option>Computer Electronics</option>
            <option>Animals And Pet</option>
            <option>Goods And Services</option>
            <option>Food Package</option>
            <option>Coupons</option>
        </select>
    </div>
    <div class="form-group">
       <label for="Description" class="control-label">Description</label>
       <textarea name="description" class="form-control" id="description" title="<h4>Write a short description</h4>" data-toggle="tooltip"></textarea> 
   </div>
    <div class="form-group">
        <label for="name" class="control-label">Location</label>
        <input required type="text" class="form-control" id="location" name="location" required title="<h4>Please enter location</h4>" data-toggle="tooltip">
    </div>
   <div class="form-group">
       <div class="input-group"> <span class="input-group-addon">PHP</span> <input type="number" id="value" name="value" class="form-control" aria-label="Amount (to the nearest dollar)" title="<h4>Please enter the approximate price</h4>" data-toggle="tooltip"> <span class="input-group-addon">.00</span> </div>
   </div>
   <input type="submit" class="btn btn-primary btn-block" value="Add item">
</form>
