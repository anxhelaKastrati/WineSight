
<?php
  
  include("Database.php");
  include("helpers.php");

  session_start();
  $db = new Database();
  $h = new Helpers();
  $errorMessage = ''; 
  $user_name = '';
  $user_type = '';

  if (isset($_SESSION['user_type'])) {
    $h->isAuthorized($_SESSION['user_type']);
    $user_type = $_SESSION['user_type'];
  }

  if (isset($_SESSION['user_name'])) {
    $user_name = $_SESSION['user_name'];
  }
 
  $notifications = $db->getAllNotificationsByType($user_type);

  function tblNotifications($notifications) {
    
    echo "<thead><tr><th>From User</th><th>From Type</th><th>Subject</th><th>Status</th><th>Action</th></tr></thead>";

    for($x=0; $x<count($notifications); $x++) {   
        echo "<tr><td>".$notifications[$x]['by_name']."</td><td>".$notifications[$x]['by_type']."</td><td>".$notifications[$x]['subject']."</td><td>".$notifications[$x]['status']."</td><td><input class=". "'"."action"."'"." name="."'"."".$notifications[$x]['id']."'"."  value="."'"."CLEAR"."'"."  type="."'"."submit"."'".  "/></tr>";
    }
  }

  
  // Clear notification

  for($x=0; $x<count($notifications); $x++) { 
   
    if (isset($_POST[$notifications[$x]['id']])) {
        
        $id = $notifications[$x]['id'];
        
        $db->clearNotificationById($id);

      }

  }

  

?>


<html>
    <head>

        <link rel="stylesheet" href="styles.css">

        <style>
             
            .main {
                margin-top: 70px;
                width: 100%;
                
            }
            
            body {
                background: #fafafa;
                padding-left: 10%;
            }
            table {
                border: 3px solid gray;
                padding: 10px 0;
                width: 90%;
                background: white;
            }
            table td {
                border-bottom: 1px solid gray;
                padding: 2px;
                height: 40px; 
                text-align: center;
            }
            table td .action {
                border-radius: 5px;
                font-size: 16px;
                padding: 10px;
                background: orange;
                color: #1a1a1a; 

            }
            table .ac {
                margin-left: 50px;
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
        <div class="menu2"> 
            <a href="notificationsS.php">MY NOTIFICATIONS</a>
            <a href="logout.php">LOGOUT</a>
			<a href="sales_director.php">Go back</a>
        </div>
        <div class="main">
        <!-- Notificatiosn -->
        <form action="notificationsS.php" method="post">
            <h3>Notifications</h3>
            <table> 
                <?php tblNotifications($notifications); ?>
            </table>
        </form>
        </div>
    </body>
<html>    