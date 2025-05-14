<?php
require_once(__DIR__ . "/../includes/config.php");
require_once(__DIR__ . "/../includes/function.php");
require_once(__DIR__ . "/../includes/header.php");
blockPage(); ?>
$user = getUser($_GET["id"]);
<h2>Add Users</h2>
<div class="">
    <?php echo returnPageError(); ?>
</div>
<form action="process_add.php" method="post">
    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
    <div class="form-group">
        <label for="username">Username</label>
        <input class="form-control" type="text" name="username" id="username" value="<?php echo $user['username']; ?>">
    </div>

    <div class="form-group">
        <label for="first_name">First Name</label>
        <input class="form-control" type="text" name="first_name" id="first_name" value="<?php echo $user['first_name']; ?>">
    </div>

    <div class="form-group">
        <label for="last_name">Last Name</label>
        <input class="form-control" type="text" name="last_name" id="last_name" value="<?php echo $user['last_name']; ?>">

    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Create User">
    </div>
</form>

<?php if($_SESSION['username'] == $user['username']): ?>
<?php if(password_verify($user['username'], $user['password'])):?>
    <p>
        <span class="label label-danger">
            You are adviced to change your password as it is currently set your username.
        </span>
    </p>
<?php endif; ?>

    
<h2>Update User Password</h2>
<form action="process_edit_password.php" method="post">
    <div class="form-group">
        <label for="old_password">Old Password</label>
        <input type="password" class="form-control" id="old_password" name="old_password">
    </div>

    <div class="form-group">
        <label for="new_password">New Password</label>
        <input type="password" class="form-control" id="new_password" name="new_password">
    </div>

    <div class="form-group">
        <label for="confirm_password">Confirm Password</label>
        <input type="password" class="form-control" id="confirm_password" name="confirm_password">
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary pull-right" value="Change Password">
    </div>
</form>

<?php endif; ?>

 <?php
require_once(__DIR__ . "/../includes/footer.php");
?>