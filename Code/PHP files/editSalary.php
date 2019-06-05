<?php
  
  include("Database.php");
  include("helpers.php");

  session_start();
  $db = new Database();
  $h = new Helpers();
  $errorMessage = ''; 
  $employeeId = '';
  $employeeType = '';
  $user_name = '';

  if (isset($_SESSION['user_type'])) {
    $h->isAuthorized($_SESSION['user_type']);
    $user_type = $_SESSION['user_type'];
  }

  if (isset($_SESSION['user_name'])) {
    $user_name = $_SESSION['user_name'];
  }
  
  
  $formAction = "editSalary.php?id=".$employeeId;

  if (isset($_GET['id'])) {
      $employeeId = $_GET['id'];
      $employee = $db->getEmployeeById($employeeId);
      
      $employeeType = $employee['type'];
      $formAction = 'editEmployee.php?id='.$employee['id'];
  }
  

  if (isset($_POST['edit'])) {

  }
  
  if (isset($_POST['remove']) && isset($_POST['salary'])) {
      $db->editSalary($employeeId, $employeeType, $_POST['salary']);

        $n['for_type'] = 'admin';
        $n['by_type'] = 'hr';
        $n['by_name'] = $user_name; 
        $n['subject'] = $db::NOTIFICATION_EMPLOYEE_EDIT;

        $db->addNotification($n);
  }

?>

<html>
    <head>

        <link rel="stylesheet" href="styles.css">

        <style>
            body {
                background: #fafafa;
                padding-left: 25%;
            }
            .main {
                margin-top: 70px;
                width: 100%;
                
            }
            table {
                border: 3px solid gray;
                padding: 10px 0;
                width: 60%;
            }
            table td {
                border-bottom: 1px solid gray;
                padding: 2px;
                
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
            .action {
                border-radius: 5px;
                font-size: 16px;
                padding: 10px;
                background: orange;
                color: #1a1a1a;
                width: 70%;
            }
            strong {
                font-size: 20px;
                margin-left: 20px;
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
            <a href="notifications.php">MY NOTIFICATIONS</a>
            <a href="logout.php">LOGOUT</a>
        </div>        
        <div class="main">
        <!-- Edit Employee's Salary -->
        <form action="<?php $formAction ?>" method="post"> 
            <h3>Enter new salary for employee: </h3>
            <input type="text" name="salary" value="Salary" placeholder="salary" />
            <input class="action" name="remove" value="Edit" type="submit" />
        </form>
        </div>
    </body>
<html>    