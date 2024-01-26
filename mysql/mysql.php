<?php
/**
 * Establishes a connection to the database.
 * Utilizes global variables for connection parameters and creates a mysqli connection.
 * Outputs an error message and exits if the connection fails.
 */
    function Connection(){
        global $connection;

        $host = "localhost";
        $database = "loginapp";
        $username = "root";
        $password = "";

        $connection = mysqli_connect($host, $username, $password, $database);

        if(mysqli_connect_error()){
            echo mysqli_connect_error();
            exit;
        }
    }
    /**
 * Updates the user's profile in the database.
 * 
 * @param string $username The current username.
 * @param string $newUsername The new username to be set.
 * @param string $newPassword The new password to be set.
 * @return bool Returns true if the update is successful, false otherwise.
 */
        
    function updateUserProfile($username, $newUsername, $newPassword) {
        global $connection;
        $query = "UPDATE users SET username = ?, password = ? WHERE username = ?";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "sss", $newUsername, $newPassword, $username);
        return mysqli_stmt_execute($stmt);
    }
    /**
 * Checks if the provided password meets the minimum security requirements.
 * 
 * @param string $password The password to be validated.
 * @return bool Returns true if the password is valid, false otherwise.
 */
    function isPasswordValid($password) {
        return strlen($password) >= 8 && preg_match("/\d/", $password);
    }
    
/**
 * Adds a user to the database after performing validations.
 * Validates username, password and confirms password, then adds the user to the database if all validations pass.
 * Redirects to login page upon successful addition.
 * 
 * @return string Returns the username if an error occurs, otherwise returns an empty string.
 */
  
    function AddFun() {
        global $connection;   
    
        $username = $_POST["username"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];
    
        if (!empty($username) && !empty($password) && !empty($confirm_password)) {

            if(strlen($username) < 8){
                echo "<div class='error-php'>The username must be at least 8 characters long</div>";
                return $username;
            }

            if(strlen($password) < 8 || !preg_match("/\d/", $password)){
                echo "<div class='error-php'>The password must be at least 8 characters long and must contain at least one number.</div>";
                return $username;
            }
            if (CheckUser($username)) {
                echo "<div class='error-php'>Username already exists!</div>";
                return $username;
            }
            if ($password === $confirm_password) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
                $query = "INSERT INTO users(username, password) VALUES(?, ?)";
                $stmt = mysqli_prepare($connection, $query);
                mysqli_stmt_bind_param($stmt, "ss", $username, $hashed_password);
                $result = mysqli_stmt_execute($stmt);  

                if (!$result) {
                    die("ERROR");
                }
                header("Location: login.php");
                return '';
            } else {
                echo "<div class='error-php'>Hesla nejsou stejná</div>";
                return $username;
            }
        } else {
            echo "<div class='error-php'>Vyplňte vše pole formulare</div>";
            return $username;
      }
    }
  /**
 * Handles user login.
 * Validates user credentials, starts a session, and redirects to the index page if successful.
 * 
 * @return string Returns the username if an error occurs, otherwise returns an empty string.
 */
    function Login(){

        global $connection;
        session_start();

        $username = $_POST["username"];
        $password = $_POST["password"];

        if (!empty($username) && !empty($password)) {
            $query = "SELECT * FROM users WHERE username = ?";
            $stmt = mysqli_prepare($connection, $query);
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if($row = mysqli_fetch_assoc($result)){

                if(password_verify($password, $row["password"])){
                    $_SESSION["logged"] = true;
                    $_SESSION["username"] = $username; 
              
                    header("Location: index.php");
                    return '';
                }else{
                    echo "<div class='error-php'>Nesravne heslo</div>";
                    return $username;
                }
            } else{
                echo "<div class='error-php'>Neexistijici uzivatel</div>";
                return $username;
            }
        } else {
            echo "<div class='error-php'>Vypln vse pole</div>";
            return $username;
        }
    }
/**
 * Checks if a username already exists in the database.
 * 
 * @param string $username The username to check.
 * @return bool Returns true if the username exists, false otherwise.
 */
    function CheckUser($username){
        global $connection;

        $query = "SELECT * FROM users WHERE username = ?";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        return mysqli_num_rows($result) > 0;
    }
    /**
 * Retrieves user data based on username.
 * 
 * @param string $username The username for which to retrieve data.
 * @return array Returns an associative array of user data.
 */

    function GetUsername($username) {
        global $connection;
    
        $query = "SELECT * FROM users WHERE username = ?";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        return mysqli_fetch_assoc($result);
    }

    /**
 * Executes a prepared query with the provided parameters.
 * 
 * @param mysqli $connection The database connection object.
 * @param string $query The SQL query to be executed.
 * @param array $params An array of parameters for the prepared statement.
 * @return mysqli_stmt Returns the prepared statement object.
 */
    function executeQuery($connection, $query, $params) {
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, str_repeat("s", count($params)), ...$params);
        mysqli_stmt_execute($stmt);
        return $stmt;
    }
    /**
 * Checks if the user has already made a reservation.
 * 
 * @param string $username The username to check for a reservation.
 * @return bool Returns true if the user has a reservation, false otherwise.
 */
    function hasUserAlreadyReserved($username) {
        global $connection;
        $stmt = executeQuery($connection, "SELECT reservation FROM users WHERE username = ?", [$username]);
        $userResult = mysqli_stmt_get_result($stmt);
        if ($userRow = mysqli_fetch_assoc($userResult)) {
            return !empty($userRow['reservation']);
        }
        return false;
    }
    /**
 * Reserves a date for a user.
 * 
 * @param string $username The username for which the reservation is to be made.
 * @param string $date The date to reserve.
 * @return bool Returns true if the reservation was successful, false otherwise.
 */
    function reserveDateForUser($username, $date) {
        global $connection;
        $stmt = executeQuery($connection, "UPDATE users SET reservation = ? WHERE username = ?", [$date, $username]);
        return mysqli_stmt_affected_rows($stmt) > 0;
    }
    /**
 * Checks if a reservation date is available.
 * 
 * @param string $date The date to check.
 * @return bool Returns true if the date is available, false otherwise.
 */
    function isReservationDateAvailable($date) {
        global $connection;
        $query = "SELECT * FROM users WHERE reservation = ?";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "s", $date);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_num_rows($result) == 0;
    }
    /**
 * Gets the total number of rows in the 'packages' table.
 * 
 * @param mysqli $connection The database connection object.
 * @return int Returns the total number of rows.
 */
    function getTotalRows($connection) {
        $totalRowsResult = $connection->query("SELECT COUNT(*) FROM packages");
        $totalRowsArray = $totalRowsResult->fetch_array();
        return $totalRowsArray[0];
    }
    /**
 * Retrieves paginated data from the 'packages' table.
 * 
 * @param mysqli $connection The database connection object.
 * @param int $startOffset The offset to start fetching rows from.
 * @param int $itemsPerPage The number of items to fetch.
 * @return mysqli_result Returns the result set of the executed query.
 */
    
    function getPaginatedData($connection, $startOffset, $itemsPerPage) {
        $stmt = $connection->prepare("SELECT * FROM packages LIMIT ?, ?");
        $stmt->bind_param("ii", $startOffset, $itemsPerPage);
        $stmt->execute();
        return $stmt->get_result();
    }


?>