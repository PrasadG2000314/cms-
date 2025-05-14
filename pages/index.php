<?php require_once(__DIR__ . "/../includes/config.php"); ?>
<?php require_once(__DIR__ . "/../includes/function.php"); ?>
<?php blockPage(); ?>
<?php $pages = getPages(); ?>
<?php require_once(__DIR__."/../includes/header.php"); ?>

<h2>Pages</h2>
<div class="pages">
    <?php foreach ($pages as $page): ?>
        <p>
         <span> <?php echo $page["title"]; ?> </span>
         <a href="/cms/pages/edit.php?id=<?php echo $page['id'] ?>" class="btn btn-primary">Edit</a>   
         <a href="/cms/pages/delete.php?id=<?php echo $page['id'] ?>" class="btn btn-danger">Delete</a>  
         <br><span>created by <?php echo $page['creator']?></span>
         <br><span>last updated by <?php echo $page['updater']?></span>
        </p>
    <?php endforeach; ?>

</div>
<?php require_once(__DIR__."/../includes/footer.php"); ?>