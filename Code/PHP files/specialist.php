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
  

  $userId = '';
  $userName = ''; 

  if (isset($_SESSION['user_id']) && isset($_SESSION['user_name'])) {

    $userId = $_SESSION['user_id'];
    $userName = $_SESSION['user_name'];  

  }

    if (isset($_POST['title']) && isset($_POST['report']) && isset($_POST['submit'])) {

        if (isset($_SESSION['user_id']) && isset($_SESSION['user_name'])) {

            $userId = $_SESSION['user_id'];
            $userName = $_SESSION['user_name'];
            
            $db->specilistAddReport($userId, $userName, $_POST['title'], $_POST['report']);

            $n['for_type'] = 'admin';
            $n['by_type'] = 'specialist';
            $n['by_name'] = $user_name; 
            $n['subject'] = $db::NOTIFICATION_REPORT_UPLOADED;
          
            $db->addNotification($n);
        } 
    }


  ?>


<html>
    <head>

        <link rel="stylesheet" href="styles.css">

        <style>
            body {
                background-image: url("bc.jpg");
                padding-left: 25%;
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
                width: 40%; 
                padding: 10px; 
            }
            .menu a {
                border-radius: 5px;
                padding: 10px;
                background: purple;
                color: white;
                font-size: 18px;
                text-decoration: none;
                margin-right: 20px;
                -webkit-box-shadow: -1px 10px 26px -4px rgba(0,0,0,0.75);
                -moz-box-shadow: -1px 10px 26px -4px rgba(0,0,0,0.75);
                box-shadow: -1px 10px 26px -4px rgba(0,0,0,0.75);
            }
            .btn {
                border-radius: 5px;
                font-size: 16px;
                padding: 10px;
                background: orange;
                color: #1a1a1a;

            } 
            form {
                width: 70%;
                
            }
            form input {
                width: 70%;
                margin-bottom: 20px;
            }
            .input {
                height: 200px;
            }
            .menu2 {
                width: 70%; 
                padding: 10px; 
                text-align: right;
            }
            .menu2 a {

                text-decoration: none;
                background: purple;
                color: white;
                font-size: 14px;
                border-radius: 5px;
                padding: 5px;
            }
			h2{
				color:white;
			}
        </style>

    </head>
    <body>
        <div class="menu">
            <?php $h->user($user_type, $user_name); ?>
            <a href="specialist.php">Home</a>  
        </div>        
        <div class="menu2"> 
            <a href="notificationsSS.php">MY NOTIFICATIONS</a>
			  <a href="catalogue.php">Catalogue</a>
			   <a href="vineyard.php">Vineyard</a>
            <a href="logout.php">LOGOUT</a>
			
        </div>     
        <div class="main">
        <!-- Form Report -->
        <h2>Upload a report </h2>
        <form action="specialist.php" method="post">
            <input type="text" value="title" name="title" placeholder="title" /><br>
            <input type="text" class="input" value="report" name="report" placeholder="Write your report here" /><br> 
            <input class="btn" type="submit" value="submit" name="submit" value="Upload Report" />
        </form>
        </div>
    </body>
<html>    