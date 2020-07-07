<?php require APP_ROOT . '/views/inc/header.php' ?>
<link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/css/books.css">

<?php flash('user_message'); ?>

<div class="row">
    <a id="btnAdd" href="<?php echo URL_ROOT; ?>/users/add" class="btn btn-primary pull-right"><i class="fa fa-pencil"></i> Add User</a>
</div>
<div id="bookTable">
    <table class="table bg-light table-bordered table-striped">
        <thead id="head">
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['users'] as $user) : ?>
                <tr>
                    <td data-label="Username"><?php echo $user->name; ?></td>
                    <td data-label="Email"><?php echo $user->email; ?></td>
                    <td data-label="Delete">
                        <?= "<a href='/users/delete/{$user->id}' class='delete' onclick='return confirm(\"Do you want to delete this record?\")' title='Delete' data-toggle='tooltip'><i class='material-icons'>&#xE872;</i></a>" ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php require APP_ROOT . '/views/inc/footer.php' ?>