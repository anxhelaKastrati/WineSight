<?php
  
  include("Database.php");
  include("helpers.php");

  session_start();
  $db = new Database();
  $h = new Helpers();
  $errorMessage = ''; 
  $adminId = ''; 
  $history = '';
  $user_name = '';

  if (isset($_SESSION['user_type'])) {
    $h->isAuthorized($_SESSION['user_type']);
    $user_type = $_SESSION['user_type'];
  }

  if (isset($_SESSION['user_name'])) {
    $user_name = $_SESSION['user_name'];
  }
  

  if (isset($_GET['id'])) {
      $adminId = $_GET['id'];  
      $history = $db->getHistoryForAdmin($adminId);

  }
  

  if (isset($_POST['edit'])) {

  }
  
  if (isset($_POST['remove'])) {
      $db->removeEmployee($employeeId, $employeeType);
  } 

  function tblHistory($history) {
    
    echo "<thead><tr><th>Admin Name</th><th>Action</th><th>Desc</th><th>Time</th></thead>";

    for($x=0; $x<count($history); $x++) {   
        echo "<tr><td>".$history[$x]['admin_name']."</td><td>".$history[$x]['action']."</td><td>".$history[$x]['desc']."</td><td><p>".$history[$x]['time']."</p></td></tr>";
    }
  }

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
            <a href="bod.php">Home</a> 
        </div>            
        <div class="menu2"> 
            <a href="notificationsB.php">MY NOTIFICATIONS</a>
            <a href="logout.php">LOGOUT</a>
        </div> 
        <div class="main"> 
        <!-- Table History -->
        <h3>Admin History</h3>
        <table> 
            <?php tblHistory($history); ?>
        </table>
        </div>
    </body>
<html>    