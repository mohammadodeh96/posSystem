<div class="container justify-content-center bg-white border border-warning px-3 py-3 rounded-4 shadow-lg col-lg-5 mb-5 d-none d-lg-block">
    <h1 class="text-center">All Users</h1>
</div>
<div class="container justify-content-center bg-white border border-warning px-3 py-3 rounded-4 shadow-lg mb-5 ms-5 d-lg-none">
    <h5 class="text-center">All Users</h5>
</div>
<div id="create-new">
    <a href="/users/create" class="btn pull-right me-0 me-lg-5 my-3 ">Create new user</a>
</div>
<div class="row col-12 mx-5 border border-warning ms-5 ms-lg-0">
    <table class="table table-striped table-responsive-md col-12 text-center ms-4 ms-lg-0">
        <thead>
        <td rowspan="2">User Name</td>
        <td rowspan="2">Display Name</td>
        <td rowspan="2">Email</td>
        <td colspan="2">Actions</td>
        </thead>
        <tbody>
            <?php foreach ($data->users as $user) : ?>
                <tr>
                    <td><?= $user->username?></td>
                    <td><?= $user->display_name?></td>
                    <td><?= $user->email ?></td>
                    <td><a href="./users/edit?id=<?= $user->id ?>" class="btn btn-warning">Edit</a></td>
                    <td><a href="./users/delete?id=<?= $user->id ?>" class="btn btn-danger">delete</a></td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>

</div>