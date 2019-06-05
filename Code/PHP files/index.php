<?php
  
  include("Database.php");
  include("helpers.php");

  session_start();
  $db = new Database();
  $h = new Helpers();
  $errorMessage = '';

  // Login

  if (isset($_POST['uname']) && isset($_POST['password']) && isset($_POST['submit'])) {

        $user = $db->login($_POST['uname'], $_POST['password']);
        if ($user) {
            
            $type = $user['type'];
            
            // Logged In

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['uname'];
            $_SESSION['user_type'] = $type;

            if (strcmp($type, $db::USER_ADMIN) == 0) {

                $_SESSION['admin_id'] = $user['id'];
                $_SESSION['admin_name'] = $user['uname'];
            }

            $h->getUrlForUsr($type);


        } else {
            
            // Not Logged In

            $errorMessage = 'Wrong credentials!';
           
        }
    }

    

?>

<html>
    <head>

        <link rel="stylesheet" href="styles.css">

        <style>
		body{
			background-color:#FFE3E5;
		}
	
            .index-form {
                width: 250px;
                height: 250px;
                background: white;
                border: 1px solid gray; 
                position: absolute;
                left: 0;
                right: 0;
                bottom: 0;
                top: 0;
                margin-left: auto;
                margin-right: auto;
                margin-top: auto;
                margin-bottom: auto;
                padding: 20px;
                
            }
            .index-form form {
                margin-top: 50px;
                text-align: center;
            }
            .error {
                width: 100%;
                text-align: center;
                color: red;
            }
            .text {
                height: 30px;
                margin-bottom: 15px;
                color: #1a1a1a;
                font-size: 18px;
                border-radius: 0;
                padding: 10px;
                background: white;
                border: 1px solid gray;

            }
            .action {
                border-radius: 5px;
                font-size: 16px;
                padding: 10px;
                background: black;
                color:white;
            }
			
				
        </style>
    </head>
    <body>
	<a>
	<img src="logo.png" style="width:555px;height:550px;">
	</a>
        <div class="index-form">
            <h2>Welcome to WineSight</h2>
            <div class="form">
                <form action="index.php" method="post">   
                    <input class="text" type="text" name="uname" value="" placeholder="Username"><br><br>
                    <input class="text" type="password" name="password" value="" placeholder="Password"><br><br>
                    <input class="action" type="submit" name="submit" value="LOGIN"><br><br>
                </form>   
                <p class="error"><?php echo $errorMessage ?></p>
            </div>  
        </div>
    </body>
</html>