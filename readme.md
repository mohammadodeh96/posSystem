# POS System API

Response schema: JSON Object { "success": boolean, "message_code": string, "body": Array }

 GET api/transactions
    - Fetches all transactions to build table
    - Request Arguments: None
    - 404 will be returned if no transaction was found

 POST /api/sell/create
    - Create a new transaction
    - Request Arguments: {'item_id': string ,'quantity': int ,'total_price': int}
    - 421 will be returned if any param was not found

 POST /api/sell/update
    - Updates transaction information
    - Request Arguments: {"id": integer}
    - 421 will be returned if id param was not found
    
 POST /api/transactions/delete
    - Delete the transaction
    - Request Arguments:{"id": integer}
    - 404 will be returned if no transaction for this id was found

 POST /api/sell
    - Get the selling price for item input id to calculate totla price
    - Request Arguments:{"id": integer}
    - 404 will be returned if id param was not found

 POST /api/item
    - Get the quantity of the item input id 
    - Request Arguments:{"id": integer}
    - 404 will be returned if no item for this id was found

 POST /api/item/edit
    - Update the available quantity in items reducing selled quantity
    - Request Arguments:{"id": integer ,"available_quantity": integer}
    - 404 will be returned if no item for this id was found

 GET /api/transaction
    - Get the transaction by id (last inserted) in order to append new table row
    - Request Arguments: none
    - 404 will be returned if no transaction found

 POST /api/user-transactions
    - Handle the user transactions relation
    - Request Arguments:{"transaction_id": integer , "user_id": integer}
    - 421 will be returned if id params was not found
 