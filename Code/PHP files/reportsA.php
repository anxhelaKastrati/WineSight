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
  

  $reports = $db->getAllReports();

  function tblReports($reports) {
    
    echo "<thead><tr><th>Title</th><th>Author</th><th>Date</th><th>Action</th></tr></thead>";

    for($x=0; $x<count($reports); $x++) {  
        $dt = gmdate("Y-M-d h:m", $reports[$x]['time']);
        echo "<tr><td>".$reports[$x]['title']."</td><td>".$reports[$x]['user_name']."</td><td>".$dt."</td><td><input class=". "'"."action"."'"." name="."'"."".$reports[$x]['id']."'"."  value="."'"."READ"."'"."  type="."'"."submit"."'".  "/></tr>";
    }
  }
  
    // Check History

    for($x=0; $x<count($reports); $x++) { 
   
        if (isset($_POST[''.$reports[$x]['id']])) {
            header("Location: report.php?id=".$reports[$x]['id']);
          }
    
      }
      

  ?>



<html>
    <head>

        <link rel="stylesheet" href="styles.css">

        <style>
            body {
                background: #fafafa;
                padding-left: 15%;
                background: #eeeeee;
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
                width: 70%;
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
                width: 50%;
                text-align: right;
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
            <a href="admin.php">Home</a> 
            <a href="reportsA.php">Reports</a>   
        </div>         
        <div class="menu2"> 
            <a href="notificationsA.php">MY NOTIFICATIONS</a>
            <a href="logout.php">LOGOUT</a>
        </div>    
        <div class="main">
        <!-- Table Reports -->
            <h3>Table of Reports</h3>
        <form action="reportsA.php" method="post">
            <table> 
                <?php tblReports($reports); ?>
            </table>
        </form>
        </div>
    </body>
<html>    