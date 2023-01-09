<div class="container justify-content-center bg-white border border-warning px-3 py-3 rounded-4 shadow-lg col-lg-5 mb-5 d-none d-lg-block">
    <h1 class="text-center">All Transactions</h1>
</div>
<div class="container justify-content-center bg-white border border-warning px-3 py-3 rounded-4 shadow-lg mb-5 ms-5 d-lg-none">
    <h5 class="text-center">All Transactions</h5>
</div>

<div class="row col-12 mx-5 border border-warning ms-5 ms-lg-0">
    <table class="table table-striped table-responsive-md col-12 text-center ms-4 ms-lg-0">
        <thead>
        <td rowspan="2">Seller Name</td>
        <td rowspan="2">Item ID</td>
        <td rowspan="2">Quantity</td>
        <td rowspan="2">Total Price</td>
        <td colspan="2">Actions</td>
        </thead>
        <tbody>
            <?php foreach ($data->transactions as $transaction) : ?>
                <tr>
                    <td><?= $transaction->seller_name?></td>
                    <td><?= $transaction->item_id?></td>
                    <td><?= $transaction->quantity?></td>
                    <td><?= $transaction->total_price ?></td>
                    <td><a href="./transactions/edit?id=<?= $transaction->id ?>" class="btn btn-warning">Edit</a></td>
                    <td><a href="./transactions/delete?id=<?= $transaction->id ?>" class="btn btn-danger">delete</a></td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>

</div>