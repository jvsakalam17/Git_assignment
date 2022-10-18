<div class="col-4 mx-auto border shadow rounded py-4 mt-5 px-4">
    <h4>Update Member</h4>
    <form method="post">
        <input type="hidden" id="id" name="id" value="<?php echo $this->data["member_id"];?>">
        <label class="mt-4">First Name:</label>
        <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $this->data["fname"];?>">
        <label class="mt-4">Last Name:</label>
        <input type="text" class="form-control" id="lname" name="lname" value="<?php echo $this->data["lname"];?>">
        <label class="mt-4">Username:</label>
        <input type="text" class="form-control" id="username" name="username" value="<?php echo $this->data["username"];?>">        
        <label class="mt-4">Password:</label>
        <input type="password" class="form-control" id="password1" name="password1" value="<?php echo $this->data["password"];?>">
        <label class="mt-4">Retype Password:</label>
        <input type="password" class="form-control" id="password2" name="password2" value="<?php echo $this->data["password"];?>">        
        <label class="mt-4">Remarks:</label>
        <textarea class="form-control" id="remarks" name="remarks"><?php echo $this->data["remarks"];?></textarea>
        <button class="btn btn-primary mt-4" id="update" name="update">Update</button>        
    </form>
</div>