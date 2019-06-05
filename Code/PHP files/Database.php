  <?php

class Database{
    public $isConn;
    protected $datab;

    // Tables

    const T_USERS = "users"; 
    const T_SEASONAL_WORKERS = "seasonal_workers";
    const T_SUPPLIERS = "suppliers";
    const T_INVOICES = "invoices";
    const T_ORDERS = "orders"; 
    
    const T_REPORTS = "reports";
    const T_ADMIN_HISTORY = "admin_history";
    const T_NOTIFICATION = "notifications";

    // Users 

    const USER_BOD = "bod";
    const USER_ADMIN = "admin";
    const USER_HR = "hr";
    const USER_SALES_DIRECTOR = "sales_director";
    const USER_SPECIALIST = "specialist";
    const USER_FINANCIER = "financier";
    const USER_SEASONAL_WORKER = "seasonal_worker";
    const USER_PRODUCTS = "products";

    // EMPLOYEE

    const EMPLOYEE_STATUS_UNAPPROVED = "not_approved";
    const EMPLOYEE_STATUS_APPROVED   = "approved";
    const ACTION_EDIT_EMPLOYEE = 'edit_employee';

    // PRODUCT

    const PRODUCT_STATUS_AVAILABLE = "available";
    const PRODUCT_STATUS_UNAVAILABLE  = "unavailable";

    // ORDER 

    const ORDER_STATUS_PENDING = "pending";
    const ORDER_STATUS_COMPLETED = "completed";
    
    // ADMIN ACTION HISTORY

    const ADMIN_ACTION_APPROVE_EMPLOYEE = "approve_employee";
    const ADMIN_ACTION_EDIT_EMPLOYEE = "edit_employee";
    const ADMIN_ACTION_REMOVE_EMPLOYEE = "remove_employee";
    
    const ADMIN_ACTION_APPROVE_SUPPLIER = "approve_supplier";
    const ADMIN_ACTION_REMOVE_SUPPLIER = "remove_supplier";

    // NOTIFICATION

    const NOTIFICATION_ORDER_CREATED = "order_created";
    const NOTIFICATION_ORDER_APPROVED = "order_approved";
    const NOTIFICATION_REPORT_UPLOADED = "report_uploaded";
    const NOTIFICATION_EMPLOYEE_ADDED = "employee_added";
    const NOTIFICATION_EMPLOYEE_APPROVED = "employee_appproved";
    const NOTIFICATION_EMPLOYEE_REMOVED = "employee_removed";
    const NOTIFICATION_EMPLOYEE_EDIT = "employee_edit";
    const NOTIFICATION_SUPPLIER_ADDED = "supplier_added";
    const NOTIFICATION_SUPPLIER_APPROVED = "supplier_approved";
    const NOTIFICATION_PRODUCT_ADDED = "product_added";
    const NOTIFICATION_PRODUCT_APPROVED = "product_approved";


    const NOTIFICATION_STATUS_SEEN = "seen";
    const NOTIFICATION_STATUS_UNSEEN = "unseen";

