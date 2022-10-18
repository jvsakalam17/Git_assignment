<div class="container pt-5">
    <div class="pt-5 mt-5"></div>
    <div class="pt-5 mt-5"></div>    
    <form method="post">
        <h4 class="text-center">Login Member</h4>
        <div class="col-6 border rounded shadow py-4 mx-auto mt-5 px-4">
        <?php if(isset($_SESSION['auth']) && $_SESSION['auth'] == "wrong"):?>    
            <div class='alert alert-danger text-center'>
                <strong>Incorrect! username or password</strong>
            </div>
        <?php endif;?>
        <label>Username:</label>
        <input type="text" id="username" name="username" class="form-control">
        <label class="mt-4">Password:</label>
        <input type="password" id="password" name="password" class="form-control">
        <button id="submit" name="submit" class="btn btn-primary mt-4">Login</button>
    </form>
    </div>
</div>