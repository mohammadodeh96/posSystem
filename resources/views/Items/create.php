<div class="container col-12 justify-content-center bg-white border border-warning px-3 py-3 rounded-4 shadow-lg ms-5 col-lg-5">
<h1 class="text-center my-5 d-none d-md-block">Edit item</h1>
<h4 class="text-center my-5 d-md-none">Edit item</h4>

<form action="/items/store" method="POST" class="col-12">
    <div class="mb-3 ">
        <label for="item_name" class="form-label">Item Name</label>
        <input type="text" class="form-control" id="item_id" name="item_name" required>
    </div>
    <div class="mb-3 ">
        <label for="cost" class="form-label">Cost</label>
        <input type="number"    class="form-control" id="item_id" name="cost" min="0.00"  step="0.01" required >
    </div>
    <div class="mb-3 ">
        <label for="selling_price" class="form-label">Selling Price</label>
        <input type="number"  class="form-control" id="item_id" name="selling_price" min="0.00"  step="0.01" required >
    </div>
    
    <div class="mb-3 ">
        <label for="available-quantity" class="form-label">Available Quantity</label>
        <input type="number" " class="form-control" id="quantity" name="available_quantity" required>
    </div>
    <button type="submit" class="btn btn-success mt-4">Save</button>
    <a href="/items" class="btn btn-danger ms-3 mt-4">Cancel</a>
</form>
</div>