<?php require APP_ROOT . '/views/inc/header.php' ?>

<link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/css/books.css">

<?php flash('authors_message'); ?>

<?php if (isset($_SESSION['user_id'])) : ?>
    <div class="row">
        <a id="btnAdd" type="button" href="<?php echo URL_ROOT; ?>/authors/add" class="btn btn-secondary">Add Author</a>
    </div>
<?php endif; ?>

<div id="bookTable">
    <table class="table bg-light table-bordered table-striped">
        <thead id="head">
            <tr>
                <th scope="col">Author</th>
                <th scope="col">Date Created</th>
                <?php if (isset($_SESSION['user_id'])) : ?>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($data["authors"] as $row) : ?>
                <tr>
                    <td data-label="Author Name">
                        <?= $row->name ?>
                    </td>
                    <td data-label="Date Created">
                        <?= $row->datecreated ?>
                    </td>
                    <?php if (isset($_SESSION['user_id'])) : ?>
                        <td data-label="Edit">
                            <?= "<a href='/authors/edit/{$row->id}' class='edit' title='Edit' data-toggle='tooltip'><i class='material-icons'>&#xE254;</i></a>" ?>
                        </td>
                        <td data-label="Delete">
                            <?= "<a href='/authors/delete/{$row->id}' class='delete' onclick='return confirm(\"Do you want to delete this record?\")' title='Delete' data-toggle='tooltip'><i class='material-icons'>&#xE872;</i></a>" ?>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>
</div>

<?php require APP_ROOT . '/views/inc/footer.php' ?>