quantity = 0;
seller_name = $('#seller_name').val();
let d = new Date();
let month = d.getMonth() + 1;
let day = d.getDate();
let today = d.getFullYear() + (month < 10 ? '0' : '') + month + (day < 10 ? '0' : '') + day;


$(document).ready(function () {

    $.ajax({
        type: "GET",
        url: "http://my_pos.local/api/transactions",
        success: function (response) {
            response.body.forEach(element => {
                {


                    if (seller_name == element.seller_name && today == element.date) {

                        $("#transactions_table").append(`
                    <tr>
                        <th scope="row">${element.seller_name}</th>
                        <td>${element.item_id}</td>                        
                        <td id="edit_quan${element.id}">${element.quantity}</td>
                        <td><input id="update_quan${element.id}" type="number" min="0" class="form-control 100"></td>
                        <td id="total_price${element.item_id}">${element.total_price}</td>
                        <td>
                        <button type="button" id="${element.id + 1}"class="btn btn-warning mx-1">edit</button>
                        <button type="button" id="${element.id}"class="btn btn-danger mx-1">delete</button>
                        </td>
                        
                    </tr>
                    `);
                        $(`#update_quan${element.id}`).hide();
                        $(`#edit_quan${element.id}`).show();

                        $(`#${element.id + 1}`).click(function (e) {
                            e.preventDefault();

                            $(`#edit_quan${element.id}`).hide()
                            $(`#update_quan${element.id}`).show();
                            $(`#${element.id + 1}`).removeClass('btn-warning').addClass('btn-success').text('save');
                            $(`#update_quan${element.id}`).change(function (e) {
                                e.preventDefault();
                                $(`#${element.id + 1}`).click(function (e) {
                                    e.preventDefault();
                                    let data = {
                                        id: element.id,
                                        item_id: element.item_id,
                                        seller_name: element.seller_name,
                                        quantity: $(`#update_quan${element.id}`).val(),
                                        total_price: element.total_price / element.quantity * $(`#update_quan${element.id}`).val(),
                                        date: today
                                    }

                                    $.ajax({
                                        type: "POST",
                                        url: "http://my_pos.local/api/sell/update",
                                        data: JSON.stringify(data),

                                        success: function (e) {

                                        }
                                    });

                                    $(`#edit_quan${element.id}`).show()
                                    $(`#update_quan${element.id}`).hide();
                                    $(`#${element.id + 1}`).removeClass('btn-success').addClass('btn-warning').text('edit');
                                    $(`#edit_quan${element.id}`).text(data.quantity)
                                    $(`#total_price${element.item_id}`).text(data.total_price)

                                });

                            });

                        });

                        $(`#${element.id}`).click(function (e) {
                            e.preventDefault();
                            $(`#${element.id}`)
                            $(this).parent().parent().hide('slow', function () {
                                $(this).remove();
                            });
                            $.ajax({
                                type: "POST",
                                url: 'http://my_pos.local/api/transactions/delete',
                                data: { id: element.id },
                                success: function () {

                                }
                            });
                        });
                    }
                }
            });
        }
    });



});
$("#item_id").change(function (e) {
    let id = $("#item_id").val();
    if (id != '') {
        $.ajax({
            type: "POST",
            data: { id: id },
            dataType: "JSON",
            url: "http://my_pos.local/api/sell",
            success: function (response) {
                data = response.body;
                quantity = data.available_quantity;
            }
        });
    }

});
$('#quantity').change(function (e) {
    e.preventDefault();
    $('#total_price').val(data.selling_price * $('#quantity').val());
});










