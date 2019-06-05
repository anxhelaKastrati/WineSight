
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

  $employees = $db->getAllSeasonalWorkers();

  function tblEmployees($employees) {

    echo "<table>";
    
    echo "<thead><tr><th>Name</th><th>Surname</th><th>Email</th></tr></thead>";

    for($x=0; $x<count($employees); $x++) { 
        echo "<tr><td>".$employees[$x]['name']."</td><td>".$employees[$x]['surname']."</td><td>".$employees[$x]['email']."</td></tr>";
    }

    echo "</table>";
  }

?>


<html>
    <head>

        <link rel="stylesheet" href="styles.css">

        <style>
            body {
                background: #e0e0eb;
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
                width: 40%; 
                padding: 10px; 
            }
            .menu a {
                border-radius: 5px;
                padding: 5px;
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
            <a href="hr.php">Home</a>
            <a href="addEmployee.php">Add Employee</a>
            <a href="seasonalWorkers.php">Seasonal Workers</a>
        </div>       
        <div class="menu2"> 
            <a href="notificationsH.php">MY NOTIFICATIONS</a>
            <a href="logout.php">LOGOUT</a>
        </div>      
        <div class="main">
        <!-- Table Employees -->
        <?php tblEmployees($employees); ?>
        </div>

    </body>
<html>    