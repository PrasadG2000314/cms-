<?php
require_once(__DIR__ . "/../includes/config.php");
require_once(__DIR__ . "/../includes/function.php");
require_once(__DIR__ . "/../includes/header.php");
blockPage(); ?>
<h2>Add Users</h2>
<div class="">
    <?php echo returnPageError(); ?>
</div>
<form action="process_add.php" method="post">
    <div class="form-group">
        <label for="username">Username</label>
        <input class="form-control" type="text" name="username" id="username">
    </div>

    <div class="form-group">
        <label for="first_name">First Name</label>
        <input class="form-control" type="text" name="first_name" id="first_name">
    </div>

    <div class="form-group">
        <label for="last_name">Last Name</label>
        <input class="form-control" type="text" name="last_name" id="last_name">
        
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Create User">
    </div>
</form>

<?php
require_once(__DIR__ . "/../includes/footer.php");

?>