<?php require APP_ROOT . '/views/inc/header.php' ?>
<link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/css/books.css">

<?php flash('genres_message'); ?>

<div class="row">
   <a id="btnBack" href="<?php echo URL_ROOT; ?>/pages/genres" class="btn btn-outline-secondary"><i class="fa fa-backward"></i> Back</a>
</div>

<div class="row">
   <div class="col-md-6 mx-auto">
      <div class="card card-body bg-light mt-5">
         <h3>Add Genre</h3>
         <p>Create a new genre</p>
         <form action="<?php echo URL_ROOT; ?>/genres/add" method="post">
            <div class="form-group">
               <label for="name">Genre name: </label>
               <input type="text" name="name" class="form-control form-control" required>
            </div>
            <input type="submit" class="btn btn-success" value="Submit" />
         </form>
      </div>
   </div>
</div>
<?php require APP_ROOT . '/views/inc/footer.php' ?>