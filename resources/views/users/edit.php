<div class="container col-12 justify-content-center bg-white border border-warning px-3 py-3 rounded-4 shadow-lg ms-5 col-lg-5">
<h1 class="text-center my-5 d-none d-md-block">Edit User</h1>
<h4 class="text-center my-5 d-md-none">Edit User</h4>

<form action="/users/update" method="POST" class="">
    <input type="hidden" name="id" value="<?= $data->user->id ?>">
    <div class="mb-3">
        <label for="display-name" class="form-label">Display Name</label>
        <input type="text" class="form-control" id="item_id" name="display_name" value="<?= $data->user->display_name ?>">
    </div>
    <div class="mb-3">
        <label for="user-email" class="form-label">Email</label>
        <input type="email" class="form-control" id="item_id" name="email" value="<?= $data->user->email ?>">
    </div>
    <div class="mb-3">
        <label for="user-username" class="form-label">Username</label>
        <input type="text" class="form-control" id="item_id" name="username" value="<?= $data->user->username ?>">
    </div>
    <div class="mb-3">
        <label for="user-role" class="form-label">Role</label>
        <select class="form-select" aria-label="Role" name="role" id="item_id">
            <option value="admin">Admin</option>
            <option value="seller">Seller</option>
            <option value="procurement">Procurement</option>
            <option value="accountant">Accountant</option>
        </select>
    </div>
    <button type="submit" class="btn btn-warning mt-4">Update</button>
    <a href="/users" class="btn btn-danger ms-3 mt-4">Cancel</a>

</form>
</div>