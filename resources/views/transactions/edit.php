<div class="container col-12 justify-content-center bg-white border border-warning px-3 py-3 rounded-4 shadow-lg ms-5 col-lg-5">
<h1 class="text-center my-5 d-none d-md-block">Edit transaction</h1>
<h4 class="text-center my-5 d-md-none">Edit transaction</h4>

<form action="/transactions/update" method="POST" class="col-12">
<input type="hidden" name="id" value="<?= $data->transaction->id ?>">
    <div class="mb-3 ">
        <label for="transaction_name" class="form-label">Item ID</label>
        <input type="text" value="<?= $data->transaction->item_id ?>" class="form-control" id="item_id" name="item_id">
    </div>
    <div class="mb-3 ">
        <label for="cost" class="form-label">Seller name</label>
        <input type="text" value="<?= $data->transaction->seller_name ?>"  class="form-control" id="item_id" name="seller_name">
    </div>
    <div class="mb-3 ">
        <label for="selling-price" class="form-label">Total Price</label>
        <input type="text" value="<?= $data->transaction->total_price ?>"  min="0.00" max="100000.00" step="0.01" class="form-control" id="item_id" name="total_price">
    </div>
    <div class="mb-3 ">
        <label for="available-quantity" class="form-label">Quantity Selled</label>
        <input type="number" value="<?= $data->transaction->quantity ?>" class="form-control" id="quantity" name="quantity">
    </div>
    <button type="submit" class="btn btn-success mt-4">Save</button>
    <a href="/transactions" class="btn btn-danger ms-3 mt-4">Cancel</a>
</form>
</div>