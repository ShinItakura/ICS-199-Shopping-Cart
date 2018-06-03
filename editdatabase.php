<html>
    <head>
        <title>Edit a product</title>
    </head>
    <body>
        <?php
        // get header
        include ('header.php');
        
        // Default query from this page;
        $q = "SELECT * from ORDER;";
        if (isset($_POST['id'])){
            // code to update product
            $orderid = $_POST['id'];
            $userid = $_POST['USER_id'];
            $orderdate = $_POST['orderDate']
        }
    
    </body>