
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
 
  $employees = $db->getAllEmployees();

  function tblEmployees($employees, $db) {
    
    echo "<thead><tr><th>Name</th><th>Surname</th><th>Position</th><th>Status</th><th>Action</th></tr></thead>";

    for($x=0; $x<count($employees); $x++) {  
        if (strcmp($employees[$x]['status'], $db::EMPLOYEE_STATUS_UNAPPROVED) == 0) {
            echo "<tr><td>".$employees[$x]['name']."</td><td>".$employees[$x]['surname']."</td><td>".$employees[$x]['type']."</td><td><p>".$employees[$x]['status']."</p></td><td ><input name="."'"."".$employees[$x]['id']."'"."  value="."'"."APPROVE"."'"." class=". "'"."action"."'"." type="."'"."submit"."'".  "/></td></td></tr>";
        } else {
            echo "<tr><td>".$employees[$x]['name']."</td><td>".$employees[$x]['surname']."</td><td>".$employees[$x]['type']."</td><td><p>".$employees[$x]['status']."</p></td></td></td></tr>";
        }
    }
  }

  
  // Approve

  for($x=0; $x<count($employees); $x++) { 
   
    if (isset($_POST[''.$employees[$x]['id']])) {
        header("Location: approveEmployee.php?id=".$employees[$x]['id']);
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
                  background-image: url("12.jpg");
				background-size: 1300px 300px;
					 background-repeat: no-repeat;
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
                background: green;
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
                background: green;
                color: white;
                font-size: 14px;
                border-radius: 5px;
                padding: 5px 12px;
				position:relative;
				top:0px;
				left:100;
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
        <!-- Table Users -->
        <form action="admin.php" method="post">
            <h3>Table of Users</h3>
            <table> 
                <?php tblEmployees($employees, $db); ?>
            </table>
        </form>
        </div>
    </body>
<html>    