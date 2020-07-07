<?php require APP_ROOT . '/views/inc/header.php' ?>

<link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/css/books.css">

<?php flash('books_message'); ?>

<?php if (isset($_SESSION['user_id'])) : ?>
    <div class="row">
        <a id="btnAdd" type="button" href="<?php echo URL_ROOT; ?>/books/add" class="btn btn-secondary">Add Book</a>
    </div>
<?php endif; ?>


<div id="bookTable">
    <table class="table bg-light table-bordered table-striped">
        <thead id="head">
            <tr>
                <th scope="col">Book</th>
                <th scope="col">Author</th>
                <th scope="col">Genre</th>
                <th scope="col">Date Created</th>
                <?php if (isset($_SESSION['user_id'])) : ?>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($data["books"] as $row) : ?>
                <tr>
                    <td data-label="Book">
                        <?= $row->book_name ?>
                    </td>
                    <td data-label="Author">
                        <?= $row->author_name ?>
                    </td>
                    <td data-label="Genre">
                        <?= $row->genre_name ?>
                    </td>
                    <td data-label="Date Created">
                        <?= $row->date_created ?>
                    </td>
                    <?php if (isset($_SESSION['user_id'])) : ?>
                        <td data-label="Edit">
                            <?= "<a href='/books/edit/{$row->book_id}' class='edit' title='Edit' data-toggle='tooltip'><i class='material-icons'>&#xE254;</i></a>" ?>
                        </td>
                        <td data-label="Delete">
                            <?= "<a href='/books/delete/{$row->book_id}' class='delete' onclick='return confirm(\"Do you want to delete this record?\")' title='Delete' data-toggle='tooltip'><i class='material-icons'>&#xE872;</i></a>" ?>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

<?php require APP_ROOT . '/views/inc/footer.php' ?>