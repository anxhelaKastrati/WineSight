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
    
    echo "<thead><tr><th>Name</th><th>Surname</th><th>Status</th></tr></thead>";

    for($x=0; $x<count($suppliers); $x++) {   
        echo "<tr><td>".$suppliers[$x]['name']."</td><td>".$suppliers[$x]['surname']."</td><td><p>".$suppliers[$x]['status']."</p></td></td></tr>";
        
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
   
        if (isset($_POST['addProduct'.$suppliers[$x]['id']])) {
            header("Location: addProduct.php?supplier_id=".$suppliers[$x]['id']);
          }
    
      }

  ?>



<html>
    <head>

        <link rel="stylesheet" href="styles.css">

        <style>
            body {
                background: #ffe6ff;
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
            .menu a {
                border-radius: 5px;
                padding: 10px;
                background:  #000000;
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
                background:  #000000;
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
        <!-- Table Suppliers -->
        <h3>Suppliers Table</h3>
        <form action="suppliers.php" method="post">
            <table> 
                <?php tblSuppliers($suppliers, $db); ?>
            </table>
        </form>
        </div>
    </body>
<html>    