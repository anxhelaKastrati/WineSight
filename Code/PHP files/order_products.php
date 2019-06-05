<?php
  
  include("Database.php");
  include("helpers.php");

  session_start();
  $db = new Database();
  $h = new Helpers();
  $errorMessage = ''; 
  $user_id = 'user-id';  
  $user_name = '';

  if (isset($_SESSION['user_type'])) {
    $h->isAuthorized($_SESSION['user_type']);
    $user_type = $_SESSION['user_type'];
  }

  if (isset($_SESSION['user_name'])) {
    $user_name = $_SESSION['user_name'];
  }
  

  $products = $db->getAllProducts();
  $p = [];

  if (isset($_SESSION['user_id']) && isset($_SESSION['user_name'])) {

      $user_id = $_SESSION['user_id'];
      $user_name = $_SESSION['user_name'];

  } 

  function tblProducts($products) {
    
    echo "<thead><tr><th>Name</th><th>Surname</th><th>Position</th><th>Status</th><th>Price</th><th>Quantity</th></tr></thead>";

    for($x=0; $x<count($products); $x++) {  
        echo "<tr><td>".$products[$x]['name']."</td><td>".$products[$x]['description']."</td><td>".$products[$x]['status']."</td><td><p>".$products[$x]['price']."</p></td><td><p>".$products[$x]['quantity']."</p></td><td><input name="."'"."".$products[$x]['id']."'"."  value="."'".""."'"."  type="."'"."number"."'".  "/></td></td></tr>";
    }
  } 

  // Approve

  for($x=0; $x<count($products); $x++) { 
   
    if (isset($_POST['submit']) && isset($_POST[''.$products[$x]['id']])) {
        
        // echo $products[$x]['id']. " ". $_POST[''.$products[$x]['id']]; 

        $prod['id'] = $products[$x]['id'];
        $prod['name'] = $products[$x]['name'];
        $prod['price'] = $products[$x]['price'];
        $prod['description'] = $products[$x]['description'];
        $prod['quantity'] = $_POST[''.$products[$x]['id']];

        array_push($p, $prod);
         
      }

  }

  $db->orderProducts($p, $user_id, $user_name);

  $n['for_type'] = 'sales_director';
  $n['by_type'] = 'admin';
  $n['by_name'] = $user_name; 
  $n['subject'] = $db::NOTIFICATION_ORDER_CREATED;

  $db->addNotification($n);

?>


<html>
    <head>

        <link rel="stylesheet" href="styles.css">

        <style>
            body {
                background: #fafafa;
                padding-left: 20%;
            }
            .main {
                margin-top: 70px;
                width: 100%;
                
            }
            table {
                border: 3px solid gray;
                padding: 10px 0;
                width: 70%;
                background: white;
            }
            table tr { 
            }
            table td {
                border-bottom: 1px solid gray;
                padding: 12px;
                text-align: center;
                
            }
            table td p {
                font-size: 16px;
                color: #1a1a1a;
            }
            table td .action,  .action {
                border-radius: 5px;
                font-size: 16px;
                padding: 10px;
                background: orange;
                color: #1a1a1a;
            }
            .action {
                margin-top: 20px;
                width: 70%;
            }
            .menu {
                width: 60%; 
                padding: 10px; 
            }
            .menu a {
                border-radius: 5px;
                padding: 10px;
                background: blue;
                color: white;
                font-size: 18px;
                text-decoration: none;
                margin-right: 20px;
                -webkit-box-shadow: -1px 10px 26px -4px rgba(0,0,0,0.75);
                -moz-box-shadow: -1px 10px 26px -4px rgba(0,0,0,0.75);
                box-shadow: -1px 10px 26px -4px rgba(0,0,0,0.75);
            }
            h4 { 
            }
            .menu2 {
                width: 70%; 
                padding: 10px; 
                text-align: right;
            }
            .menu2 a {

                text-decoration: none;
                background: blue;
                color: white;
                font-size: 14px;
                border-radius: 5px;
                padding: 5px;
            }
        </style>

    </head>
    <body> 
        <div class="menu"> 
            <?php $h->user($user_type, $user_name); ?>
            <a href="sales_director.php">Home</a> 
            <a href="suppliers.php">Add Products</a> 
            <a href="addSupplier.php">Add Supplier</a> 
            <a href="order_products.php">Order Products</a>
        </div>         
        <div class="menu2"> 
            <a href="notificationsS.php">MY NOTIFICATIONS</a>
            <a href="logout.php">LOGOUT</a>
        </div>    
        <div class="main">
        <!-- Table Products -->
        <h3>Order products</h3>
        <form action="order_products.php" method="post">
            <table> 
                <?php tblProducts($products); ?>
            </table>
            <input class="action" type="submit" name="submit" value="Complete Order" />
        </form>
        </div>
    </body>
<html>    