// config.php
<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');     // Change in production
define('DB_PASS', '');         // Change in production
define('DB_NAME', 'ementor_db');

// Application configuration
define('SITE_NAME', 'E-Mentor Educational Platform');
define('SITE_URL', 'http://localhost/ementor');  // Change in production

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);  // Set to 0 in production

// Session configuration
ini_set('session.cookie_lifetime', 0);
ini_set('session.gc_maxlifetime', 3600);
session_start();

// Timezone setting
date_default_timezone_set('UTC');  // Change as per your timezone
?>

// database.php
<?php
require_once 'config.php';

class Database {
    private $connection;
    
    public function __construct() {
        $this->connect();
    }
    
    private function connect() {
        try {
            $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            
            if ($this->connection->connect_error) {
                throw new Exception("Connection failed: " . $this->connection->connect_error);
            }
            
            $this->connection->set_charset("utf8mb4");
        } catch (Exception $e) {
            error_log($e->getMessage());
            die("Database connection failed. Please try again later.");
        }
    }
    
    public function query($sql) {
        $result = $this->connection->query($sql);
        if (!$result) {
            error_log("Query failed: " . $this->connection->error);
            return false;
        }
        return $result;
    }
    
    public function prepare($sql) {
        return $this->connection->prepare($sql);
    }
    
    public function escape($string) {
        return $this->connection->real_escape_string($string);
    }
    
    public function getLastId() {
        return $this->connection->insert_id;
    }
    
    public function close() {
        $this->connection->close();
    }
}
?>

// functions.php
<?php
require_once 'config.php';
require_once 'database.php';

// User Authentication Functions
function loginUser($email, $password) {
    $db = new Database();
    $email = $db->escape($email);
    
    $sql = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
    $result = $db->query($sql);
    
    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            return true;
        }
    }
    return false;
}

function logoutUser() {
    session_destroy();
    header('Location: index.php');
    exit();
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Course Related Functions
function getCourses() {
    $db = new Database();
    $sql = "SELECT * FROM courses ORDER BY created_at DESC";
    $result = $db->query($sql);
    
    $courses = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $courses[] = $row;
        }
    }
    return $courses;
}

function getUserCourses($user_id) {
    $db = new Database();
    $user_id = $db->escape($user_id);
    
    $sql = "SELECT c.* FROM courses c 
            JOIN user_courses uc ON c.id = uc.course_id 
            WHERE uc.user_id = '$user_id'";
    
    $result = $db->query($sql);
    
    $courses = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $courses[] = $row;
        }
    }
    return $courses;
}

// Utility Functions
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function generateRandomString($length = 10) {
    return bin2hex(random_bytes($length));
}

function redirectTo($page) {
    header("Location: $page");
    exit();
}

function displayMessage($message, $type = 'info') {
    $_SESSION['message'] = $message;
    $_SESSION['message_type'] = $type;
}

function getMessage() {
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
        $type = $_SESSION['message_type'];
        unset($_SESSION['message']);
        unset($_SESSION['message_type']);
        return ["message" => $message, "type" => $type];
    }
    return null;
}
?>
