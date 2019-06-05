<?php

class Helpers {
    
    public function __construct() {

    }

    public function getUrlForUsr($type) {  
        header("Location: " . $type. ".php");
    }
    
    public function user($type, $user_name) {
        echo "<h4>[" . strtoupper($type) . "][" . $user_name . "]</h4>";
    }

    public function isAuthorized($userType) {
        $url = $_SERVER['REQUEST_URI'];

        if ((strpos($url, 'admin') !== false)) {
            if (strcmp($userType, 'admin') !== 0) {
                header("Location: index.php");
                return false;
            } 
        }

        if ((strpos($url, 'bod') !== false)) {
            if (strcmp($userType, 'bod') !== 0) {
                header("Location: index.php");
                return false;
            } 
        }

        if ((strpos($url, 'specialist') !== false)) {
            if (strcmp($userType, 'specialist') !== 0) {
                header("Location: index.php");
                return false;
            } 
        }

        if ((strpos($url, 'hr') !== false)) {
            if (strcmp($userType, 'hr') !== 0) {
                header("Location: index.php");
                return false;
            } 
        }

        if ((strpos($url, 'financier') !== false)) {
            if (strcmp($userType, 'financier') !== 0) {
                header("Location: index.php");
                return false;
            } 
        }

        if ((strpos($url, 'sales_director') !== false)) {
            if (strcmp($userType, 'sales_director') !== 0) {
                header("Location: index.php");
                return false;
            } 
        }

    }
}

?>