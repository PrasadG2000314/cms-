<?php startSession(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple PHP Cms</title>
    <link rel="stylesheet" href="/cms/css/bootstrap.css" media="screen" title="no title" charset="utf-8" />
</head>

<body>
    <div class="container">
        
        <ul class="nav nav-tabs">
            <li><a href="/">Home</a></li>
            <?php if(isset($_SESSION["id"])): ?>
            <li><a href="/pages/">Pages</a></li>
            <li><a href="/pages/unpublished.php">Unpublished Page</a></li>
            <li><a href="/pages/add.php">Create Page</a></li>
            <li><a href="/users/">Users</a></li>
            <li><a href="/users/add.php">Create User</a></li>
            <?php endif; ?>
            
            <?php if(isset($_SESSION["id"])): ?>
                <li><a href="/logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="/login.php">Login</a></li>        
            <?php endif; ?>
        </ul>

        <div class="">
            <?php echo returnPageMessage(); ?>;
        </div>




    </div>
</body>

</html>