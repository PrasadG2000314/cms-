<?php require_once(__DIR__ . "/../includes/config.php"); ?>
<?php require_once(__DIR__ . "/../includes/function.php"); ?>
<?php blockPage(); ?>
<?php require_once(__DIR__ . "/../includes/header.php"); ?>
<?php $pages = getPage($_GET["id"]);?>



<h2>Edit Page</h2>
<div>
    <?php echo returnPageError(); ?>
</div>

<form action="process_edit.php" method="post">
    <input type="hidden" name="id" value="<?php echo $page['id']; ?>">
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" class="form-control" value="<?php echo $page['title']; ?>">
    </div>

    <div class="form-group">
        <label for="body">Body</label>
        <textarea name="body" id="body" class="form-control"><?php echo $page["body"]; ?></textarea>
    </div>
    
    <div class="form-group">
        <label for="published">
            <input type="checkbox" name="published" id="published" value="1"
            <?php if($page["published"] == 1) {echo "checked"; }?>
            > Publish?
        </label>    
    </div>
    
    <div class="form-group">
        <input type="submit" class="btn btn-primary pull-right" value="Update">
    </div>
   
</form>

<?php require_once(__DIR__ . "/../includes/footer.php"); ?>
