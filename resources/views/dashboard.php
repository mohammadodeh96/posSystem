<section class="bgimage d-none d-lg-block">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <h3>Welcome <?php 
        $get_user = ($_SESSION['user']);
        $username = $get_user['username'];
        echo ucfirst($username)?></h3>
        <h6>HTU Store</h6>
        <span>Point Of Sales System</span>
      </div>
    </div>
  </div>
</section>




  <div class="row col-12 justify-content-center my-5 ms-5" id="card-container">

    <div class="card  mb-3 mx-4 col-12  h-25 rounded-4 shadow-lg col-md-4 col-lg-2 border border-warning" id="dash-card">
      <div class="fs-6 font-weight-bold py-3 text-center text-capitalize">Total sales</div>
      <div class="card-body">
        <h3 class="card-text fs-5 text-center font-weight-bold"><?= $data->qun ?> </h3>
        <h5 class="text-center fs-6 text-nowrap">Items Sold</h5>
      </div>
    </div>
    <div class="card  mb-3 mx-4 col-12  h-25 rounded-4 shadow-lg col-md-4 col-lg-2 border border-warning" id="dash-card">
      <div class="fs-6 font-weight-bold py-3 text-center text-capitalize text-nowrap">Total Tranaction</div>
      <div class="card-body">
        <h3 class="card-text fs-5 text-center font-weight-bold"><?= $data->transactions_count ?> </h3>
        <h5 class="text-center fs-6 text-nowrap ">Transactions</h5>
      </div>
    </div>
    <div class="card  mb-3 mx-4 col-12  h-25 rounded-4 shadow-lg col-md-4 col-lg-2 border border-warning" id="dash-card">
      <div class="fs-6 font-weight-bold py-3 text-center text-capitalize">Total Items</div>
      <div class="card-body">
        <h3 class="card-text fs-5 text-center font-weight-bold"><?= $data->item_qun ?></h3>
        <h5 class="text-center text-nowrap fs-6"> Items In Stock</h5>
      </div>
    </div>
    <div class="card  mb-5 mx-4 col-12  h-25 rounded-4 shadow-lg col-md-4 col-lg-2 border border-warning" id="dash-card">
      <div class="fs-6 font-weight-bold py-3 text-center text-capitalize">Total Users</div>
      <div class="card-body">
        <h3 class="card-text fs-5 text-center font-weight-bold"><?= $data->users_count ?></h3>
        <h5 class="text-center fs-6">Users</h5>
      </div>
    </div>
  </div>



  
<div class="container  col-lg-11" id="table-container">
  <div class="row col-12 justify-content-center ms-2">
    <div class="container  bg-white border border-secondary  py-3 rounded-4 shadow-lg mb-5  border border-warning">
      <div class="row col-12 justify-content-center table-responsive">
        <h3 class="text-center border mb-5 rounded-4 py-3">Top 5 Items To Sell</h3>
        <table class="table text-center border border-warning table-striped table-responsive-md mb-5">
          <thead class="table-light">
            <tr>
              <th scope="col">Item Name</th>
              <th scope="col">Item Price</th>
              <th scope="col">Item cost</th>
            </tr>
          </thead>
          <tbody>

            <?php foreach ($data->items_top as $item) : ?>
              <tr>
                <td><?= $item->item_name ?></td>
                <td><?= $item->selling_price ?></td>
                <td><?= $item->cost ?></td>

              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


<div class="container col-lg-11" id="table-container">
  <div class="row col-12 justify-content-center  mt-3 ms-2">
    <div class="container  bg-white border border-secondary  py-3 rounded-4 shadow-lg mb-5  border border-warning">

      <div class="row col-12 justify-content-center table-responsive ">
        <h3 class="text-center border mb-5 rounded-4 py-3 ">Items Quantity In Stock</h3>
        <table class="table text-center border border-warning table-striped table-responsive-md">
          <thead class="table-light">
            <tr>
              <th scope="col">Item Name</th>
              <th scope="col">Item Quantity</th>
            </tr>
          </thead>
          <tbody>

            <?php foreach ($data->ava_quan as $item) : ?>
              <tr>
                <td><?= $item->item_name ?></td>
                <td><?= $item->available_quantity ?></td>

              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
