<?php
  
  include("Database.php");
  include("helpers.php");

  session_start();
  $db = new Database();
  $h = new Helpers();
  $errorMessage = ''; 
  $user_name = '';

  if (isset($_SESSION['user_type'])) {
    $h->isAuthorized($_SESSION['user_type']);
    $user_type = $_SESSION['user_type'];
  }

  if (isset($_SESSION['user_name'])) {
    $user_name = $_SESSION['user_name'];
  }
  

  $suppliers = $db->getAllSuppliers();

  function tblSuppliers($suppliers, $db) {
    
    echo "<thead><tr><th>Name</th><th>Surname</th><th>Action</th></tr></thead>";

    for($x=0; $x<count($suppliers); $x++) {  
        if (strcmp($suppliers[$x]['status'], $db::EMPLOYEE_STATUS_APPROVED) == 0) { 
            echo "<tr><td>".$suppliers[$x]['name']."</td><td>".$suppliers[$x]['surname']."</td><td><input  class=". "'"."action"."'"." name="."'"."add".$suppliers[$x]['id']."'"."  value="."'"."ADD PRODUCTS"."'"."  type="."'"."submit"."'".  "/></td></td></tr>";    
        }
    }
  }

    // Approve

    for($x=0; $x<count($suppliers); $x++) { 
   
        if (isset($_POST[''.$suppliers[$x]['id']])) {
            header("Location: approveSupplier.php?id=".$suppliers[$x]['id']);
          }
    
      }
    
    // Add Products

    for($x=0; $x<count($suppliers); $x++) { 
   
        if (isset($_POST['add'.$suppliers[$x]['id']])) {
            header("Location: addProduct.php?supplier_name=".$suppliers[$x]['name']."&supplier_id=".$suppliers[$x]['id']);
          }
    
      }

  ?>



<html>
    <head>

        <link rel="stylesheet" href="styles.css">

        <style>
            body {
                background: #f2f2f2;
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
            table td .action {
                border-radius: 5px;
                font-size: 16px;
                padding: 10px;
                background: orange;
                color: #1a1a1a;
            }
            .menu {
                width: 60%; 
                padding: 10px; 
            }
            .menu a {
                border-radius: 5px;
                padding: 10px;
                background: green;
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
                background: green;
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
        <!-- Table Employees -->
        <h3>Choose a supplier:</h3>
        <form action="<?php $formAction ?>" method="post">
            <table> 
                <?php tblSuppliers($suppliers, $db); ?>
            </table>
        </form>
        </div>
    </body>
<html>    