<?php require APP_ROOT . '/views/inc/header.php' ?>
<link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/css/books.css">

<?php flash('books_message'); ?>

<div class="row">
   <a id="btnBack" href="<?php echo URL_ROOT?>/pages/books" class="btn btn-outline-secondary"><i class="fa fa-backward"></i> Back</a>
</div>

<div class="row">
   <div class="col-md-6 mx-auto">
      <div class="card card-body bg-light mt-5">
         <h3>Edit Book</h3>
         <form action="<?php echo URL_ROOT . "/books/edit/{$data['id']}" ?>" method="post">
            <div class="form-group">
               <label for="name">Book title: </label>
               <input type="text" name="name" class="form-control form-control" value="<?php echo $data['name']; ?>" required>
            </div>
            <div class="form-group">
               <label for="author">Author: </label>
               <div>
                  <select class="form-control" name="author" required>
                     <option value="">--- Select ---</option>
                     <?php
                     foreach ($data["authors"] as $row) : ?>
                        <option value="<?= $row->name; ?>" <?php if ($row->id == $data['authorID']) echo 'selected="selected"'; ?>>
                           <?= $row->name; ?>
                        </option>
                     <?php endforeach; ?>
                  </select>
               </div>
            </div>
            <div class="form-group">
               <label for="name">Genre: </label>
               <div>
                  <select class="form-control" name="genre" required>
                     <option value="">--- Select ---</option>
                     <?php
                     foreach ($data["genres"] as $row) : ?>
                        <option value="<?= $row->name; ?>" <?php if ($row->id == $data['genreID']) echo 'selected="selected"'; ?>>
                           <?= $row->name; ?>
                        </option>
                     <?php endforeach; ?>
                  </select>
               </div>
            </div>
            <input type="submit" class="btn btn-success" value="Submit" />
         </form>
      </div>
   </div>
</div>
<?php require APP_ROOT . '/views/inc/footer.php' ?>