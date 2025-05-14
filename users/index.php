<?php 
require_once(__DIR__ . "/../includes/config.php");
require_once(__DIR__ . "/../includes/function.php");    
blockPage();
$users = getUsers();
?>

<?php require_once(__DIR__ . "/../includes/header.php"); ?>

<h2>Users</h2>
<div class="">
    <?php echo returnPageError(); ?>
</div>
<div class="users">
    <?php foreach ($users as $user): ?>
        <?php if($_SESSION['id'] != $user['id']): ?>
        <p>
         <span> <?php echo $user["first_name"]." " . $user["last_name"]; ?> </span>
         <a class="btn btn-primary" href="/cms/users/edit.php?id=<?php echo $user['id'] ?>" class="btn btn-primary">Edit</a>   
         <a class="btn btn-danger" href="/cms/users/delete.php?id=<?php echo $user['id'] ?>" class="btn btn-danger">Delete</a>   
        </p>
        <?php endif; ?>
    <?php endforeach; ?>
<?php require_once(__DIR__ . "/../includes/footer.php"); ?>