    // connect to db
    public function __construct($username = "root", $password = "", $host = "localhost", $dbname = "wine_sight", $options = []){
        $this->isConn = TRUE;
        try {
            $this->datab = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password, $options);
            $this->datab->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->datab->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }

    }

    // disconnect from db
    public function Disconnect(){
        $this->datab = NULL;
        $this->isConn = FALSE;
    }
    // get row
    public function getRow($query, $params = []){
        try {
            $stmt = $this->datab->prepare($query);
            $stmt->execute($params);
            return $stmt->fetch();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
    // get rows
    public function getRows($query, $params = []){
        try {
            $stmt = $this->datab->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
    // insert row
    public function insertRow($query, $params = []){
        try {
            $stmt = $this->datab->prepare($query);
            $stmt->execute($params);
            return TRUE;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
    // update row
    public function updateRow($sql){
		try{
        $stmt = $this->datab->prepare($sql);
		 $stmt->execute();
		 return TRUE;
		}
		catch(PDOException $e)
		{
            
		}
    }
    // delete row
    public function deleteRow($query, $params = []){
        $this->insertRow($query, $params);
    }
	// print table
	public function printTbl($stmt){
		while ($stmt->fetch())
			{
			$title = $row['title'];
			$body = $row['body'];
			echo "<tr>";
			echo "<td>" . $title . "</td>";
			echo "<td>" .$body . "</td>";
			echo "</tr>";
			}
    }
    
    public function login($uname, $pass) {
        $q = "SELECT * FROM users WHERE uname = '$uname' AND pass = '$pass' ";
        return $this->getRow($q);
    }

    public function getSupplierById($id) {
        $q = "SELECT * FROM suppliers WHERE `id` LIKE '$id' ";
        return $this->getRow($q);
    }

    public function getAllAdmins() { 
        $q = "SELECT * FROM `users` WHERE type LIKE 'admin'";
        return $this->getRows($q);
    }

    public function getAllReports() { 
        $q = "SELECT * FROM ". $this::T_REPORTS;
        return $this->getRows($q);
    }

    public function getAllEmployees() {
        $q = "SELECT * FROM ". $this::T_USERS;
        return $this->getRows($q);
    }

    public function getAllSuppliers() {
        $q = "SELECT * FROM ". $this::T_SUPPLIERS;
        return $this->getRows($q);
    }

    public function getAllOrders() {
        $q = "SELECT * FROM ". $this::T_ORDERS;
        return $this->getRows($q);
    }

    public function getEmployeeById($id) {
        $q = "SELECT * FROM users WHERE `id` LIKE '$id' ";
        return $this->getRow($q);
    }

    public function getReportById($id) {
        $q = "SELECT * FROM reports WHERE `id` LIKE '$id' ";
        return $this->getRow($q);
    }

    public function addNotification($n) {
        $for_type = $n['for_type'];
        $by_type = $n['by_type'];
        $by_name = $n['by_name'];
        $subject = $n['subject'];
        $status = $this::NOTIFICATION_STATUS_UNSEEN;

        $q = "INSERT INTO `notifications` (`for_type`, `by_type`, `by_name`, `status`, `subject`) VALUES ('$for_type', '$by_type', '$by_name', '$status', '$subject') ";
        $this->insertRow($q);
    }

    public function getAllNotificationsByType($type) {
        $status = $this::NOTIFICATION_STATUS_UNSEEN;

        $q = "SELECT * FROM `notifications` WHERE  `for_type` LIKE '$type' AND `status` LIKE '$status'  ";
        return $this->getRows($q);
    }

    public function clearNotificationById($id) {
        $status = $this::NOTIFICATION_STATUS_SEEN;

        $q = "UPDATE notifications SET `status` = '$status' WHERE `id` LIKE '$id' ";
        $this->updateRow($q);
    }

    public function addEmployee($e) {
        $date_created = time();
        $last_login = time(); 
        
        $uname = $e['uname'];
        $pass = $e['pass'];
        $name = $e['name'];
        $surname = $e['surname'];
        $bday = $e['bday'];
        $email = $e['email'];
        $phone = $e['phone'];
        $salary = $e['salary'];
        $academic_degree = $e['academic_degree'];
        $gender = $e['gender']; 
        $type = $e['type'];
        $status = $this::EMPLOYEE_STATUS_UNAPPROVED;

        $q = '';

        if (strcmp($type, $this::USER_SEASONAL_WORKER) == 0) {
            $q = "INSERT INTO `seasonal_workers` (`uname`, `pass`, `name`, `surname`, `bday`, `email`, `phone`, `salary`, `last_login`, `date_created`, `academic_degree`, `gender`, `type`, `status`) VALUES ('$uname', '$pass', '$name' ,'$surname', '$bday' , '$email', '$phone', '$salary' , '$last_login' , '$date_created', '$academic_degree', '$gender', '$type', '$status' )";
        } else {
            $q = "INSERT INTO `users` (`uname`, `pass`, `name`, `surname`, `bday`, `email`, `phone`, `salary`, `last_login`, `date_created`, `academic_degree`, `gender`, `type`, `status`) VALUES ('$uname', '$pass', '$name' ,'$surname', '$bday' , '$email', '$phone', '$salary' , '$last_login' , '$date_created', '$academic_degree', '$gender', '$type', '$status' )";
        }

        $this->insertRow($q);
    }
 
    public function addSupplier($e) { 
        $name = $e['name'];  
        $surname = $e['surname']; 
        $email = $e['email'];
        $phone = $e['phone'];
        $status = $this::EMPLOYEE_STATUS_UNAPPROVED;

        $q = '';

        $q = "INSERT INTO `suppliers` (`name`, `surname`, `email`, `phone`, `status`) VALUES ('$name', '$surname', '$email' ,'$phone', '$status' )";

        $this->insertRow($q);
    }

    public function addProduct($e) {
        $category = $e['category'];
        $description = $e['description']; 
        $name = $e['name'];  
        $price = $e['price'];
        $quantity = $e['quantity']; 
        $supplier_id = $e['supplier_id'];
        $status = $this::PRODUCT_STATUS_AVAILABLE;

        $q = '';

        $q = "INSERT INTO `products` (`name`, `price`, `category`, `description`, `status`, `quantity`, `supplier_id`) VALUES ('$name', '$price', '$category' ,'$description', '$status', '$quantity', '$supplier_id')";
        $this->insertRow($q);
    }

    public function orderProduct($p, $user_id, $user_name) {
        $product_id = $p['id'];
        $product_name = $p['name'];
        $product_description = $p['description'];
        $quantity = $p['quantity'];
        $price =  $p['price'];
        $amount = $price * $quantity;
        $status = $this::ORDER_STATUS_PENDING;

        if ($quantity > 0) {
            $q = "INSERT INTO `orders` (`product_name`, `product_description`, `quantity`,`price`, `amount`, `status`, `user_id`, `user_name`, `product_id`) VALUES ('$product_name', '$product_description', '$quantity', '$price', '$amount', '$status', '$user_id', '$user_name', '$product_id')";
            $this->insertRow($q);
        }
    }

    public function orderProducts($products,  $user_id, $user_name) {
        for($x=0; $x<count($products); $x++) {  
            $this->orderProduct($products[$x],  $user_id, $user_name); 
        }
    }

    public function addInvoice($invoice, $invoice_name) {
        $category = 'Product';
        $date = time();
        $status = "Paid";
        $am = 0;

        for($x=0; $x<count($invoice); $x++) { 
            $am += $invoice[$x]['amount'];
        }

        $q = "INSERT INTO `invoices` (`amount`, `category`, `date`, `name`, `status`) VALUES ('$am', '$category', '$date', '$invoice_name', 'paid')";
        $this->insertRow($q);

    }

    public function getAllInvoices() {
        $q = "SELECT * FROM ". $this::T_INVOICES;
        return $this->getRows($q);
    }

    public function removeEmployee($id, $type) {
        $q = '';

        if (strcmp($type, $this::USER_SEASONAL_WORKER) == 0) {
            $q = "DELETE FROM `seasonal_workers` WHERE id='$id'";
        } else {
            $q = "DELETE FROM `users` WHERE id='$id'";
        }
        
        $this->deleteRow($q);
        $this->addToAdminHistory($this::ADMIN_ACTION_REMOVE_EMPLOYEE, $id);
    }

    public function editSalary($id, $type, $salary) { 
        $id = (int)$id;
        $q = '';
        
        if (strcmp($type, $this::USER_SEASONAL_WORKER) == 0) {
            $q = "UPDATE seasonal_workers SET `salary` = '$salary' WHERE `id` LIKE '$id' ";
        } else {
            $q = "UPDATE users SET `salary` = '$salary' WHERE `id` LIKE '$id' ";
        }

        $this->updateRow($q); 
    }


    public function approveEmployee($id) {
        $status = "status";
        $statusValue = $this::EMPLOYEE_STATUS_APPROVED;
        $id = (int)$id;
        
        $q = "UPDATE users SET `status` = '$statusValue' WHERE `id` LIKE '$id' ";
        $this->updateRow($q);
        $this->addToAdminHistory($this::ADMIN_ACTION_APPROVE_EMPLOYEE, $id);
    }

    public function approveSupplier($id) {
        $status = "status";
        $statusValue = $this::EMPLOYEE_STATUS_APPROVED;
        $id = (int)$id;
        
        $q = "UPDATE suppliers SET `status` = '$statusValue' WHERE `id` LIKE '$id' ";
        $this->updateRow($q);
        $this->addToAdminHistory($this::ADMIN_ACTION_APPROVE_SUPPLIER, $id);
    }

    public function getAllSeasonalWorkers() {
        $q = "SELECT * FROM ". $this::T_SEASONAL_WORKERS;
        return $this->getRows($q);
    }

    public function addToAdminHistory($action, $desc) {
        $time = time();
        $adminId = '0';
        $adminName = 'admin_name';
        if (isset($_SESSION['admin_id'])) {
            $adminId = $_SESSION['admin_id'];
            $adminName = $_SESSION['admin_name'];
        } 

        $q = "INSERT INTO `admin_history`(`action`, `desc`, `time`, `admin_id`, `admin_name`) VALUES ('$action','$desc', '$time', '$adminId', '$adminName')";
        $this->insertRow($q);
    }

    public function getHistoryForAdmin($id) {
        $q = "SELECT * FROM admin_history WHERE admin_id LIKE $id";
        return $this->getRows($q);
    }

    public function specilistAddReport($userId, $userName, $title, $report) {
        $time = time(); 

        $q = "INSERT INTO `reports` (`user_id`, `report`, `time`, `user_name`, `title`) VALUES ('$userId', '$report', '$time', '$userName', '$title')";
        $this->insertRow($q);
    }  

    public function getAllProducts() { 
        $q = "SELECT * FROM `products`";
        return $this->getRows($q);
    }
}

?>
