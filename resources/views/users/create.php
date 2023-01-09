<div class="container col-12 justify-content-center bg-white border border-warning px-3 py-3 rounded-4 shadow-lg ms-5 col-lg-5">
<h1 class="text-center my-5 d-none d-md-block">Create User</h1>
<h4 class="text-center my-5 d-md-none">Create User</h4>

<form action="/users/store" method="POST" class="col-12">
    <div class="mb-3 ">
        <label for="user_name" class="form-label">User Name</label>
        <input type="text" class="form-control" id="item_id" name="username" required>
    </div>
    <div class="mb-3 ">
        <label for="cost" class="form-label">Display Name</label>
        <input type="text"    class="form-control" id="item_id" name="display_name" required>
    </div>
    <div class="mb-3 ">
        <label for="email" class="form-label">Email</label>
        <input type="email"  class="form-control" id="item_id" name="email" required>
    </div>
    
    <div class="mb-3 ">
        <label for="password" class="form-label">Password</label>
        <input type="password" " class="form-control" id="quantity" name="password" required>item_id
    </div>
    <button type="submit" class="btn btn-success mt-4">Save</button>
    <a href="/users" class="btn btn-danger ms-3 mt-4">Cancel</a>
</form>
</div>