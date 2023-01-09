<div class="card  mb-3 mx-4 col-12 rounded-4 shadow-lg  border border-warning col-lg-8">
    <h3 class="text-center my-5">User Information</h3>
    <div class="col-12 col-lg-6">
        <form action="/profile/update" method="POST" enctype="multipart/form-data">
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
                <label for="profile_picture" class="form-label">Profile Picture</label>
                <input class="form-control" type="file" id="item_id" name="profile_picture" value="<?= $data->user->profile_picture?>" required>
            </div>
            <button type="submit" class="btn btn-warning my-4">Update</button>

        </form>
        
    </div>
    <div>
    <?php if ($data->user->profile_picture != null): ?>
        <img class="d-none d-lg-block me-5 border border-warning" src="../../resources/assets/<?=$data->user->profile_picture?>" alt="" id="profile-pic">
        <?php endif?>
    </div>
    

</div>