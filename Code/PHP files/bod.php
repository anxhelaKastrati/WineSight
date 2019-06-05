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
  

  $admins = $db->getAllAdmins();

  function tblAdmin($admins) {
    
    echo "<thead><tr><th>Name</th><th>Surname</th><th>History</th></tr></thead>";

    for($x=0; $x<count($admins); $x++) {  
        echo "<tr><td>".$admins[$x]['name']."</td><td>".$admins[$x]['surname']."</td><td><input class=". "'"."action"."'"." name="."'"."".$admins[$x]['id']."'"."  value="."'"."CHECK HISTORY"."'"."  type="."'"."submit"."'".  "/></tr>";
    }
  }
  
    // Check History

    for($x=0; $x<count($admins); $x++) { 
   
        if (isset($_POST[''.$admins[$x]['id']])) {
            header("Location: history.php?id=".$admins[$x]['id']);
          }
    
      }
      

  ?>



<html>
    <head>

        <link rel="stylesheet" href="styles.css">

        <style>
            body {
				
        background-image: url("bd.png");
		background-size: 1200px 700px;
		 background-repeat: no-repeat;

 
               
                padding-left: 15%;
                

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
			h2{
				color:blue;
				position:relative;
				
				bottom:70px;
				left:322px;
		
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
            <a href="notificationsB.php">MY NOTIFICATIONS</a>
            <a href="logout.php">LOGOUT</a>
        </div>    
        <div class="main">
        <!-- Table Admins -->
        <h2>Table of Admins</h2>
        <form action="bod.php" method="post">
            <table> 
                <?php tblAdmin($admins); ?>
            </table>
        </form>
        </div>
    </body>
<html>    