$('#sell-item').click(function () {
    let data = {
        item_id: $('#item_id').val(),
        seller_name: $('#seller_name').val(),
        quantity: $('#quantity').val(),
        total_price: $('#total_price').val(),
        date: today
    };

    if (quantity > 0) {
        
        $.ajax({
            type: "POST",
            url: "http://my_pos.local/api/sell/create",
            data: JSON.stringify(data),
            success: function (response) {

                $.ajax({
                    type: "GET",
                    url: "http://my_pos.local/api/transaction",
                    data: String,
                    success: function (response) {
                        response.body.forEach(element => {

                            $("#transactions_table").append(`
                                <tr>
                                    <th scope="row">${element.seller_name}</th>
                                    <td>${element.item_id}</td>                        
                                    <td id="edit_quan${element.id}">${element.quantity}</td>
                                    <td><input id="update_quan${element.id}" type="number" min="0" class="form-control 100"></td>
                                    <td id="total_price${element.item_id}">${element.total_price}</td>
                                    <td >
                                    <button type="button" id="${element.id + 1}"class="btn btn-warning mx-1">edit</button>
                                    <button type="button" id="delete${element.id}"class="btn btn-danger mx-1">delete</button>
                                    </td>
                                    
                                </tr>
                                `);
                            $(`#update_quan${element.id}`).hide();
                            $(`#edit_quan${element.id}`).show();

                            $(`#${element.id + 1}`).click(function (e) {
                                e.preventDefault();

                                $(`#edit_quan${element.id}`).hide()
                                $(`#update_quan${element.id}`).show();
                                $(`#${element.id + 1}`).removeClass('btn-warning').addClass('btn-success').text('save');
                                $(`#update_quan${element.id}`).change(function (e) {
                                    e.preventDefault();
                                    $(`#${element.id + 1}`).click(function (e) {
                                        e.preventDefault();
                                        let data = {
                                            id: element.id,
                                            item_id: element.item_id,
                                            seller_name: element.seller_name,
                                            quantity: $(`#update_quan${element.id}`).val(),
                                            total_price: element.total_price / element.quantity * $(`#update_quan${element.id}`).val(),
                                            date: today
                                        }

                                        $.ajax({
                                            type: "POST",
                                            url: "http://my_pos.local/api/sell/update",
                                            data: JSON.stringify(data),

                                            success: function (e) {

                                            }
                                        });

                                        $(`#edit_quan${element.id}`).show()
                                        $(`#update_quan${element.id}`).hide();
                                        $(`#${element.id + 1}`).removeClass('btn-success').addClass('btn-warning').text('edit');
                                        $(`#edit_quan${element.id}`).text(data.quantity)
                                        $(`#total_price${element.item_id}`).text(data.total_price)

                                    });

                                });

                            });

                            $.ajax({
                                type: "GET",
                                url: "http://my_pos.local/api/transaction",
                                success: function (response) {
                                    response.body.forEach(element => {

                                    })
                                }
                            });
                            $(`#delete${element.id}`).click(function (e) {
                                e.preventDefault();
                                console.log(element.id)
                                $(`#delete${element.id}`)
                                $(this).parent().parent().hide('slow', function () {
                                    $(this).remove();
                                });
                                $.ajax({
                                    type: "POST",
                                    url: 'http://my_pos.local/api/transactions/delete',
                                    data: { id: element.id },
                                    success: function () {

                                    }
                                });
                            });


                        })
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "http://my_pos.local/api/item",
                    data: { id: data.item_id },

                    success: function (response) {
                        x = response.body
                        quantity = x.available_quantity - data.quantity
                        $.ajax({
                            type: "POST",
                            url: "http://my_pos.local/api/item/edit",
                            data: JSON.stringify({ id: data.item_id, available_quantity: quantity }),
                            success: function (response) {

                            }
                        });
                    }

                });
                $.ajax({
                    type: "GET",
                    url: "http://my_pos.local/api/transaction",
                    data: String,
                    success: function (response) {
                        response.body.forEach(element => {
                            $.ajax({
                                type: "POST",
                                url: "http://my_pos.local/api/user-transactions",
                                data: { transaction_id: element.id, user_id: $('#seller_id').val() },
                                success: function (response) {

                                }
                            });
                        })
                    }
                })

            },

            error: function (e) {
                alert('not done');
            }
        });
    } else {
        alert('item out of stock');
    }


    $('#userInputContainer').trigger('reset');


});




