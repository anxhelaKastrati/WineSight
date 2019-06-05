
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
  

  $invoices = $db->getAllInvoices();

  function tblInvoices($invoices) {
    
    echo "<thead><tr><th>Name</th><th>Category</th><th>Date</th><th>Amount</th><th>Status</th></tr></thead>";

    for($x=0; $x<count($invoices); $x++) {  
        $dt = gmdate("Y-M-d h:m", $invoices[$x]['date']);
        echo "<tr><td>".$invoices[$x]['name']."</td><td>".$invoices[$x]['category']."</td><td>".$dt."</td><td><p>".$invoices[$x]['amount']."</p></td><td><p>".$invoices[$x]['status']."</p></td></td></tr>";
    }
  } 

?>


<html>
    <head>

        <link rel="stylesheet" href="styles.css">

        <style>
            body {
                 background-image: url("1.png");
		background-size: 2000px 1060px;
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
        <!-- Table Invoices --> 
        <h3>All Invoices Table</h3>
        <table> 
            <?php tblInvoices($invoices); ?>
        </table> 
        </div>
    </body>
<html>    