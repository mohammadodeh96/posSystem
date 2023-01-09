<div class="row col-12 justify-content-center ms-5 ms-lg-0 ">
    <div class="container col-12 justify-content-center bg-white border border-warning px-3 py-3 rounded-4 shadow-lg col-lg-11 col-md-11 mb-5">
        <form id="userInputContainer" class="my-4 d-lg-inline-flex col-12">

            <div id="select-item" class="input-group col 12 my-2 ">

                <select id="item_id" name="item_id" class="form-select" aria-label="Default select example" required>
                    <option selected disabled>Select Item</option>
                    <?php foreach ($data->items as $item) : ?>
                        <option value="<?= $item->id ?>"><?= $item->item_name ?></option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="input-group col 12 my-2 ">
                <input id="quantity" name="quantity" placeholder="Quantity (Number)" type="number" class="form-control" aria-describedby="addon-wrapping" min="1" max="100" oninput="validity.valid||(value='')" required>
            </div>

            <div class="input-group col 12 my-2 ">
                <input id="total_price" value="" disabled name="total_price" placeholder="Total Price" type="number" class="form-control" aria-describedby="addon-wrapping" min="0" max="1000" step="0.01" required>
            </div>

            <button id="sell-item" type="button" class="btn col 12 my-2 ">Sell Items</button>
            <?php
            $get_user = ($_SESSION['user']);
            $username = $get_user['username'];
            ?>
            <input id="seller_name" type="hidden" value="<?php echo $username ?>">

            <?php
            $get_user = ($_SESSION['user']);
            $user_id = $get_user['user_id'];
            ?>
            <input id="seller_id" type="hidden" value="<?php echo $user_id ?>">

        </form>
    </div>
</div>




<table class="table table-striped table-responsive-md text-center my-5 ms-5 ms-lg-0 border border-warning">
    <thead>
        <tr>

            <th scope="col">Seller Name</th>
            <th scope="col">item id</th>
            <th scope="col">Quantity</th>
            <th></th>
            <th scope="col">Total Price </th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tr>
        <tbody id="transactions_table">
    </tr>
    </tbody>
</table>



