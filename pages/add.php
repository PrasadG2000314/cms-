<?php require_once(__DIR__ . "/../includes/config.php"); ?>
<?php require_once(__DIR__ . "/../includes/function.php"); ?>
<?php blockPage(); ?>
<?php require_once(__DIR__ . "/../includes/header.php"); ?>
<h2>Add Page</h2>
<div>
    <?php echo returnPageError(); ?>
</div>

<form action="process_add.php" method="post">
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" class="form-control" value="">
    </div>

    <div class="form-group">
        <label for="body">Body</label>
        <textarea name="body" id="body" class="form-control"></textarea> 
    </div>
    
    <div class="form-group">
        <label for="published">
            <input type="checkbox" name="published" id="published" value="1"> Publish?
        </label>    
    </div>
    
    <div class="form-group">
        <input type="submit" class="btn btn-primary pull-right" value="Create">
    </div>
   
</form>

<?php require_once(__DIR__ . "/../includes/footer.php"); ?>
