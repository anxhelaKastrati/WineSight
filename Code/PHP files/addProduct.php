
<?php
  
  include("Database.php");
  include("helpers.php");

  session_start();
  $db = new Database();
  $h = new Helpers();
  $errorMessage = ''; 
  $formAction = '';
  $name = '';
  $user_name = '';

  if (isset($_SESSION['user_type'])) {
    $h->isAuthorized($_SESSION['user_type']);
    $user_type = $_SESSION['user_type'];
  }

  if (isset($_SESSION['user_name'])) {
    $user_name = $_SESSION['user_name'];
  }
  
  if (isset($_GET['supplier_id'])) {
        $id = $_GET['supplier_id'];
        $name = $_GET['supplier_name'];
        $formAction = "addProduct.php?supplier_name=".$name."&supplier_id=".$id;  
    }


  // Add Product

  if (isset($_POST['name']) && isset($_POST['description']) && isset($_POST['category']) && isset($_POST['price']) && isset($_POST['quantity']) && isset($_POST['submit'])) {

        $e['name'] = $_POST['name'];;
        $e['description'] = $_POST['description'];
        $e['category'] = $_POST['category']; 
        $e['price'] = $_POST['price']; 
        $e['quantity'] = $_POST['quantity']; 
        $e['supplier_id'] = $_GET['supplier_id'];   
        
        $db->addProduct($e);
        $errorMessage = 'Product added!';
        
        $n['for_type'] = 'admin';
        $n['by_type'] = 'sales_director';
        $n['by_name'] = $user_name; 
        $n['subject'] = $db::NOTIFICATION_PRODUCT_ADDED;

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
            table {
                border: 3px solid gray;
                padding: 10px 0;
                width: 60%;
            }
            table td {
                border-bottom: 1px solid gray;
                padding: 2px;
                
            }
            .main {
                margin-top: 70px;
                width: 100%;
                
            }
            .menu {
                width: 60%; 
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
            .form-holder {
                margin-top: 10px;
                width: 100%;
                display: flex;
            }
            .form-holder .col {
                width: 30%;
            }
            .form-holder .col input {
                width: 200px;
                margin-bottom: 10px;
                font-size: 16px;
                color: black;
                padding: 5px 5px 5px 0; 
            }
            .btn {
                width: 50%;
                text-align: center;
                height: 40px;
                background: green;
                color: white;
                padding: 10px;
                border-radius: 5px;
                font-size: 18px;
                margin-top: 30px;

            } 
            .radio {
                margin-top: 20px;
                margin-right: 10px;
            }
            h4 {
                width: 50%;
                text-align: right;
            }
            span {
                color: blue;
                font-size: 19px;
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
        <h4>[Sales Director]</h4>
        <div class="menu">
            <?php $h->user($user_type, $user_name); ?>
            <a href="sales_director.php">Home</a> 
            <a href="suppliers.php">Add Products</a> 
            <a href="addSupplier.php">Add Supplier</a> 
            <a href="order_products.php">Order Products</a>
        </div>         
        <div class="menu2"> 
            <a href="notifications.php">MY NOTIFICATIONS</a>
            <a href="logout.php">LOGOUT</a>
        </div>    
        <div class="main">
        <!-- Form Add Product -->
        <h3>Add new product for <?php echo "<span>".$name ."</span>"  ?></h3>
         <form action="<?php $formAction ?>" method="post"> 
            <div class="form-holder">
                <div class="col"> 
                    <input type="text" placeholder="Name" name="name" /><br>
                    <input type="text" placeholder="Description" name="description" /><br>
                    <input type="text" placeholder="Category" name="category" /><br> 
                </div>
                <div class="col">
                    <input type="text" placeholder="Price" name="price" /><br>
                    <input type="text" placeholder="Quantity" name="quantity" /><br>
                </div> 
            </div>  
                <input class="btn" type="submit" name="submit" value="ADD" />
                <br>
                <?php echo $errorMessage; ?>
        </form>
        </div>
    </body>
<html>    