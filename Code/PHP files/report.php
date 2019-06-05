<?php
  
  include("Database.php");
  include("helpers.php");

  session_start();
  $db = new Database();
  $h = new Helpers();
  $errorMessage = ''; 
  $id = '';
  $user_name = '';

  if (isset($_SESSION['user_type'])) {
    $h->isAuthorized($_SESSION['user_type']);
    $user_type = $_SESSION['user_type'];
  }

  if (isset($_SESSION['user_name'])) {
    $user_name = $_SESSION['user_name'];
  }
  
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
  }

  $report = $db->getReportById($id);

  function report($report) {
     echo "<h3>".$report['title']."</h3>";
     echo "<br>";echo "<br>";
     echo "<h3>".$report['user_name']."</h3>";
     echo "<br>";echo "<br>";
     echo "<p>".$report['report']."</p>";
  
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
            <a href="bod.php">Home</a> 
            <a href="reports.php">Reports</a>   
        </div>      
        <div class="menu2"> 
            <a href="notifications.php">MY NOTIFICATIONS</a>
            <a href="logout.php">LOGOUT</a>
        </div>       
        <div class="main"> 
        <h3>Report</h3>
        <!-- Table Reports -->
        <?php report($report) ?>
        </div>
    </body>
<html>    