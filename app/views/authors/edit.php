<?php require APP_ROOT . '/views/inc/header.php' ?>
<link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/css/books.css">

<?php flash('authors_message'); ?>

<div class="row">
   <a id="btnBack" href="<?php echo URL_ROOT ?>/pages/authors" class="btn btn-outline-secondary"><i class="fa fa-backward"></i> Back</a>
</div>

<div class="row">
   <div class="col-md-6 mx-auto">
      <div class="card card-body bg-light mt-5">
         <h3>Edit Author</h3>
         <form action=<?php echo URL_ROOT . "/authors/edit/{$data['id']}" ?> method="post">
            <div class="form-group">
               <label for="name">Author name: </label>
               <input type="text" name="name" class="form-control form-control" value="<?php echo $data['name']; ?>" required>
            </div>
            <input type="submit" class="btn btn-success" value="Submit" />
         </form>
      </div>
   </div>
</div>
<?php require APP_ROOT . '/views/inc/footer.php' ?>