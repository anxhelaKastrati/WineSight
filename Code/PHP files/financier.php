
<?php
  
  include("Database.php");
  include("helpers.php");

  session_start();
  $db = new Database();
  $h = new Helpers();
  $errorMessage = '';  
  $invoice = [];
  $user_name = '';

  if (isset($_SESSION['user_type'])) {
    $h->isAuthorized($_SESSION['user_type']);
    $user_type = $_SESSION['user_type'];
  }

  if (isset($_SESSION['user_name'])) {
    $user_name = $_SESSION['user_name'];
  }
  

  $orders = $db->getAllOrders();

  function tblOrders($orders) {
    
    echo "<thead><tr><th>Id</th><th>Product</th><th>Desc</th><th>Price</th><th>Quantity</th><th>Amount</th></tr></thead>";

    for($x=0; $x<count($orders); $x++) {  
        echo "<tr><td>".$orders[$x]['id']."</td><td>".$orders[$x]['product_name']."</td><td>".$orders[$x]['product_description']."</td><td>".$orders[$x]['price']."</td><td><p>".$orders[$x]['quantity']."</p></td><td><p>".$orders[$x]['amount']."</p></td><td><input name="."'"."pay".$orders[$x]['id']."'"."  value="."'"."PAY"."'"."  type="."'"."radio"."'".  "/></td></td></tr>";
    }
  }

  
  // Remove

  if (isset($_POST['submit']) && isset($_POST['invoice_name'])) {
      
    for($x=0; $x<count($orders); $x++) { 
   
        if (isset($_POST['pay'.$orders[$x]['id']])) {
            // echo $orders[$x]['id'];

            $p['id'] = $orders[$x]['id'];
            $p['product_name'] = $orders[$x]['product_name']; 
            $p['amount'] = $orders[$x]['amount']; 

            array_push($invoice, $p);
             
          }
    
      }

      $db->addInvoice($invoice, $_POST['invoice_name']);

      $n['for_type'] = 'admin';
      $n['by_type'] = 'financier';
      $n['by_name'] = $user_name; 
      $n['subject'] = $db::NOTIFICATION_ORDER_CREATED;
      
      $db->addNotification($n);

  }

  

?>


<html>
    <head>

        <link rel="stylesheet" href="styles.css">

        <style>
            body {
                
				 background-image: url("bi.jpg");
		background-size: 1300px 2700px;
		 background-repeat: no-repeat;
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
                width: 40%; 
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
            .text {
                margin-top: 20px;
                height: 30px;
                color: #1a1a1a;
                font-size: 28px;
                
            }
            .action {
                border-radius: 5px;
                font-size: 16px;
                padding: 10px;
                background: orange;
                color: #1a1a1a;
                width: 70%;
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
            <a href="financier.php">Home</a> 
            <a href="allPayments.php">All Payments</a>
        </div>         
        <div class="menu2"> 
            <a href="notificationsF.php">MY NOTIFICATIONS</a>
            <a href="logout.php">LOGOUT</a>
        </div>    
        <div class="main">
        <!-- Table Orders -->
        <form action="financier.php" method="post">
            <table> 
                <?php tblOrders($orders); ?>
            </table>
            <input class="text" type="text" name="invoice_name" value="Invoice Name" />
            <br>
            <br>
            <br>
            <br>
            <br>
            <input class="action" type="submit" name="submit" value="COMPLETE PAYMENT" />
        </form>
        </div>
    </body>
<html>    